<?php
// app/controller/OffreController.php

namespace app\controller;

use app\controller\BaseController;
use App\Model\Offre;
use App\Model\Entreprise;

class OffreController extends BaseController {
    public function index() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $motcle = $_GET['motcle'] ?? '';
        $filtreCompetences = $_GET['competences'] ?? '';

        $page = max(1, (int)($_GET['page'] ?? 1));
        $limit = 10;
        $offset = ($page - 1) * $limit;

        $result = Offre::search($motcle, $filtreCompetences, $limit, $offset);
        $offres = $result['offres'];
        $total = $result['total'];
        $totalPages = ceil($total / $limit);

        foreach ($offres as &$offre) {
            $detailLink = '<a href="' . BASE_URL . 'index.php?controller=offre&action=detail&id=' . $offre['id'] . '" class="btn-voir">Détails</a>';

            if (!empty($_SESSION['user']) && in_array($_SESSION['user']['role'], ['Admin', 'pilote'])) {
                $modifyLink = ' <a href="' . BASE_URL . 'index.php?controller=offre&action=modifier&id=' . $offre['id'] . '" class="btn-modifier">Modifier</a>';
                $deleteLink = ' <a href="' . BASE_URL . 'index.php?controller=offre&action=supprimer&id=' . $offre['id'] . '" class="btn-supprimer" data-id="' . $offre['id'] . '">Supprimer</a>';
                $offre['actions'] = $detailLink . $modifyLink . $deleteLink;
            } else {
                $offre['actions'] = $detailLink;
            }
        }
        unset($offre);

        $this->render('offres/index.twig', [
            'offres' => $offres,
            'page' => $page,
            'totalPages' => $totalPages,
            'motcle' => $motcle,
            'competences' => $filtreCompetences
        ]);
    }

    public function gererOffres() {
        $this->checkAuth(['Admin','pilote']);
    
        $page = max(1, (int)($_GET['page'] ?? 1));
        $limit = 10;
        $offset = ($page - 1) * $limit;
        
        $total = Offre::countAllOffres();
        $totalPages = ceil($total / $limit);
        $offres = Offre::findAllPaginated($limit, $offset);
        
        $this->render('offres/gerer.twig', [
            'offres' => $offres,
            'page' => $page,
            'totalPages' => $totalPages
        ]);
    }
    

    public function detail($id) {
        if (!$id) {
            die("Erreur : ID de l'offre manquant.");
        }
        $offre = Offre::findById($id);
        if (!$offre) {
            die("Erreur : Offre introuvable.");
        }
        $this->render('offres/detail.twig', ['offre' => $offre]);
    }

    public function create() {
        $this->checkAuth(['Admin', 'pilote']);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $titre = trim($_POST['titre']);
            $description = trim($_POST['description']);
            $entreprise_id = intval($_POST['entreprise_id']);
            $remuneration = trim($_POST['remuneration']);
            $date_debut = $_POST['date_debut'];
            $date_fin = $_POST['date_fin'];
            $competences = trim($_POST['competences'] ?? '');

            if (!empty($titre) && !empty($description) && $entreprise_id > 0) {
                $offre = new Offre();
                $offre->titre = $titre;
                $offre->description = $description;
                $offre->entreprise_id = $entreprise_id;
                $offre->remuneration = $remuneration;
                $offre->date_debut = $date_debut;
                $offre->date_fin = $date_fin;
                $offre->competences = $competences;

                if ($offre->save()) {
                    header("Location: " . BASE_URL . "index.php?controller=offre&action=index&notif=created");
                    exit;
                } else {
                    $_SESSION['error'] = "Erreur lors de la sauvegarde de l'offre.";
                }
            } else {
                $_SESSION['error'] = "Veuillez remplir tous les champs obligatoires.";
            }
        }

        $entreprises = Entreprise::findAll();
        $this->render('offres/create.twig', ['entreprises' => $entreprises]);
    }

    public function modifier($id) {
        $this->checkAuth(['Admin','pilote']);
    
        if (!$id) {
            die("Erreur : ID manquant pour modifier une offre.");
        }
    
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $titre = trim($_POST['titre']);
            $description = trim($_POST['description']);
            $remuneration = trim($_POST['remuneration']);
            $date_debut = $_POST['date_debut'];
            $date_fin = $_POST['date_fin'];
            $competences = trim($_POST['competences'] ?? '');
            $entreprise_id = intval($_POST['entreprise_id']);
    
            if (
                empty($titre) || empty($description) || empty($remuneration) ||
                empty($date_debut) || empty($date_fin) || empty($entreprise_id)
            ) {
                $_SESSION["error"] = "Tous les champs sont requis.";
                header("Location: " . BASE_URL . "index.php?controller=offre&action=modifier&id=" . $id);
                exit;
            }
    
            $offre = new Offre();
            $offre->id = $id;
            $offre->titre = $titre;
            $offre->description = $description;
            $offre->remuneration = $remuneration;
            $offre->date_debut = $date_debut;
            $offre->date_fin = $date_fin;
            $offre->competences = $competences;
            $offre->entreprise_id = $entreprise_id;
            $offre->save();
    
            header("Location: " . BASE_URL . "index.php?controller=offre&action=gererOffres&notif=updated");
            exit;
        }
    
        $offre = Offre::findById($id);
        if (!$offre) {
            die("Erreur : Offre introuvable.");
        }
    
        $entreprises = Entreprise::findAll();
        $this->render('offres/modifier.twig', [
            'offre' => $offre,
            'entreprises' => $entreprises
        ]);
    }
    
    

    public function supprimer() {
        $this->checkAuth(['Admin', 'pilote']);
    
        $id = $_GET['id'] ?? null;
        $page = $_GET['page'] ?? 1;
        
        if ($id) {
            Offre::deleteById($id);
            header("Location: " . BASE_URL . "index.php?controller=offre&action=gererOffres&notif=deleted&page=" . $page);
            exit;
        }
    }
    

    public function search() {
        $motcle = $_GET['motcle'] ?? '';
        $page = max(1, (int)($_GET['page'] ?? 1));
        $limit = 10;
        $offset = ($page - 1) * $limit;

        if (!empty($motcle)) {
            $result = Offre::search($motcle, '', $limit, $offset);
            $offres = $result['offres'];
            $total = $result['total'];
            $totalPages = ceil($total / $limit);

            $this->render('offres/index.twig', [
                'offres' => $offres,
                'motcle' => $motcle,
                'page' => $page,
                'totalPages' => $totalPages,
                'competences' => ''
            ]);
        } else {
            $this->index();
        }
    }
}