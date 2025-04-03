<?php
// app/controller/EntrepriseController.php

namespace app\controller;

use app\controller\BaseController;
use App\Model\Entreprise;

class EntrepriseController extends BaseController
{
    public function index() {
        $nom = $_GET['nom'] ?? '';
        $ville = $_GET['ville'] ?? '';
        $secteur = $_GET['secteur'] ?? '';
        $page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
        $limit = 10;
        $offset = ($page - 1) * $limit;

        $entreprises = Entreprise::search($nom, $ville, $secteur, $limit, $offset);
        $totalEntreprises = Entreprise::countAll($nom, $ville, $secteur);
        $totalPages = ceil($totalEntreprises / $limit);

        $entrepriseModel = new Entreprise();
        $secteurs = $entrepriseModel->getAllSecteurs();

        foreach ($entreprises as &$entreprise) {
            $entreprise['actions'] = $this->getActionsForEntreprise($entreprise);
        }

        $this->render('entreprises/index.twig', [
            'entreprises' => $entreprises,
            'nom' => $nom,
            'ville' => $ville,
            'secteur' => $secteur,
            'page' => $page,
            'totalPages' => $totalPages,
            'secteurs' => $secteurs
        ]);
    }

    public function creer() {
        $this->checkAuth(['Admin', 'pilote']);

        $entrepriseModel = new Entreprise();
        $secteurs = $entrepriseModel->getAllSecteurs();

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $entreprise = new Entreprise();
            foreach (['nom', 'ville', 'secteur', 'taille', 'description', 'email', 'telephone'] as $field) {
                $entreprise->$field = trim($_POST[$field] ?? '');
            }

            if (!empty($entreprise->nom) && !empty($entreprise->ville) && !empty($entreprise->secteur) && !empty($entreprise->taille)) {
                $entreprise->save();
                $this->redirect('entreprise', 'index', ['notif' => 'created']);
            }
        }

        $this->render('entreprises/creer.twig', [
            'secteurs' => $secteurs
        ]);
    }

    public function modifier($id) {
        $this->checkAuth(['Admin', 'pilote']);

        $entrepriseData = Entreprise::findById($id);
        if (!$entrepriseData) {
            die("Entreprise introuvable.");
        }

        $entrepriseModel = new Entreprise();
        $secteurs = $entrepriseModel->getAllSecteurs();

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $entreprise = new Entreprise();
            $entreprise->id = $id;
            foreach (['nom', 'ville', 'secteur', 'taille', 'description', 'email', 'telephone'] as $field) {
                $entreprise->$field = trim($_POST[$field] ?? '');
            }

            $entreprise->save();
            $this->redirect('entreprise', 'index', ['notif' => 'updated']);
        }

        $this->render('entreprises/modifier.twig', [
            'entreprise' => $entrepriseData,
            'secteurs' => $secteurs
        ]);
    }

    /**
     * Supprime une entreprise (réservé aux Admin/pilote)
     */
    public function supprimer() {
        $this->checkAuth(['Admin', 'pilote']);
    
        // On capture l'ID quelle que soit la méthode
        $id = $_POST['id'] ?? $_GET['id'] ?? null;
    
        // Gérer la redirection après suppression
        $redirectParams = ['notif' => 'deleted'];
        foreach (['nom', 'ville', 'secteur', 'page'] as $param) {
            if (!empty($_GET[$param])) {
                $redirectParams[$param] = $_GET[$param];
            }
        }
    
        // Si on a bien un ID, on supprime
        if ($id) {
            Entreprise::delete($id);
        }
    
        $this->redirect('entreprise', 'index', $redirectParams);
    }
    
    /**
     * Affiche les détails d'une entreprise
     */
    public function details($id) {
        $entrepriseData = Entreprise::findById($id);
        if (!$entrepriseData) {
            die("Entreprise introuvable.");
        }

        $this->render('entreprises/details.twig', [
            'entreprise' => $entrepriseData
        ]);
    }

    /**
     * Action pour gérer l'évaluation d'une entreprise
     */
    public function evaluer($id) {
        // Autoriser l'évaluation pour les rôles "Étudiant", "pilote" et "Admin"
        $this->checkAuth(['Étudiant', 'pilote', 'Admin']);
        
        $entrepriseData = Entreprise::findById($id);
        if (!$entrepriseData) {
            die("Entreprise introuvable.");
        }
        
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $note = isset($_POST['note']) ? (int)$_POST['note'] : 0;
            $commentaire = trim($_POST['commentaire'] ?? '');
            
            // Validation de la note
            if ($note < 1 || $note > 5) {
                $error = "La note doit être comprise entre 1 et 5.";
                $this->render('entreprises/details.twig', [
                    'entreprise' => $entrepriseData,
                    'error' => $error
                ]);
                return;
            }
            
            try {
                $pdo = \Database::getInstance();
                $stmt = $pdo->prepare("INSERT INTO evaluation_entreprise (entreprise_id, user_id, note, commentaire) VALUES (?, ?, ?, ?)");
                $stmt->execute([$id, $this->user['id'], $note, $commentaire]);
                $this->redirect('entreprise', 'details', ['id' => $id, 'notif' => 'evaluation_sent']);
            } catch (\PDOException $e) {
                $error = "Erreur lors de l'enregistrement de l'évaluation : " . $e->getMessage();
                $this->render('entreprises/details.twig', [
                    'entreprise' => $entrepriseData,
                    'error' => $error
                ]);
                return;
            }
        } else {
            // En GET, rediriger vers les détails de l'entreprise
            $this->redirect('entreprise', 'details', ['id' => $id]);
        }
    }

    /**
     * Génère les boutons d'action pour une entreprise dans la liste
     */
    private function getActionsForEntreprise($entreprise) {
        $id = $entreprise['id'];
        $params = ['id' => $id];
        foreach (['nom', 'ville', 'secteur', 'page'] as $param) {
            if (!empty($_GET[$param])) {
                $params[$param] = $_GET[$param];
            }
        }
        $actions = '';
        $actions .= '<a href="' . $this->generateUrl('entreprise', 'details', ['id' => $id]) . '" class="btn btn-voir">Détails</a>';
    
        if (isset($this->user) && in_array($this->user['role'], ['Admin', 'pilote'])) {
            $actions .= ' <a href="' . $this->generateUrl('entreprise', 'modifier', ['id' => $id]) . '" class="btn btn-modifier">Modifier</a>';
            // Ajout de data-id pour que le JS puisse récupérer l'ID à supprimer
            $actions .= ' <a href="' . $this->generateUrl('entreprise', 'supprimer', $params) . '" data-id="' . $id . '" class="btn btn-supprimer">Supprimer</a>';
        }
        return $actions;
    }
}
