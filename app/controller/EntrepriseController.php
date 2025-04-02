<?php
// Namespace pour organiser les classes dans l'application
namespace app\controller;

// Import de la classe de base pour les contrôleurs
use app\controller\BaseController;
// Accès à la base de données via le singleton
use Database;
// Modèle représentant une entreprise (ORM ou classe custom)
use app\model\Entreprise;

class EntrepriseController extends BaseController
{
    /**
     * Affiche la liste des entreprises avec :
     * - Recherche par nom, ville ou secteur
     * - Pagination
     * - Boutons conditionnels selon le rôle (Admin/Pilote)
     */
    public function index() {
<<<<<<< Updated upstream
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        $pdo = Database::getInstance();

        // Récupération des filtres GET
        $nom = isset($_GET['nom']) ? trim($_GET['nom']) : '';
        $ville = isset($_GET['ville']) ? trim($_GET['ville']) : '';
        $secteur = isset($_GET['secteur']) ? trim($_GET['secteur']) : '';

        // Pagination
        $page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
        $limit = 10;
        $offset = ($page - 1) * $limit;

        // Construction des filtres SQL
        $sqlFilter = " WHERE 1=1 ";
        $params = [];

        if ($nom !== '') {
            $sqlFilter .= " AND nom LIKE ? ";
            $params[] = "%$nom%";
        }

        if ($ville !== '') {
            $sqlFilter .= " AND ville LIKE ? ";
            $params[] = "%$ville%";
        }

        if ($secteur !== '') {
            $sqlFilter .= " AND secteur LIKE ? ";
            $params[] = "%$secteur%";
        }

        // Nombre total de résultats filtrés
        $sqlCount = "SELECT COUNT(*) as total FROM entreprise " . $sqlFilter;
        $stmtCount = $pdo->prepare($sqlCount);
        $stmtCount->execute($params);
        $total = $stmtCount->fetch()['total'];
        $totalPages = ceil($total / $limit);

        // Requête principale avec pagination
        $sqlData = "SELECT * FROM entreprise " . $sqlFilter . " ORDER BY nom ASC LIMIT $limit OFFSET $offset";
        $stmtData = $pdo->prepare($sqlData);
        $stmtData->execute($params);
        $entreprises = $stmtData->fetchAll(\PDO::FETCH_ASSOC);

        // Génération des boutons d'action
        foreach ($entreprises as &$entreprise) {
            $detailLink = '<a href="' . BASE_URL . 'index.php?controller=entreprise&action=details&id=' . $entreprise['id'] . '" class="btn-voir">Détails</a>';

            if (isset($_SESSION['user']) && in_array($_SESSION['user']['role'], ['Admin', 'pilote'])) {
                $modifyLink = ' <a href="' . BASE_URL . 'index.php?controller=entreprise&action=modifier&id=' . $entreprise['id'] . '" class="btn-modifier">Modifier</a>';
                $deleteLink = ' <form action="' . BASE_URL . 'index.php?controller=entreprise&action=supprimer" method="POST" style="display:inline;">
                                    <input type="hidden" name="id" value="' . $entreprise['id'] . '">
                                    <button type="submit" class="btn-supprimer" onclick="return confirm(\'Voulez-vous vraiment supprimer cette entreprise ?\');">Supprimer</button>
                                </form>';
                $entreprise['actions'] = $detailLink . $modifyLink . $deleteLink;
            } else {
                $entreprise['actions'] = $detailLink;
            }
        }
        unset($entreprise); // Libération de la référence

        // Rendu de la vue avec Twig
        $this->render('entreprises/index.twig', [
=======
        // Récupération des paramètres de recherche
        $nom = isset($_GET['nom']) ? $_GET['nom'] : '';
        $ville = isset($_GET['ville']) ? $_GET['ville'] : '';
        $secteur = isset($_GET['secteur']) ? $_GET['secteur'] : '';
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        
        // Nombre d'éléments par page
        $limit = 10;
        $offset = ($page - 1) * $limit;
        
        // Récupération des entreprises
        $entreprises = Entreprise::search($nom, $ville, $secteur, $limit, $offset);
        
        // Ajout des actions pour chaque entreprise
        foreach ($entreprises as &$entreprise) {
            $entreprise['actions'] = $this->getActionsForEntreprise($entreprise);
        }
        unset($entreprise);
        
        $totalEntreprises = Entreprise::countAll($nom, $ville, $secteur);
        $totalPages = ceil($totalEntreprises / $limit);
        
        // Récupération de tous les secteurs distincts pour le menu déroulant
        $entrepriseModel = new Entreprise();
        $secteurs = $entrepriseModel->getAllSecteurs();
        
        // Rendu du template
        echo $this->render('entreprises/index.twig', [
>>>>>>> Stashed changes
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
<<<<<<< Updated upstream

                header("Location: " . BASE_URL . "index.php?controller=entreprise&action=index");
                exit;
=======
                $this->redirect('entreprise', 'index', ['notif' => 'created']);
>>>>>>> Stashed changes
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

        $pdo = Database::getInstance();
        $stmt = $pdo->prepare("SELECT * FROM entreprise WHERE id = ?");
        $stmt->execute([$id]);
        $entrepriseData = $stmt->fetch(\PDO::FETCH_ASSOC);

        if (!$entrepriseData) {
            $this->redirect('entreprise', 'index', ['error' => 'not_found']);
        }

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $nom = trim($_POST["nom"]);
            $ville = trim($_POST["ville"]);
            $secteur = trim($_POST["secteur"]);
            $taille = trim($_POST["taille"]);
            $description = trim($_POST["description"]);
            $email = trim($_POST["email"]);
            $telephone = trim($_POST["telephone"]);

<<<<<<< Updated upstream
            $stmt = $pdo->prepare("UPDATE entreprise SET nom = ?, ville = ?, secteur = ?, taille = ?, description = ?, email = ?, telephone = ? WHERE id = ?");
            $stmt->execute([$nom, $ville, $secteur, $taille, $description, $email, $telephone, $id]);

            header("Location: " . BASE_URL . "index.php?controller=entreprise&action=index");
            exit;
=======
            $entreprise->save();
            $this->redirect('entreprise', 'index', ['notif' => 'updated']);
>>>>>>> Stashed changes
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

<<<<<<< Updated upstream
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $id = $_POST["id"];
            $pdo = Database::getInstance();
            $stmt = $pdo->prepare("DELETE FROM entreprise WHERE id = ?");
            $stmt->execute([$id]);

            header("Location: " . BASE_URL . "index.php?controller=entreprise&action=index");
            exit;
=======
        $id = $_GET['id'] ?? null;
        if ($id) {
            Entreprise::delete($id);
            $this->redirect('entreprise', 'index', ['notif' => 'deleted']);
        } else {
            $this->redirect('entreprise', 'index', ['error' => 'missing_id']);
>>>>>>> Stashed changes
        }
    }

    /**
     * Évaluation d'une entreprise par un étudiant.
     */
    public function evaluer($id) {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'etudiant') {
            header("Location: " . BASE_URL . "index.php?controller=home&action=index");
            exit;
        }

        $pdo = Database::getInstance();
        $stmt = $pdo->prepare("SELECT * FROM entreprise WHERE id = ?");
        $stmt->execute([$id]);
        $entreprise = $stmt->fetch(\PDO::FETCH_ASSOC);

        if (!$entreprise) {
            $this->redirect('entreprise', 'index', ['error' => 'not_found']);
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $note = intval($_POST['note'] ?? 0);
            $commentaire = trim($_POST['commentaire'] ?? '');
            $user_id = $_SESSION['user']['id'];

            $stmtEval = $pdo->prepare("INSERT INTO evaluation_entreprise (entreprise_id, user_id, note, commentaire, date_evaluation) VALUES (?, ?, ?, ?, NOW())");
            $stmtEval->execute([$id, $user_id, $note, $commentaire]);

            $_SESSION['message'] = "Évaluation enregistrée avec succès !";
            $this->redirect('entreprise', 'details', ['id' => $id]);
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
        
        $pdo = Database::getInstance();
        $stmt = $pdo->prepare("SELECT * FROM entreprise WHERE id = ?");
        $stmt->execute([$id]);
        $entrepriseData = $stmt->fetch(\PDO::FETCH_ASSOC);

        if (!$entrepriseData) {
            $this->redirect('entreprise', 'index', ['error' => 'not_found']);
        }

        $this->render('entreprises/details.twig', [
            'entreprise' => $entrepriseData
        ]);
    }
<<<<<<< Updated upstream
}
=======

    /**
     * Génère les actions disponibles pour une entreprise.
     */
    private function getActionsForEntreprise($entreprise) {
        $actions = '';

        // Bouton de détails pour tous les utilisateurs
        $actions .= '<a href="' . $this->generateUrl('entreprise', 'details', ['id' => $entreprise['id']]) . '" class="btn-voir">Détails</a>';

        // Actions supplémentaires pour Admin et pilote
        if (isset($_SESSION['user']) && in_array($_SESSION['user']['role'], ['Admin', 'pilote'])) {
            $actions .= ' <a href="' . $this->generateUrl('entreprise', 'modifier', ['id' => $entreprise['id']]) . '" class="btn-modifier">Modifier</a>';
            $actions .= ' <a href="#" class="btn-supprimer" data-id="' . $entreprise['id'] . '">Supprimer</a>';
        }

        // Action d'évaluation pour les étudiants
        if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 'Etudiant') {
            $actions .= ' <a href="' . $this->generateUrl('entreprise', 'evaluer', ['id' => $entreprise['id']]) . '" class="btn-evaluate">Évaluer</a>';
        }

        return $actions;
    }
}
>>>>>>> Stashed changes
