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
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $nom = $_GET['nom'] ?? '';
        $ville = $_GET['ville'] ?? '';
        $secteur = $_GET['secteur'] ?? '';

        $page = max(1, (int)($_GET['page'] ?? 1));
        $limit = 10;
        $offset = ($page - 1) * $limit;

        $total = Entreprise::countAll($nom, $ville, $secteur);
        $totalPages = ceil($total / $limit);
        $entreprises = Entreprise::search($nom, $ville, $secteur, $limit, $offset);

        foreach ($entreprises as &$entreprise) {
            $detailLink = '<a href="' . BASE_URL . 'index.php?controller=entreprise&action=details&id=' . $entreprise['id'] . '" class="btn-voir">Détails</a>';

            if (!empty($_SESSION['user']) && in_array($_SESSION['user']['role'], ['Admin', 'pilote'])) {
                $modifyLink = ' <a href="' . BASE_URL . 'index.php?controller=entreprise&action=modifier&id=' . $entreprise['id'] . '" class="btn-modifier">Modifier</a>';
                $deleteLink = ' <a href="' . BASE_URL . 'index.php?controller=entreprise&action=supprimer&id=' . $entreprise['id'] . '" class="btn-supprimer" data-id="' . $entreprise['id'] . '">Supprimer</a>';
                $entreprise['actions'] = $detailLink . $modifyLink . $deleteLink;
            } else {
                $entreprise['actions'] = $detailLink;
            }
        }
        unset($entreprise);

        $this->render('entreprises/index.twig', [
            'entreprises' => $entreprises,
            'page' => $page,
            'totalPages' => $totalPages,
            'nom' => $nom,
            'ville' => $ville,
            'secteur' => $secteur
        ]);
    }

    public function creer() {
        echo "création entreprise OK";
        $this->checkAuth(['Admin', 'pilote']);
    
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $entreprise = new Entreprise();
            foreach (['nom', 'ville', 'secteur', 'taille', 'description', 'email', 'telephone'] as $field) {
                $entreprise->$field = trim($_POST[$field] ?? '');
            }
    
            if (!empty($entreprise->nom) && !empty($entreprise->ville) && !empty($entreprise->secteur) && !empty($entreprise->taille)) {
                $entreprise->save();
                header("Location: " . BASE_URL . "index.php?controller=entreprise&action=index&notif=created");
                exit;
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
            header("Location: " . BASE_URL . "index.php?controller=entreprise&action=index&notif=updated");
            exit;
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
            header("Location: " . BASE_URL . "index.php?controller=entreprise&action=index&notif=deleted");
            exit;
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
            header("Location: " . BASE_URL . "index.php?controller=entreprise&action=details&id=" . $id);
            exit;
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
}
