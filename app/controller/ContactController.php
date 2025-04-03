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
        // Pas besoin de démarrer la session ici puisque BaseController le fait déjà
        // dans son constructeur

        if ($_SERVER["REQUEST_METHOD"] !== "POST") {
            $_SESSION["error"] = "Méthode non autorisée.";
            $this->redirect('contact', 'index');
        }
        
        $nom = htmlspecialchars($_POST["nom"]);
        $email = filter_var($_POST["email"], FILTER_VALIDATE_EMAIL);
        $message = htmlspecialchars($_POST["message"]);

        if (!$email) {
            $_SESSION["error"] = "Email invalide.";
            $this->redirect('contact', 'index');
        }

        try {
            ContactMessage::create($nom, $email, $message);
            $this->redirect('contact', 'index', ['notif' => 'sent']);
        } catch (\PDOException $e) {
            $_SESSION["error"] = "Erreur lors de l'enregistrement du message.";
            $this->redirect('contact', 'index');
        }
    }
}
