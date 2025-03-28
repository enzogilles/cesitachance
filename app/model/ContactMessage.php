<?php
// app/model/ContactMessage.php

namespace App\Model;

use PDO;

class ContactMessage extends BaseModel
{
    public $id;
    public $nom;
    public $email;
    public $message;
    public $date_envoi;

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Insère un nouveau message de contact.
     */
    public static function create($nom, $email, $message)
    {
        $pdo = \Database::getInstance();
        $stmt = $pdo->prepare("INSERT INTO contact_messages (nom, email, message) VALUES (?, ?, ?)");
        return $stmt->execute([$nom, $email, $message]);
    }

    /**
     * Récupère tous les messages, par ordre de date_envoi DESC
     */
    public static function findAll()
    {
        $pdo = \Database::getInstance();
        $stmt = $pdo->query("SELECT * FROM contact_messages ORDER BY date_envoi DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
