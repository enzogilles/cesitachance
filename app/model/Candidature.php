<?php
// app/model/Candidature.php

namespace App\Model;

use PDO;

class Candidature extends BaseModel
{
    // propriété statique pour le test unitaire
    public static $staticMocks = [];

    public $id;
    public $user_id;
    public $offre_id;
    public $date_soumission;
    public $statut;
    public $cv;
    public $lettre;

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Récupère toutes les candidatures avec jointures (offre, entreprise, utilisateur).
     */
    public static function findAllWithRelations()
    {
        // vérification si un mock existe pour cette méthode
         if (isset(self::$staticMocks['findAllWithRelations'])) {
            $callback = self::$staticMocks['findAllWithRelations'];
            return $callback();
         }
        try {
            $pdo = \Database::getInstance();
            $sql = "
                SELECT c.id,
                       e.nom AS entreprise,
                       o.titre AS offre,
                       c.date_soumission,
                       c.cv,
                       c.lettre,
                       c.statut,
                       u.nom AS user_nom,
                       u.prenom AS user_prenom
                FROM candidature c
                INNER JOIN offre o ON c.offre_id = o.id
                INNER JOIN entreprise e ON o.entreprise_id = e.id
                INNER JOIN user u ON c.user_id = u.id
                ORDER BY c.date_soumission DESC
            ";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);

        } catch (\PDOException $e) {
            throw new \Exception("Erreur lors de la récupération de toutes les candidatures : " . $e->getMessage());
        }
    }

    /**
     * Récupère toutes les candidatures pour un utilisateur donné (avec jointure).
     */
    public static function findAllByUserIdWithRelations($userId)
    {
        try {
            $pdo = \Database::getInstance();
            $sql = "
                SELECT c.id,
                       e.nom AS entreprise,
                       o.titre AS offre,
                       c.date_soumission,
                       c.cv,
                       c.lettre,
                       c.statut,
                       u.nom AS user_nom,
                       u.prenom AS user_prenom
                FROM candidature c
                INNER JOIN offre o ON c.offre_id = o.id
                INNER JOIN entreprise e ON o.entreprise_id = e.id
                INNER JOIN user u ON c.user_id = u.id
                WHERE c.user_id = :user_id
                ORDER BY c.date_soumission DESC
            ";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['user_id' => $userId]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);

        } catch (\PDOException $e) {
            throw new \Exception("Erreur lors de la récupération des candidatures de l'utilisateur : " . $e->getMessage());
        }
    }

    /**
     * Trouve une candidature par son ID
     */
    public static function findById($id)
    {
        try {
            $pdo = \Database::getInstance();
            $sql = "
                SELECT c.*,
                       e.nom AS entreprise,
                       o.titre AS offre,
                       u.nom AS user_nom,
                       u.prenom AS user_prenom
                FROM candidature c
                INNER JOIN offre o ON c.offre_id = o.id
                INNER JOIN entreprise e ON o.entreprise_id = e.id
                INNER JOIN user u ON c.user_id = u.id
                WHERE c.id = ?
            ";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            throw new \Exception("Erreur lors de la récupération de la candidature : " . $e->getMessage());
        }
    }

    /**
     * Vérifie si une candidature existe déjà pour un utilisateur et une offre
     */
    public static function exists($userId, $offreId)
    {
        // Vérifier si un mock existe pour cette méthode
        if (isset(self::$staticMocks['exists'])) {
            $callback = self::$staticMocks['exists'];
            return $callback($userId, $offreId);
        }
        try {
            $pdo = \Database::getInstance();
            $stmt = $pdo->prepare("SELECT COUNT(*) FROM candidature WHERE user_id = ? AND offre_id = ?");
            $stmt->execute([$userId, $offreId]);
            return $stmt->fetchColumn() > 0;
        } catch (\PDOException $e) {
            throw new \Exception("Erreur lors de la vérification de l'existence de la candidature : " . $e->getMessage());
        }
    }

    /**
     * Sauvegarde la candidature (insertion ou mise à jour).
     */
    public function save()
    {
        try {
            if (isset($this->id)) {
                // Mise à jour
                $sql = "
                    UPDATE candidature
                    SET user_id = ?,
                        offre_id = ?,
                        date_soumission = ?,
                        statut = ?,
                        cv = ?,
                        lettre = ?
                    WHERE id = ?
                ";
                $stmt = $this->pdo->prepare($sql);
                return $stmt->execute([
                    $this->user_id,
                    $this->offre_id,
                    $this->date_soumission,
                    $this->statut,
                    $this->cv,
                    $this->lettre,
                    $this->id
                ]);
            } else {
                // Insertion
                $sql = "
                    INSERT INTO candidature (user_id, offre_id, date_soumission, statut, cv, lettre)
                    VALUES (?, ?, ?, ?, ?, ?)
                ";
                $stmt = $this->pdo->prepare($sql);
                $result = $stmt->execute([
                    $this->user_id,
                    $this->offre_id,
                    $this->date_soumission,
                    $this->statut,
                    $this->cv,
                    $this->lettre
                ]);
                if ($result) {
                    $this->id = $this->pdo->lastInsertId();
                }
                return $result;
            }
        } catch (\PDOException $e) {
            throw new \Exception("Erreur lors de l'enregistrement de la candidature : " . $e->getMessage());
        }
    }

    /**
     * Met à jour le statut d'une candidature.
     */
    public static function updateStatus($id, $statut)
    {
         // Vérifier si un mock existe pour cette méthode
         if (isset(self::$staticMocks['updateStatus'])) {
             $callback = self::$staticMocks['updateStatus'];
            return $callback($id, $statut);
        }
        try {
            $pdo = \Database::getInstance();
            $stmt = $pdo->prepare("UPDATE candidature SET statut = ? WHERE id = ?");
            return $stmt->execute([$statut, $id]);
        } catch (\PDOException $e) {
            throw new \Exception("Erreur lors de la mise à jour du statut de la candidature : " . $e->getMessage());
        }
    }

    /**
     * Supprime le fichier CV du serveur.
     */
    public static function deleteCvFile(string $filename): bool
    {
        $safeFilename = basename($filename);
        $filePath = __DIR__ . '/../../uploads/' . $safeFilename;

        if (file_exists($filePath)) {
            return unlink($filePath);
        }
        return false;
    }
}
