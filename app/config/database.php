<?php

declare(strict_types=1);

require_once __DIR__ . '/../../vendor/autoload.php';

use Dotenv\Dotenv;

class Database
{
    private static ?PDO $instance = null;

    public static function getInstance(): PDO
    {
        if (self::$instance === null) {
            try {
                $dotenv = Dotenv::createImmutable(__DIR__ . '/../../');
                $dotenv->load();

                $host     = $_ENV['DB_HOST'];
                $dbname   = $_ENV['DB_NAME'];
                $user     = $_ENV['DB_USER'];
                $password = $_ENV['DB_PASS'];

                $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";

                self::$instance = new PDO($dsn, $user, $password, [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                ]);

            } catch (PDOException $e) {
                throw new RuntimeException('Erreur de connexion à la base de données : ' . $e->getMessage());
            }
        }

        return self::$instance;
    }
}
