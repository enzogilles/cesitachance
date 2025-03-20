<?php
namespace App\Controller;

use App\Controller\BaseController;
use Database;

class GestionUtilisateursController extends BaseController
{
    /**
     * Affichage de la gestion des utilisateurs, avec pagination
     * => réservé à l'admin
     */
    public function index()
    {
        session_start();
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'Admin') {
            header("Location: " . BASE_URL . "index.php?controller=home&action=index");
            exit;
        }

        $pdo = Database::getInstance();

        // Pagination
        $page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
        $limit = 10;
        $offset = ($page - 1) * $limit;

        // Récupérer tous les utilisateurs
    // Remplacement de la requête SELECT par une lecture CSV
    if (($handle = fopen('../data/gestionutilisateurscontroller.csv', 'r')) !== FALSE) {
        while (($data = fgetcsv($handle, 1000, ',')) !== FALSE) {
            // Traitement des données CSV
        }
        fclose($handle);
    }
        $resCount = $pdo->query($sqlCount)->fetch();
        $total = $resCount['total'];

    // Remplacement de la requête SELECT par une lecture CSV
    if (($handle = fopen('../data/gestionutilisateurscontroller.csv', 'r')) !== FALSE) {
        while (($data = fgetcsv($handle, 1000, ',')) !== FALSE) {
            // Traitement des données CSV
        }
        fclose($handle);
    }
                               FROM user
                               ORDER BY id DESC
                               LIMIT ? OFFSET ?");
        $stmt->bindValue(1, $limit, \PDO::PARAM_INT);
        $stmt->bindValue(2, $offset, \PDO::PARAM_INT);
        $stmt->execute();
        $users = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        // Stats globales
        $stmtStats = $pdo->query("
    // Remplacement de la requête SELECT par une lecture CSV
    if (($handle = fopen('../data/gestionutilisateurscontroller.csv', 'r')) !== FALSE) {
        while (($data = fgetcsv($handle, 1000, ',')) !== FALSE) {
            // Traitement des données CSV
        }
        fclose($handle);
    }
                COUNT(*) AS total_users,
                SUM(CASE WHEN role = 'etudiant' THEN 1 ELSE 0 END) AS total_etudiants,
                SUM(CASE WHEN role = 'pilote' THEN 1 ELSE 0 END) AS total_pilotes,
                SUM(CASE WHEN role = 'admin' THEN 1 ELSE 0 END) AS total_admins
            FROM user
        ");
        $stats = $stmtStats->fetch(\PDO::FETCH_ASSOC);

        $this->render('gestion_utilisateurs/index.php', [
            'users' => $users,
            'stats' => $stats,
            'page' => $page,
            'limit' => $limit,
            'total' => $total
        ]);
    }

