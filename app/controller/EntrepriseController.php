<?php
// app/controller/EntrepriseController.php

namespace app\controller;

use app\controller\BaseController;
use Database;
use app\model\Entreprise;

class EntrepriseController extends BaseController
{
    /**
     * Liste, recherche multi-critères et pagination des entreprises.
     */
    public function index() {
        session_start();
        $pdo = Database::getInstance();

        // Filtres
        $nom = isset($_GET['nom']) ? trim($_GET['nom']) : '';
        $ville = isset($_GET['ville']) ? trim($_GET['ville']) : '';
        $secteur = isset($_GET['secteur']) ? trim($_GET['secteur']) : '';

        // Pagination
        $page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
        $limit = 10;
        $offset = ($page - 1) * $limit;

        // Construction de la clause WHERE avec filtres
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

        // Count
        // Count
        $sqlCount = "SELECT COUNT(*) as total FROM entreprise " . $sqlFilter;
        $stmtCount = $pdo->prepare($sqlCount);
        $stmtCount->execute($params);
        $rowCount = $stmtCount->fetch();
        $total = $rowCount['total'];
        $totalPages = ceil($total / $limit); // Définition de $totalPages

        // Data
        $sqlData = "SELECT * FROM entreprise " . $sqlFilter . " ORDER BY nom ASC LIMIT " . (int)$limit . " OFFSET " . (int)$offset;
        $stmtData = $pdo->prepare($sqlData);
        $stmtData->execute($params);
        $entreprises = $stmtData->fetchAll(\PDO::FETCH_ASSOC);



    // On construit la colonne "actions" pour chaque entreprise
foreach ($entreprises as &$entreprise) {
    // Toujours le bouton "Détails"
    $detailLink = '<a href="' . BASE_URL . 'index.php?controller=entreprise&action=details&id=' . $entreprise['id'] . '" class="btn-voir">Détails</a>';

    // Si l'utilisateur est connecté ET a le rôle Admin ou pilote
    if (isset($_SESSION['user']) && in_array($_SESSION['user']['role'], ['Admin', 'pilote'])) {
        $modifyLink = ' <a href="' . BASE_URL . 'index.php?controller=entreprise&action=modifier&id=' . $entreprise['id'] . '" class="btn-modifier">Modifier</a>';
        $deleteLink = ' <form action="' . BASE_URL . 'index.php?controller=entreprise&action=supprimer" method="POST" style="display:inline;">
                            <input type="hidden" name="id" value="' . $entreprise['id'] . '">
                            <button type="submit" class="btn-supprimer" onclick="return confirm(\'Voulez-vous vraiment supprimer cette entreprise ?\');">Supprimer</button>
                        </form>';
        $entreprise['actions'] = $detailLink . $modifyLink . $deleteLink;
    } else {
        // Pour les étudiants ou non connectés, on affiche seulement "Détails"
        $entreprise['actions'] = $detailLink;
    }
}
unset($entreprise);
 // Bonne pratique pour libérer la référence

    // (4) Calcul du totalPages etc. pour ta pagination...

    // (5) On passe le tableau complet à Twig
    $this->render('entreprises/index.twig', [
        'entreprises' => $entreprises,
        'page'        => $page,
        'totalPages'  => $totalPages,
        'nom'         => $nom,
        'ville'       => $ville,
        'secteur'     => $secteur
    ]);
    }

    /**
     * Créer une entreprise -> réservé Admin/Pilote.
     */
    public function creer() {
        session_start();
        if (!isset($_SESSION['user']) || !in_array($_SESSION['user']['role'], ['Admin','pilote'])) {
            header("Location: " . BASE_URL . "index.php?controller=home&action=index");
            exit;
        }

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $nom         = trim($_POST["nom"]);
            $ville       = trim($_POST["ville"]);
            $secteur     = trim($_POST["secteur"]);
            $taille      = trim($_POST["taille"]);
            $description = trim($_POST["description"]);
            $email       = trim($_POST["email"]);
            $telephone   = trim($_POST["telephone"]);

            if (!empty($nom) && !empty($ville) && !empty($secteur) && !empty($taille)) {
                $entreprise = new Entreprise();
                $entreprise->nom         = $nom;
                $entreprise->ville       = $ville;
                $entreprise->secteur     = $secteur;
                $entreprise->taille      = $taille;
                $entreprise->description = $description;
                $entreprise->email       = $email;
                $entreprise->telephone   = $telephone;
                $entreprise->save();

                header("Location: " . BASE_URL . "index.php?controller=entreprise&action=index");
                exit;
            }
        }

