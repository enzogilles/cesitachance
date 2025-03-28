<?php
// app/controller/GestionUtilisateursController.php

namespace app\controller;

use app\controller\BaseController;
use App\Model\Utilisateur;
use PDO;

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

        // Pagination
        $page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
        $limit = 10;
        $offset = ($page - 1) * $limit;

        // Récupération des utilisateurs via Model
        $total = Utilisateur::countAll();
        $users = Utilisateur::findAll($limit, $offset);

        // Statistiques globales
        $stats = Utilisateur::getStats();

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
                Utilisateur::createUser($nom, $prenom, $email, $role, $password);
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

            Utilisateur::updateUser($id, $nom, $prenom, $email, $role);

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
            Utilisateur::deleteUser($id);

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

            $search_result = null;
            if (!empty($searchQuery)) {
                $search_result = Utilisateur::search($searchQuery);
            }

            // Récupération des statistiques
            $stats = Utilisateur::getStats();

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

        // Vérifier que l'utilisateur est un étudiant
        $etudiant = Utilisateur::isEtudiant($id);
        if (!$etudiant) {
            die("Cet utilisateur n'est pas un étudiant ou n'existe pas.");
        }

        // On fait nos stats en direct (ou via un Model) :
        $pdo = \Database::getInstance();

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
