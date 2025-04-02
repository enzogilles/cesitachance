<?php
// app/controller/WishlistController.php

namespace App\Controller;

use app\Controller\BaseController;
use App\Model\Wishlist;
use App\Model\Utilisateur;
use App\Model\Offre;

class WishlistController extends BaseController
{
    /**
     * Affiche la wishlist de l'étudiant connecté
     * ou la liste des étudiants si Admin/pilote.
     */

     public function index()
     {
         if (session_status() === PHP_SESSION_NONE) {
             session_start();
         }
     
         if (!isset($_SESSION['user'])) {
             header("Location: " . BASE_URL . "index.php?controller=utilisateur&action=connexion");
             exit;
         }
     
         $pdo = \Database::getInstance();
     
         // Si c'est un admin/pilote qui consulte la liste des étudiants
         if (in_array($_SESSION['user']['role'], ['Admin', 'pilote'])) {
             $page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
             $limit = 10;
             $offset = ($page - 1) * $limit;
     
             // Compte total des utilisateurs ciblés
             $stmt = $pdo->prepare("
                 SELECT COUNT(*) as total 
                 FROM user 
                 WHERE role IN ('Étudiant', 'Admin')
             ");
             $stmt->execute();
             $count = $stmt->fetch(\PDO::FETCH_ASSOC);
             $total = $count['total'];
             $totalPages = ceil($total / $limit);
     
             // Récupération paginée pour affichage
             $stmt = $pdo->prepare("
                 SELECT id, nom, prenom, email, role
                 FROM user 
                 WHERE role IN ('Étudiant', 'Admin')
                 ORDER BY nom, prenom
                 LIMIT ?, ?
             ");
             $stmt->bindValue(1, $offset, \PDO::PARAM_INT);
             $stmt->bindValue(2, $limit, \PDO::PARAM_INT);
             $stmt->execute();
             $students = $stmt->fetchAll(\PDO::FETCH_ASSOC);
     
             // Récupération de tous les utilisateurs pour le <select>
             $stmtAll = $pdo->prepare("
                 SELECT id, nom, prenom, role 
                 FROM user 
                 WHERE role IN ('Étudiant', 'Admin') 
                 ORDER BY nom, prenom
             ");
             $stmtAll->execute();
             $allUsers = $stmtAll->fetchAll(\PDO::FETCH_ASSOC);
     
             $this->render('wishlist/index.twig', [
                 'students' => $students,
                 'allUsers' => $allUsers,
                 'page' => $page,
                 'totalPages' => $totalPages,
                 'user' => $_SESSION['user'],
                 'student_id' => $_GET['student_id'] ?? null,
             ]);
             return;
         }
     
         // Si c'est un étudiant ou un admin qui consulte sa propre wishlist
         if (in_array($_SESSION['user']['role'], ['Étudiant', 'Admin'])) {
             $userId = $_SESSION['user']['id'];
             $page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
             $limit = 10;
             $offset = ($page - 1) * $limit;
     
             $wishlist = Wishlist::findByUserIdWithRelationsPaginated($userId, $limit, $offset);
             $total = Wishlist::countByUserId($userId);
             $totalPages = ceil($total / $limit);
     
             $this->render('wishlist/index.twig', [
                 'wishlist' => $wishlist,
                 'user' => $_SESSION['user'],
                 'page' => $page,
                 'totalPages' => $totalPages
             ]);
             return;
         }
     }

    /**
     * Vue pour qu'un Admin/pilote voie la wishlist d'un étudiant précis.
     */
    public function view()
    {
        $this->checkAuth(['Admin', 'pilote']);

        if (!isset($_GET['student_id'])) {
            header("Location: " . BASE_URL . "index.php?controller=wishlist&action=index");
            exit;
        }

        $student_id = (int) $_GET['student_id'];

        $wishlist = Wishlist::findByUserIdWithRelations($student_id);
        $student = Utilisateur::findById($student_id);

        $this->render('wishlist/index.twig', [
            'wishlist' => $wishlist,
            'user' => $_SESSION['user'],
            'student' => $student,
        ]);
    }

    /**
     * Ajoute une offre à la wishlist -> réservé aux Étudiants ou Admin.
     */
    public function add()
    {
        $this->checkAuth(['Étudiant', 'Admin']);

        if (
            $_SERVER['REQUEST_METHOD'] === 'POST' &&
            strpos($_SERVER['CONTENT_TYPE'] ?? '', 'application/json') !== false
        ) {
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
    public function remove()
    {
        $this->checkAuth(['Étudiant', 'Admin']);

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
    public function search()
    {
        $this->checkAuth(['Admin']);
    
        $motcle = isset($_GET['motcle']) ? trim($_GET['motcle']) : '';
        $studentId = isset($_GET['student_id']) && $_GET['student_id'] !== '' ? (int)$_GET['student_id'] : null;
        $page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
        $limit = 10;
        $offset = ($page - 1) * $limit;
    
        $wishlist = [];
        $student = null;
        $total = 0;
        $totalPages = 0;
    
        if ($studentId !== null) {
            $result = Wishlist::searchByStudent($studentId, $motcle, $limit, $offset);
            $wishlist = $result['wishlist'];
            $total = $result['total'];
            $totalPages = ceil($total / $limit);
            $student = Utilisateur::findById($studentId);
        }
    
        $this->render('wishlist/index.twig', [
            'wishlist' => $wishlist,
            'motcle' => $motcle,
            'page' => $page,
            'totalPages' => $totalPages,
            'student' => $student,
            'user' => $_SESSION['user'],
            'notif' => '1',
            'student_id' => $studentId 
        ]);
    }
    
    
}
