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

            // Redirection avec URL propre
            $this->redirect('offre', 'detail', ['id' => $offreId, 'success' => 1]);
        }
    }

    /**
     * Met à jour le statut d'une candidature
     * -> réservé aux Admin / Pilote.
     */
    public function updateStatus() {
        // Vérifie la connexion + rôles
        $this->checkAuth(['Admin','pilote']);

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $candidatureId = $_POST['candidature_id'];
            $nouveauStatut = $_POST['statut'];

            // Model
            Candidature::updateStatus($candidatureId, $nouveauStatut);

            // Redirection avec URL propre
            $this->redirect('candidature', 'index');
        }
    }
}
