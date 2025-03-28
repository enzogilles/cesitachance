<?php
// app/controller/ContactController.php

namespace app\controller;

use app\controller\BaseController;
use App\Model\ContactMessage;

class ContactController extends BaseController {

    /**
     * Affiche le formulaire de contact (ouvert à tous).
     */
    public function index() {
        $this->render('contact/index.twig');
    }
    
    /**
     * Traite l'envoi du formulaire de contact (ouvert à tous).
     */
    public function send() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if ($_SERVER["REQUEST_METHOD"] !== "POST") {
            $_SESSION["error"] = "Méthode non autorisée.";
            header("Location: " . BASE_URL . "index.php?controller=contact&action=index");
            exit;
        }
    
        $nom     = htmlspecialchars($_POST["nom"]);
        $email   = filter_var($_POST["email"], FILTER_VALIDATE_EMAIL);
        $message = htmlspecialchars($_POST["message"]);
    
        if (!$email) {
            $_SESSION["error"] = "Email invalide.";
            header("Location: " . BASE_URL . "index.php?controller=contact&action=index");
            exit;
        }

        try {
            // Model
            ContactMessage::create($nom, $email, $message);

            $_SESSION["success"] = "Votre message a bien été envoyé et enregistré.";
        } catch (\PDOException $e) {
            $_SESSION["error"] = "Erreur lors de l'enregistrement du message.";
        }
    
        header("Location: " . BASE_URL . "index.php?controller=contact&action=index");
        exit;
    }

    /**
     * Affiche tous les messages reçus -> réservé à l'admin.
     */
    public function messages() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'Admin') {
            header("Location: " . BASE_URL . "index.php?controller=contact&action=index");
            exit;
        }

        // Model
        $messages = ContactMessage::findAll();
    
        $this->render('contact/messages.twig', ['messages' => $messages]);
    }
}
