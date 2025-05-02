<?php
/**
 * This is the router, the main entry point of the StockFlow application.
 * It handles the routing and dispatches requests to the appropriate controller methods.
 */

require "vendor/autoload.php";

use App\Controller\HomeController;
use App\Controller\DashboardController;
use App\Controller\ProductController;
use App\Controller\StockController;
use App\Controller\OrderController;
use App\Controller\UserController;

// Initialize session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Configure Twig
$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment($loader, [
    'debug' => true,
    'cache' => false // Set to a directory path for production
]);
$twig->addExtension(new \Twig\Extension\DebugExtension());

// Add current session to twig globals
$twig->addGlobal('session', $_SESSION);
$twig->addGlobal('current_date', date('Y-m-d H:i:s'));

// Parse the URI
if (isset($_GET['uri'])) {
    $uri = trim($_GET['uri'], '/');
} else {
    $uri = '';
}

// Split URI into segments
$segments = explode('/', $uri);
$controller = isset($segments[0]) && !empty($segments[0]) ? $segments[0] : 'home';
$action = isset($segments[1]) && !empty($segments[1]) ? $segments[1] : 'index';
$params = array_slice($segments, 2);

// Convert to CamelCase for controller class name
$controllerName = str_replace(' ', '', ucwords(str_replace('-', ' ', $controller)));
$controllerClass = "App\\Controller\\{$controllerName}Controller";

// Initialize controller and execute action
try {
    if (class_exists($controllerClass)) {
        // Instantiate the controller
        $controllerInstance = new $controllerClass($twig);
        
        // Check if the action method exists
        if (method_exists($controllerInstance, $action)) {
            // Call the action with parameters
            call_user_func_array([$controllerInstance, $action], $params);
        } else {
            // Action not found
            header("HTTP/1.0 404 Not Found");
            echo "Action '$action' not found in controller '$controllerName'";
        }
    } else {
        // Try mapping specific routes
        switch ($uri) {
            case '':
            case 'home':
                $controller = new HomeController($twig);
                $controller->index();
                break;
                
            case 'dashboard':
                $controller = new DashboardController($twig);
                $controller->index();
                break;
                
            case 'dashboard/alerts':
                $controller = new DashboardController($twig);
                $controller->alerts();
                break;
                
            case 'dashboard/stock-evolution':
                $controller = new DashboardController($twig);
                $controller->stockEvolution();
                break;
                
            case 'dashboard/categories':
                $controller = new DashboardController($twig);
                $controller->categoryDistribution();
                break;
                
            case 'dashboard/delivery-stats':
                $controller = new DashboardController($twig);
                $controller->deliveryStats();
                break;
                
            case 'dashboard/export':
                $controller = new DashboardController($twig);
                $controller->exportData();
                break;
                
            case 'login':
                $controller = new UserController($twig);
                $controller->login();
                break;
                
            case 'logout':
                $controller = new UserController($twig);
                $controller->logout();
                break;
                
            default:
                // 404 Not Found
                header("HTTP/1.0 404 Not Found");
                $controller = new HomeController($twig);
                $controller->notFound();
                break;
        }
    }
} catch (Exception $e) {
    // Handle exceptions
    header("HTTP/1.0 500 Internal Server Error");
    echo "Error: " . $e->getMessage();
    // Log the error
    error_log($e->getMessage());
}