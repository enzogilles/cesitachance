<?php
// app/controller/ContactController.php

namespace app\controller;

use app\controller\BaseController;
use App\Model\ContactMessage;

class ContactController extends BaseController
{

    /**
     * Affiche le formulaire de contact (ouvert à tous).
     */
    public function index()
    {
        // Pas de restriction de rôle, pas besoin de checkAuth
        $this->render('contact/index.twig');
    }

    /**
     * Traite l'envoi du formulaire de contact (ouvert à tous).
     */
    public function send()
    {
        // Pas de restriction absolue, pas besoin de checkAuth
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if ($_SERVER["REQUEST_METHOD"] !== "POST") {
            $_SESSION["error"] = "Méthode non autorisée.";
            header("Location: " . BASE_URL . "index.php?controller=contact&action=index");
            exit;
        }
        

        $nom = htmlspecialchars($_POST["nom"]);
        $email = filter_var($_POST["email"], FILTER_VALIDATE_EMAIL);
        $message = htmlspecialchars($_POST["message"]);

        if (!$email) {
            $_SESSION["error"] = "Email invalide.";
            header("Location: " . BASE_URL . "index.php?controller=contact&action=index");
            exit;
        }

try {
    ContactMessage::create($nom, $email, $message);
    header("Location: " . BASE_URL . "index.php?controller=contact&action=index&notif=sent");
    exit;
} catch (\PDOException $e) {
    $_SESSION["error"] = "Erreur lors de l'enregistrement du message.";
    header("Location: " . BASE_URL . "index.php?controller=contact&action=index");
    exit;
}
    }


    /**
     * Affiche tous les messages reçus -> réservé à l'admin.
     */
    public function messages()
    {
        $this->checkAuth(['Admin']);

        // Model
        $messages = ContactMessage::findAll();

        $this->render('contact/messages.twig', ['messages' => $messages]);
    }
}
