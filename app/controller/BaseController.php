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
            $this->redirect('utilisateur', 'connexion');
            exit;
        }
        // Si on a précisé des rôles autorisés, on vérifie
        if (!empty($allowedRoles)) {
            $userRole = $_SESSION['user']['role'] ?? '';
            if (!in_array($userRole, $allowedRoles)) {
                $this->redirect('home', 'index');
                exit;
            }
        }
    }

    /**
     * Génère une URL propre à partir du contrôleur, de l'action et des paramètres optionnels
     *
     * @param string $controller Nom du contrôleur
     * @param string $action Nom de l'action
     * @param array $params Paramètres additionnels
     * @return string URL générée
     */
    public function generateUrl($controller, $action, $params = []) {
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
    }

    /**
     * Effectue une redirection vers l'URL générée à partir du contrôleur et de l'action
     *
     * @param string $controller Nom du contrôleur
     * @param string $action Nom de l'action
     * @param array $params Paramètres additionnels
     */
    public function redirect($controller, $action, $params = []) {
        $url = $this->generateUrl($controller, $action, $params);
        header("Location: $url");
        exit;
    }

    /**
     * Envoie une réponse JSON
     *
     * @param array $data Les données à envoyer
     * @param int $status Code HTTP de la réponse
     */
    protected function jsonResponse($data, $status = 200) {
        header('Content-Type: application/json');
        http_response_code($status);
        echo json_encode($data);
        exit;
    }
}
