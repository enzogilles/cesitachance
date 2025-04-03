<?php

// Démarrer la session
session_start();

//-------------------------------------------------------------------------------------------

ini_set('display_errors', 1);
error_reporting(E_ALL);

//-------------------------------------------------------------------------------------------

// Charger la configuration globale et les classes...
require_once __DIR__ . '/app/config/config.php';
require_once __DIR__ . '/app/config/database.php';

//-------------------------------------------------------------------------------------------

spl_autoload_register(function ($class) {
    $prefix = 'app\\';
    $base_dir = __DIR__ . '/app/';

//-------------------------------------------------------------------------------------------

    $len = strlen($prefix);

    if (strncmp($prefix, $class, $len) !== 0) {
        return;
    }

//-------------------------------------------------------------------------------------------

    $relative_class = substr($class, $len);
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

    if (file_exists($file)) {
        require_once $file;
    }
});

//-------------------------------------------------------------------------------------------

// Récupérer l'URL demandée
$url = isset($_GET['url']) ? $_GET['url'] : '';
$url = rtrim($url, '/');
$url = filter_var($url, FILTER_SANITIZE_URL);

//-------------------------------------------------------------------------------------------

// Diviser l'URL en segments
$segments = explode('/', $url);

//-------------------------------------------------------------------------------------------

// Par défaut, on utilise le contrôleur "home" et l'action "index"
$controllerName = !empty($segments[0]) ? $segments[0] : 'home';
$actionName = isset($segments[1]) ? $segments[1] : 'index';
$params = array_slice($segments, 2);

//-------------------------------------------------------------------------------------------

// Définir manuellement $_GET['id'] si présent dans les paramètres
if (isset($segments[2])) {
    $_GET['id'] = $segments[2];
}

//-------------------------------------------------------------------------------------------

// Construire le nom complet du contrôleur
$controllerClass = 'app\\controller\\' . ucfirst($controllerName) . 'Controller';

//-------------------------------------------------------------------------------------------

if (class_exists($controllerClass)) {
    $controller = new $controllerClass();
    if (method_exists($controller, $actionName)) {
        // Vérifier si l'action attend un paramètre (ex: id)
        $reflection = new ReflectionMethod($controller, $actionName);
        $requiredParams = $reflection->getNumberOfRequiredParameters();
        
        if ($requiredParams > 0) {
            if (count($params) >= $requiredParams) {
                call_user_func_array([$controller, $actionName], $params);
            } else {
                die("Erreur : Nombre de paramètres insuffisant pour l'action '$actionName'.");
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
