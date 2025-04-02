<<<<<<< Updated upstream:public/index.php
<?php
// public/index.php


session_start();
// Démarre la session pour accéder aux données de session


ini_set('display_errors', 1);
error_reporting(E_ALL);


// Charger la configuration globale et les classes...
require_once __DIR__ . '/../app/config/config.php';
require_once __DIR__ . '/../app/config/database.php';

spl_autoload_register(function ($class) {
    $prefix = 'app\\';
    $base_dir = __DIR__ . '/../app/';
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

// Récupérer le contrôleur et l'action demandés
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
                $controller->$actionName($_GET['id']); // ✅ On passe bien l'ID ici
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
=======
<?php

// Point d'entrée principal de l'application

// Démarrer la session
session_start();

ini_set('display_errors', 1);
error_reporting(E_ALL);

// Chargement des dépendances
require_once 'app/config/config.php';  // Doit être chargé en premier
require_once 'app/config/database.php';

// Ajouter une fonction pour générer des URLs
// function url($controller = 'home', $action = 'index', $params = []) {
//     $base = rtrim(BASE_URL, '/');
//     $url = $base . '/' . $controller;
//     if ($action !== 'index') {
//         $url .= '/' . $action;
//     }
    
//     if (isset($params['id'])) {
//         $url .= '/' . $params['id'];
//         unset($params['id']);
//     }
    
//     if (!empty($params)) {
//         $query = http_build_query($params);
//         $url .= '?' . $query;
//     }
    
//     return $url;
// }

// Rendre la fonction disponible globalement
$GLOBALS['url'] = 'url';

// Autoloading simple (à remplacer par Composer idéalement)
spl_autoload_register(function ($className) {
    // Convertir namespace en chemin de fichier
    $file = str_replace('\\', DIRECTORY_SEPARATOR, $className) . '.php';
    $file = __DIR__ . DIRECTORY_SEPARATOR . $file;
    
    if (file_exists($file)) {
        require_once $file;
    }
});

// Récupérer le contrôleur depuis l'URL
$controller = $_GET['controller'] ?? 'home';
$action = $_GET['action'] ?? 'index';
$id = $_GET['id'] ?? null;

// Construire le nom de la classe du contrôleur
$controllerClass = 'app\\controller\\' . ucfirst($controller) . 'Controller';

try {
    // Vérifier si le contrôleur existe
    if (!class_exists($controllerClass)) {
        throw new Exception("Contrôleur '$controllerClass' introuvable.");
    }
    
    // Instancier le contrôleur
    $controllerInstance = new $controllerClass();
    
    // Vérifier si l'action existe
    if (!method_exists($controllerInstance, $action)) {
        throw new Exception("Action '$action' introuvable dans le contrôleur '$controllerClass'.");
    }
    
    // Exécuter l'action (avec l'ID si disponible)
    if ($id !== null) {
        $controllerInstance->$action($id);
    } else {
        $controllerInstance->$action();
    }
    
} catch (Exception $e) {
    // Afficher l'erreur ou rediriger vers une page d'erreur
    echo "Erreur : " . $e->getMessage();
}
>>>>>>> Stashed changes:index.php
