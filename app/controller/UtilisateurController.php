<?php
// app/controller/UtilisateurController.php

namespace app\controller;

use app\controller\BaseController;
use App\Model\Utilisateur;

class UtilisateurController extends BaseController {

    /**
     * Nettoie et récupère une valeur du formulaire
     */
    private function getFormInput($key, $default = '') {
        return isset($_POST[$key]) ? trim($_POST[$key]) : $default;
    }
    
    /**
     * Valide les champs requis d'un formulaire
     * @return bool|string True si valide, message d'erreur sinon
     */
    private function validateRequiredFields($fields) {
        foreach ($fields as $field) {
            if (empty($this->getFormInput($field))) {
                return "Tous les champs sont requis.";
            }
        }
        return true;
    }
    
    /**
     * Affiche une erreur et le formulaire
     */
    private function renderWithError($viewPath, $error) {
        $this->render($viewPath, ['error' => $error]);
        return;
    }

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
        // Vérifie juste que l'utilisateur est connecté
        $this->checkAuth();

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

        // Repartir sur une nouvelle session propre
        session_start();
        session_regenerate_id(true);

        // Redirection vers la page d'accueil avec URL propre
        $this->redirect('home', 'index');
    }

    /**
     * Traitement de la connexion (login).
     */
    public function login() {
        if ($_SERVER["REQUEST_METHOD"] !== "POST") {
            return;
        }

        $email = $this->getFormInput("email");
        $password = $this->getFormInput("password", null);
        
        // Validation des champs
        $validation = $this->validateRequiredFields(['email', 'password']);
        if ($validation !== true) {
            return $this->renderWithError('utilisateurs/connexion.twig', $validation);
        }

        // Vérification des identifiants
        $user = Utilisateur::findByEmail($email);
        if (!$user || !password_verify($password, $user['password'])) {
            return $this->renderWithError('utilisateurs/connexion.twig', "Email ou mot de passe incorrect.");
        }

        // Si tout est OK, on connecte l'utilisateur
        $_SESSION["user"] = [
            "id" => $user["id"],
            "nom" => $user["nom"],
            "prenom" => $user["prenom"],
            "email" => $user["email"],
            "role" => $user["role"]
        ];

        // Gestion de l'option "Rester connecté"
        $_SESSION["remember"] = isset($_POST["remember"]) && $_POST["remember"] === "on";

        // Redirection vers le dashboard avec URL propre
        $this->redirect('dashboard', 'index');
    }

    /**
     * Traitement de l'inscription.
     */
    public function register() {
        if ($_SERVER["REQUEST_METHOD"] !== "POST") {
            return;
        }

        // Récupération des données du formulaire
        $nom = $this->getFormInput("nom");
        $prenom = $this->getFormInput("prenom");
        $email = $this->getFormInput("email");
        $role = $this->getFormInput("role");
        $password = $this->getFormInput("password", null);
        $confirmPassword = $this->getFormInput("confirm-password", null);

        // Validation des champs requis
        $validation = $this->validateRequiredFields([
            'nom', 'prenom', 'email', 'role', 'password', 'confirm-password'
        ]);
        if ($validation !== true) {
            return $this->renderWithError('utilisateurs/inscription.twig', $validation);
        }

        // Validation du format de l'email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return $this->renderWithError('utilisateurs/inscription.twig', "Format d'email invalide.");
        }

        // Validation de la correspondance des mots de passe
        if ($password !== $confirmPassword) {
            return $this->renderWithError('utilisateurs/inscription.twig', "Les mots de passe ne correspondent pas.");
        }

        // Vérification de l'unicité de l'email
        if (Utilisateur::emailExists($email)) {
            return $this->renderWithError('utilisateurs/inscription.twig', "Cet email est déjà utilisé.");
        }

        // Création de l'utilisateur
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $res = Utilisateur::createUser($nom, $prenom, $email, $role, $hashedPassword);
        
        if ($res) {
            $this->redirect('utilisateur', 'connexion');
        } else {
            return $this->renderWithError('utilisateurs/inscription.twig', "Erreur lors de l'inscription.");
        }
    }

    /**
     * Affiche la page "Mot de passe oublié".
     */
    public function resetPassword() {
        $this->render('utilisateurs/resetPassword.twig');
    }

}
