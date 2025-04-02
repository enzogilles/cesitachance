<?php
namespace app\controller;

// Contrôleur de base que les autres contrôleurs vont étendre
class BaseController {
    protected $twig;

    public function __construct() {
        // S'assurer que config.php est inclus avant tout
        if (!defined('BASE_URL')) {
            require_once __DIR__ . '/../config/config.php';
        }
        
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
<<<<<<< Updated upstream
    
    
    
=======

    /**
     * Vérifie que l'utilisateur est connecté et, si un tableau de rôles est fourni,
     * que son rôle figure dans cette liste. Sinon, redirige.
     *
     * @param array $allowedRoles Tableau des rôles autorisés. Laisser vide = tout utilisateur connecté.
     */
    protected function checkAuth(array $allowedRoles = []) {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
        // L'utilisateur doit être logué
        if (!isset($_SESSION['user'])) {
            header("Location: " . $this->generateUrl('utilisateur', 'connexion'));
            exit;
        }
        // Si on a précisé des rôles autorisés, on vérifie
        if (!empty($allowedRoles)) {
            $userRole = $_SESSION['user']['role'] ?? '';
            if (!in_array($userRole, $allowedRoles)) {
                header("Location: " . $this->generateUrl('home', 'index'));
                exit;
            }
        }
    }

    /**
     * Génère une URL propre selon le contrôleur, l'action et les paramètres
     *
     * @param string $controller Nom du contrôleur
     * @param string $action Nom de l'action
     * @param array $params Paramètres additionnels (optionnel)
     * @return string URL générée
     */
    protected function generateUrl(string $controller = 'home', string $action = 'index', array $params = []) {
        // S'assurer que config.php est inclus
        if (!function_exists('url')) {
            require_once __DIR__ . '/../config/config.php';
        }
        
        // Maintenant on peut utiliser la fonction url()
        return url($controller, $action, $params);
    }

    /**
     * Redirige vers une autre URL
     *
     * @param string $controller Nom du contrôleur
     * @param string $action Nom de l'action
     * @param array $params Paramètres additionnels (optionnel)
     */
    protected function redirect(string $controller, string $action, array $params = []) {
        header("Location: " . $this->generateUrl($controller, $action, $params));
        exit;
    }
>>>>>>> Stashed changes
}
