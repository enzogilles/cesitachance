<?php
// app/model/Wishlist.php

namespace App\Model;

use PDO;

class Wishlist extends BaseModel
{
    public $id;
    public $user_id;
    public $offre_id;

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Récupère la wishlist d'un utilisateur (avec jointure sur Offre et Entreprise).
     */
    public static function findByUserIdWithRelations($userId)
    {
        $pdo = \Database::getInstance();
        $stmt = $pdo->prepare("
            SELECT w.id AS wishlist_id,
                   o.id AS offre_id,
                   o.titre,
                   e.nom AS entreprise
            FROM wishlist w
            JOIN offre o ON w.offre_id = o.id
            JOIN entreprise e ON o.entreprise_id = e.id
            WHERE w.user_id = ?
        ");
        $stmt->execute([$userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Vérifie l'existence d'une offre déjà en wishlist.
     */
    public static function exists($userId, $offreId)
    {
        $pdo = \Database::getInstance();
        $stmt = $pdo->prepare("SELECT id FROM wishlist WHERE user_id = ? AND offre_id = ?");
        $stmt->execute([$userId, $offreId]);
        return $stmt->fetch() !== false;
    }

    /**
     * Ajoute une offre en wishlist.
     */
    public static function add($userId, $offreId)
    {
        $pdo = \Database::getInstance();
        $stmt = $pdo->prepare("INSERT INTO wishlist (user_id, offre_id) VALUES (?, ?)");
        $stmt->execute([$userId, $offreId]);
        return $stmt->rowCount() > 0;
    }


    /**
     * Supprime une entrée de la wishlist par son ID (clé primaire).
     */
    public static function remove($wishlistId)
    {
        $pdo = \Database::getInstance();
        $stmt = $pdo->prepare("DELETE FROM wishlist WHERE id = ?");
        return $stmt->execute([$wishlistId]);
    }
}
