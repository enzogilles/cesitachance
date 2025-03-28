<?php
namespace app\controller;

// Contrôleur de base que les autres contrôleurs vont étendre
class BaseController {
    protected $twig;

    public function __construct() {
        // Inclut Twig et initialise le moteur de rendu
        require_once __DIR__ . '/../config/twig.php';
        $this->twig = $twig;
    }

    /**
     * Rend une vue Twig avec les données fournies
     *
     * @param string $template Nom du template (ex : 'home/index.twig')
     * @param array  $data     Données à injecter dans la vue
     */
    protected function render($template, $data = []) {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
    
        $user = isset($_SESSION['user']) && !empty($_SESSION['user']) ? $_SESSION['user'] : null;
    
        echo $this->twig->render($template, array_merge($data, [
            'session' => $_SESSION,
            'user' => $user,
            'BASE_URL' => BASE_URL
        ]));
    }
}
