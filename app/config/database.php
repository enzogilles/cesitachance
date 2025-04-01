<?php
//  Gérer une seule instance PDO dans toute l'application
class Database {
    private static $instance = null;

    public static function getInstance() {
        if (self::$instance === null) {
            // Paramètres de connexion
            $host     = 'localhost';
            $dbname   = 'projet_web';
            $username = 'root';
            $password = '';

            // DSN (Data Source Name) avec encodage UTF-8
            $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";

            try {
                // Création de l'instance PDO
                self::$instance = new PDO($dsn, $username, $password);
                // Active le mode exception pour les erreurs SQL
                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                // En cas d’erreur, on stoppe tout
                die("Erreur de connexion à la base de données : " . $e->getMessage());
            }
        }
        return self::$instance;
    }
}