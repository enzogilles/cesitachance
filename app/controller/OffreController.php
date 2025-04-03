<?php
// app/controller/OffreController.php

namespace app\controller;

use app\controller\BaseController;
use App\Model\Offre;
use App\Model\Entreprise;

class OffreController extends BaseController {
    public function index() {

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
            $detailLink = '<a href="' . $this->generateUrl('offre', 'detail', ['id' => $offre['id']]) . '" class="btn-voir">Détails</a>';

            if (!empty($_SESSION['user']) && in_array($_SESSION['user']['role'], ['Admin', 'pilote'])) {
                $modifyLink = ' <a href="' . $this->generateUrl('offre', 'modifier', ['id' => $offre['id']]) . '" class="btn-modifier">Modifier</a>';
                $deleteLink = ' <a href="' . $this->generateUrl('offre', 'supprimer', ['id' => $offre['id']]) . '" class="btn-supprimer" data-id="' . $offre['id'] . '">Supprimer</a>';
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

        // Paramètres de pagination
        $page = max(1, (int)($_GET['page'] ?? 1));
        $limit = 10;
        $offset = ($page - 1) * $limit;

        // Récupérer le nombre total d'offres pour la pagination
        $total = Offre::countAll();
        $totalPages = ceil($total / $limit);
        
        // Récupérer les offres pour la page actuelle
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

    public function create()
    {
        $this->checkAuth(['Admin', 'pilote']);
    
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $offre = new Offre();
            $offre->titre = trim($_POST['titre']);
            $offre->description = trim($_POST['description']);
            $offre->remuneration = trim($_POST['remuneration']);
            $offre->date_debut = $_POST['date_debut'];
            $offre->date_fin = $_POST['date_fin'];
            $offre->entreprise_id = intval($_POST['entreprise_id']);
            $offre->competences = trim($_POST['competences'] ?? '');
    
            if (
                empty($offre->titre) || empty($offre->description) || empty($offre->remuneration) ||
                empty($offre->date_debut) || empty($offre->date_fin) || empty($offre->entreprise_id)
            ) {
                $this->render('offres/create.twig', [
                    'error' => 'Tous les champs obligatoires doivent être remplis.',
                    'entreprises' => Entreprise::findAll()
                ]);
                return;
            }
    
            $offre->save();

            $this->redirect('offre', 'gererOffres', ['notif' => 'created']);
        }
    
        $this->render('offres/create.twig', [
            'entreprises' => Entreprise::findAll()
        ]);
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
                $this->redirect('offre', 'modifier', ['id' => $id]);
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
    
            $this->redirect('offre', 'gererOffres', ['notif' => 'updated']);
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
        if ($id) {
            Offre::deleteById($id);
            $this->redirect('offre', 'gererOffres', ['notif' => 'deleted']);
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