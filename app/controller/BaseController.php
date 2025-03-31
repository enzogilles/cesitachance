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
        // On démarre la session ici si pas déjà active
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

        // Récupération éventuelle de l'utilisateur connecté
        $user = isset($_SESSION['user']) && !empty($_SESSION['user']) ? $_SESSION['user'] : null;

        echo $this->twig->render($template, array_merge($data, [
            'session' => $_SESSION,
            'user' => $user,
            'BASE_URL' => BASE_URL
        ]));
    }

    /**
     * Vérifie que l’utilisateur est connecté et, si un tableau de rôles est fourni,
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
            header("Location: " . BASE_URL . "index.php?controller=utilisateur&action=connexion");
            exit;
        }
        // Si on a précisé des rôles autorisés, on vérifie
        if (!empty($allowedRoles)) {
            $userRole = $_SESSION['user']['role'] ?? '';
            if (!in_array($userRole, $allowedRoles)) {
                header("Location: " . BASE_URL . "index.php?controller=home&action=index");
                exit;
            }
        }
    }
}
