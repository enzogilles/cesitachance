<?php
// app/controller/HomeController.php

namespace app\controller;

use app\controller\BaseController;
use App\Model\Offre;

class HomeController extends BaseController {
    /**
     * Page d'accueil (ouverte à tous)
     */
    public function index() {
        // On utilise le model Offre pour récupérer les 5 dernières
        $offres = Offre::findLatest(5);

        $this->render('home/index.twig', ['offres' => $offres]);
    }
}
