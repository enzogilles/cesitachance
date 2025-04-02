<?php
// Initialise l’environnement Twig pour le templating

require_once __DIR__ . '/../../vendor/autoload.php';

// Définit le dossier où se trouvent les fichiers .twig
$loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/../views');

// Crée l’environnement Twig avec options : cache et debug
$twig = new \Twig\Environment($loader, [
    'cache' => false, // Cache des templates compilés
    'debug' => true,                          // Mode debug (désactiver en production)
]);

// Ajout de l’extension debug (dump dans Twig)
$twig->addExtension(new \Twig\Extension\DebugExtension());

// Ajouter cette fonction personnalisée à Twig
$twig->addFunction(new \Twig\TwigFunction('url', function ($controller, $action, $params = []) {
    $url = BASE_URL . $controller . '/' . $action;
    
    // Ajouter les paramètres d'identifiant
    if (isset($params['id'])) {
        $url .= '/' . $params['id'];
        unset($params['id']);
    }
    
    // Ajouter les autres paramètres en tant que query string
    if (!empty($params)) {
        $url .= '?' . http_build_query($params);
    }
    
    return $url;
}));
?>