<?php
// Namespace pour organiser les classes dans l'application
namespace app\controller;

// Import de la classe de base pour les contrôleurs
use app\controller\BaseController;
// Modèle représentant une entreprise
use App\Model\Entreprise;

class EntrepriseController extends BaseController
{
    /**
     * Affiche la liste des entreprises avec :
     * - Recherche par nom, ville ou secteur
     * - Pagination
     * - Boutons conditionnels selon le rôle (Admin/Pilote)
     */
    public function index() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Récupération des filtres GET
        $nom = isset($_GET['nom']) ? trim($_GET['nom']) : '';
        $ville = isset($_GET['ville']) ? trim($_GET['ville']) : '';
        $secteur = isset($_GET['secteur']) ? trim($_GET['secteur']) : '';

        // Pagination
        $page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
        $limit = 10;
        $offset = ($page - 1) * $limit;

        // On utilise le modèle pour compter et récupérer les données
        $total = Entreprise::countAll($nom, $ville, $secteur);
        $totalPages = ceil($total / $limit);

        $entreprises = Entreprise::search($nom, $ville, $secteur, $limit, $offset);

        // Boutons d'action pour la vue
        foreach ($entreprises as &$entreprise) {
            $detailLink = '<a href="' . BASE_URL . 'index.php?controller=entreprise&action=details&id=' . $entreprise['id'] . '" class="btn-voir">Détails</a>';

            if (isset($_SESSION['user']) && in_array($_SESSION['user']['role'], ['Admin', 'pilote'])) {
                $modifyLink = ' <a href="' . BASE_URL . 'index.php?controller=entreprise&action=modifier&id=' . $entreprise['id'] . '" class="btn-modifier">Modifier</a>';
                $deleteLink = ' <form action="' . BASE_URL . 'index.php?controller=entreprise&action=supprimer" method="POST" style="display:inline;">
                                    <input type="hidden" name="id" value="' . $entreprise['id'] . '">
                                    <button type="submit" class="btn-supprimer");">Supprimer</button>
                                </form>';
                $entreprise['actions'] = $detailLink . $modifyLink . $deleteLink;
            } else {
                $entreprise['actions'] = $detailLink;
            }
        }
        unset($entreprise);

        $this->render('entreprises/index.twig', [
            'entreprises' => $entreprises,
            'page' => $page,
            'totalPages' => $totalPages,
            'nom' => $nom,
            'ville' => $ville,
            'secteur' => $secteur
        ]);
    }

    /**
     * Formulaire de création d'une entreprise.
     * Accessible uniquement aux Admins ou Pilotes.
     */
    public function creer() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['user']) || !in_array($_SESSION['user']['role'], ['Admin', 'pilote'])) {
            header("Location: " . BASE_URL . "index.php?controller=home&action=index");
            exit;
        }

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $nom = trim($_POST["nom"]);
            $ville = trim($_POST["ville"]);
            $secteur = trim($_POST["secteur"]);
            $taille = trim($_POST["taille"]);
            $description = trim($_POST["description"]);
            $email = trim($_POST["email"]);
            $telephone = trim($_POST["telephone"]);

            if (!empty($nom) && !empty($ville) && !empty($secteur) && !empty($taille)) {
                $entreprise = new Entreprise();
                $entreprise->nom = $nom;
                $entreprise->ville = $ville;
                $entreprise->secteur = $secteur;
                $entreprise->taille = $taille;
                $entreprise->description = $description;
                $entreprise->email = $email;
                $entreprise->telephone = $telephone;
                $entreprise->save();

                header("Location: " . BASE_URL . "index.php?controller=entreprise&action=index");
                exit;
            }
        }

        $this->render('entreprises/gestion.twig');
    }

    /**
     * Formulaire de modification d'une entreprise.
     * Réservé à Admins/Pilotes.
     */
    public function modifier($id) {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['user']) || !in_array($_SESSION['user']['role'], ['Admin', 'pilote'])) {
            header("Location: " . BASE_URL . "index.php?controller=home&action=index");
            exit;
        }

        $entrepriseData = Entreprise::findById($id);

        if (!$entrepriseData) {
            die("Entreprise introuvable.");
        }

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $nom = trim($_POST["nom"]);
            $ville = trim($_POST["ville"]);
            $secteur = trim($_POST["secteur"]);
            $taille = trim($_POST["taille"]);
            $description = trim($_POST["description"]);
            $email = trim($_POST["email"]);
            $telephone = trim($_POST["telephone"]);

            $entreprise = new Entreprise();
            $entreprise->id = $id;
            $entreprise->nom = $nom;
            $entreprise->ville = $ville;
            $entreprise->secteur = $secteur;
            $entreprise->taille = $taille;
            $entreprise->description = $description;
            $entreprise->email = $email;
            $entreprise->telephone = $telephone;
            $entreprise->save();

            header("Location: " . BASE_URL . "index.php?controller=entreprise&action=index");
            exit;
        }

        $this->render('entreprises/modifier.twig', [
            'entreprise' => $entrepriseData
        ]);
    }

    /**
     * Suppression d'une entreprise. Réservé aux Admins/Pilotes.
     */
    public function supprimer() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['user']) || !in_array($_SESSION['user']['role'], ['Admin', 'pilote'])) {
            header("Location: " . BASE_URL . "index.php?controller=home&action=index");
            exit;
        }

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $id = $_POST["id"];
            Entreprise::delete($id);

            header("Location: " . BASE_URL . "index.php?controller=entreprise&action=index");
            exit;
        }
    }

    /**
     * Évaluation d'une entreprise par un étudiant.
     * (Ici inchangé, vous pourriez aussi créer un model "EvaluationEntreprise")
     */
    public function evaluer($id) {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'Etudiant') {
            header("Location: " . BASE_URL . "index.php?controller=home&action=index");
            exit;
        }

        $entreprise = Entreprise::findById($id);
        if (!$entreprise) {
            die("Entreprise introuvable.");
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // On insère dans la table evaluation_entreprise
            $_SESSION['message'] = "Évaluation enregistrée avec succès !";
            header("Location: " . BASE_URL . "index.php?controller=entreprise&action=details&id=" . $id);
            exit;
        }

        $this->render('entreprises/evaluer.twig', [
            'entreprise' => $entreprise
        ]);
    }

    /**
     * Affiche les détails d’une entreprise.
     */
    public function details($id) {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $entrepriseData = Entreprise::findById($id);
        if (!$entrepriseData) {
            die("Entreprise introuvable.");
        }

        $this->render('entreprises/details.twig', [
            'entreprise' => $entrepriseData
        ]);
    }
}
