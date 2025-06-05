<?php
require_once '../includes/bootstrap.php';

$controller = $_GET['controller'] ?? 'auth';
$action = $_GET['action'] ?? 'login';

if ($controller == 'auth') {
    require_once '../controllers/AuthController.php';
    $controller = new AuthController();
    if ($action == 'login') $controller->login();
    elseif ($action == 'signup') $controller->signup();
    elseif ($action == 'logout') $controller->logout();
} elseif ($controller == 'user') {
    require_once '../controllers/UserController.php';
    $controller = new UserController();
    if ($action == 'dashboard') $controller->dashboard();
    elseif ($action == 'profile') $controller->profile();
    elseif ($action == 'my_rides') $controller->myRides();
    elseif ($action == 'my_connections') $controller->myConnections();
} elseif ($controller == 'ride') {
    require_once '../controllers/RideController.php';
    $controller = new RideController();
    if ($action == 'create') $controller->create();
    elseif ($action == 'search') $controller->search();
    elseif ($action == 'book') $controller->book();
    elseif ($action == 'list') $controller->listRides();
    elseif ($action == 'manageBookings') $controller->manageBookings();
    elseif ($action == 'cancel') {
        $ride_id = $_GET['ride_id'];
        if ($controller->cancelRide($ride_id)) {
            header('Location: ?controller=user&action=my_rides');
        } else {
            header('Location: ?controller=user&action=my_rides&error=cancel_failed');
        }
    }
}
?>