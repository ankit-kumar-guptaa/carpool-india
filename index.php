<?php
// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Include bootstrap file
require_once 'includes/bootstrap.php';

// Get controller and action from query parameters
$controller = isset($_GET['controller']) ? $_GET['controller'] : 'ride';
$action = isset($_GET['action']) ? $_GET['action'] : 'listRides';

// Redirect logged-in users to dashboard if accessing homepage
if (isset($_SESSION['user_id']) && $controller == 'ride' && $action == 'listRides') {
    header('Location: ?controller=user&action=dashboard');
    exit;
}

// Route requests to appropriate controller
switch ($controller) {
    case 'auth':
        require_once 'controllers/AuthController.php';
        $authController = new AuthController();
        if (method_exists($authController, $action)) {
            $authController->$action();
        } else {
            $authController->login();
        }
        break;

    case 'ride':
        require_once 'controllers/RideController.php';
        $rideController = new RideController();
        if (method_exists($rideController, $action)) {
            $rideController->$action();
        } else {
            $rideController->listRides();
        }
        break;

    case 'user':
        require_once 'controllers/UserController.php';
        $userController = new UserController();
        if (method_exists($userController, $action)) {
            $userController->$action();
        } else {
            $userController->dashboard();
        }
        break;

    default:
        require_once 'controllers/RideController.php';
        $rideController = new RideController();
        $rideController->listRides();
        break;
}
?>