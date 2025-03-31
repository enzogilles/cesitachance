<?php
// public/index.php

// --- Configurer la durée du cookie de session ---
// Cette configuration doit se faire AVANT session_start()

// Vérifier si la requête est une tentative de connexion
if ($_SERVER['REQUEST_METHOD'] === 'POST' 
    && isset($_POST['controller'], $_POST['action'])
    && $_POST['controller'] === 'utilisateur' 
    && $_POST['action'] === 'login') {
    
    // Si la case "Rester connecté" est cochée, on définit un cookie de session persistant (30 jours)
    if (isset($_POST['remember']) && $_POST['remember'] === 'on') {
        session_set_cookie_params(30 * 24 * 3600);
    } else {
        // Sinon, le cookie de session est éphémère (se termine à la fermeture du navigateur)
        session_set_cookie_params(0);
    }
} else {
    // Pour toutes les autres requêtes, on opte pour un cookie éphémère
    session_set_cookie_params(0);
}

// Démarrer la session
session_start();

ini_set('display_errors', 1);
error_reporting(E_ALL);

// Charger la configuration globale et les classes...
require_once __DIR__ . '/app/config/config.php';
require_once __DIR__ . '/app/config/database.php';

spl_autoload_register(function ($class) {
    $prefix = 'app\\';
    $base_dir = __DIR__ . '/app/';
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        return;
    }
    $relative_class = substr($class, $len);
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';
    if (file_exists($file)) {
        require_once $file;
    }
});

// Récupérer le contrôleur et l'action demandés via $_REQUEST
$controllerName = $_REQUEST['controller'] ?? 'home';
$actionName = $_REQUEST['action'] ?? 'index';

// Construire le nom complet du contrôleur
$controllerClass = 'app\\controller\\' . ucfirst($controllerName) . 'Controller';
if (class_exists($controllerClass)) {
    $controller = new $controllerClass();
    if (method_exists($controller, $actionName)) {
        // Vérifier si l'action attend un paramètre (ex: id)
        $reflection = new ReflectionMethod($controller, $actionName);
        if ($reflection->getNumberOfRequiredParameters() > 0) {
            if (isset($_GET['id'])) {
                $controller->$actionName($_GET['id']); // On passe l'ID ici
            } else {
                die("Erreur : Paramètre 'id' manquant pour l'action '$actionName'.");
            }
        } else {
            $controller->$actionName();
        }
    } else {
        echo "Action '$actionName' non trouvée dans le contrôleur '$controllerClass'.";
    }
} else {
    echo "Contrôleur '$controllerClass' non trouvé.";
}
