<?php
require_once 'BaseModel.php';

class Candidature extends BaseModel {

    public function __construct() {
        // Les colonnes de la table candidature
        // Adaptez ces en-têtes selon votre structure réelle (exemple : id, id_utilisateur, id_offre, date_candidature, status)
        $headers = ['id', 'id_utilisateur', 'id_offre', 'date_candidature', 'status'];
        parent::__construct('candidature', $headers);
    }

    // Récupère toutes les candidatures
    public function getAll() {
        return $this->readAll();
    }

    // Récupère une candidature par son id
    public function getById($id) {
        $rows = $this->readAll();
        foreach ($rows as $row) {
            if ($row['id'] == $id) {
                return $row;
            }
        }
        return null;
    }

    // Crée une nouvelle candidature
    public function create($data) {
        $rows = $this->readAll();
        $data['id'] = $this->generateId();
        // S'assurer que toutes les colonnes sont présentes
        foreach ($this->headers as $header) {
            if (!isset($data[$header])) {
                $data[$header] = '';
            }
        }
        $rows[] = $data;
        $this->writeAll($rows);
        return $data;
    }

    // Met à jour une candidature par son id
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

    // Supprime une candidature par son id
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
