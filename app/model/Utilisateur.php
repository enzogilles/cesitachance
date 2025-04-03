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
    public $password;

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Récupère un utilisateur par son email (pour login).
     */
    public static function findByEmail($email)
    {
        try {
            $pdo = \Database::getInstance();
            $stmt = $pdo->prepare("SELECT id, nom, prenom, email, role, password FROM user WHERE email = ?");
            $stmt->execute([$email]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            throw new \Exception("Erreur lors de la récupération de l'utilisateur par email : " . $e->getMessage());
        }
    }

    /**
     * Crée un nouvel utilisateur dans la BDD.
     */
    public static function createUser($nom, $prenom, $email, $role, $hashedPassword)
    {
        try {
            $pdo = \Database::getInstance();
            $sql = "INSERT INTO user (nom, prenom, email, role, password) VALUES (?, ?, ?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            return $stmt->execute([$nom, $prenom, $email, $role, $hashedPassword]);
        } catch (\PDOException $e) {
            throw new \Exception("Erreur lors de la création d'un utilisateur : " . $e->getMessage());
        }
    }

    /**
     * Vérifie si un email existe déjà (pour l'inscription).
     */
    public static function emailExists($email)
    {
        try {
            $pdo = \Database::getInstance();
            $stmt = $pdo->prepare("SELECT id FROM user WHERE email = ?");
            $stmt->execute([$email]);
            return $stmt->fetch() !== false;
        } catch (\PDOException $e) {
            throw new \Exception("Erreur lors de la vérification de l'existence de l'email : " . $e->getMessage());
        }
    }

    /**
     * Récupère le total d'utilisateurs (pour pagination).
     */
    public static function countAll()
    {
        try {
            $pdo = \Database::getInstance();
            $stmt = $pdo->prepare("SELECT COUNT(*) as total FROM user");
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return $row['total'] ?? 0;
        } catch (\PDOException $e) {
            throw new \Exception("Erreur lors du comptage des utilisateurs : " . $e->getMessage());
        }
    }

    /**
     * Finds a user by their ID.
     */
    public static function findById(int $id)
    {
        try {
            $pdo = \Database::getInstance();
            $stmt = $pdo->prepare("
                SELECT id, nom, prenom, email, role
                FROM user
                WHERE id = :id
            ");
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
        } catch (\PDOException $e) {
            throw new \Exception("Erreur lors de la récupération de l'utilisateur par ID : " . $e->getMessage());
        }
    }


    /**
     * Récupère tous les utilisateurs (avec pagination).
     */
    public static function findAll($limit, $offset)
    {
        try {
            $pdo = \Database::getInstance();
            $sql = "SELECT id, nom, prenom, email, role FROM user ORDER BY id DESC LIMIT ? OFFSET ?";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(1, $limit, PDO::PARAM_INT);
            $stmt->bindValue(2, $offset, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            throw new \Exception("Erreur lors de la récupération de tous les utilisateurs : " . $e->getMessage());
        }
    }

    /**
     * Récupère certaines stats globales sur les utilisateurs.
     */
    public static function getStats()
    {
        try {
            $pdo = \Database::getInstance();
            $stmt = $pdo->prepare("
                SELECT 
                    COUNT(*) AS total_users,
                    SUM(CASE WHEN role = 'etudiant' THEN 1 ELSE 0 END) AS total_etudiants,
                    SUM(CASE WHEN role = 'pilote' THEN 1 ELSE 0 END) AS total_pilotes,
                    SUM(CASE WHEN role = 'admin' THEN 1 ELSE 0 END) AS total_admins
                FROM user
            ");
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            throw new \Exception("Erreur lors de la récupération des stats utilisateurs : " . $e->getMessage());
        }
    }

    /**
     * Met à jour un utilisateur (Admin).
     */
    public static function updateUser($id, $nom, $prenom, $email, $role)
    {
        try {
            $pdo = \Database::getInstance();
            $sql = "UPDATE user SET nom = ?, prenom = ?, email = ?, role = ? WHERE id = ?";
            $stmt = $pdo->prepare($sql);
            return $stmt->execute([$nom, $prenom, $email, $role, $id]);
        } catch (\PDOException $e) {
            throw new \Exception("Erreur lors de la mise à jour de l'utilisateur : " . $e->getMessage());
        }
    }

    /**
     * Supprime un utilisateur.
     */
    public static function deleteUser($id)
    {
        try {
            $pdo = \Database::getInstance();
            $stmt = $pdo->prepare("DELETE FROM user WHERE id = ?");
            return $stmt->execute([$id]);
        } catch (\PDOException $e) {
            throw new \Exception("Erreur lors de la suppression de l'utilisateur : " . $e->getMessage());
        }
    }
    

    /**
     * Recherche par nom/prenom/email.
     */
    public static function search($searchQuery)
    {
        $pdo = \Database::getInstance();
        $stmt = $pdo->prepare("SELECT * FROM user 
                           WHERE nom LIKE :q 
                              OR prenom LIKE :q 
                              OR email LIKE :q
                           LIMIT 1");
        $stmt->bindValue(':q', '%' . $searchQuery . '%');
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Recherche par nom/prenom/email avec filtre par rôle
     */
    public static function searchByRole($searchQuery, $role)
    {
        try {
            $pdo = \Database::getInstance();
            $stmt = $pdo->prepare("SELECT * FROM user 
                           WHERE role = :role 
                           AND (nom LIKE :q 
                           OR prenom LIKE :q 
                           OR email LIKE :q)
                           LIMIT 1");
            $stmt->bindValue(':role', $role);
            $stmt->bindValue(':q', '%' . $searchQuery . '%');
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            throw new \Exception("Erreur lors de la recherche d'utilisateur par rôle : " . $e->getMessage());
        }
    }



    /**
     * Vérifie qu'un utilisateur (id) est un étudiant (pour stats).
     */
    public static function isEtudiant($id)
    {
        try {
            $pdo = \Database::getInstance();
            $stmt = $pdo->prepare("SELECT * FROM user WHERE id = ? AND role = 'etudiant'");
            $stmt->execute([$id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            throw new \Exception("Erreur lors de la vérification du rôle étudiant : " . $e->getMessage());
        }
    }

    /**
     * Récupère tous les utilisateurs dont le rôle est 'Étudiant'.
     */
    public static function findAllEtudiants()
    {
        try {
            $pdo = \Database::getInstance();
            $stmt = $pdo->prepare("SELECT id, nom, prenom, email, role FROM user WHERE role = 'Étudiant'");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            throw new \Exception("Erreur lors de la récupération de la liste des étudiants : " . $e->getMessage());
        }
    }


    /**
     * Compte le nombre d'utilisateurs par rôle
     */
    public static function countByRole($role)
    {
        try {
            $pdo = \Database::getInstance();
            $stmt = $pdo->prepare("SELECT COUNT(*) as total FROM user WHERE role = ?");
            $stmt->execute([$role]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return $row['total'] ?? 0;
        } catch (\PDOException $e) {
            throw new \Exception("Erreur lors du comptage des utilisateurs par rôle : " . $e->getMessage());
        }
    }

    /**
     * Récupère tous les utilisateurs d'un rôle spécifique
     */
    public static function findByRole($role, $limit, $offset)
    {
        try {
            $pdo = \Database::getInstance();
            $sql = "SELECT id, nom, prenom, email, role 
                FROM user 
                WHERE role = ? 
                ORDER BY id DESC 
                LIMIT ? OFFSET ?";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(1, $role, PDO::PARAM_STR);
            $stmt->bindValue(2, $limit, PDO::PARAM_INT);
            $stmt->bindValue(3, $offset, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            throw new \Exception("Erreur lors de la récupération des utilisateurs par rôle : " . $e->getMessage());
        }
    }

    public static function findStudentsAndAdminsPaginated($offset, $limit)
{
    try {
        $pdo = \Database::getInstance();
        
        // Compter le total pour la pagination
        $stmt = $pdo->prepare("SELECT COUNT(*) as total FROM user WHERE role IN ('Étudiant', 'Admin')");
        $stmt->execute();
        $count = $stmt->fetch(\PDO::FETCH_ASSOC);
        $total = $count['total'];
        
        // Requête principale
        $stmt = $pdo->prepare("SELECT id, nom, prenom, email, role 
                              FROM user 
                              WHERE role IN ('Étudiant', 'Admin') 
                              ORDER BY nom, prenom 
                              LIMIT ?, ?");
        $stmt->bindValue(1, $offset, \PDO::PARAM_INT);
        $stmt->bindValue(2, $limit, \PDO::PARAM_INT);
        $stmt->execute();
        $users = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        
        return [
            'users' => $users,
            'total' => $total
        ];
    } catch (\PDOException $e) {
        throw new \Exception("Erreur lors de la récupération des utilisateurs : " . $e->getMessage());
    }
}

/**
 * Récupère tous les étudiants et admins
 */
public static function findAllStudentsAndAdmins()
{
    try {
        $pdo = \Database::getInstance();
        $stmt = $pdo->prepare("SELECT id, nom, prenom, role 
                              FROM user 
                              WHERE role IN ('Étudiant', 'Admin') 
                              ORDER BY nom, prenom");
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    } catch (\PDOException $e) {
        throw new \Exception("Erreur lors de la récupération de tous les utilisateurs : " . $e->getMessage());
    }
}
}
?>