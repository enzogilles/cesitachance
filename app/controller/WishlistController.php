<?php
// app/controller/WishlistController.php

namespace app\controller;

use app\controller\BaseController;
use Database;

class WishlistController extends BaseController {

    /**
     * Affiche la wishlist de l'utilisateur connecté -> réservé aux Étudiants ou Admin.
     */
    public function index() {
        session_start();
        if (!isset($_SESSION['user']) || !in_array($_SESSION['user']['role'], ['Étudiant', 'Admin'])) {
            header("Location: " . BASE_URL . "index.php?controller=utilisateur&action=connexion");
            exit;
        }
        
        $user_id = $_SESSION['user']['id'];
        $pdo = Database::getInstance();
        
        $stmt = $pdo->prepare("
            SELECT w.id AS wishlist_id, o.id AS offre_id, o.titre, e.nom AS entreprise
            FROM wishlist w
            JOIN offre o ON w.offre_id = o.id
            JOIN entreprise e ON o.entreprise_id = e.id
            WHERE w.user_id = ?
        ");
        $stmt->execute([$user_id]);
        $wishlist = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        
        $this->render('wishlist/index.twig', ['wishlist' => $wishlist]);
    }

    /**
     * Ajouter une offre à la wishlist -> réservé aux Étudiants ou Admin.
     */
    public function add() {
        session_start();
        if (!isset($_SESSION['user']) || !in_array($_SESSION['user']['role'], ['Étudiant', 'Admin'])) {
            header("Location: " . BASE_URL . "index.php?controller=utilisateur&action=connexion");
            exit;
        }
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['offre_id'])) {
            $user_id = $_SESSION['user']['id'];
            $offre_id = intval($_POST['offre_id']);
    
            $pdo = Database::getInstance();
            
            $stmt = $pdo->prepare("SELECT id FROM wishlist WHERE user_id = ? AND offre_id = ?");
            $stmt->execute([$user_id, $offre_id]);
            
            if ($stmt->fetch()) {
                $_SESSION['error'] = "Cette offre est déjà dans votre wishlist.";
            } else {
                $stmt = $pdo->prepare("INSERT INTO wishlist (user_id, offre_id) VALUES (?, ?)");
                $stmt->execute([$user_id, $offre_id]);
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
        session_start();
        if (!isset($_SESSION['user']) || !in_array($_SESSION['user']['role'], ['Étudiant', 'Admin'])) {
            header("Location: " . BASE_URL . "index.php?controller=utilisateur&action=connexion");
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $wishlist_id = $_POST['wishlist_id'];
            $pdo = Database::getInstance();
            $stmt = $pdo->prepare("DELETE FROM wishlist WHERE id = ?");
            $stmt->execute([$wishlist_id]);
            header("Location: " . BASE_URL . "index.php?controller=wishlist&action=index");
            exit;
        }
    }

    /**
     * Recherche d'offres dans la wishlist (ancienne méthode).
     */
    public function search() {
        session_start();
        $pdo = Database::getInstance();

        $motcle = isset($_GET['motcle']) ? trim($_GET['motcle']) : '';
        $page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
        $limit = 10;
        $offset = ($page - 1) * $limit;

        if (!empty($motcle)) {
            $stmtCount = $pdo->prepare("
                SELECT COUNT(*) as total 
                FROM offre o
                JOIN entreprise e ON o.entreprise_id = e.id
                WHERE o.titre LIKE :motcle OR o.description LIKE :motcle
            ");
            $stmtCount->execute(['motcle' => "%$motcle%"]);
            $resCount = $stmtCount->fetch(\PDO::FETCH_ASSOC);
            $total = $resCount['total'];
            $totalPages = ceil($total / $limit);

            $stmt = $pdo->prepare("
                SELECT o.id, o.titre, o.description, o.remuneration,
                       e.nom as entreprise
                FROM offre o
                JOIN entreprise e ON o.entreprise_id = e.id
                WHERE o.titre LIKE :motcle OR o.description LIKE :motcle
                ORDER BY o.id DESC
                LIMIT :limit OFFSET :offset
            ");
            $stmt->bindValue(':motcle', "%$motcle%", \PDO::PARAM_STR);
            $stmt->bindValue(':limit', $limit, \PDO::PARAM_INT);
            $stmt->bindValue(':offset', $offset, \PDO::PARAM_INT);
            $stmt->execute();
            $offres = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } else {
            $this->index();
            return;
        }

        $this->render('offres/index.twig', [
            'offres' => $offres,
            'motcle' => $motcle,
            'page' => $page,
            'totalPages' => $totalPages,
            'competences' => ''
        ]);
    }
}
