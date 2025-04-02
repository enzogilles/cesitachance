<?php
<<<<<<< Updated upstream
// Définit l'URL de base de l'application (utile pour générer des liens dynamiques)
define('BASE_URL', 'http://localhost/cesitachance-1/public/');
=======
// Définit l'URL de base du site 
define('BASE_URL', 'http://localhost/cesitachance-3/');

// Fonction pour générer des URLs propres
function url($controller = 'home', $action = 'index', $params = []) {
    $base = rtrim(BASE_URL, '/');
    $url = $base . '/' . $controller;
    if ($action !== 'index') {
        $url .= '/' . $action;
    }
    
    if (isset($params['id'])) {
        $url .= '/' . $params['id'];
        unset($params['id']);
    }
    
    if (!empty($params)) {
        $query = http_build_query($params);
        $url .= '?' . $query;
    }
    
    return $url;
}
?>
>>>>>>> Stashed changes
