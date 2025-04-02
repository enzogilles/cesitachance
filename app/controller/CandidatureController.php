<?php
// app/controller/CandidatureController.php

namespace app\controller;

use PDO;
use PDOException;

require_once __DIR__ . '/../config/database.php';

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
        $pdo = \Database::getInstance();
        
        if ($userRole === 'Admin') {
            $sql = "SELECT candidature.id, entreprise.nom AS entreprise, offre.titre,
                           candidature.date_soumission, candidature.cv, candidature.lettre, candidature.statut
                    FROM candidature
                    INNER JOIN offre ON candidature.offre_id = offre.id
                    INNER JOIN entreprise ON offre.entreprise_id = entreprise.id
                    ORDER BY candidature.date_soumission DESC";
            $stmt = $pdo->query($sql);
        } else {
            $sql = "SELECT candidature.id, entreprise.nom AS entreprise, offre.titre,
                           candidature.date_soumission, candidature.cv, candidature.lettre, candidature.statut
                    FROM candidature
                    INNER JOIN offre ON candidature.offre_id = offre.id
                    INNER JOIN entreprise ON offre.entreprise_id = entreprise.id
                    WHERE candidature.user_id = :user_id
                    ORDER BY candidature.date_soumission DESC";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['user_id' => $userId]);
        }
        $candidatures = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $this->render('candidatures/index.twig', [
            'candidatures' => $candidatures,
            'userRole' => $userRole // ✅ ajoute cette ligne
        ]);
            }

    /**
<<<<<<< Updated upstream
     * Postuler à une offre avec CV et lettre de motivation.
=======
     * Affiche le formulaire pour postuler à une offre
     */
    public function postuler_form() {
        // Vérifie connexion
        $this->checkAuth(['Étudiant']);
        
        $offreId = isset($_GET['offre_id']) ? $_GET['offre_id'] : null;
        
        if (!$offreId) {
            $this->redirect('offre', 'index');
        }
        
        // Charger les détails de l'offre
        // Code pour récupérer l'offre...
        
        $this->render('candidatures/postuler.twig', [
            'offre_id' => $offreId
        ]);
    }

    /**
     * Postuler à une offre (avec upload CV, etc.)
     * -> accessible à tout utilisateur connecté (par défaut).
>>>>>>> Stashed changes
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
<<<<<<< Updated upstream
    
            try {
                $pdo = \Database::getInstance();
    
                $sql = "INSERT INTO candidature (user_id, offre_id, cv, lettre, date_soumission) 
                        VALUES (:user_id, :offre_id, :cv, :lettre, :date_soumission)";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([
                    ':user_id' => $userId,
                    ':offre_id' => $offreId,
                    ':cv' => 'uploads/' . time() . "_" . $cvName,
                    ':lettre' => $lettreMotivation,
                    ':date_soumission' => $dateCandidature
                ]);
    
                header("Location: " . BASE_URL . "index.php?controller=offre&action=detail&id=$offreId&success=1");
                exit();
    
            } catch (PDOException $e) {
                die("Erreur lors de la candidature : " . $e->getMessage());
            }
=======

            // Création et sauvegarde de la candidature
            $candidature = new Candidature();
            $candidature->user_id = $userId;
            $candidature->offre_id = $offreId;
            $candidature->cv = 'public/uploads/' . $timestamp . "_" . $cvName;
            $candidature->lettre = $lettreMotivation;
            $candidature->date_soumission = $dateCandidature;
            $candidature->statut = 'en attente';
            $candidature->save();

            // Redirection avec la nouvelle méthode
            $this->redirect('offre', 'detail', ['id' => $offreId, 'success' => 1]);
>>>>>>> Stashed changes
        }
    }

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
<<<<<<< Updated upstream
    
            $pdo = \Database::getInstance();
            $stmt = $pdo->prepare("UPDATE candidature SET statut = ? WHERE id = ?");
            $stmt->execute([$nouveauStatut, $candidatureId]);
    
            header("Location: " . BASE_URL . "index.php?controller=candidature&action=index");
            exit;
=======

            // Model
            Candidature::updateStatus($candidatureId, $nouveauStatut);

            // Redirection avec la nouvelle méthode
            $this->redirect('candidature', 'index');
>>>>>>> Stashed changes
        }
    }
}
