<?php
// app/model/Utilisateur.php

namespace App\Model;

use PDO;

class Utilisateur extends BaseModel
{
    public $id;
    public $nom;
    public $prenom;
    public $email;
    public $role;
    public $password; // ou password_hash suivant votre table

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Récupère un utilisateur par son email (pour login).
     */
    public static function findByEmail($email)
    {
        $pdo = \Database::getInstance();
        $stmt = $pdo->prepare("SELECT id, nom, prenom, email, role, password FROM user WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Crée un nouvel utilisateur dans la BDD.
     */
    public static function createUser($nom, $prenom, $email, $role, $hashedPassword)
    {
        $pdo = \Database::getInstance();
        $sql = "INSERT INTO user (nom, prenom, email, role, password) VALUES (?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute([$nom, $prenom, $email, $role, $hashedPassword]);
    }

    /**
     * Vérifie si un email existe déjà (pour l'inscription).
     */
    public static function emailExists($email)
    {
        $pdo = \Database::getInstance();
        $stmt = $pdo->prepare("SELECT id FROM user WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch() !== false;
    }

    /**
     * Récupère le total d'utilisateurs (pour pagination).
     */
    public static function countAll()
    {
        $pdo = \Database::getInstance();
        $stmt = $pdo->query("SELECT COUNT(*) as total FROM user");
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['total'] ?? 0;
    }

    /**
     * Finds a user by their ID.
     *
     * @param int $id The ID of the user.
     * @return array|null The user data or null if not found.
     */
    public static function findById(int $id)
    {
        $pdo = \Database::getInstance();
        $stmt = $pdo->prepare("
            SELECT id, nom, prenom, email, role
            FROM user
            WHERE id = :id
        ");
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }
    
    /**
     * Récupère tous les utilisateurs (avec pagination).
     */
    public static function findAll($limit, $offset)
    {
        $pdo = \Database::getInstance();
        $sql = "SELECT id, nom, prenom, email, role FROM user ORDER BY id DESC LIMIT ? OFFSET ?";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(1, $limit, PDO::PARAM_INT);
        $stmt->bindValue(2, $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Récupère certaines stats globales sur les utilisateurs.
     */
    public static function getStats()
    {
        $pdo = \Database::getInstance();
        $stmt = $pdo->query("
            SELECT 
                COUNT(*) AS total_users,
                SUM(CASE WHEN role = 'etudiant' THEN 1 ELSE 0 END) AS total_etudiants,
                SUM(CASE WHEN role = 'pilote' THEN 1 ELSE 0 END) AS total_pilotes,
                SUM(CASE WHEN role = 'admin' THEN 1 ELSE 0 END) AS total_admins
            FROM user
        ");
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Met à jour un utilisateur (Admin).
     */
    public static function updateUser($id, $nom, $prenom, $email, $role)
    {
        $pdo = \Database::getInstance();
        $sql = "UPDATE user SET nom = ?, prenom = ?, email = ?, role = ? WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute([$nom, $prenom, $email, $role, $id]);
    }

    /**
     * Supprime un utilisateur.
     */
    public static function deleteUser($id)
    {
        $pdo = \Database::getInstance();
        $stmt = $pdo->prepare("DELETE FROM user WHERE id = ?");
        return $stmt->execute([$id]);
    }

    /**
     * Recherche par nom/prenom/email.
     */
    public static function search($searchQuery)
    {
        $pdo = \Database::getInstance();
        $sql = "SELECT * FROM user WHERE nom LIKE ? OR prenom LIKE ? OR email LIKE ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(["%$searchQuery%", "%$searchQuery%", "%$searchQuery%"]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Vérifie qu'un utilisateur (id) est un étudiant (pour stats).
     */
    public static function isEtudiant($id)
    {
        $pdo = \Database::getInstance();
        $stmt = $pdo->prepare("SELECT * FROM user WHERE id = ? AND role = 'etudiant'");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Récupère tous les utilisateurs dont le rôle est 'Étudiant'.
     */
    public static function findAllEtudiants()
    {
        $pdo = \Database::getInstance();
        $stmt = $pdo->prepare("SELECT id, nom, prenom, email, role FROM user WHERE role = 'Étudiant'");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}
