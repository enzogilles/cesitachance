<?php
namespace App\Controller;

use App\Model\Offre;
use App\Model\Entreprise;

require_once __DIR__ . '/../model/Offre.php';  // Inclure le modèle Offre
require_once __DIR__ . '/../model/Entreprise.php';  // Inclure le modèle Entreprise
require_once __DIR__ . '/BaseController.php';  // Inclure le contrôleur de base


class OffreController extends BaseController
{
    private $offreModel;
    private $entrepriseModel;

    public function __construct()
    {
        $this->offreModel = new Offre();
        $this->entrepriseModel = new Entreprise();
    }

    /**
     * Liste des offres (remplacé SQL par lecture CSV)
     */
    public function index()
    {
        session_start();
        $offres = [];

        // Lecture du fichier CSV contenant les offres
        $csvFile = __DIR__ . "/../../data/offre.csv";
        if (file_exists($csvFile) && ($handle = fopen($csvFile, "r")) !== FALSE) {
            fgetcsv($handle, 1000, ","); // Ignorer l'en-tête
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $offres[] = [
                    'id' => $data[0],
                    'titre' => $data[1],
                    'entreprise' => $data[2],
                    'description' => $data[3],
                ];
            }
            fclose($handle);
        }

        $this->render('offres/index.php', ['offres' => $offres]);
    }

    /**
     * Afficher le détail d’une offre (remplacé SQL par lecture CSV)
     */
    public function detail($id)
    {
        session_start();
        if (!$id) {
            die("Erreur : ID de l'offre manquant.");
        }

        $offre = null;
        $csvFile = __DIR__ . "/../../data/offre.csv";
        if (file_exists($csvFile) && ($handle = fopen($csvFile, "r")) !== FALSE) {
            fgetcsv($handle, 1000, ","); // Ignorer l'en-tête
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                if ($data[0] == $id) {
                    $offre = [
                        'id' => $data[0],
                        'titre' => $data[1],
                        'entreprise' => $data[2],
                        'description' => $data[3],
                    ];
                    break;
                }
            }
            fclose($handle);
        }

        if (!$offre) {
            die("Erreur : Offre introuvable.");
        }

        $this->render('offres/detail.php', ['offre' => $offre]);
    }

    /**
     * Créer une nouvelle offre (remplacé SQL par ajout CSV)
     */
    public function create()
    {
        session_start();
        if (!isset($_SESSION['user']) || !in_array($_SESSION['user']['role'], ['Admin', 'pilote'])) {
            header("Location: index.php?controller=home&action=index");
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                count(file(__DIR__ . "/../../data/offre.csv")), // ID auto-incrémenté
                $_POST['titre'],
                $_POST['entreprise_id'],
                $_POST['description'],
            ];

            // Ajouter l'offre au fichier CSV
            $file = fopen(__DIR__ . "/../../data/offre.csv", "a");
            fputcsv($file, $data);
            fclose($file);

            header("Location: index.php?controller=offre&action=index");
            exit;
        }

        $this->render('offres/create.php');
    }

    /**
     * Supprimer une offre (remplacé SQL par suppression dans CSV)
     */
    public function supprimer($id)
    {
        session_start();
        if (!isset($_SESSION['user']) || !in_array($_SESSION['user']['role'], ['Admin', 'pilote'])) {
            header("Location: index.php?controller=home&action=index");
            exit;
        }

        if (!$id) {
            die("Erreur : ID de l'offre manquant.");
        }

        $csvFile = __DIR__ . "/../../data/offre.csv";
        $rows = [];

        // Lire toutes les offres et ne pas inclure celle à supprimer
        if (file_exists($csvFile) && ($handle = fopen($csvFile, "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                if ($data[0] != $id) {
                    $rows[] = $data;
                }
            }
            fclose($handle);
        }

        // Réécrire le fichier sans l'offre supprimée
        $file = fopen($csvFile, "w");
        foreach ($rows as $row) {
            fputcsv($file, $row);
        }
        fclose($file);

        header("Location: index.php?controller=offre&action=index");
        exit;
    }
}
