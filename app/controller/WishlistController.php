<?php
// app/controller/WishlistController.php

namespace App\Controller;

use app\Controller\BaseController;
use App\Model\Wishlist;
use App\Model\Utilisateur;
use App\Model\Offre;

class WishlistController extends BaseController
{
    public function index()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['user']) || !in_array($_SESSION['user']['role'], ['Étudiant', 'Admin', 'pilote'])) {
            header("Location: " . BASE_URL . "index.php?controller=utilisateur&action=connexion");
            exit;
        }

        $role = $_SESSION['user']['role'];

        if ($role === 'Étudiant') {
            $user_id = $_SESSION['user']['id'];
            $wishlist = Wishlist::findByUserIdWithRelations($user_id);
            $this->render('wishlist/index.twig', [
                'wishlist' => $wishlist,
                'userRole' => $role,
                'user'     => $_SESSION['user']
            ]);
        } elseif (in_array($role, ['Admin', 'pilote'])) {
            $students = Utilisateur::findAllEtudiants();
            $this->render('wishlist/index.twig', [
                'students' => $students,
                'userRole' => $role,
                'user'     => $_SESSION['user']
            ]);
        } else {
            header("Location: " . BASE_URL . "index.php?controller=utilisateur&action=connexion");
            exit;
        }
    }

    public function view()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['user']) || !in_array($_SESSION['user']['role'], ['Admin', 'pilote'])) {
            header("Location: " . BASE_URL . "index.php?controller=utilisateur&action=connexion");
            exit;
        }

        if (!isset($_GET['student_id'])) {
            header("Location: " . BASE_URL . "index.php?controller=wishlist&action=index");
            exit;
        }

        $student_id = (int) $_GET['student_id'];

        $wishlist = Wishlist::findByUserIdWithRelations($student_id);
        $student  = Utilisateur::findById($student_id);

        $this->render('wishlist/index.twig', [
            'wishlist' => $wishlist,
            'user'     => $_SESSION['user'],
            'student'  => $student,
        ]);
    }

    /**
     * Ajoute une offre à la wishlist -> réservé aux Étudiants ou Admin.
     */
    public function add() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    
        if (!isset($_SESSION['user']) || !in_array($_SESSION['user']['role'], ['Étudiant', 'Admin'])) {
            if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
                strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
                header('Content-Type: application/json');
                echo json_encode(['success' => false, 'message' => 'Non autorisé']);
                exit;
            }
            header("Location: " . BASE_URL . "index.php?controller=utilisateur&action=connexion");
            exit;
        }
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST' &&
            strpos($_SERVER['CONTENT_TYPE'] ?? '', 'application/json') !== false) {
    
            $data = json_decode(file_get_contents("php://input"), true);
    
            if (!isset($data['offre_id'])) {
                header('Content-Type: application/json');
                echo json_encode(['success' => false, 'message' => 'ID d\'offre manquant']);
                exit;
            }
    
            $user_id = $_SESSION['user']['id'];
            $offre_id = intval($data['offre_id']);
    
            if (Wishlist::exists($user_id, $offre_id)) {
                echo json_encode(['success' => false, 'message' => 'Offre déjà dans la wishlist']);
            } else {
                $success = Wishlist::add($user_id, $offre_id);
                if ($success) {
                    $pdo = \Database::getInstance();
                    $wishlist_id = $pdo->lastInsertId();
                    echo json_encode(['success' => true, 'wishlist_id' => $wishlist_id]);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Erreur lors de l\'ajout']);
                }
            }
            exit;
        }
    
        header('Content-Type: application/json');
        echo json_encode(['success' => false, 'message' => 'Requête invalide']);
        exit;
    }
    
    /**
     * Retire une offre de la wishlist -> réservé aux Étudiants ou Admin.
     */
    public function remove() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    
        if (!isset($_SESSION['user']) || !in_array($_SESSION['user']['role'], ['Étudiant', 'Admin'])) {
            if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
                header('Content-Type: application/json');
                echo json_encode(['success' => false, 'message' => 'Non autorisé']);
                exit;
            }
            header("Location: " . BASE_URL . "index.php?controller=utilisateur&action=connexion");
            exit;
        }
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = file_get_contents("php://input");
            $json = json_decode($data, true);
    
            if ($json && isset($json['wishlist_id'])) {
                $wishlist_id = $json['wishlist_id'];
                $success = Wishlist::remove($wishlist_id);
    
                header('Content-Type: application/json');
                echo json_encode(['success' => $success]);
                exit;
            }
    
            if (isset($_POST['wishlist_id'])) {
                $wishlist_id = $_POST['wishlist_id'];
                Wishlist::remove($wishlist_id);
    
                header("Location: " . BASE_URL . "index.php?controller=wishlist&action=index");
                exit;
            }
        }
    
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
