<?php
// app/model/Entreprise.php

namespace App\Model;

use PDO;

class Entreprise extends BaseModel
{
    public $id;
    public $nom;
    public $secteur;
    public $ville;
    public $taille;
    public $description;
    public $email;
    public $telephone;

    public function __construct()
    {
        parent::__construct();
        $this->pdo = \Database::getInstance();
    }

    public static function findById($id)
    {
        try {
            $pdo = \Database::getInstance();
            $stmt = $pdo->prepare("
                SELECT e.*,
                       (SELECT COUNT(*)
                        FROM candidature c
                        JOIN offre o ON c.offre_id = o.id
                        WHERE o.entreprise_id = e.id
                       ) AS nb_stagiaires,
                       (SELECT AVG(v.note)
                        FROM evaluation_entreprise v
                        WHERE v.entreprise_id = e.id
                       ) AS moyenne_eval
                FROM entreprise e
                WHERE e.id = ?
            ");
            $stmt->execute([$id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            throw new \Exception("Erreur lors de la récupération de l'entreprise par ID : " . $e->getMessage());
        }
    }

    public static function search($nom, $ville, $secteur, $limit, $offset)
    {
        try {
            $pdo = \Database::getInstance();
            $sqlFilter = " WHERE 1=1 ";
            $params = [];

            if ($nom !== '') {
                $sqlFilter .= " AND nom LIKE ? ";
                $params[] = "%$nom%";
            }
            if ($ville !== '') {
                $sqlFilter .= " AND ville LIKE ? ";
                $params[] = "%$ville%";
            }
            if ($secteur !== '') {
                $sqlFilter .= " AND secteur LIKE ? ";
                $params[] = "%$secteur%";
            }

            $sqlData = "SELECT * FROM entreprise " . $sqlFilter . " ORDER BY nom ASC LIMIT ? OFFSET ?";
            $stmt = $pdo->prepare($sqlData);

            $i = 1;
            foreach ($params as $p) {
                $stmt->bindValue($i++, $p);
            }
            $stmt->bindValue($i++, $limit, PDO::PARAM_INT);
            $stmt->bindValue($i, $offset, PDO::PARAM_INT);

            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);

        } catch (\PDOException $e) {
            throw new \Exception("Erreur lors de la recherche d'entreprises : " . $e->getMessage());
        }
    }

    public static function countAll($nom, $ville, $secteur)
    {
        try {
            $pdo = \Database::getInstance();
            $sqlFilter = " WHERE 1=1 ";
            $params = [];

            if ($nom !== '') {
                $sqlFilter .= " AND nom LIKE ? ";
                $params[] = "%$nom%";
            }
            if ($ville !== '') {
                $sqlFilter .= " AND ville LIKE ? ";
                $params[] = "%$ville%";
            }
            if ($secteur !== '') {
                $sqlFilter .= " AND secteur LIKE ? ";
                $params[] = "%$secteur%";
            }

            $sqlCount = "SELECT COUNT(*) as total FROM entreprise " . $sqlFilter;
            $stmtCount = $pdo->prepare($sqlCount);
            $stmtCount->execute($params);
            $row = $stmtCount->fetch(PDO::FETCH_ASSOC);

            return $row['total'] ?? 0;
        } catch (\PDOException $e) {
            throw new \Exception("Erreur lors du comptage des entreprises : " . $e->getMessage());
        }
    }

    public static function findAll()
    {
        try {
            $pdo = \Database::getInstance();
            $stmt = $pdo->prepare("SELECT * FROM entreprise ORDER BY id DESC");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            throw new \Exception("Erreur lors de la récupération de toutes les entreprises : " . $e->getMessage());
        }
    }

    public static function delete($id)
    {
        try {
            $pdo = \Database::getInstance();
            $stmt = $pdo->prepare("DELETE FROM entreprise WHERE id = ?");
            return $stmt->execute([$id]);
        } catch (\PDOException $e) {
            throw new \Exception("Erreur lors de la suppression de l'entreprise : " . $e->getMessage());
        }
    }

    public function save()
    {
        try {
            if (isset($this->id)) {
                $stmt = $this->pdo->prepare("UPDATE entreprise SET nom = ?, secteur = ?, ville = ?, taille = ?, description = ?, email = ?, telephone = ? WHERE id = ?");
                return $stmt->execute([
                    $this->nom,
                    $this->secteur,
                    $this->ville,
                    $this->taille,
                    $this->description,
                    $this->email,
                    $this->telephone,
                    $this->id
                ]);
            } else {
                $stmt = $this->pdo->prepare("INSERT INTO entreprise (nom, secteur, ville, taille, description, email, telephone) VALUES (?, ?, ?, ?, ?, ?, ?)");
                $result = $stmt->execute([
                    $this->nom,
                    $this->secteur,
                    $this->ville,
                    $this->taille,
                    $this->description,
                    $this->email,
                    $this->telephone
                ]);
                if ($result) {
                    $this->id = $this->pdo->lastInsertId();
                }
                return $result;
            }
        } catch (\PDOException $e) {
            throw new \Exception("Erreur lors de la sauvegarde de l'entreprise : " . $e->getMessage());
        }
    }

    public function getAllSecteurs() {
        try {
            $stmt = $this->pdo->prepare("SELECT DISTINCT secteur FROM entreprise WHERE secteur IS NOT NULL AND secteur != '' ORDER BY secteur");
            $stmt->execute();
            $secteurs = [];
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $secteurs[] = $row['secteur'];
            }
            return $secteurs;
        } catch (\PDOException $e) {
            throw new \Exception("Erreur lors de la récupération des secteurs : " . $e->getMessage());
        }
    }
}
