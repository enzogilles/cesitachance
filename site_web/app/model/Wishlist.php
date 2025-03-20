<?php
require_once 'BaseModel.php';

class Wishlist extends BaseModel {

    public function __construct() {
        // Colonnes de la table wishlist (exemple : id, id_utilisateur, id_offre)
        $headers = ['id', 'id_utilisateur', 'id_offre'];
        parent::__construct('wishlist', $headers);
    }

    // Récupère toutes les entrées de la wishlist
    public function getAll() {
        return $this->readAll();
    }

    // Récupère une entrée par son id
    public function getById($id) {
        $rows = $this->readAll();
        foreach ($rows as $row) {
            if ($row['id'] == $id) {
                return $row;
            }
        }
        return null;
    }

    // Crée une nouvelle entrée dans la wishlist
    public function create($data) {
        $rows = $this->readAll();
        $data['id'] = $this->generateId();
        foreach ($this->headers as $header) {
            if (!isset($data[$header])) {
                $data[$header] = '';
            }
        }
        $rows[] = $data;
        $this->writeAll($rows);
        return $data;
    }

    // Met à jour une entrée de la wishlist par son id
    public function update($id, $data) {
        $rows = $this->readAll();
        foreach ($rows as &$row) {
            if ($row['id'] == $id) {
                foreach ($data as $key => $value) {
                    if (in_array($key, $this->headers)) {
                        $row[$key] = $value;
                    }
                }
                $this->writeAll($rows);
                return $row;
            }
        }
        return null;
    }

    // Supprime une entrée de la wishlist par son id
    public function delete($id) {
        $rows = $this->readAll();
        $found = false;
        foreach ($rows as $index => $row) {
            if ($row['id'] == $id) {
                unset($rows[$index]);
                $found = true;
                break;
            }
        }
        if ($found) {
            $rows = array_values($rows);
            $this->writeAll($rows);
            return true;
        }
        return false;
    }
}
