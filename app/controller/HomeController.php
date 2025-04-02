<?php
// app/controller/HomeController.php

namespace app\controller;

use app\controller\BaseController;
use Database;

class HomeController extends BaseController {
    /**
     * Page d'accueil
     */
    public function index() {
        $pdo = Database::getInstance();
        $stmt = $pdo->query("
            SELECT offre.id, offre.titre, entreprise.nom AS entreprise
            FROM offre
            JOIN entreprise ON offre.entreprise_id = entreprise.id
            ORDER BY offre.id DESC
            LIMIT 5
        ");
        $offres = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        $this->render('home/index.twig', ['offres' => $offres]);
    }
}
