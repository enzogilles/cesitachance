<?php
// app/controller/CandidatureController.php

namespace app\controller;

use app\controller\BaseController;
use App\Model\Candidature;

class CandidatureController extends BaseController {

    public function index() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['user']['id'])) {
            header("Location: " . BASE_URL . "login.php");
            exit;
        }
        
        $userId   = $_SESSION['user']['id'];
        $userRole = $_SESSION['user']['role'];
        
        // On récupère la liste via les méthodes du modèle :
        if ($userRole === 'Admin') {
            $candidatures = Candidature::findAllWithRelations();
        } else {
            $candidatures = Candidature::findAllByUserIdWithRelations($userId);
        }
        
        $this->render('candidatures/index.twig', [
            'candidatures' => $candidatures,
            'userRole' => $userRole
        ]);
    }

    /**
     * Postuler à une offre avec CV et lettre de motivation.
     */
    public function postuler() {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            
            if (!isset($_SESSION['user']['id'])) {
                die("Erreur : utilisateur non connecté.");
            }
    
            $userId = $_SESSION['user']['id'];
            $offreId = $_POST['offre_id'];
            $dateCandidature = date('Y-m-d');
    
            // Vérification et création du dossier d'upload si nécessaire
            $uploadDir = __DIR__ . '/../../uploads/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }
    
            // Upload du CV
            if (isset($_FILES['cv']) && $_FILES['cv']['error'] === 0) {
                $cvTmpPath = $_FILES['cv']['tmp_name'];
                $cvName = basename($_FILES['cv']['name']);
                $cvDestination = $uploadDir . time() . "_" . $cvName;
    
                if (!move_uploaded_file($cvTmpPath, $cvDestination)) {
                    die("Erreur lors du téléchargement du fichier.");
                }
            } else {
                die("Erreur : veuillez fournir un CV au format PDF.");
            }
    
            $lettreMotivation = isset($_POST['lettre_motivation']) ? trim($_POST['lettre_motivation']) : '';

            // On utilise maintenant le Model pour créer / sauvegarder la candidature
            $candidature = new Candidature();
            $candidature->user_id = $userId;
            $candidature->offre_id = $offreId;
            $candidature->cv = 'uploads/' . time() . "_" . $cvName;
            $candidature->lettre = $lettreMotivation;
            $candidature->date_soumission = $dateCandidature;
            // On peut définir un statut par défaut
            $candidature->statut = 'en attente';
            $candidature->save();

            // Redirection
            header("Location: " . BASE_URL . "index.php?controller=offre&action=detail&id=$offreId&success=1");
            exit();
        }
    }

    /**
     * Met à jour le statut d'une candidature (Admin / Pilote).
     */
    public function updateStatus() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['user']) || !in_array($_SESSION['user']['role'], ['Admin','pilote'])) {
            header("Location: " . BASE_URL . "index.php?controller=home&action=index");
            exit;
        }
    
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $candidatureId = $_POST['candidature_id'];
            $nouveauStatut = $_POST['statut'];

            // Model
            Candidature::updateStatus($candidatureId, $nouveauStatut);
    
            header("Location: " . BASE_URL . "index.php?controller=candidature&action=index");
            exit;
        }
    }
}
