<?php
// app/controller/GestionUtilisateursController.php

namespace app\controller;

use app\controller\BaseController;
use App\Model\Utilisateur;
use PDO;

class GestionUtilisateursController extends BaseController
{
    /**
     * Affichage de la gestion des utilisateurs (Admin ou pilote), avec pagination
     */
    public function index()
    {
        // Vérification des droits d'accès
        $this->checkAuth(['Admin', 'pilote']);

        // On récupère, s'il existe, le résultat d'une recherche stocké en session
        $search_result = $_SESSION['search_result'] ?? null;
        unset($_SESSION['search_result']);

        // Pagination
        $page = isset($_GET['page']) ? max(1, (int) $_GET['page']) : 1;
        $limit = 10;
        $offset = ($page - 1) * $limit;

        // Si c'est un pilote, on ne récupère que les étudiants
        if ($this->user['role'] === 'pilote') {
            $total = Utilisateur::countByRole('Étudiant');
            $users = Utilisateur::findByRole('Étudiant', $limit, $offset);
        } else {
            // Pour les admins, on récupère tous les utilisateurs
            $total = Utilisateur::countAll();
            $users = Utilisateur::findAll($limit, $offset);
        }

        // Statistiques globales
        $stats = Utilisateur::getStats();

        // Rendu de la vue Twig
        $this->render('gestion_utilisateurs/index.twig', [
            'users'         => $users,
            'stats'         => $stats,
            'page'          => $page,
            'limit'         => $limit,
            'total'         => $total,
            'search_result' => $search_result
        ]);
    }

    /**
     * Création d'un utilisateur (Admin ou pilote)
     */
    public function create()
    {
        // On autorise maintenant le pilote aussi
        $this->checkAuth(['Admin', 'pilote']);

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $nom      = trim($_POST["nom"]);
            $prenom   = trim($_POST["prenom"]);
            $email    = trim($_POST["email"]);
            $role     = trim($_POST["role"]);
            $password = password_hash($_POST["password"], PASSWORD_BCRYPT);

            // Si le pilote crée un utilisateur, on impose qu'il soit "Étudiant".
            if ($this->user['role'] === 'pilote') {
                if ($role !== 'Étudiant') {
                    $role = 'Étudiant';
                }
            }

            if (!empty($nom) && !empty($prenom) && !empty($email) && !empty($role) && !empty($password)) {
                Utilisateur::createUser($nom, $prenom, $email, $role, $password);
                $created = true;
            } else {
                $_SESSION["error"] = "Veuillez remplir tous les champs.";
                $created = false;
            }

            $this->redirect('gestionutilisateurs', 'index', $created ? ['notif' => 'created'] : ['notif' => 'error']);
        }
    }

    /**
     * Modification d'un utilisateur
     */
    public function update()
    {
        $this->checkAuth(['Admin', 'pilote']);

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $id     = $_POST["id"];
            $nom    = trim($_POST["nom"])    ?? null;
            $prenom = trim($_POST["prenom"]) ?? null;
            $email  = trim($_POST["email"])  ?? null;
            $role   = trim($_POST["role"])   ?? null;

            // Vérification supplémentaire pour les pilotes
            if ($this->user['role'] === 'pilote') {
                // Vérifier que l'utilisateur à modifier est un Étudiant
                $user = Utilisateur::findById($id);
                if (!$user || $user['role'] !== 'Étudiant') {
                    $_SESSION["error"] = "Vous ne pouvez modifier que les comptes étudiants.";
                    $this->redirect('gestionutilisateurs', 'index');
                }
                // Forcer le rôle Étudiant pour la modification par un pilote
                $role = 'Étudiant';
            }

            Utilisateur::updateUser($id, $nom, $prenom, $email, $role);
            $this->redirect('gestionutilisateurs', 'index', ['notif' => 'updated']);
            header('Location: ' . BASE_URL . 'gestion-utilisateurs?notif=updated');
        }
    }

    /**
     * Suppression d'un utilisateur
     */
    public function delete()
    {
        $this->checkAuth(['Admin', 'pilote']);

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $id = $_POST["id"];

            // Vérification supplémentaire pour les pilotes
            if ($this->user['role'] === 'pilote') {
                $user = Utilisateur::findById($id);
                if (!$user || $user['role'] !== 'Étudiant') {
                    $_SESSION["error"] = "Vous ne pouvez supprimer que les comptes étudiants.";
                    $this->redirect('gestionutilisateurs', 'index');
                    return;
                }
            }

            Utilisateur::deleteUser($id);
            $_SESSION["message"] = "Utilisateur supprimé avec succès.";
            $this->redirect('gestionutilisateurs', 'index', ['notif' => 'deleted']);
        }
    }

    /**
     * Recherche d'un utilisateur
     */
    public function search()
    {
        $this->checkAuth(['Admin', 'pilote']);

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $searchQuery = trim($_POST["search_query"]);

            if ($this->user['role'] === 'pilote') {
                // Modification de la recherche pour les pilotes (seulement les étudiants)
                $search_result = (!empty($searchQuery))
                    ? Utilisateur::searchByRole($searchQuery, 'Étudiant')
                    : [];
            } else {
                $search_result = (!empty($searchQuery))
                    ? Utilisateur::search($searchQuery)
                    : [];
            }

            // On stocke le résultat de la recherche en session
            $_SESSION['search_result'] = $search_result;

            $this->redirect('gestionutilisateurs', 'index', ['notif' => 1]);
        } else {
            echo "Veuillez utiliser le formulaire pour effectuer une recherche.";
        }
    }

    /**
     * Consulter les statistiques d'un compte Étudiant -> réservé à Admin/Pilote.
     */
    public function statsEtudiant($id)
    {
        $this->checkAuth(['Admin', 'pilote']);

        // Vérifier que l'utilisateur est un Étudiant
        $etudiant = Utilisateur::isEtudiant($id);
        if (!$etudiant) {
            die("Cet utilisateur n'est pas un étudiant ou n'existe pas.");
        }

        try {
            $pdo = \Database::getInstance();

            // Comptage des candidatures
            $stmtCandid = $pdo->prepare("SELECT COUNT(*) AS nb_candidatures FROM candidature WHERE user_id = ?");
            $stmtCandid->execute([$id]);
            $rowCandid = $stmtCandid->fetch(PDO::FETCH_ASSOC);
            $nbCandidatures = $rowCandid['nb_candidatures'];

            // Comptage de la wishlist
            $stmtWish = $pdo->prepare("SELECT COUNT(*) AS nb_wishlist FROM wishlist WHERE user_id = ?");
            $stmtWish->execute([$id]);
            $rowWish = $stmtWish->fetch(PDO::FETCH_ASSOC);
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
}
