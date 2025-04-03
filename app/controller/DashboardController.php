<?php
// app/controller/DashboardController.php

namespace app\controller;

use app\controller\BaseController;
use App\Model\DashboardStats;

class DashboardController extends BaseController {

    /**
     * Dashboard principal -> réservé aux utilisateurs Admin ou Pilote.
     */
    public function index() {
        $this->checkAuth(['Admin','pilote']);
        $stats = DashboardStats::getOfferStats();
        $this->render('dashboard/index.twig', [
            'user'  => $_SESSION['user'],
            'stats' => $stats
        ]);
    }
    

    /**
     * Statistiques sur les offres -> réservé à Admin/Pilote.
     */
    public function offerStats() {
        $this->checkAuth(['Admin','pilote']);

        // On récupère les stats via le Model
        $stats = DashboardStats::getOfferStats();

        $this->render('dashboard/offerStats.twig', ['stats' => $stats]);
    }
}
