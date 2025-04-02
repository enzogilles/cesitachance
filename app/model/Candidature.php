<?php
// app/model/Candidature.php

namespace App\Model;

use PDO;

class Candidature extends BaseModel
{
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
?>