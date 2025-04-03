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
        if (!isset($_SESSION['user'])) {
            $this->redirect('utilisateur', 'connexion');
        }

        if (in_array($_SESSION['user']['role'], ['Admin', 'pilote'])) {
            $page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
            $limit = 10;
            $offset = ($page - 1) * $limit;

            $result = Utilisateur::findStudentsAndAdminsPaginated($offset, $limit);
            $students = $result['users'];
            $total = $result['total'];
            $totalPages = ceil($total / $limit);

            $allUsers = Utilisateur::findAllStudentsAndAdmins();

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

    public function view()
    {
        $this->checkAuth(['Admin', 'pilote']);

        if (!isset($_GET['student_id'])) {
            $this->redirect('wishlist', 'index');
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
                echo json_encode(['success' => false, 'message' => "ID d'offre manquant"]);
                exit;
            }

            $user_id = $_SESSION['user']['id'];
            $offre_id = (int)$data['offre_id'];

            if (Wishlist::exists($user_id, $offre_id)) {
                echo json_encode(['success' => false, 'message' => "Offre d\u00e9j\u00e0 dans la wishlist"]);
            } else {
                $result = Wishlist::add($user_id, $offre_id);
                echo json_encode([
                    'success' => $result['success'],
                    'wishlist_id' => $result['wishlist_id'],
                    'message' => $result['success'] ? null : "Erreur lors de l'ajout"
                ]);
            }
            exit;
        }

        header('Content-Type: application/json');
        echo json_encode(['success' => false, 'message' => 'Requête invalide']);
        exit;
    }

    public function remove()
    {
        $this->checkAuth(['Étudiant', 'Admin']);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = json_decode(file_get_contents("php://input"), true);

            if ($data && isset($data['wishlist_id'])) {
                $success = Wishlist::remove($data['wishlist_id']);
                header('Content-Type: application/json');
                echo json_encode(['success' => $success]);
                exit;
            }

            if (isset($_POST['wishlist_id'])) {
                Wishlist::remove($_POST['wishlist_id']);
                $this->redirect('wishlist', 'index');
            }
        }

        header('Content-Type: application/json');
        echo json_encode(['success' => false, 'message' => 'Requête invalide.']);
        exit;
    }

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