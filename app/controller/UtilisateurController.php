<?php
// app/controller/UtilisateurController.php

namespace app\controller;

use app\controller\BaseController;
use Database;

class UtilisateurController extends BaseController {

    /**
     * Page de connexion -> accessible à tous.
     */
    public function connexion() {
        $this->render('utilisateurs/connexion.twig');
    }

    /**
     * Page d'inscription -> accessible à tous.
     */
    public function inscription() {
        $this->render('utilisateurs/inscription.twig');
    }

    /**
     * Déconnecte l'utilisateur.
     */
    public function logout() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    
        // Supprimer toutes les données de session
        $_SESSION = [];
    
        // Supprimer le cookie de session
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }
    
        // Détruire la session côté serveur
        session_destroy();
    
        // ✅ Repartir sur une nouvelle session propre (évite les résurrections de session)
        session_start();
        session_regenerate_id(true);
<<<<<<< Updated upstream
    
        // Redirection
        header("Location: " . BASE_URL . "index.php?controller=home&action=index");
        exit();
=======

        // Redirection vers la page d'accueil avec la nouvelle méthode
        $this->redirect('home', 'index');
>>>>>>> Stashed changes
    }
    
    

    /**
     * Traitement de la connexion.
     */
    public function login() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        $pdo = Database::getInstance();
    
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $email = trim($_POST["email"]);
            $password = $_POST["password"];
    
            if (empty($email) || empty($password)) {
                // On réaffiche la page connexion.twig avec un message
                $error = "Veuillez remplir tous les champs.";
                $this->render('utilisateurs/connexion.twig', ['error' => $error]);
                return;
            }
    
            $stmt = $pdo->prepare("SELECT id, nom, prenom, email, role, password FROM user WHERE email = ?");
            $stmt->execute([$email]);
            $user = $stmt->fetch(\PDO::FETCH_ASSOC);
    
            if (!$user || !password_verify($password, $user['password'])) {
                // Email ou mot de passe incorrect
                $error = "Email ou mot de passe incorrect.";
                $this->render('utilisateurs/connexion.twig', ['error' => $error]);
                return;
            }
    
            // Si tout est OK, on connecte l'utilisateur
            $_SESSION["user"] = [
                "id" => $user["id"],
                "nom" => $user["nom"],
                "prenom" => $user["prenom"],
                "email" => $user["email"],
                "role" => $user["role"]
            ];
<<<<<<< Updated upstream
    
            // Redirection vers le dashboard
            header("Location: " . BASE_URL . "index.php?controller=dashboard&action=index");
            exit;
=======

            // Gestion de l'option "Rester connecté"
            if (isset($_POST["remember"]) && $_POST["remember"] === "on") {
                $_SESSION["remember"] = true;
            } else {
                $_SESSION["remember"] = false;
            }

            // Redirection vers le dashboard avec la nouvelle méthode
            $this->redirect('dashboard', 'index');
>>>>>>> Stashed changes
        }
    }
    

    /**
     * Traitement de l'inscription.
     */
    public function register() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        $pdo = Database::getInstance();
    
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $nom = trim($_POST["nom"]);
            $prenom = trim($_POST["prenom"]);
            $email = trim($_POST["email"]);
            $role = trim($_POST["role"]);
            $password = $_POST["password"];
            $confirmPassword = $_POST["confirm-password"];
    
            if (empty($nom) || empty($prenom) || empty($email) || empty($role) || empty($password) || empty($confirmPassword)) {
                $error = "Tous les champs sont requis.";
                $this->render('utilisateurs/inscription.twig', ['error' => $error]);
                return;
            }
    
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error = "Format d'email invalide.";
                $this->render('utilisateurs/inscription.twig', ['error' => $error]);
                return;
            }
    
            if ($password !== $confirmPassword) {
                $error = "Les mots de passe ne correspondent pas.";
                $this->render('utilisateurs/inscription.twig', ['error' => $error]);
                return;
            }
    
            $stmt = $pdo->prepare("SELECT id FROM user WHERE email = ?");
            $stmt->execute([$email]);
            if ($stmt->fetch()) {
                $error = "Cet email est déjà utilisé.";
                $this->render('utilisateurs/inscription.twig', ['error' => $error]);
                return;
            }
    
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
<<<<<<< Updated upstream
    
            $stmt = $pdo->prepare("INSERT INTO user (nom, prenom, email, role, password) VALUES (?, ?, ?, ?, ?)");
            if ($stmt->execute([$nom, $prenom, $email, $role, $hashedPassword])) {
                header("Location: " . BASE_URL . "index.php?controller=utilisateur&action=connexion");
                exit();
=======

            $res = Utilisateur::createUser($nom, $prenom, $email, $role, $hashedPassword);
            if ($res) {
                $this->redirect('utilisateur', 'connexion');
>>>>>>> Stashed changes
            } else {
                $error = "Erreur lors de l'inscription.";
                $this->render('utilisateurs/inscription.twig', ['error' => $error]);
                return;
            }
        }
    }

    /**
     * Affiche la page "Mot de passe oublié".
     */
    public function resetPassword() {
        $this->render('utilisateurs/resetPassword.twig');
    }

    /**
     * Traite la demande de réinitialisation du mot de passe.
     */
    public function sendResetLink() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        $pdo = Database::getInstance();

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $email = trim($_POST["email"]);
            if (empty($email)) {
                $error = "Veuillez saisir votre email.";
                $this->render('utilisateurs/resetPassword.twig', ['error' => $error]);
                return;
            }

            $stmt = $pdo->prepare("SELECT id FROM user WHERE email = ?");
            $stmt->execute([$email]);
            $user = $stmt->fetch(\PDO::FETCH_ASSOC);
            if (!$user) {
                $error = "Aucun compte associé à cet email.";
                $this->render('utilisateurs/resetPassword.twig', ['error' => $error]);
                return;
            }

            $token = bin2hex(random_bytes(16));
            $expiration = date("Y-m-d H:i:s", strtotime("+1 hour"));
            $stmt = $pdo->prepare("INSERT INTO password_resets (user_id, token, expiration) VALUES (?, ?, ?)");
            $stmt->execute([$user['id'], $token, $expiration]);