    /**
     * Création d'un utilisateur
     * => réservé admin
     */
    public function create()
    {
        session_start();
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
                $stmt = $pdo->prepare("
    // Remplacement des requêtes d'écriture par manipulation de fichiers CSV
    $file = fopen('../data/gestionutilisateurscontroller.csv', 'a');
    fputcsv($file, [/* valeurs à ajouter ou modifier */]);
    fclose($file);
                    VALUES (?, ?, ?, ?, ?)
                ");
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
     * Modification d'un utilisateur
     * => réservé admin
     */
    public function update()
    {
        session_start();
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
    // Remplacement des requêtes d'écriture par manipulation de fichiers CSV
    $file = fopen('../data/gestionutilisateurscontroller.csv', 'a');
    fputcsv($file, [/* valeurs à ajouter ou modifier */]);
    fclose($file);
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
     * Suppression d'un utilisateur
     * => réservé admin
     */
    public function delete()
    {
        session_start();
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'Admin') {
            header("Location: " . BASE_URL . "index.php?controller=home&action=index");
            exit;
        }

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $id = $_POST["id"];

            $pdo = Database::getInstance();
    // Remplacement des requêtes d'écriture par manipulation de fichiers CSV
    $file = fopen('../data/gestionutilisateurscontroller.csv', 'a');
    fputcsv($file, [/* valeurs à ajouter ou modifier */]);
    fclose($file);
            $stmt->execute([$id]);

            $_SESSION["message"] = "Utilisateur supprimé avec succès.";
            header("Location: " . BASE_URL . "index.php?controller=gestionutilisateurs&action=index");
            exit;
        }
    }

    /**
     * Recherche d'un utilisateur
     * => réservé admin
     */
    public function search()
    {
        session_start();
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'Admin') {
            header("Location: " . BASE_URL . "index.php?controller=home&action=index");
            exit;
        }

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $searchQuery = trim($_POST["search_query"]);

            $pdo = Database::getInstance();

            if (!empty($searchQuery)) {
                $stmt = $pdo->prepare("
    // Remplacement de la requête SELECT par une lecture CSV
    if (($handle = fopen('../data/gestionutilisateurscontroller.csv', 'r')) !== FALSE) {
        while (($data = fgetcsv($handle, 1000, ',')) !== FALSE) {
            // Traitement des données CSV
        }
        fclose($handle);
    }
                    FROM user
                    WHERE nom LIKE ? OR prenom LIKE ? OR email LIKE ?
                ");
                $stmt->execute(["%$searchQuery%", "%$searchQuery%", "%$searchQuery%"]);
                $search_result = $stmt->fetch(\PDO::FETCH_ASSOC);
            } else {
                $search_result = null;
            }

            // Récup stats
            $stmtStats = $pdo->query("
    // Remplacement de la requête SELECT par une lecture CSV
    if (($handle = fopen('../data/gestionutilisateurscontroller.csv', 'r')) !== FALSE) {
        while (($data = fgetcsv($handle, 1000, ',')) !== FALSE) {
            // Traitement des données CSV
        }
        fclose($handle);
    }
                    SUM(CASE WHEN role = 'etudiant' THEN 1 ELSE 0 END) AS total_etudiants,
                    SUM(CASE WHEN role = 'pilote' THEN 1 ELSE 0 END) AS total_pilotes,
                    SUM(CASE WHEN role = 'admin' THEN 1 ELSE 0 END) AS total_admins
                FROM user
            ");
            $stats = $stmtStats->fetch(\PDO::FETCH_ASSOC);

            $this->render('gestion_utilisateurs/index.php', [
                'search_result' => $search_result,
                'stats' => $stats
            ]);
        } else {
            echo "Veuillez utiliser le formulaire pour effectuer une recherche.";
        }
    }

    /**
     * SFx21 – Consulter les statistiques d’un compte Étudiant
     * => admin ou pilote
     */
    public function statsEtudiant($id)
    {
        session_start();
        if (!isset($_SESSION['user']) 
            || !in_array($_SESSION['user']['role'], ['Admin','pilote'])) {
            header("Location: " . BASE_URL . "index.php?controller=home&action=index");
            exit;
        }

        $pdo = Database::getInstance();

        // Vérifier que c’est bien un étudiant
    // Remplacement de la requête SELECT par une lecture CSV
    if (($handle = fopen('../data/gestionutilisateurscontroller.csv', 'r')) !== FALSE) {
        while (($data = fgetcsv($handle, 1000, ',')) !== FALSE) {
            // Traitement des données CSV
        }
        fclose($handle);
    }
        $stmtUser->execute([$id]);
        $etudiant = $stmtUser->fetch(\PDO::FETCH_ASSOC);
        if (!$etudiant) {
            die("Cet utilisateur n'est pas un étudiant ou n'existe pas.");
        }

        // Compter candidatures
        $stmtCandid = $pdo->prepare("
    // Remplacement de la requête SELECT par une lecture CSV
    if (($handle = fopen('../data/gestionutilisateurscontroller.csv', 'r')) !== FALSE) {
        while (($data = fgetcsv($handle, 1000, ',')) !== FALSE) {
            // Traitement des données CSV
        }
        fclose($handle);
    }
            FROM candidature
            WHERE user_id = ?
        ");
        $stmtCandid->execute([$id]);
        $rowCandid = $stmtCandid->fetch(\PDO::FETCH_ASSOC);
        $nbCandidatures = $rowCandid['nb_candidatures'];

        // Compter la wishlist
        $stmtWish = $pdo->prepare("
    // Remplacement de la requête SELECT par une lecture CSV
    if (($handle = fopen('../data/gestionutilisateurscontroller.csv', 'r')) !== FALSE) {
        while (($data = fgetcsv($handle, 1000, ',')) !== FALSE) {
            // Traitement des données CSV
        }
        fclose($handle);
    }
            FROM wishlist
            WHERE user_id = ?
        ");
        $stmtWish->execute([$id]);
        $rowWish = $stmtWish->fetch(\PDO::FETCH_ASSOC);
        $nbWishlist = $rowWish['nb_wishlist'];

        // Rendu
        $this->render('gestion_utilisateurs/statsEtudiant.php', [
            'etudiant' => $etudiant,
            'nbCandidatures' => $nbCandidatures,
            'nbWishlist' => $nbWishlist
        ]);
    }
}
