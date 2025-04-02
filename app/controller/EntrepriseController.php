<?php
// app/controller/EntrepriseController.php

namespace app\controller;

use app\controller\BaseController;
use App\Model\Entreprise;

class EntrepriseController extends BaseController
{
    /**
     * Affiche la liste des entreprises avec recherche/pagination (ouvert à tous).
     */
    public function index() {
        // Récupération des paramètres de recherche
        $nom = isset($_GET['nom']) ? $_GET['nom'] : '';
        $ville = isset($_GET['ville']) ? $_GET['ville'] : '';
        $secteur = isset($_GET['secteur']) ? $_GET['secteur'] : '';
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        
        // Nombre d'éléments par page
        $limit = 10;
        $offset = ($page - 1) * $limit;
        
        // Récupération des entreprises
        $entreprises = Entreprise::search($nom, $ville, $secteur, $limit, $offset);
        $totalEntreprises = Entreprise::countAll($nom, $ville, $secteur);
        $totalPages = ceil($totalEntreprises / $limit);
        
        // Récupération de tous les secteurs distincts pour le menu déroulant
        $entrepriseModel = new Entreprise();
        $secteurs = $entrepriseModel->getAllSecteurs();
        
        // Ajout des actions pour chaque entreprise
        foreach ($entreprises as &$entreprise) {
            $entreprise['actions'] = $this->getActionsForEntreprise($entreprise);
        }
        
        // Rendu du template
        echo $this->render('entreprises/index.twig', [
            'entreprises' => $entreprises,
            'nom' => $nom,
            'ville' => $ville,
            'secteur' => $secteur,
            'page' => $page,
            'totalPages' => $totalPages,
            'user' => isset($_SESSION['user']) ? $_SESSION['user'] : null,
            'secteurs' => $secteurs
        ]);
    }

    public function creer() {
        $this->checkAuth(['Admin', 'pilote']);
    
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
    
        $this->render('entreprises/creer.twig');
    }

    public function modifier($id) {
        $this->checkAuth(['Admin', 'pilote']);

        $entrepriseData = Entreprise::findById($id);
        if (!$entrepriseData) {
            die("Entreprise introuvable.");
        }

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
            'entreprise' => $entrepriseData
        ]);
    }

    public function supprimer() {
        $this->checkAuth(['Admin', 'pilote']);

        $id = $_GET['id'] ?? null;
        if ($id) {
            Entreprise::delete($id);
            $this->redirect('entreprise', 'index', ['notif' => 'deleted']);
        }
    }

    public function evaluer($id) {
        $this->checkAuth(['Etudiant']);

        $entreprise = Entreprise::findById($id);
        if (!$entreprise) {
            die("Entreprise introuvable.");
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $_SESSION['message'] = "Évaluation enregistrée avec succès !";
            $this->redirect('entreprise', 'details', ['id' => $id]);
        }

        $this->render('entreprises/evaluer.twig', [
            'entreprise' => $entreprise
        ]);
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

    /**
     * Génère les actions disponibles pour une entreprise.
     */
    private function getActionsForEntreprise($entreprise) {
        $actions = '';

        // Bouton de détails pour tous les utilisateurs
        $actions .= '<a href="' . $this->generateUrl('entreprise', 'details', ['id' => $entreprise['id']]) . '" class="btn btn-voir">Détails</a>';

        // Actions supplémentaires pour Admin et pilote
        if (isset($_SESSION['user']) && in_array($_SESSION['user']['role'], ['Admin', 'pilote'])) {
            $actions .= ' <a href="' . $this->generateUrl('entreprise', 'modifier', ['id' => $entreprise['id']]) . '" class="btn btn-modifier">Modifier</a>';
            $actions .= ' <a href="' . $this->generateUrl('entreprise', 'supprimer', ['id' => $entreprise['id']]) . '" class="btn btn-supprimer"">Supprimer</a>';
        }

        // Action d'évaluation pour les étudiants
        if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 'Etudiant') {
            $actions .= ' <a href="' . $this->generateUrl('entreprise', 'evaluer', ['id' => $entreprise['id']]) . '" class="btn btn-evaluate">Évaluer</a>';
        }

        return $actions;
    }
}