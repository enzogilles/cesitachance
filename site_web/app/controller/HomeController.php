<?php
namespace App\Controller;

use App\Controller\BaseController;

class HomeController extends BaseController {
    public function index() {
        $offres = [];

        // Lecture des offres depuis un fichier CSV
        $csvFile = __DIR__ . "/../../data/offre.csv";
        if (file_exists($csvFile) && ($handle = fopen($csvFile, "r")) !== FALSE) {
            // Lire la première ligne (en-têtes) et l'ignorer
            fgetcsv($handle, 1000, ",");
            
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

        // Rendre la vue avec les offres récupérées
        $this->render('home/index.php', ['offres' => $offres]);
    }
}
