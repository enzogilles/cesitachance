<?php
// app/controller/OffreController.php

namespace app\controller;

use app\controller\BaseController;
use app\model\Offre;
use Database;

class OffreController extends BaseController {
    private $offreModel;

    public function __construct() {
        parent::__construct();
        $this->offreModel = new Offre();
    }

    /**
     * Liste des offres avec pagination et recherche multi-critères.
     */
    public function index() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        $pdo = Database::getInstance();

        // Filtres
        $motcle = isset($_GET['motcle']) ? trim($_GET['motcle']) : '';
        $filtreCompetences = isset($_GET['competences']) ? trim($_GET['competences']) : '';

        // Pagination
        $page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
        $limit = 10;
        $offset = ($page - 1) * $limit;

<<<<<<< Updated upstream
        // Construction de la clause WHERE
        $sqlFilter = " WHERE 1=1 ";
        $params = [];
        if ($motcle !== '') {
            $sqlFilter .= " AND (o.titre LIKE ? OR o.description LIKE ?) ";
            $params[] = "%$motcle%";
            $params[] = "%$motcle%";
=======
        $result = Offre::search($motcle, $filtreCompetences, $limit, $offset);
        $offres = $result['offres'];
        $total = $result['total'];
        $totalPages = ceil($total / $limit);

        foreach ($offres as &$offre) {
            $detailLink = '<a href="' . $this->generateUrl('offre', 'detail', ['id' => $offre['id']]) . '" class="btn-voir">Détails</a>';

            if (!empty($_SESSION['user']) && in_array($_SESSION['user']['role'], ['Admin', 'pilote'])) {
                $modifyLink = ' <a href="' . $this->generateUrl('offre', 'modifier', ['id' => $offre['id']]) . '" class="btn-modifier">Modifier</a>';
                $deleteLink = ' <a href="' . $this->generateUrl('offre', 'supprimer', ['id' => $offre['id']]) . '" class="btn-supprimer" data-id="' . $offre['id'] . '">Supprimer</a>';
                $offre['actions'] = $detailLink . $modifyLink . $deleteLink;
            } else {
                $offre['actions'] = $detailLink;
            }
>>>>>>> Stashed changes
        }
        if ($filtreCompetences !== '') {
            $sqlFilter .= " AND o.competences LIKE ? ";
            $params[] = "%$filtreCompetences%";
        }

        // Récupération du nombre total d'offres
        $sqlCount = "SELECT COUNT(*) as total FROM offre o " . $sqlFilter;
        $stmtCount = $pdo->prepare($sqlCount);
        $stmtCount->execute($params);
        $rowCount = $stmtCount->fetch(\PDO::FETCH_ASSOC);
        $total = $rowCount['total'];

        // Récupération des offres avec pagination
        $sqlData = "
            SELECT o.id, o.titre, o.description, o.remuneration,
                   o.date_debut, o.date_fin, o.competences,
                   e.nom as entreprise,
                   (SELECT COUNT(*) FROM candidature c WHERE c.offre_id = o.id) as nb_candidats
            FROM offre o
            JOIN entreprise e ON o.entreprise_id = e.id
            " . $sqlFilter . "
            ORDER BY o.id DESC
            LIMIT ? OFFSET ?
        ";
        $stmtData = $pdo->prepare($sqlData);
        $pIndex = 1;
        foreach ($params as $val) {
            $stmtData->bindValue($pIndex, $val);
            $pIndex++;
        }
        $stmtData->bindValue($pIndex, $limit, \PDO::PARAM_INT);
        $pIndex++;
        $stmtData->bindValue($pIndex, $offset, \PDO::PARAM_INT);
        $stmtData->execute();
        $offres = $stmtData->fetchAll(\PDO::FETCH_ASSOC);

        $totalPages = ceil($total / $limit);

        $this->render('offres/index.twig', [
            'offres' => $offres,
            'page' => $page,
            'totalPages' => $totalPages,
            'motcle' => $motcle,
            'competences' => $filtreCompetences
        ]);
    }

