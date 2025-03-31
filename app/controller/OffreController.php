<?php
// app/controller/OffreController.php

namespace app\controller;

use app\controller\BaseController;
use App\Model\Offre;
use App\Model\Entreprise;

class OffreController extends BaseController {
    private $offreModel;

    public function __construct() {
        parent::__construct();
        $this->offreModel = new Offre();
    }

    /**
     * Liste des offres avec pagination et recherche multi-critères (ouvert à tous).
     */
    public function index() {
        // Pas de restriction, tout visiteur peut voir les offres

        $motcle = isset($_GET['motcle']) ? trim($_GET['motcle']) : '';
        $filtreCompetences = isset($_GET['competences']) ? trim($_GET['competences']) : '';

        // Pagination
        $page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
        $limit = 10;
        $offset = ($page - 1) * $limit;

        // On appelle le Model qui gère la recherche
        $result = Offre::search($motcle, $filtreCompetences, $limit, $offset);
        $offres = $result['offres'];
        $total = $result['total'];
        $totalPages = ceil($total / $limit);

        $this->render('offres/index.twig', [
            'offres' => $offres,
            'page' => $page,
            'totalPages' => $totalPages,
            'motcle' => $motcle,
            'competences' => $filtreCompetences
        ]);
    }

    /**
     * Page d'administration : gérer toutes les offres -> réservé Admin/Pilote.
     */
    public function gererOffres() {
        $this->checkAuth(['Admin','pilote']);

        $offres = Offre::findAll();
        $this->render('offres/gerer.twig', ['offres' => $offres]);
    }

    /**
     * Détail d’une offre (ouvert à tous).
     */
    public function detail($id) {
        // Pas de restriction
        if (!$id) {
            die("Erreur : ID de l'offre manquant.");
        }
        $offre = Offre::findById($id);
        if (!$offre) {
            die("Erreur : Offre introuvable.");
        }
        $this->render('offres/detail.twig', ['offre' => $offre]);
    }

    /**
     * Créer une nouvelle offre -> réservé Admin/Pilote.
     */
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
                    header("Location: " . BASE_URL . "index.php?controller=offre&action=index");
                    exit;
                } else {
                    $_SESSION['error'] = "Erreur lors de la sauvegarde de l'offre.";
                }
            } else {
                $_SESSION['error'] = "Veuillez remplir tous les champs obligatoires.";
            }
        }
    
        // Récupérer la liste des entreprises
        $entreprises = Entreprise::findAll();
    
        // Passer les entreprises à la vue
        $this->render('offres/create.twig', ['entreprises' => $entreprises]);
    }

    /**
     * Modifier une offre -> réservé Admin/Pilote.
     */
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

            if (empty($titre) || empty($description) || empty($remuneration) ||
                empty($date_debut) || empty($date_fin)) {
                $_SESSION["error"] = "Tous les champs sont requis.";
                header("Location: " . BASE_URL . "index.php?controller=offre&action=modifier&id=" . $id);
                exit;
            }

            // On met à jour via le model
            $offre = new Offre();
            $offre->id = $id;
            $offre->titre = $titre;
            $offre->description = $description;
            $offre->remuneration = $remuneration;
            $offre->date_debut = $date_debut;
            $offre->date_fin = $date_fin;
            $offre->competences = $competences;
            $offre->save();

            $_SESSION["success"] = "L'offre a été mise à jour avec succès.";
            header("Location: " . BASE_URL . "index.php?controller=offre&action=gererOffres");
            exit;
        }

        $offre = Offre::findById($id);
        if (!$offre) {
            die("Erreur : Offre introuvable.");
        }

        $this->render('offres/modifier.twig', ['offre' => $offre]);
    }

    /**
     * Supprimer une offre -> réservé Admin/Pilote.
     */
    public function supprimer($id) {
        $this->checkAuth(['Admin','pilote']);

        if (!$id) {
            die("Erreur : ID manquant pour supprimer une offre.");
        }

        // On fait appel à la méthode de suppression
        Offre::deleteById($id);

        header("Location: " . BASE_URL . "index.php?controller=offre&action=gererOffres");
        exit;
    }

    /**
     * Recherche d'offres par mot-clé (alias de index).
     */
    public function search() {
        // Pas de restriction
        $motcle = isset($_GET['motcle']) ? trim($_GET['motcle']) : '';
        $page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
        $limit = 10;
        $offset = ($page - 1) * $limit;

        if (!empty($motcle)) {
            // On réutilise la méthode search() de la classe Offre
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
            // Si pas de mot clé, on renvoie la liste complète
            $this->index();
        }
    }
}
