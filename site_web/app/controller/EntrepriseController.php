<?php
namespace App\Controller;

use App\Model\Entreprise;

require_once __DIR__ . '/../model/Entreprise.php';
require_once __DIR__ . '/BaseController.php';

class EntrepriseController extends BaseController {

    private $entrepriseModel;

    public function __construct() {
        $this->entrepriseModel = new Entreprise();
    }

    /**
     * Affiche la liste des entreprises (lecture CSV)
     */
    public function index() {
        session_start();
        $entreprises = $this->entrepriseModel->getAll();

        $this->render('entreprises/index.php', [
            'entreprises' => $entreprises
        ]);
    }

    /**
     * Créer une entreprise
     */
    public function creer() {
        session_start();
        if (!isset($_SESSION['user']) || !in_array($_SESSION['user']['role'], ['Admin', 'pilote'])) {
            header("Location: index.php?controller=home&action=index");
            exit;
        }

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $data = [
                'nom' => trim($_POST["nom"]),
                'adresse' => trim($_POST["adresse"]),
                'email' => trim($_POST["email"]),
                'telephone' => trim($_POST["telephone"])
            ];

            $this->entrepriseModel->create($data);
            header("Location: index.php?controller=entreprise&action=index");
            exit;
        }

        $this->render('entreprises/gestion.php');
    }

    /**
     * Modifier une entreprise
     */
    public function modifier($id) {
        session_start();
        if (!isset($_SESSION['user']) || !in_array($_SESSION['user']['role'], ['Admin', 'pilote'])) {
            header("Location: index.php?controller=home&action=index");
            exit;
        }

        $entreprise = $this->entrepriseModel->getById($id);
        if (!$entreprise) {
            die("Erreur : Entreprise introuvable.");
        }

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $data = [
                'nom' => trim($_POST["nom"]),
                'adresse' => trim($_POST["adresse"]),
                'email' => trim($_POST["email"]),
                'telephone' => trim($_POST["telephone"])
            ];

            $this->entrepriseModel->update($id, $data);
            header("Location: index.php?controller=entreprise&action=index");
            exit;
        }

        $this->render('entreprises/modifier.php', ['entreprise' => $entreprise]);
    }

    /**
     * Supprimer une entreprise
     */
    public function supprimer($id) {
        session_start();
        if (!isset($_SESSION['user']) || !in_array($_SESSION['user']['role'], ['Admin', 'pilote'])) {
            header("Location: index.php?controller=home&action=index");
            exit;
        }

        $this->entrepriseModel->delete($id);
        header("Location: index.php?controller=entreprise&action=index");
        exit;
    }
}
