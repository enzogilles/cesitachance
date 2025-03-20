<?php
namespace App\Model;

require_once __DIR__ . '/BaseModel.php';

use App\Model\BaseModel;

class Entreprise extends BaseModel {

    public function __construct() {
        $headers = ['id', 'nom', 'adresse', 'email', 'telephone'];
        parent::__construct('entreprises', $headers);
    }

    public function getAll() {
        return $this->readAll();
    }

    public function getById($id) {
        $rows = $this->readAll();
        foreach ($rows as $row) {
            if ($row['id'] == $id) {
                return $row;
            }
        }
        return null;
    }

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
