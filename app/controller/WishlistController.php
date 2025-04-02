<?php
// app/controller/WishlistController.php

namespace app\controller;

use app\controller\BaseController;
use Database;

class WishlistController extends BaseController {

    /**
     * Affiche la wishlist de l'utilisateur connecté -> réservé aux Étudiants ou Admin.
     */
<<<<<<< Updated upstream
    public function index() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        if (!isset($_SESSION['user']) || !in_array($_SESSION['user']['role'], ['Étudiant', 'Admin'])) {
            header("Location: " . BASE_URL . "index.php?controller=utilisateur&action=connexion");
            exit;
=======
    public function index()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['user'])) {
            $this->redirect('utilisateur', 'connexion');
>>>>>>> Stashed changes
        }
        
        $user_id = $_SESSION['user']['id'];
        $pdo = Database::getInstance();
        
<<<<<<< Updated upstream
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
=======
            // Récupération des étudiants avec pagination
            $stmt = $pdo->prepare("
                SELECT id, nom, prenom, email
                FROM user 
                WHERE role = 'Étudiant'
                ORDER BY nom, prenom
                LIMIT ?, ?
            ");
            $stmt->bindValue(1, $offset, \PDO::PARAM_INT);
            $stmt->bindValue(2, $limit, \PDO::PARAM_INT);
            $stmt->execute();
            $students = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            
            // Récupération de tous les étudiants pour le menu déroulant
            $stmt = $pdo->prepare("
                SELECT id, nom, prenom 
                FROM user 
                WHERE role = 'Étudiant'
                ORDER BY nom, prenom
            ");
            $stmt->execute();
            $etudiants = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        
            $this->render('wishlist/index.twig', [
                'students' => $students,
                'etudiants' => $etudiants,  // Ajout de la liste complète des étudiants
                'page' => $page,
                'totalPages' => $totalPages,
                'user' => $_SESSION['user']
            ]);
            return;
        }
        
        // Si c'est un étudiant, on affiche sa propre wishlist
        $user_id = $_SESSION['user']['id'];
        $wishlist = Wishlist::findByUserIdWithRelations($user_id);
        
        $this->render('wishlist/index.twig', [
            'offres' => $wishlist, // Renommer wishlist en offres pour compatibilité avec le template
            'user' => $_SESSION['user']
        ]);
>>>>>>> Stashed changes
    }

    /**
     * Ajouter une offre à la wishlist -> réservé aux Étudiants ou Admin.
     */
<<<<<<< Updated upstream
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
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
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
=======
    public function view()
    {
        $this->checkAuth(['Admin', 'pilote']);

        if (!isset($_GET['student_id'])) {
            $this->redirect('wishlist', 'index');
        }

        $student_id = (int) $_GET['student_id'];

        $wishlist = Wishlist::findByUserIdWithRelations($student_id);
        $student = Utilisateur::findById($student_id);
        
        // Récupération de tous les étudiants pour le menu déroulant
        $pdo = \Database::getInstance();
        $stmt = $pdo->prepare("
            SELECT id, nom, prenom 
            FROM user 
            WHERE role = 'Étudiant'
            ORDER BY nom, prenom
        ");
        $stmt->execute();
        $etudiants = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        $this->render('wishlist/index.twig', [
            'offres' => $wishlist,
            'etudiants' => $etudiants,  // Ajout de la liste complète des étudiants
            'user' => $_SESSION['user'],
            'student' => $student,
            'etudiant_id' => $student_id
        ]);
>>>>>>> Stashed changes
    }

    /**
     * Recherche d'offres dans la wishlist (ancienne méthode).
     */
<<<<<<< Updated upstream
    public function search() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
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
=======
    public function add()
    {
        $this->checkAuth(['Étudiant', 'Admin']);

        // Toujours utiliser JSON pour la réponse pour assurer la cohérence
        header('Content-Type: application/json');
        
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(['success' => false, 'message' => 'Méthode non autorisée']);
            exit;
        }
        
        // Récupération des données (priorité au format JSON pour les requêtes AJAX)
        $data = null;
        $isAjax = false;
        
        if (strpos($_SERVER['CONTENT_TYPE'] ?? '', 'application/json') !== false) {
            $data = json_decode(file_get_contents("php://input"), true);
            $offre_id = isset($data['offre_id']) ? intval($data['offre_id']) : null;
            $isAjax = true;
        } else {
            $offre_id = isset($_POST['offre_id']) ? intval($_POST['offre_id']) : null;
        }
        
        if (!$offre_id) {
            echo json_encode(['success' => false, 'message' => 'ID d\'offre manquant']);
            exit;
        }
        
        $user_id = $_SESSION['user']['id'];
        
        // Vérifier si l'offre est déjà dans la wishlist
        if (Wishlist::exists($user_id, $offre_id)) {
            echo json_encode(['success' => false, 'message' => 'Offre déjà dans la wishlist']);
            exit;
        }
        
        // Ajouter l'offre à la wishlist
        $success = Wishlist::add($user_id, $offre_id);
        
        if ($success) {
            $pdo = \Database::getInstance();
            $wishlist_id = $pdo->lastInsertId();
            
            // Si c'est une requête Ajax, retourner un JSON
            echo json_encode(['success' => true, 'wishlist_id' => $wishlist_id, 'message' => 'Offre ajoutée à la wishlist']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Erreur lors de l\'ajout']);
        }
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

                $this->redirect('wishlist', 'index');
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
        // On peut exiger d'être connecté, en pratique
        $this->checkAuth(['Admin', 'pilote']);

        if (!isset($_GET['etudiant_id']) || empty($_GET['etudiant_id'])) {
            $this->redirect('wishlist', 'index');
            return;
        }

        $etudiant_id = (int) $_GET['etudiant_id'];
        $page = isset($_GET['page']) ? max(1, (int) $_GET['page']) : 1;
        $limit = 10;
        $offset = ($page - 1) * $limit;

        // Récupération de la wishlist de l'étudiant sélectionné
        $wishlist = Wishlist::findByUserIdWithRelations($etudiant_id);
        $student = Utilisateur::findById($etudiant_id);
        
        // Récupération de tous les étudiants pour le menu déroulant
        $pdo = \Database::getInstance();
        $stmt = $pdo->prepare("
            SELECT id, nom, prenom 
            FROM user 
            WHERE role = 'Étudiant'
            ORDER BY nom, prenom
        ");
        $stmt->execute();
        $etudiants = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        $this->render('wishlist/index.twig', [
            'offres' => $wishlist,
            'etudiants' => $etudiants,  // Ajout de la liste complète des étudiants
            'user' => $_SESSION['user'],
            'student' => $student,
            'etudiant_id' => $etudiant_id
>>>>>>> Stashed changes
        ]);
    }
}
