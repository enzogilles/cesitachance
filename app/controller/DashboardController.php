<?php
// app/controller/DashboardController.php

namespace app\controller;

use app\controller\BaseController;
use App\Model\DashboardStats;

class DashboardController extends BaseController {

    /**
     * Dashboard principal réservé aux utilisateurs connectés (Admin ou Pilote).
     */
    public function index() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['user']) || !in_array($_SESSION['user']['role'], ['Admin','pilote'])) {
            header("Location: " . BASE_URL . "index.php?controller=home&action=index");
            exit;
        }

        $this->render('dashboard/index.twig', ['user' => $_SESSION['user']]);
    }

    /**
     * Statistiques sur les offres -> réservé à Admin/Pilote.
     */
    public function offerStats() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['user']) || !in_array($_SESSION['user']['role'], ['Admin','pilote'])) {
            header("Location: " . BASE_URL . "index.php?controller=home&action=index");
            exit;
        }

        // On récupère les stats via le Model
        $stats = DashboardStats::getOfferStats();

        $this->render('dashboard/offerStats.twig', ['stats' => $stats]);
    }
}
