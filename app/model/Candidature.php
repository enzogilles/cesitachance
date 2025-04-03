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
     * @return bool true si la mise à jour a réussi, false sinon
     */
    public static function updateStatus($id, $statut)
    {
        try {
            error_log("Début updateStatus - ID: $id, Statut: $statut");
            
            // Vérification que l'ID existe
            $pdo = \Database::getInstance();
            $checkStmt = $pdo->prepare("SELECT id FROM candidature WHERE id = ?");
            $checkStmt->execute([$id]);
            
            if (!$checkStmt->fetch()) {
                error_log("Candidature non trouvée pour l'ID: $id");
                return false;
            }
    
            // Mise à jour du statut
            $stmt = $pdo->prepare("UPDATE candidature SET statut = ? WHERE id = ?");
            $result = $stmt->execute([$statut, $id]);
    
            if (!$result) {
                error_log("Erreur SQL: " . print_r($stmt->errorInfo(), true));
                return false;
            }
    
            error_log("Mise à jour réussie - ID: $id, Nouveau statut: $statut");
            return true;
    
        } catch (\PDOException $e) {
            error_log("Exception PDO dans updateStatus: " . $e->getMessage());
            throw $e;
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