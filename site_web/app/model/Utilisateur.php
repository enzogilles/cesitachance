<?php
require_once 'BaseModel.php';

class Utilisateur extends BaseModel {

    public function __construct() {
        // Colonnes de la table utilisateur (exemple : id, nom, prenom, email, password, role_id)
        $headers = ['id', 'nom', 'prenom', 'email', 'password', 'role_id'];
        parent::__construct('utilisateur', $headers);
    }

    // Récupère tous les utilisateurs
    public function getAll() {
        return $this->readAll();
    }

    // Récupère un utilisateur par son id
    public function getById($id) {
        $rows = $this->readAll();
        foreach ($rows as $row) {
            if ($row['id'] == $id) {
                return $row;
            }
        }
        return null;
    }

    // Récupère un utilisateur par son email (utile pour la connexion)
    public function getByEmail($email) {
        $rows = $this->readAll();
        foreach ($rows as $row) {
            if ($row['email'] == $email) {
                return $row;
            }
        }
        return null;
    }

    // Crée un nouvel utilisateur
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

    // Met à jour un utilisateur par son id
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

    // Supprime un utilisateur par son id
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
