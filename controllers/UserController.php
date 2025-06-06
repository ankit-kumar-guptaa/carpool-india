<?php
require_once '../models/User.php';
require_once '../models/Ride.php';
require_once '../models/Booking.php';
require_once '../controllers/RideController.php';

class UserController {
    private $user;
    private $rideController;

    public function __construct() {
        $this->user = new User();
        $this->rideController = new RideController();
    }

    public function dashboard() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ?controller=auth&action=login');
            exit;
        }
        $user = $this->user->getUserById($_SESSION['user_id']);
        require_once '../views/dashboard.php';
    }

    public function profile() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ?controller=auth&action=login');
            exit;
        }
        $user = $this->user->getUserById($_SESSION['user_id']);
        require_once '../views/user/profile.php';
    }

    public function my_rides() {
        $this->rideController->getUserRides();
    }

    public function my_connections() {
        $this->rideController->getUserConnections();
    }
}
?>