        $this->render('entreprises/gestion.twig');
    }

    /**
     * Modifier une entreprise -> réservé Admin/Pilote.
     */
    public function modifier($id) {
        session_start();
        if (!isset($_SESSION['user']) || !in_array($_SESSION['user']['role'], ['Admin','pilote'])) {
            header("Location: " . BASE_URL . "index.php?controller=home&action=index");
            exit;
        }

        $pdo = Database::getInstance();
        $stmt = $pdo->prepare("SELECT * FROM entreprise WHERE id = ?");
        $stmt->execute([$id]);
        $entrepriseData = $stmt->fetch(\PDO::FETCH_ASSOC);

        if (!$entrepriseData) {
            die("Entreprise introuvable.");
        }

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $nom         = trim($_POST["nom"]);
            $ville       = trim($_POST["ville"]);
            $secteur     = trim($_POST["secteur"]);
            $taille      = trim($_POST["taille"]);
            $description = trim($_POST["description"]);
            $email       = trim($_POST["email"]);
            $telephone   = trim($_POST["telephone"]);

            $stmt = $pdo->prepare("
                UPDATE entreprise
                SET nom = ?, ville = ?, secteur = ?, taille = ?,
                    description = ?, email = ?, telephone = ?
                WHERE id = ?
            ");
            $stmt->execute([
                $nom,
                $ville,
                $secteur,
                $taille,
                $description,
                $email,
                $telephone,
                $id
            ]);

            header("Location: " . BASE_URL . "index.php?controller=entreprise&action=index");
            exit;
        }

        $this->render('entreprises/modifier.twig', [
            'entreprise' => $entrepriseData
        ]);
    }

    /**
     * Supprimer une entreprise -> réservé Admin/Pilote.
     */
    public function supprimer() {
        session_start();
        if (!isset($_SESSION['user']) || !in_array($_SESSION['user']['role'], ['Admin','pilote'])) {
            header("Location: " . BASE_URL . "index.php?controller=home&action=index");
            exit;
        }

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $id = $_POST["id"];

            $pdo = Database::getInstance();
            $stmt = $pdo->prepare("DELETE FROM entreprise WHERE id = ?");
            $stmt->execute([$id]);

            header("Location: " . BASE_URL . "index.php?controller=entreprise&action=index");
            exit;
        }
    }

    /**
     * Évaluer une entreprise -> réservé aux étudiants.
     */
    public function evaluer($id) {
        session_start();
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'etudiant') {
            header("Location: " . BASE_URL . "index.php?controller=home&action=index");
            exit;
        }

        $pdo = Database::getInstance();
        $stmt = $pdo->prepare("SELECT * FROM entreprise WHERE id = ?");
        $stmt->execute([$id]);
        $entreprise = $stmt->fetch(\PDO::FETCH_ASSOC);
        if (!$entreprise) {
            die("Entreprise introuvable.");
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $note = intval($_POST['note'] ?? 0);
            $commentaire = trim($_POST['commentaire'] ?? '');
            $user_id = $_SESSION['user']['id'];

            $stmtEval = $pdo->prepare("
                INSERT INTO evaluation_entreprise (entreprise_id, user_id, note, commentaire, date_evaluation)
                VALUES (?, ?, ?, ?, NOW())
            ");
            $stmtEval->execute([$id, $user_id, $note, $commentaire]);

            $_SESSION['message'] = "Évaluation enregistrée avec succès !";
            header("Location: " . BASE_URL . "index.php?controller=entreprise&action=details&id=" . $id);
            exit;
        }

        $this->render('entreprises/evaluer.twig', [
            'entreprise' => $entreprise
        ]);
    }

    /**
     * Afficher les détails d'une entreprise.
     */
    public function details($id) {
        session_start();
        $pdo = Database::getInstance();
        $stmt = $pdo->prepare("SELECT * FROM entreprise WHERE id = ?");
        $stmt->execute([$id]);
        $entrepriseData = $stmt->fetch(\PDO::FETCH_ASSOC);

        if (!$entrepriseData) {
            die("Entreprise introuvable.");
        }

        $this->render('entreprises/details.twig', [
            'entreprise' => $entrepriseData
        ]);
    }
}