    /**
     * Page d'administration : gérer toutes les offres -> réservé Admin/Pilote.
     */
    public function gererOffres() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        if (!isset($_SESSION['user']) || !in_array($_SESSION['user']['role'], ['Admin','pilote'])) {
            header("Location: " . BASE_URL . "index.php?controller=home&action=index");
            exit;
        }

        $pdo = Database::getInstance();
        $stmt = $pdo->query("
            SELECT o.id, o.titre, o.remuneration, o.date_debut, o.date_fin,
                   e.nom AS entreprise
            FROM offre o
            JOIN entreprise e ON o.entreprise_id = e.id
            ORDER BY o.id DESC
        ");
        $offres = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        $this->render('offres/gerer.twig', ['offres' => $offres]);
    }

    /**
     * Détail d’une offre.
     */
    public function detail($id) {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        if (!$id) {
            $_SESSION["error"] = "Erreur : ID de l'offre manquant.";
            $this->redirect('offre', 'index');
        }
        $offre = $this->offreModel->findById($id);
        if (!$offre) {
            $_SESSION["error"] = "Erreur : Offre introuvable.";
            $this->redirect('offre', 'index');
        }
        $this->render('offres/detail.twig', ['offre' => $offre]);
    }

<<<<<<< Updated upstream
    /**
     * Créer une nouvelle offre -> réservé Admin/Pilote.
     */
    public function create() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        if (!isset($_SESSION['user']) || !in_array($_SESSION['user']['role'], ['Admin','pilote'])) {
            header("Location: " . BASE_URL . "index.php?controller=home&action=index");
            exit;
=======
    public function create()
    {
        $this->checkAuth(['Admin', 'pilote']);
    
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $offre = new Offre();
            $offre->titre = trim($_POST['titre']);
            $offre->description = trim($_POST['description']);
            $offre->remuneration = trim($_POST['remuneration']);
            $offre->date_debut = $_POST['date_debut'];
            $offre->date_fin = $_POST['date_fin'];
            $offre->entreprise_id = intval($_POST['entreprise_id']);
            $offre->competences = trim($_POST['competences'] ?? '');
    
            if (
                empty($offre->titre) || empty($offre->description) || empty($offre->remuneration) ||
                empty($offre->date_debut) || empty($offre->date_fin) || empty($offre->entreprise_id)
            ) {
                $this->render('offres/create.twig', [
                    'error' => 'Tous les champs obligatoires doivent être remplis.',
                    'entreprises' => Entreprise::findAll()
                ]);
                return;
            }
    
            $offre->save();

            $this->redirect('offre', 'gererOffres', ['notif' => 'created']);
>>>>>>> Stashed changes
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $titre = trim($_POST['titre']);
            $description = trim($_POST['description']);
            $entreprise_id = intval($_POST['entreprise_id']);
            $remuneration = trim($_POST['remuneration']);
            $date_debut = $_POST['date_debut'];
            $date_fin = $_POST['date_fin'];
            $competences = trim($_POST['competences'] ?? '');

            if (!empty($titre) && !empty($description) && $entreprise_id > 0) {
                $offre = new Offre();
                $offre->titre = $titre;
                $offre->description = $description;
                $offre->entreprise_id = $entreprise_id;
                $offre->remuneration = $remuneration;
                $offre->date_debut = $date_debut;
                $offre->date_fin = $date_fin;
                $offre->competences = $competences;

                if ($offre->save()) {
                    header("Location: " . BASE_URL . "index.php?controller=offre&action=index");
                    exit;
                } else {
                    $_SESSION['error'] = "Erreur lors de la sauvegarde de l'offre.";
                }
            } else {
                $_SESSION['error'] = "Veuillez remplir tous les champs obligatoires.";
            }
        }
        $this->render('offres/create.twig');
    }

