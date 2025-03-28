<?php
// app/model/DashboardStats.php

namespace App\Model;

use PDO;

class DashboardStats extends BaseModel
{
    /**
     * Récupère l'ensemble des statistiques liées aux offres (exemple).
     */
    public static function getOfferStats()
    {
        $pdo = \Database::getInstance();

        // Nombre total d'offres
        $stmtTotal = $pdo->query("SELECT COUNT(*) as total FROM offre");
        $total_offres = $stmtTotal->fetch(PDO::FETCH_ASSOC)['total'];

        // TOP 5 des offres les plus wishlistées
        $stmtTopWishlist = $pdo->query("
            SELECT o.titre, e.nom AS entreprise, COUNT(w.id) AS nb
            FROM wishlist w
            JOIN offre o ON w.offre_id = o.id
            JOIN entreprise e ON o.entreprise_id = e.id
            GROUP BY o.id
            ORDER BY nb DESC
            LIMIT 5
        ");
        $top_wishlist = $stmtTopWishlist->fetchAll(PDO::FETCH_ASSOC);

        // Répartition par durée
        $stmtDuree = $pdo->query("
            SELECT DATEDIFF(date_fin, date_debut) AS duree, COUNT(*) AS nb
            FROM offre
            GROUP BY duree
            ORDER BY duree
        ");
        $durees = $stmtDuree->fetchAll(PDO::FETCH_ASSOC);

        return [
            'total_offres' => $total_offres,
            'top_wishlist' => $top_wishlist,
            'durees'       => $durees
        ];
    }
}
