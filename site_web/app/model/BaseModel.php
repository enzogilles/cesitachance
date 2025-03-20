<?php
namespace App\Model;

class BaseModel {
    protected $filePath;
    protected $headers = [];

    public function __construct($fileName, $headers = []) {
        // On stocke les fichiers CSV dans le dossier data à la racine du projet.
        $this->filePath = __DIR__ . "/../../data/{$fileName}.csv";
        $this->headers = $headers;
        if (!file_exists($this->filePath)) {
            $this->createFile();
        }
    }

    /**
     * Crée le fichier CSV avec les en-têtes spécifiés
     */
    protected function createFile() {
        $handle = fopen($this->filePath, 'w');
        if (!empty($this->headers)) {
            fputcsv($handle, $this->headers);
        }
        fclose($handle);
    }

    protected function readAll() {
        $rows = [];
        if (($handle = fopen($this->filePath, 'r')) !== false) {
            // Lire la première ligne (les en-têtes) et l’ignorer ensuite
            $header = fgetcsv($handle);
            while (($data = fgetcsv($handle)) !== false) {
                // Vérifier que le nombre de colonnes correspond aux en-têtes
                if (count($data) == count($this->headers)) {
                    $rows[] = array_combine($this->headers, $data);
                }
            }
            fclose($handle);
        }
        return $rows;
    }

    protected function writeAll($rows) {
        $handle = fopen($this->filePath, 'w');
        fputcsv($handle, $this->headers);
        foreach ($rows as $row) {
            $data = [];
            foreach ($this->headers as $header) {
                $data[] = isset($row[$header]) ? $row[$header] : '';
            }
            fputcsv($handle, $data);
        }
        fclose($handle);
    }

    protected function generateId() {
        $rows = $this->readAll();
        $maxId = 0;
        foreach ($rows as $row) {
            $id = intval($row['id']);
            if ($id > $maxId) {
                $maxId = $id;
            }
        }
        return $maxId + 1;
    }
}
