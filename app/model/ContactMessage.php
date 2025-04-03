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
        try {
            $pdo = \Database::getInstance();
            $stmt = $pdo->prepare("INSERT INTO contact_messages (nom, email, message) VALUES (?, ?, ?)");
            return $stmt->execute([$nom, $email, $message]);
        } catch (\PDOException $e) {
            throw new \Exception("Erreur lors de l'insertion du message de contact : " . $e->getMessage());
        }
    }
}
?>