<<<<<<< Updated upstream
            $resetLink = BASE_URL . "index.php?controller=utilisateur&action=changePassword&token=" . $token;

            mail($email, "Réinitialisation de votre mot de passe", "Cliquez sur ce lien pour réinitialiser votre mot de passe : " . $resetLink);
=======
            // Génération du lien de réinitialisation avec la nouvelle méthode
            $resetLink = $this->generateUrl('utilisateur', 'changePassword', ['token' => $token]);
            
            // Envoi du mail
            mail($email, "Réinitialisation de votre mot de passe", 
                 "Cliquez sur ce lien pour réinitialiser votre mot de passe : " . $resetLink);
>>>>>>> Stashed changes

            $message = "Un lien de réinitialisation a été envoyé à votre adresse email.";
            $this->render('utilisateurs/resetPassword.twig', ['message' => $message]);
        }
    }
    
    /**
     * Affiche le formulaire de changement de mot de passe (avec token).
     */
    public function changePassword() {
        $token = $_GET['token'] ?? '';
        
        if (empty($token)) {
            $this->redirect('utilisateur', 'resetPassword', ['error' => 'token_missing']);
        }
        
        // Vérifier la validité du token
        $pdo = \Database::getInstance();
        $stmt = $pdo->prepare("SELECT user_id, expiration FROM password_resets WHERE token = ? AND expiration > NOW()");
        $stmt->execute([$token]);
        $reset = $stmt->fetch();
        
        if (!$reset) {
            $this->redirect('utilisateur', 'resetPassword', ['error' => 'invalid_token']);
        }
        
        $this->render('utilisateurs/changePassword.twig', ['token' => $token]);
    }
    
    /**
     * Traite le formulaire de changement de mot de passe.
     */
    public function updatePassword() {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $token = $_POST['token'] ?? '';
            $password = $_POST['password'] ?? '';
            $confirmPassword = $_POST['confirm_password'] ?? '';
            
            if (empty($token) || empty($password) || empty($confirmPassword)) {
                $this->render('utilisateurs/changePassword.twig', [
                    'token' => $token,
                    'error' => 'Tous les champs sont requis.'
                ]);
                return;
            }
            
            if ($password !== $confirmPassword) {
                $this->render('utilisateurs/changePassword.twig', [
                    'token' => $token,
                    'error' => 'Les mots de passe ne correspondent pas.'
                ]);
                return;
            }
            
            // Vérifier la validité du token
            $pdo = \Database::getInstance();
            $stmt = $pdo->prepare("SELECT user_id FROM password_resets WHERE token = ? AND expiration > NOW()");
            $stmt->execute([$token]);
            $reset = $stmt->fetch();
            
            if (!$reset) {
                $this->redirect('utilisateur', 'resetPassword', ['error' => 'invalid_token']);
            }
            
            // Mettre à jour le mot de passe
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $updateStmt = $pdo->prepare("UPDATE users SET password = ? WHERE id = ?");
            $updateStmt->execute([$hashedPassword, $reset['user_id']]);
            
            // Supprimer le token utilisé
            $deleteStmt = $pdo->prepare("DELETE FROM password_resets WHERE token = ?");
            $deleteStmt->execute([$token]);
            
            $this->redirect('utilisateur', 'connexion', ['notif' => 'password_updated']);
        }
    }
}
