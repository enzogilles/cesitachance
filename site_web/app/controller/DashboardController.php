<?php
namespace App\Controller;

use App\Controller\BaseController;
use Database;

class DashboardController extends BaseController {

    /**
     * - On décide que le dashboard principal est réservé
     *   aux utilisateurs connectés (admin ou pilote ?).
     */
    public function index() {
        session_start();

        // Soit on laisse tout user => false,
        // Soit admin/pilote => ci-dessous :
        if (!isset($_SESSION['user']) 
            || !in_array($_SESSION['user']['role'], ['Admin','pilote'])) {
            header("Location: " . BASE_URL . "index.php?controller=home&action=index");
            exit;
        }

        $this->render('dashboard/index.php', ['user' => $_SESSION['user']]);
    }

    // Statistiques sur les offres
    // -> réservé admin/pilote
    public function offerStats() {
        session_start();
        if (!isset($_SESSION['user']) 
            || !in_array($_SESSION['user']['role'], ['Admin','pilote'])) {
            header("Location: " . BASE_URL . "index.php?controller=home&action=index");
            exit;
        }

        $pdo = Database::getInstance();

        // Nombre total d'offres
    // Remplacement de la requête SELECT par une lecture CSV
    if (($handle = fopen('../data/dashboardcontroller.csv', 'r')) !== FALSE) {
        while (($data = fgetcsv($handle, 1000, ',')) !== FALSE) {
            // Traitement des données CSV
        }
        fclose($handle);
    }
        $stats['total_offres'] = $stmtTotal->fetch(\PDO::FETCH_ASSOC)['total'];

        // TOP 5 des offres les plus wishlistées
        $stmtTopWishlist = $pdo->query("
    // Remplacement de la requête SELECT par une lecture CSV
    if (($handle = fopen('../data/dashboardcontroller.csv', 'r')) !== FALSE) {
        while (($data = fgetcsv($handle, 1000, ',')) !== FALSE) {
            // Traitement des données CSV
        }
        fclose($handle);
    }
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
    // Remplacement de la requête SELECT par une lecture CSV
    if (($handle = fopen('../data/dashboardcontroller.csv', 'r')) !== FALSE) {
        while (($data = fgetcsv($handle, 1000, ',')) !== FALSE) {
            // Traitement des données CSV
        }
        fclose($handle);
    }
            FROM offre
            GROUP BY duree
            ORDER BY duree
        ");
        $stats['durees'] = $stmtDuree->fetchAll(\PDO::FETCH_ASSOC);

        $this->render('dashboard/offerStats.php', ['stats' => $stats]);
    }
}
