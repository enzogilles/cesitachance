<?php
// app/controller/GestionUtilisateursController.php

namespace app\controller;

use app\controller\BaseController;
use App\Model\Utilisateur;
use PDO;

class GestionUtilisateursController extends BaseController
{
    /**
     * Affichage de la gestion des utilisateurs, avec pagination -> Admin seulement
     */
    public function index()
    {
        $this->checkAuth(['Admin']);

        // On récupère, s'il existe, le résultat d'une recherche stocké en session
        $search_result = $_SESSION['search_result'] ?? null;
        unset($_SESSION['search_result']);  // On le supprime de la session après l'avoir récupéré

        // Pagination
        $page  = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
        $limit = 10;
        $offset = ($page - 1) * $limit;

        // Récupération des utilisateurs (paginer)
        $total = Utilisateur::countAll();
        $users = Utilisateur::findAll($limit, $offset);

        // Statistiques globales
        $stats = Utilisateur::getStats();

        // Rendu de la vue Twig
        $this->render('gestion_utilisateurs/index.twig', [
            'users'         => $users,
            'stats'         => $stats,
            'page'          => $page,
            'limit'         => $limit,
            'total'         => $total,
            'search_result' => $search_result,
        ]);
    }

    /**
     * Création d'un utilisateur -> réservé à l'Admin.
     */
    public function create()
    {
        $this->checkAuth(['Admin']);

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $nom      = trim($_POST["nom"]);
            $prenom   = trim($_POST["prenom"]);
            $email    = trim($_POST["email"]);
            $role     = trim($_POST["role"]);
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
    public function update()
    {
        $this->checkAuth(['Admin']);

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $id     = $_POST["id"];
            $nom    = trim($_POST["nom"]) ?? null;
            $prenom = trim($_POST["prenom"]) ?? null;
            $email  = trim($_POST["email"]) ?? null;
            $role   = trim($_POST["role"]) ?? null;

            Utilisateur::updateUser($id, $nom, $prenom, $email, $role);

            $_SESSION["message"] = "Utilisateur modifié avec succès.";

            header("Location: " . BASE_URL . "index.php?controller=gestionutilisateurs&action=index");
            exit;
        }
    }

    /**
     * Suppression d'un utilisateur -> réservé à l'Admin.
     */
    public function delete()
    {
        $this->checkAuth(['Admin']);

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
    public function search()
    {
        $this->checkAuth(['Admin']);
    
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $searchQuery = trim($_POST["search_query"]);
            $search_result = null;

            if (!empty($searchQuery)) {
                // exemple : on ne gère qu'un seul résultat ou un tableau...
                $results = Utilisateur::search($searchQuery);
                $search_result = (!empty($results)) ? $results[0] : [];
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
    public function statsEtudiant($id)
    {
        $this->checkAuth(['Admin','pilote']);

        // Vérifier que l'utilisateur est un étudiant
        $etudiant = Utilisateur::isEtudiant($id);
        if (!$etudiant) {
            die("Cet utilisateur n'est pas un étudiant ou n'existe pas.");
        }

        try {
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

        } catch (\PDOException $e) {
            throw new \Exception("Erreur lors de la récupération des statistiques étudiant : " . $e->getMessage());
        }

        $this->render('gestion_utilisateurs/statsEtudiant.twig', [
            'etudiant'       => $etudiant,
            'nbCandidatures' => $nbCandidatures,
            'nbWishlist'     => $nbWishlist
        ]);
    }
    
    /**
     * Vérifie que l’utilisateur est connecté et a l’un des rôles autorisés.
     * (Cette méthode s'appuie sur le BaseController::checkAuth())
     */
    protected function checkAuth(array $allowedRoles = [])
    {
        parent::checkAuth($allowedRoles);
    }
}
