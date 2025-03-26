<?php
// app/controller/DashboardController.php

namespace app\controller;

use app\controller\BaseController;
use Database;

class DashboardController extends BaseController {

    /**
     * Dashboard principal réservé aux utilisateurs connectés (Admin ou Pilote).
     */
    public function index() {
        session_start();

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
        session_start();
        if (!isset($_SESSION['user']) || !in_array($_SESSION['user']['role'], ['Admin','pilote'])) {
            header("Location: " . BASE_URL . "index.php?controller=home&action=index");
            exit;
        }

        $pdo = Database::getInstance();

        // Nombre total d'offres
        $stmtTotal = $pdo->query("SELECT COUNT(*) as total FROM offre");
        $stats['total_offres'] = $stmtTotal->fetch(\PDO::FETCH_ASSOC)['total'];

        // TOP 5 des offres les plus wishlistées
        $stmtTopWishlist = $pdo->query("
            SELECT o.titre, e.nom as entreprise, COUNT(w.id) as nb
            FROM wishlist w
            JOIN offre o ON w.offre_id = o.id
            JOIN entreprise e ON o.entreprise_id = e.id
            GROUP BY o.id
            ORDER BY nb DESC
            LIMIT 5
        ");
        $stats['top_wishlist'] = $stmtTopWishlist->fetchAll(\PDO::FETCH_ASSOC);

        // Répartition par durée (exemple)
        $stmtDuree = $pdo->query("
            SELECT DATEDIFF(date_fin, date_debut) as duree, COUNT(*) as nb
            FROM offre
            GROUP BY duree
            ORDER BY duree
        ");
        $stats['durees'] = $stmtDuree->fetchAll(\PDO::FETCH_ASSOC);

        $this->render('dashboard/offerStats.twig', ['stats' => $stats]);
    }
}
