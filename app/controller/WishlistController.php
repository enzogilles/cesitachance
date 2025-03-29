<?php
// app/controller/WishlistController.php

namespace app\controller;

use app\controller\BaseController;
use App\Model\Wishlist;
use App\Model\Offre;

class WishlistController extends BaseController {

    /**
     * Affiche la wishlist de l'utilisateur connecté -> réservé aux Étudiants ou Admin.
     */
    public function index() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['user']) || !in_array($_SESSION['user']['role'], ['Étudiant', 'Admin'])) {
            header("Location: " . BASE_URL . "index.php?controller=utilisateur&action=connexion");
            exit;
        }

        $user_id = $_SESSION['user']['id'];
        $wishlist = Wishlist::findByUserIdWithRelations($user_id);
        
        $this->render('wishlist/index.twig', ['wishlist' => $wishlist]);
    }

    /**
     * Ajouter une offre à la wishlist -> réservé aux Étudiants ou Admin.
     */
    public function add() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['user']) || !in_array($_SESSION['user']['role'], ['Étudiant', 'Admin'])) {
            header("Location: " . BASE_URL . "index.php?controller=utilisateur&action=connexion");
            exit;
        }
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['offre_id'])) {
            $user_id = $_SESSION['user']['id'];
            $offre_id = intval($_POST['offre_id']);
    
            if (Wishlist::exists($user_id, $offre_id)) {
                $_SESSION['error'] = "Cette offre est déjà dans votre wishlist.";
            } else {
                Wishlist::add($user_id, $offre_id);
                $_SESSION['message'] = "Offre ajoutée à la wishlist !";
            }

            header("Location: " . BASE_URL . "index.php?controller=wishlist&action=index");
            exit;
        } else {
            $_SESSION['error'] = "Une erreur est survenue.";
            header("Location: " . BASE_URL . "index.php?controller=offre&action=index");
            exit;
        }
    }

    /**
     * Retirer une offre de la wishlist -> réservé aux Étudiants ou Admin.
     */
    public function remove() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    
        if (!isset($_SESSION['user']) || !in_array($_SESSION['user']['role'], ['Étudiant', 'Admin'])) {
            // Si c’est une requête AJAX
            if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
                header('Content-Type: application/json');
                echo json_encode(['success' => false, 'message' => 'Non autorisé']);
                exit;
            }
    
            // Sinon, redirection classique
            header("Location: " . BASE_URL . "index.php?controller=utilisateur&action=connexion");
            exit;
        }
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = file_get_contents("php://input");
            $json = json_decode($data, true);
    
            // Si AJAX (fetch)
            if ($json && isset($json['wishlist_id'])) {
                $wishlist_id = $json['wishlist_id'];
                $success = Wishlist::remove($wishlist_id);
    
                header('Content-Type: application/json');
                echo json_encode(['success' => $success]);
                exit;
            }
    
            // Sinon, formulaire classique (non-AJAX)
            if (isset($_POST['wishlist_id'])) {
                $wishlist_id = $_POST['wishlist_id'];
                Wishlist::remove($wishlist_id);
    
                header("Location: " . BASE_URL . "index.php?controller=wishlist&action=index");
                exit;
            }
        }
    
        // Si aucune condition n'est remplie
        if (!headers_sent()) {
            header('Content-Type: application/json');
        }
        echo json_encode(['success' => false, 'message' => 'Requête invalide.']);
        exit;
    }
    

    /**
     * Recherche d'offres dans la wishlist (exemple).
     */
    public function search() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Ici, c'est plus une recherche globale d'offres
        // Vous pourriez limiter la recherche uniquement à celles déjà en wishlist
        // ou bien réutiliser la recherche existante d'OffreController.

        $motcle = isset($_GET['motcle']) ? trim($_GET['motcle']) : '';
        $page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
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
