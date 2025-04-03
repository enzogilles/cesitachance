<?php
// app/controller/WishlistController.php

namespace App\Controller;

use app\Controller\BaseController;
use App\Model\Wishlist;
use App\Model\Utilisateur;
use App\Model\Offre;

class WishlistController extends BaseController
{
    private $defaultLimit = 10;
    
    /**
     * Récupère les paramètres de pagination
     */
    private function getPaginationParams()
    {
        $page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
        $limit = $this->defaultLimit;
        $offset = ($page - 1) * $limit;
        
        return [
            'page' => $page,
            'limit' => $limit,
            'offset' => $offset
        ];
    }
    
    /**
     * Prépare les paramètres communs pour les templates
     */
    private function getBaseTemplateParams($additionalParams = [])
    {
        $params = [
            'user' => $_SESSION['user'] ?? null,
            'student_id' => $_GET['student_id'] ?? null,
        ];
        
        return array_merge($params, $additionalParams);
    }
    
    /**
     * Envoie une réponse JSON
     */
    private function sendJsonResponse($data)
    {
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
        exit;
    }

    public function index()
    {
        if (!isset($_SESSION['user'])) {
            $this->redirect('utilisateur', 'connexion');
        }

        $userRole = $_SESSION['user']['role'];

        // Cas Admin/Pilote
        if (in_array($userRole, ['Admin', 'pilote'])) {
            $pagination = $this->getPaginationParams();
            
            $result = Utilisateur::findStudentsAndAdminsPaginated(
                $pagination['offset'], 
                $pagination['limit']
            );
            
            $totalPages = ceil($result['total'] / $pagination['limit']);
            
            $templateParams = $this->getBaseTemplateParams([
                'students' => $result['users'],
                'allUsers' => Utilisateur::findAllStudentsAndAdmins(),
                'page' => $pagination['page'],
                'totalPages' => $totalPages,
            ]);
            
            $this->render('wishlist/index.twig', $templateParams);
            return;
        }

        // Cas Étudiant/Admin
        if (in_array($userRole, ['Étudiant', 'Admin'])) {
            $userId = $_SESSION['user']['id'];
            $pagination = $this->getPaginationParams();
            
            $wishlist = Wishlist::findByUserIdWithRelationsPaginated(
                $userId, 
                $pagination['limit'], 
                $pagination['offset']
            );
            
            $total = Wishlist::countByUserId($userId);
            $totalPages = ceil($total / $pagination['limit']);
            
            $templateParams = $this->getBaseTemplateParams([
                'wishlist' => $wishlist,
                'page' => $pagination['page'],
                'totalPages' => $totalPages
            ]);
            
            $this->render('wishlist/index.twig', $templateParams);
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

        $templateParams = $this->getBaseTemplateParams([
            'wishlist' => $wishlist,
            'student' => $student,
        ]);

        $this->render('wishlist/index.twig', $templateParams);
    }

    public function add()
    {
        $this->checkAuth(['Étudiant', 'Admin']);

        // Vérifie si c'est une requête JSON valide
        if (
            $_SERVER['REQUEST_METHOD'] !== 'POST' || 
            strpos($_SERVER['CONTENT_TYPE'] ?? '', 'application/json') === false
        ) {
            $this->sendJsonResponse(['success' => false, 'message' => 'Requête invalide']);
        }

        $data = json_decode(file_get_contents("php://input"), true);

        if (!isset($data['offre_id'])) {
            $this->sendJsonResponse(['success' => false, 'message' => "ID d'offre manquant"]);
        }

        $user_id = $_SESSION['user']['id'];
        $offre_id = (int)$data['offre_id'];

        if (Wishlist::exists($user_id, $offre_id)) {
            $this->sendJsonResponse(['success' => false, 'message' => "Offre déjà dans la wishlist"]);
        } 
        
        $result = Wishlist::add($user_id, $offre_id);
        $this->sendJsonResponse([
            'success' => $result['success'],
            'wishlist_id' => $result['wishlist_id'],
            'message' => $result['success'] ? null : "Erreur lors de l'ajout"
        ]);
    }

    public function remove()
    {
        $this->checkAuth(['Étudiant', 'Admin']);

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->sendJsonResponse(['success' => false, 'message' => 'Requête invalide.']);
        }

        // Traitement des requêtes AJAX
        $data = json_decode(file_get_contents("php://input"), true);
        if ($data && isset($data['wishlist_id'])) {
            $success = Wishlist::remove($data['wishlist_id']);
            $this->sendJsonResponse(['success' => $success]);
        }

        // Traitement des requêtes de formulaire standard
        if (isset($_POST['wishlist_id'])) {
            Wishlist::remove($_POST['wishlist_id']);
            $this->redirect('wishlist', 'index');
        }

        $this->sendJsonResponse(['success' => false, 'message' => 'ID de wishlist manquant.']);
    }

    public function search()
    {
        $this->checkAuth(['Admin']);

        $motcle = isset($_GET['motcle']) ? trim($_GET['motcle']) : '';
        $studentId = isset($_GET['student_id']) && $_GET['student_id'] !== '' ? (int)$_GET['student_id'] : null;
        $pagination = $this->getPaginationParams();
        
        $wishlist = [];
        $student = null;
        $total = 0;
        $totalPages = 0;

        if ($studentId !== null) {
            $result = Wishlist::searchByStudent(
                $studentId, 
                $motcle, 
                $pagination['limit'], 
                $pagination['offset']
            );
            
            $wishlist = $result['wishlist'];
            $total = $result['total'];
            $totalPages = ceil($total / $pagination['limit']);
            $student = Utilisateur::findById($studentId);
        }

        $templateParams = $this->getBaseTemplateParams([
            'wishlist' => $wishlist,
            'motcle' => $motcle,
            'page' => $pagination['page'],
            'totalPages' => $totalPages,
            'student' => $student,
            'notif' => '1',
        ]);

        $this->render('wishlist/index.twig', $templateParams);
    }
}