<?php
// app/controller/CandidatureController.php

namespace app\controller;

use app\controller\BaseController;
use App\Model\Candidature;

class CandidatureController extends BaseController {
    private $uploadDir;

    public function __construct() {
        parent::__construct();
        $this->uploadDir = __DIR__ . '/../../public/uploads/';
    }

    /**
     * Liste les candidatures de l'utilisateur connecté
     * ou toutes si c'est un Admin.
     */
    public function index() {
        // Vérifie que l'utilisateur est loggué (peu importe le rôle)
        $this->checkAuth();

        $userId   = $this->user['id'];
        $userRole = $this->user['role'];

        if ($userRole === 'Admin' || $userRole === 'pilote') {
            // L'admin voit toutes les candidatures
            $candidatures = Candidature::findAllWithRelations();
        } else {
            // Sinon, l'utilisateur voit seulement ses propres candidatures
            $candidatures = Candidature::findAllByUserIdWithRelations($userId);
        }

        $this->render('candidatures/index.twig', [
            'candidatures' => $candidatures,
            'userRole' => $userRole
        ]);
    }

    /**
     * Postuler à une offre (avec upload CV, etc.)
     */
    public function postuler() {
        // Vérifie connexion
        $this->checkAuth();

        if ($_SERVER["REQUEST_METHOD"] !== "POST") {
            return;
        }

        // Récupération et validation des données
        $userId = $this->user['id'];
        $offreId = filter_input(INPUT_POST, 'offre_id', FILTER_VALIDATE_INT);
        
        if (!$offreId) {
            die("Erreur : ID d'offre invalide.");
        }

        // Vérification si l'utilisateur a déjà postulé
        if (Candidature::exists($userId, $offreId)) {
            $this->redirect('candidature', 'index', ['error' => 1]);
            return;
        }

        // Upload du CV
        $cvPath = $this->uploadCV();
        if (!$cvPath) {
            return; // Les messages d'erreur sont gérés dans la méthode uploadCV
        }

        // Nettoyage et validation de la lettre de motivation
        $lettreMotivation = filter_input(INPUT_POST, 'lettre_motivation', FILTER_SANITIZE_STRING);
        if ($lettreMotivation === false) {
            $lettreMotivation = '';
        }

        // Création et sauvegarde de la candidature
        $candidature = new Candidature();
        $candidature->user_id = $userId;
        $candidature->offre_id = $offreId;
        $candidature->cv = $cvPath;
        $candidature->lettre = $lettreMotivation;
        $candidature->date_soumission = date('Y-m-d');
        $candidature->statut = 'en attente';
        
        try {
            $candidature->save();
            $this->redirect('candidature', 'index', ['success' => 1]);
        } catch (\Exception $e) {
            // Si erreur, on supprime le fichier uploadé
            if (file_exists(__DIR__ . '/../../' . $cvPath)) {
                unlink(__DIR__ . '/../../' . $cvPath);
            }
            die("Erreur lors de l'enregistrement de la candidature : " . $e->getMessage());
        }
    }

    /**
     * Méthode privée pour gérer l'upload du CV
     * @return string|bool Chemin relatif du CV ou false en cas d'erreur
     */
    private function uploadCV() {
        // Vérification et création du dossier d'upload si nécessaire
        if (!is_dir($this->uploadDir)) {
            mkdir($this->uploadDir, 0777, true);
        }

        // Validation et upload du CV
        if (isset($_FILES['cv']) && $_FILES['cv']['error'] === 0) {
            // Vérification du type de fichier
            $allowedTypes = ['application/pdf'];
            if (!in_array($_FILES['cv']['type'], $allowedTypes)) {
                die("Erreur : seuls les fichiers PDF sont acceptés.");
            }

            // Vérification de la taille (5MB max)
            if ($_FILES['cv']['size'] > 5 * 1024 * 1024) {
                die("Erreur : la taille du fichier ne doit pas dépasser 5MB.");
            }

            $cvTmpPath = $_FILES['cv']['tmp_name'];
            $cvName = basename($_FILES['cv']['name']);
            $timestamp = time();
            $cvDestination = $this->uploadDir . $timestamp . "_" . $cvName;
            $relativePath = 'public/uploads/' . $timestamp . "_" . $cvName;

            if (!move_uploaded_file($cvTmpPath, $cvDestination)) {
                die("Erreur lors du téléchargement du fichier.");
            }
            
            return $relativePath;
        } else {
            die("Erreur : veuillez fournir un CV au format PDF.");
        }
    }

    /**
     * Met à jour le statut d'une candidature
     * -> réservé aux Admin / Pilote.
     */
    public function updateStatus() {
        // Vérifie la connexion + rôles
        $this->checkAuth(['Admin', 'pilote']);
    
        if ($_SERVER["REQUEST_METHOD"] !== "POST") {
            return;
        }
        
        $candidatureId = filter_input(INPUT_POST, 'candidature_id', FILTER_VALIDATE_INT);
        $nouveauStatut = filter_input(INPUT_POST, 'statut', FILTER_SANITIZE_STRING);
        
        if (!$candidatureId || !$nouveauStatut) {
            die("Données invalides");
        }

        try {
            Candidature::updateStatus($candidatureId, $nouveauStatut);
            $this->redirect('candidature', 'index');
        } catch (\Exception $e) {
            die("Erreur lors de la mise à jour du statut : " . $e->getMessage());
        }
    }

    /**
     * Vérifie si une candidature existe déjà pour l'utilisateur et l'offre
     */
    public function checkExisting() {
        $offreId = filter_input(INPUT_GET, 'offre_id', FILTER_VALIDATE_INT);
        $userId = $this->user['id'] ?? null;
    
        if (!$offreId || !$userId) {
            echo json_encode(['exists' => false]);
            exit;
        }
    
        try {
            $exists = Candidature::exists($userId, $offreId);
            echo json_encode(['exists' => $exists]);
        } catch (\Exception $e) {
            echo json_encode(['exists' => false, 'error' => $e->getMessage()]);
        }
        exit;
    }
}