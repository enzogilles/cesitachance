<?php
// app/model/Offre.php

namespace App\Model;

use PDO;

class Offre extends BaseModel
{
    public $id;
    public $titre;
    public $description;
    public $duree;         // non indispensable si on calcule via date_debut/date_fin
    public $remuneration;
    public $entreprise_id;
    public $date_debut;
    public $date_fin;
    public $competences;

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Récupère une offre par son ID, avec le nom de l'entreprise et le nb de candidats.
     */
    public static function findById($id)
    {
        try {
            $pdo = \Database::getInstance();
            $stmt = $pdo->prepare("
                SELECT o.*,
                       e.nom AS entreprise,
                       (SELECT COUNT(*) FROM candidature c WHERE c.offre_id = o.id) AS nb_candidats
                FROM offre o
                JOIN entreprise e ON o.entreprise_id = e.id
                WHERE o.id = ?
            ");
            $stmt->execute([$id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            throw new \Exception("Erreur lors de la récupération de l'offre par ID : " . $e->getMessage());
        }
    }

    /**
     * Récupère la liste complète des offres (pour la gestion).
     */
    public static function findAll()
    {
        try {
            $pdo = \Database::getInstance();
            $sql = "
                SELECT o.id,
                       o.titre,
                       o.remuneration,
                       o.date_debut,
                       o.date_fin,
                       e.nom AS entreprise
                FROM offre o
                JOIN entreprise e ON o.entreprise_id = e.id
                ORDER BY o.id DESC
            ";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            throw new \Exception("Erreur lors de la récupération de toutes les offres : " . $e->getMessage());
        }
    }

    /**
     * Récupère les dernières offres (ex : pour la page d'accueil).
     */
    public static function findLatest($limit = 5)
    {
        try {
            $pdo = \Database::getInstance();
            $stmt = $pdo->prepare("
                SELECT o.id, o.titre, e.nom AS entreprise
                FROM offre o
                JOIN entreprise e ON o.entreprise_id = e.id
                ORDER BY o.id DESC
                LIMIT ?
            ");
            // le LIMIT ? nécessite un bindValue en mode PARAM_INT
            $stmt->bindValue(1, $limit, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);

        } catch (\PDOException $e) {
            throw new \Exception("Erreur lors de la récupération des dernières offres : " . $e->getMessage());
        }
    }

    /**
     * Recherche d'offres avec filtres (mot cle, competences) + pagination.
     */
    public static function search($motcle, $filtreCompetences, $limit, $offset)
    {
        try {
            $pdo = \Database::getInstance();
            $params = [];
            $sqlFilter = " WHERE 1=1 ";

            if (!empty($motcle)) {
                $sqlFilter .= " AND (o.titre LIKE ? OR o.description LIKE ?) ";
                $params[] = "%$motcle%";
                $params[] = "%$motcle%";
            }
            if (!empty($filtreCompetences)) {
                $sqlFilter .= " AND o.competences LIKE ? ";
                $params[] = "%$filtreCompetences%";
            }

            // Nombre total pour pagination
            $countSql = "SELECT COUNT(*) as total FROM offre o " . $sqlFilter;
            $countStmt = $pdo->prepare($countSql);
            $countStmt->execute($params);
            $totalRow = $countStmt->fetch(PDO::FETCH_ASSOC);
            $total = $totalRow['total'] ?? 0;

            // Récupération des offres
            $sqlData = "
                SELECT o.id,
                       o.titre,
                       o.description,
                       o.remuneration,
                       o.date_debut,
                       o.date_fin,
                       o.competences,
                       e.nom AS entreprise,
                       (SELECT COUNT(*) FROM candidature c WHERE c.offre_id = o.id) AS nb_candidats
                FROM offre o
                JOIN entreprise e ON o.entreprise_id = e.id
                $sqlFilter
                ORDER BY o.id DESC
                LIMIT ? OFFSET ?
            ";
            $stmtData = $pdo->prepare($sqlData);

            $i = 1;
            foreach ($params as $p) {
                $stmtData->bindValue($i, $p);
                $i++;
            }
            $stmtData->bindValue($i, $limit, PDO::PARAM_INT);
            $i++;
            $stmtData->bindValue($i, $offset, PDO::PARAM_INT);

            $stmtData->execute();
            $offres = $stmtData->fetchAll(PDO::FETCH_ASSOC);

            return [
                'offres' => $offres,
                'total'  => $total
            ];
        } catch (\PDOException $e) {
            throw new \Exception("Erreur lors de la recherche d'offres : " . $e->getMessage());
        }
    }

    /**
     * Supprime une offre (et ses candidatures associées).
     */
    public static function deleteById($id)
    {
        try {
            $pdo = \Database::getInstance();
            // Supprimer d'abord les candidatures associées
            $stmt = $pdo->prepare("DELETE FROM candidature WHERE offre_id = ?");
            $stmt->execute([$id]);

            // Puis supprimer l'offre
            $stmt = $pdo->prepare("DELETE FROM offre WHERE id = ?");
            $stmt->execute([$id]);

            return true;
        } catch (\PDOException $e) {
            throw new \Exception("Erreur lors de la suppression de l'offre : " . $e->getMessage());
        }
    }

    /**
     * Sauvegarde (insertion ou mise à jour).
     */
    public function save()
    {
        try {
            if (isset($this->id)) {
                // Mise à jour
                $stmt = $this->pdo->prepare("
                    UPDATE offre
                    SET titre = ?,
                        description = ?,
                        remuneration = ?,
                        entreprise_id = ?,
                        date_debut = ?,
                        date_fin = ?,
                        competences = ?,
                        duree = DATEDIFF(date_fin, date_debut)
                    WHERE id = ?
                ");
                return $stmt->execute([
                    $this->titre,
                    $this->description,
                    $this->remuneration,
                    $this->entreprise_id,
                    $this->date_debut,
                    $this->date_fin,
                    $this->competences,
                    $this->id
                ]);
            } else {
                // Insertion
                $stmt = $this->pdo->prepare("
                    INSERT INTO offre
                        (titre, description, remuneration, entreprise_id, date_debut, date_fin, competences, duree)
                    VALUES (?, ?, ?, ?, ?, ?, ?, DATEDIFF(?, ?))
                ");
                $result = $stmt->execute([
                    $this->titre,
                    $this->description,
                    $this->remuneration,
                    $this->entreprise_id,
                    $this->date_debut,
                    $this->date_fin,
                    $this->competences,
                    $this->date_fin,
                    $this->date_debut
                ]);
                if ($result) {
                    $this->id = $this->pdo->lastInsertId();
                }
                return $result;
            }
        } catch (\PDOException $e) {
            throw new \Exception("Erreur lors de la sauvegarde de l'offre : " . $e->getMessage());
        }
    }
}
?>