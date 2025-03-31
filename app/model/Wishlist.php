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
     * Récupère la wishlist d'un utilisateur (jointure sur Offre et Entreprise).
     */
    public static function findByUserIdWithRelations($userId)
    {
        try {
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
                ORDER BY w.id DESC
            ");
            $stmt->execute([$userId]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            throw new \Exception("Erreur lors de la récupération de la wishlist : " . $e->getMessage());
        }
    }

    /**
     * Vérifie si une offre est déjà présente dans la wishlist d'un utilisateur.
     */
    public static function exists($userId, $offreId)
    {
        try {
            $pdo = \Database::getInstance();
            $stmt = $pdo->prepare("SELECT id FROM wishlist WHERE user_id = ? AND offre_id = ?");
            $stmt->execute([$userId, $offreId]);
            return $stmt->fetch() !== false;
        } catch (\PDOException $e) {
            throw new \Exception("Erreur lors de la vérification d'existence d'une offre dans la wishlist : " . $e->getMessage());
        }
    }

    /**
     * Ajoute une offre à la wishlist d'un utilisateur.
     */
    public static function add($userId, $offreId)
    {
        try {
            // On peut vérifier s'il existe déjà
            if (self::exists($userId, $offreId)) {
                return false;
            }
            $pdo = \Database::getInstance();
            $stmt = $pdo->prepare("INSERT INTO wishlist (user_id, offre_id) VALUES (?, ?)");
            $stmt->execute([$userId, $offreId]);
            return $stmt->rowCount() > 0;
        } catch (\PDOException $e) {
            throw new \Exception("Erreur lors de l'ajout d'une offre dans la wishlist : " . $e->getMessage());
        }
    }

    /**
     * Supprime une entrée de la wishlist par son ID (clé primaire).
     */
    public static function remove($wishlistId)
    {
        try {
            $pdo = \Database::getInstance();
            $stmt = $pdo->prepare("DELETE FROM wishlist WHERE id = ?");
            return $stmt->execute([$wishlistId]);
        } catch (\PDOException $e) {
            throw new \Exception("Erreur lors de la suppression d'une offre de la wishlist : " . $e->getMessage());
        }
    }
}
