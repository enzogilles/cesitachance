<?php
// app/controller/GestionUtilisateursController.php

namespace app\controller;

use app\controller\BaseController;
use Database;

class GestionUtilisateursController extends BaseController
{
    /**
     * Affichage de la gestion des utilisateurs, avec pagination -> réservé à l'Admin.
     */
    public function index() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'Admin') {
            header("Location: " . BASE_URL . "index.php?controller=home&action=index");
            exit;
        }

        $pdo = Database::getInstance();

        // Pagination
        $page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
        $limit = 10;
        $offset = ($page - 1) * $limit;

        // Récupération des utilisateurs
        $sqlCount = "SELECT COUNT(*) as total FROM user";
        $resCount = $pdo->query($sqlCount)->fetch();
        $total = $resCount['total'];

        $stmt = $pdo->prepare("SELECT id, nom, prenom, email, role FROM user ORDER BY id DESC LIMIT ? OFFSET ?");
        $stmt->bindValue(1, $limit, \PDO::PARAM_INT);
        $stmt->bindValue(2, $offset, \PDO::PARAM_INT);
        $stmt->execute();
        $users = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        // Statistiques globales
        $stmtStats = $pdo->query("
            SELECT 
                COUNT(*) AS total_users,
                SUM(CASE WHEN role = 'etudiant' THEN 1 ELSE 0 END) AS total_etudiants,
                SUM(CASE WHEN role = 'pilote' THEN 1 ELSE 0 END) AS total_pilotes,
                SUM(CASE WHEN role = 'admin' THEN 1 ELSE 0 END) AS total_admins
            FROM user
        ");
        $stats = $stmtStats->fetch(\PDO::FETCH_ASSOC);

        $this->render('gestion_utilisateurs/index.twig', [
            'users' => $users,
            'stats' => $stats,
            'page' => $page,
            'limit' => $limit,
            'total' => $total
        ]);
    }

    /**
     * Création d'un utilisateur -> réservé à l'Admin.
     */
    public function create() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'Admin') {
            header("Location: " . BASE_URL . "index.php?controller=home&action=index");
            exit;
        }

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $nom = trim($_POST["nom"]);
            $prenom = trim($_POST["prenom"]);
            $email = trim($_POST["email"]);
            $role = trim($_POST["role"]);
            $password = password_hash($_POST["password"], PASSWORD_BCRYPT);

            if (!empty($nom) && !empty($prenom) && !empty($email) && !empty($role) && !empty($password)) {
                $pdo = Database::getInstance();
                $stmt = $pdo->prepare("INSERT INTO user (nom, prenom, email, role, password) VALUES (?, ?, ?, ?, ?)");
                $stmt->execute([$nom, $prenom, $email, $role, $password]);

                $_SESSION["message"] = "Utilisateur ajouté avec succès.";
            } else {
                $_SESSION["error"] = "Veuillez remplir tous les champs.";
            }

            header("Location: " . BASE_URL . "index.php?controller=gestionutilisateurs&action=index");
            exit;
        }
    }

    /**
     * Modification d'un utilisateur -> réservé à l'Admin.
     */
    public function update() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'Admin') {
            header("Location: " . BASE_URL . "index.php?controller=home&action=index");
            exit;
        }

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $id = $_POST["id"];
            $nom = trim($_POST["nom"]) ?? null;
            $prenom = trim($_POST["prenom"]) ?? null;
            $email = trim($_POST["email"]) ?? null;
            $role = trim($_POST["role"]) ?? null;

            $pdo = Database::getInstance();
            $sql = "UPDATE user SET ";
            $params = [];

            if ($nom) {
                $sql .= "nom = ?, ";
                $params[] = $nom;
            }
            if ($prenom) {
                $sql .= "prenom = ?, ";
                $params[] = $prenom;
            }
            if ($email) {
                $sql .= "email = ?, ";
                $params[] = $email;
            }
            if ($role) {
                $sql .= "role = ?, ";
                $params[] = $role;
            }

            $sql = rtrim($sql, ", ") . " WHERE id = ?";
            $params[] = $id;

            $stmt = $pdo->prepare($sql);
            $stmt->execute($params);

            $_SESSION["message"] = "Utilisateur modifié avec succès.";
            header("Location: " . BASE_URL . "index.php?controller=gestionutilisateurs&action=index");
            exit;
        }
    }

    /**
     * Suppression d'un utilisateur -> réservé à l'Admin.
     */
    public function delete() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'Admin') {
            header("Location: " . BASE_URL . "index.php?controller=home&action=index");
            exit;
        }

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $id = $_POST["id"];

            $pdo = Database::getInstance();
            $stmt = $pdo->prepare("DELETE FROM user WHERE id = ?");
            $stmt->execute([$id]);

            $_SESSION["message"] = "Utilisateur supprimé avec succès.";
            header("Location: " . BASE_URL . "index.php?controller=gestionutilisateurs&action=index");
            exit;
        }
    }

    /**
     * Recherche d'un utilisateur -> réservé à l'Admin.
     */
    public function search() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'Admin') {
            header("Location: " . BASE_URL . "index.php?controller=home&action=index");
            exit;
        }

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $searchQuery = trim($_POST["search_query"]);

            $pdo = Database::getInstance();

            if (!empty($searchQuery)) {
                $stmt = $pdo->prepare("SELECT * FROM user WHERE nom LIKE ? OR prenom LIKE ? OR email LIKE ?");
                $stmt->execute(["%$searchQuery%", "%$searchQuery%", "%$searchQuery%"]);
                $search_result = $stmt->fetch(\PDO::FETCH_ASSOC);
            } else {
                $search_result = null;
            }

            // Récupération des statistiques
            $stmtStats = $pdo->query("
                SELECT COUNT(*) AS total_users,
                    SUM(CASE WHEN role = 'etudiant' THEN 1 ELSE 0 END) AS total_etudiants,
                    SUM(CASE WHEN role = 'pilote' THEN 1 ELSE 0 END) AS total_pilotes,
                    SUM(CASE WHEN role = 'admin' THEN 1 ELSE 0 END) AS total_admins
                FROM user
            ");
            $stats = $stmtStats->fetch(\PDO::FETCH_ASSOC);

            $this->render('gestion_utilisateurs/index.twig', [
                'search_result' => $search_result,
                'stats' => $stats
            ]);
        } else {
            echo "Veuillez utiliser le formulaire pour effectuer une recherche.";
        }
    }

    /**
     * Consulter les statistiques d’un compte Étudiant -> réservé à Admin/Pilote.
     */
    public function statsEtudiant($id) {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        if (!isset($_SESSION['user']) || !in_array($_SESSION['user']['role'], ['Admin','pilote'])) {
            header("Location: " . BASE_URL . "index.php?controller=home&action=index");
            exit;
        }

        $pdo = Database::getInstance();

        // Vérifier que l'utilisateur est un étudiant
        $stmtUser = $pdo->prepare("SELECT * FROM user WHERE id = ? AND role = 'etudiant'");
        $stmtUser->execute([$id]);
        $etudiant = $stmtUser->fetch(\PDO::FETCH_ASSOC);
        if (!$etudiant) {
            die("Cet utilisateur n'est pas un étudiant ou n'existe pas.");
        }

        // Comptage des candidatures
        $stmtCandid = $pdo->prepare("SELECT COUNT(*) AS nb_candidatures FROM candidature WHERE user_id = ?");
        $stmtCandid->execute([$id]);
        $rowCandid = $stmtCandid->fetch(\PDO::FETCH_ASSOC);
        $nbCandidatures = $rowCandid['nb_candidatures'];

        // Comptage de la wishlist
        $stmtWish = $pdo->prepare("SELECT COUNT(*) AS nb_wishlist FROM wishlist WHERE user_id = ?");
        $stmtWish->execute([$id]);
        $rowWish = $stmtWish->fetch(\PDO::FETCH_ASSOC);
        $nbWishlist = $rowWish['nb_wishlist'];

        $this->render('gestion_utilisateurs/statsEtudiant.twig', [
            'etudiant' => $etudiant,
            'nbCandidatures' => $nbCandidatures,
            'nbWishlist' => $nbWishlist
        ]);
    }
}
