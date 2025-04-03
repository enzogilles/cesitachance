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

        echo $this->render('entreprises/index.twig', [
            'entreprises' => $entreprises,
            'nom' => $nom,
            'ville' => $ville,
            'secteur' => $secteur,
            'page' => $page,
            'totalPages' => $totalPages,
            'user' => $_SESSION['user'] ?? null,
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

    public function supprimer() {
        $this->checkAuth(['Admin', 'pilote']);
    
        $id = $_GET['id'] ?? null;
        $redirectParams = ['notif' => 'deleted'];
        foreach (['nom', 'ville', 'secteur', 'page'] as $param) {
            if (!empty($_GET[$param])) {
                $redirectParams[$param] = $_GET[$param];
            }
        }
    
        if ($id) {
            Entreprise::delete($id);
        }
    
        $this->redirect('entreprise', 'index', $redirectParams);
    }
    
    public function details($id) {
        $entrepriseData = Entreprise::findById($id);
        if (!$entrepriseData) {
            die("Entreprise introuvable.");
        }

        $this->render('entreprises/details.twig', [
            'entreprise' => $entrepriseData
        ]);
    }
    
    // Action pour gérer l'évaluation d'une entreprise
    public function evaluer($id) {
        // Autoriser l'évaluation pour les rôles "Étudiant", "pilote" et "Admin"
        if (!isset($_SESSION['user']) || !in_array($_SESSION['user']['role'], ['Étudiant', 'pilote', 'Admin'])) {
            $this->redirect('entreprise', 'details', ['id' => $id, 'error' => 'Accès refusé']);
            return;
        }
        
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
                    'error' => $error,
                    'user' => $_SESSION['user']
                ]);
                return;
            }
            
            try {
                $pdo = \Database::getInstance();
                $stmt = $pdo->prepare("INSERT INTO evaluation_entreprise (entreprise_id, user_id, note, commentaire) VALUES (?, ?, ?, ?)");
                $stmt->execute([$id, $_SESSION['user']['id'], $note, $commentaire]);
                $this->redirect('entreprise', 'details', ['id' => $id, 'notif' => 'evaluation_sent']);
            } catch (\PDOException $e) {
                $error = "Erreur lors de l'enregistrement de l'évaluation : " . $e->getMessage();
                $this->render('entreprises/details.twig', [
                    'entreprise' => $entrepriseData,
                    'error' => $error,
                    'user' => $_SESSION['user']
                ]);
                return;
            }
        } else {
            // En GET, rediriger vers les détails de l'entreprise
            $this->redirect('entreprise', 'details', ['id' => $id]);
        }
    }

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
    
        if (isset($_SESSION['user']) && in_array($_SESSION['user']['role'], ['Admin', 'pilote'])) {
            $actions .= ' <a href="' . $this->generateUrl('entreprise', 'modifier', ['id' => $id]) . '" class="btn btn-modifier">Modifier</a>';
            $actions .= ' <a href="' . $this->generateUrl('entreprise', 'supprimer', $params) . '" class="btn btn-supprimer">Supprimer</a>';
        }
    
        if (isset($_SESSION['user']) && in_array($_SESSION['user']['role'], ['Étudiant', 'pilote', 'Admin'])) {
            $actions .= ' <a href="' . $this->generateUrl('entreprise', 'evaluer', ['id' => $id]) . '" class="btn-details">Évaluer</a>';
        }
    
        return $actions;
    }
}
