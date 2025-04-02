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

    /**
     * Recherche dans la wishlist d'un étudiant donné (titre offre + entreprise)
     */
    public static function searchByStudent($userId, $motcle, $limit, $offset)
    {
        try {
            $pdo = \Database::getInstance();
            $params = [$userId];
            $sqlFilter = "";

            if (!empty($motcle)) {
                $sqlFilter .= " AND (o.titre LIKE ? OR e.nom LIKE ?) ";
                $params[] = "%$motcle%";
                $params[] = "%$motcle%";
            }

            $sqlCount = "SELECT COUNT(*) as total
                         FROM wishlist w
                         JOIN offre o ON w.offre_id = o.id
                         JOIN entreprise e ON o.entreprise_id = e.id
                         WHERE w.user_id = ? $sqlFilter";

            $stmtCount = $pdo->prepare($sqlCount);
            $stmtCount->execute($params);
            $total = $stmtCount->fetch(PDO::FETCH_ASSOC)['total'] ?? 0;

            $sql = "SELECT w.id AS wishlist_id,
                           o.id AS offre_id,
                           o.titre,
                           e.nom AS entreprise
                    FROM wishlist w
                    JOIN offre o ON w.offre_id = o.id
                    JOIN entreprise e ON o.entreprise_id = e.id
                    WHERE w.user_id = ? $sqlFilter
                    ORDER BY w.id DESC
                    LIMIT ? OFFSET ?";

            $stmt = $pdo->prepare($sql);
            $i = 1;
            foreach ($params as $p) {
                $stmt->bindValue($i++, $p);
            }
            $stmt->bindValue($i++, $limit, PDO::PARAM_INT);
            $stmt->bindValue($i, $offset, PDO::PARAM_INT);

            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return [
                'wishlist' => $result,
                'total' => $total
            ];
        } catch (\PDOException $e) {
            throw new \Exception("Erreur lors de la recherche dans la wishlist : " . $e->getMessage());
        }
    }

    /**
     * Récupère la wishlist d'un utilisateur (jointure sur Offre et Entreprise).
     */
    public static function findByUserIdWithRelations($userId)
    {
        try {
            $pdo = \Database::getInstance();
            $stmt = $pdo->prepare("SELECT w.id AS wishlist_id,
                                          o.id AS offre_id,
                                          o.titre,
                                          e.nom AS entreprise
                                   FROM wishlist w
                                   JOIN offre o ON w.offre_id = o.id
                                   JOIN entreprise e ON o.entreprise_id = e.id
                                   WHERE w.user_id = ?
                                   ORDER BY w.id DESC");
            $stmt->execute([$userId]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            throw new \Exception("Erreur lors de la récupération de la wishlist : " . $e->getMessage());
        }
    }

    /**
     * Récupère la wishlist paginée d’un utilisateur.
     */
    public static function findByUserIdWithRelationsPaginated($userId, $limit, $offset)
    {
        try {
            $pdo = \Database::getInstance();
            $stmt = $pdo->prepare("SELECT w.id AS wishlist_id,
                                          o.id AS offre_id,
                                          o.titre,
                                          e.nom AS entreprise
                                   FROM wishlist w
                                   JOIN offre o ON w.offre_id = o.id
                                   JOIN entreprise e ON o.entreprise_id = e.id
                                   WHERE w.user_id = ?
                                   ORDER BY w.id DESC
                                   LIMIT ? OFFSET ?");
            $stmt->bindValue(1, $userId, PDO::PARAM_INT);
            $stmt->bindValue(2, $limit, PDO::PARAM_INT);
            $stmt->bindValue(3, $offset, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            throw new \Exception("Erreur lors de la récupération paginée de la wishlist : " . $e->getMessage());
        }
    }

    /**
     * Compte les éléments de la wishlist d’un utilisateur.
     */
    public static function countByUserId($userId)
    {
        try {
            $pdo = \Database::getInstance();
            $stmt = $pdo->prepare("SELECT COUNT(*) AS total FROM wishlist WHERE user_id = ?");
            $stmt->execute([$userId]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return $row['total'] ?? 0;
        } catch (\PDOException $e) {
            throw new \Exception("Erreur lors du comptage des éléments de la wishlist : " . $e->getMessage());
        }
    }
}