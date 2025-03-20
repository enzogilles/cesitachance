<?php
namespace App\Model;

require_once __DIR__ . '/BaseModel.php';

class Offre extends BaseModel {

    public function __construct() {
        $headers = ['id', 'id_entreprise', 'titre', 'description', 'date_publication', 'statut', 'remuneration'];
        parent::__construct('offres', $headers);
    }
    

    // Récupère toutes les offres
    public function getAll() {
        return $this->readAll();
    }

    // Récupère une offre par son id
    public function getById($id) {
        $rows = $this->readAll();
        foreach ($rows as $row) {
            if ($row['id'] == $id) {
                return $row;
            }
        }
        return null;
    }

    // Crée une nouvelle offre
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

    // Met à jour une offre par son id
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

    // Supprime une offre par son id
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