    /**
     * Modifier une offre -> réservé Admin/Pilote.
     */
    public function modifier($id) {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        if (!isset($_SESSION['user']) || !in_array($_SESSION['user']['role'], ['Admin','pilote'])) {
            header("Location: " . BASE_URL . "index.php?controller=home&action=index");
            exit;
        }

        if (!$id) {
            $_SESSION["error"] = "Erreur : ID manquant pour modifier une offre.";
            $this->redirect('offre', 'gererOffres');
        }

        $pdo = Database::getInstance();

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $titre = trim($_POST['titre']);
            $description = trim($_POST['description']);
            $remuneration = trim($_POST['remuneration']);
            $date_debut = $_POST['date_debut'];
            $date_fin = $_POST['date_fin'];
            $competences = trim($_POST['competences'] ?? '');

            if (empty($titre) || empty($description) || empty($remuneration) ||
                empty($date_debut) || empty($date_fin)) {
                $_SESSION["error"] = "Tous les champs sont requis.";
                $this->redirect('offre', 'modifier', ['id' => $id]);
            }
<<<<<<< Updated upstream

            try {
                $stmt = $pdo->prepare("
                    UPDATE offre
                    SET titre = ?, description = ?, remuneration = ?,
                        date_debut = ?, date_fin = ?, competences = ?
                    WHERE id = ?
                ");
                $stmt->execute([
                    $titre, $description, $remuneration,
                    $date_debut, $date_fin, $competences, $id
                ]);

                $_SESSION["success"] = "L'offre a été mise à jour avec succès.";
                header("Location: " . BASE_URL . "index.php?controller=offre&action=gererOffres");
                exit;
            } catch (\PDOException $e) {
                $_SESSION["error"] = "Erreur lors de la mise à jour : " . $e->getMessage();
                header("Location: " . BASE_URL . "index.php?controller=offre&action=modifier&id=" . $id);
                exit;
            }
=======
    
            $offre = new Offre();
            $offre->id = $id;
            $offre->titre = $titre;
            $offre->description = $description;
            $offre->remuneration = $remuneration;
            $offre->date_debut = $date_debut;
            $offre->date_fin = $date_fin;
            $offre->competences = $competences;
            $offre->entreprise_id = $entreprise_id;
            $offre->save();
    
            $this->redirect('offre', 'gererOffres', ['notif' => 'updated']);
>>>>>>> Stashed changes
        }

        $stmt = $pdo->prepare("SELECT * FROM offre WHERE id = ?");
        $stmt->execute([$id]);
        $offre = $stmt->fetch(\PDO::FETCH_ASSOC);

        if (!$offre) {
            $_SESSION["error"] = "Erreur : Offre introuvable.";
            $this->redirect('offre', 'gererOffres');
        }

<<<<<<< Updated upstream
        $this->render('offres/modifier.twig', ['offre' => $offre]);
    }

    /**
     * Supprimer une offre -> réservé Admin/Pilote.
     */
    public function supprimer($id) {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        if (!isset($_SESSION['user']) || !in_array($_SESSION['user']['role'], ['Admin','pilote'])) {
            header("Location: " . BASE_URL . "index.php?controller=home&action=index");
            exit;
=======
    public function supprimer() {
        $this->checkAuth(['Admin', 'pilote']);
    
        $id = $_GET['id'] ?? null;
        if ($id) {
            Offre::deleteById($id);
            $this->redirect('offre', 'gererOffres', ['notif' => 'deleted']);
        } else {
            $_SESSION["error"] = "Erreur : ID manquant pour supprimer une offre.";
            $this->redirect('offre', 'gererOffres');
>>>>>>> Stashed changes
        }

        if (!$id) {
            die("Erreur : ID manquant pour supprimer une offre.");
        }

        $offre = $this->offreModel->findById($id);
        if (!$offre) {
            die("Erreur : Offre introuvable.");
        }

        $deleted = $this->offreModel->deleteById($id);
        if ($deleted) {
            header("Location: " . BASE_URL . "index.php?controller=offre&action=gererOffres");
            exit;
        } else {
            die("Erreur : Échec de la suppression de l'offre.");
        }
    }

    /**
     * Recherche d'offres par mot-clé.
     */
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
        ]);
    }
}
