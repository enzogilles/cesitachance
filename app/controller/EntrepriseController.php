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

        // Instantiate Entreprise model to get all sectors
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

        // Instantiate Entreprise model to get all sectors
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
    
        // Préserver les filtres si présents
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
    
        if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 'Etudiant') {
            $actions .= ' <a href="' . $this->generateUrl('entreprise', 'evaluer', ['id' => $id]) . '" class="btn btn-evaluate">Évaluer</a>';
        }
    
        return $actions;
    }
    
}
