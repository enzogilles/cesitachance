<?php
// app/controller/CandidatureController.php

namespace app\controller;

use app\controller\BaseController;
use App\Model\Candidature;

class CandidatureController extends BaseController {

    /**
     * Liste les candidatures de l'utilisateur connecté
     * ou toutes si c'est un Admin.
     */
    public function index() {
        // Vérifie que l'utilisateur est loggué (peu importe le rôle)
        $this->checkAuth();

        $userId   = $_SESSION['user']['id'];
        $userRole = $_SESSION['user']['role'];

        if ($userRole === 'Admin' || $userRole === 'pilote') {
            // L'admin voit toutes les candidatures
            $candidatures = Candidature::findAllWithRelations();
        } else {
            // Sinon, l'utilisateur voit seulement ses propres candidatures
            $candidatures = Candidature::findAllByUserIdWithRelations($userId);
        }

        // Debug the candidatures data
        // var_dump($candidatures); exit;

        $this->render('candidatures/index.twig', [
            'candidatures' => $candidatures,
            'userRole' => $userRole
        ]);
    }

    /**
     * Postuler à une offre (avec upload CV, etc.)
     * -> accessible à tout utilisateur connecté (par défaut).
     */
    public function postuler() {
        // Vérifie connexion
        $this->checkAuth();

        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            $userId = $_SESSION['user']['id'];
            $offreId = $_POST['offre_id'];
            $dateCandidature = date('Y-m-d');

            // Vérification et création du dossier d'upload si nécessaire
            $uploadDir = __DIR__ . '/../../public/uploads/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            // Upload du CV
            if (isset($_FILES['cv']) && $_FILES['cv']['error'] === 0) {
                $cvTmpPath = $_FILES['cv']['tmp_name'];
                $cvName = basename($_FILES['cv']['name']);
                $timestamp = time();
                $cvDestination = $uploadDir . $timestamp . "_" . $cvName;

                if (!move_uploaded_file($cvTmpPath, $cvDestination)) {
                    die("Erreur lors du téléchargement du fichier.");
                }
            } else {
                die("Erreur : veuillez fournir un CV au format PDF.");
            }

            $lettreMotivation = isset($_POST['lettre_motivation']) ? trim($_POST['lettre_motivation']) : '';

            // Création et sauvegarde de la candidature
            $candidature = new Candidature();
            $candidature->user_id = $userId;
            $candidature->offre_id = $offreId;
            $candidature->cv = 'public/uploads/' . $timestamp . "_" . $cvName;
            $candidature->lettre = $lettreMotivation;
            $candidature->date_soumission = $dateCandidature;
            $candidature->statut = 'en attente';
            $candidature->save();

            $this->redirect('candidature', 'index', ['success' => 1]);
        }
    }

    /**
     * Met à jour le statut d'une candidature
     * -> réservé aux Admin
     */
    public function updateStatus() {
        try {
            // Vérification de l'authentification
            $this->checkAuth(['Admin', 'pilote']);
            
            if ($_SERVER["REQUEST_METHOD"] !== "POST") {
                throw new \Exception("Méthode non autorisée");
            }
    
            // Log de toutes les données reçues
            error_log("POST data: " . print_r($_POST, true));
            
            $candidatureId = isset($_POST['candidature_id']) ? $_POST['candidature_id'] : null;
            $nouveauStatut = isset($_POST['statut']) ? $_POST['statut'] : null;
    
            // Log des valeurs extraites
            error_log("Valeurs extraites - ID: " . var_export($candidatureId, true) . 
                     ", Statut: " . var_export($nouveauStatut, true));
    
            // Validation
            if (!$candidatureId || !is_numeric($candidatureId)) {
                throw new \Exception("ID de candidature invalide");
            }
    
            if (!in_array($nouveauStatut, ['0', '1', '2'], true)) {
                throw new \Exception("Statut invalide ($nouveauStatut)");
            }
    
            // Conversion des valeurs
            $candidatureId = (int)$candidatureId;
            $nouveauStatut = (int)$nouveauStatut;
    
            // Mise à jour du statut
            $success = Candidature::updateStatus($candidatureId, $nouveauStatut);
    
            // Log du résultat
            error_log("Résultat de la mise à jour: " . ($success ? "succès" : "échec"));
    
            // Réponse
            $this->jsonResponse([
                'success' => $success,
                'message' => $success ? 'Statut mis à jour avec succès' : 'Échec de la mise à jour'
            ]);
    
        } catch (\Exception $e) {
            error_log("Erreur dans updateStatus: " . $e->getMessage());
            $this->jsonResponse([
                'success' => false,
                'message' => $e->getMessage()
            ], 400);
        }
    }
    
    protected function jsonResponse($data, $status = 200) {
        http_response_code($status);
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }
}
