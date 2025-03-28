<?php
// app/model/Entreprise.php

namespace App\Model;

use PDO;

class Entreprise extends BaseModel {
    public $id;
    public $nom;
    public $secteur;
    public $ville;
    public $taille;

    // NOUVEAUX CHAMPS :
    public $description;
    public $email;
    public $telephone;

    public function __construct() {
        parent::__construct();
    }

    /**
     * Récupère les informations d'une entreprise par son ID.
     *
     * @param int $id
     * @return array|false
     */
    public static function findById($id) {
        $pdo = \Database::getInstance();
        $stmt = $pdo->prepare("SELECT * FROM entreprise WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Recherche d'entreprises avec filtres, pagination et tri.
     */
    public static function search($nom, $ville, $secteur, $limit, $offset)
    {
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

        // on bind chaque param dynamique
        $i = 1;
        foreach ($params as $p) {
            $stmt->bindValue($i, $p);
            $i++;
        }
        $stmt->bindValue($i, $limit, PDO::PARAM_INT);
        $i++;
        $stmt->bindValue($i, $offset, PDO::PARAM_INT);

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Compte le nombre total d'entreprises selon les filtres.
     */
    public static function countAll($nom, $ville, $secteur)
    {
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
    }

    /**
     * Supprime une entreprise par son ID.
     */
    public static function delete($id)
    {
        $pdo = \Database::getInstance();
        $stmt = $pdo->prepare("DELETE FROM entreprise WHERE id = ?");
        return $stmt->execute([$id]);
    }

    /**
     * Sauvegarde l'entreprise (insertion ou mise à jour).
     *
     * @return bool
     */
    public function save() {
        if (isset($this->id)) {
            $stmt = $this->pdo->prepare("
                UPDATE entreprise
                SET nom = ?,
                    secteur = ?,
                    ville = ?,
                    taille = ?,
                    description = ?,
                    email = ?,
                    telephone = ?
                WHERE id = ?
            ");
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
            $stmt = $this->pdo->prepare("
                INSERT INTO entreprise
                    (nom, secteur, ville, taille, description, email, telephone)
                VALUES (?, ?, ?, ?, ?, ?, ?)
            ");
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
    }
}
