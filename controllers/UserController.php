<?php
require_once '../models/User.php';
require_once '../models/Ride.php';
require_once '../models/Booking.php';

class UserController {
    private $user;
    private $ride;
    private $booking;

    public function __construct() {
        $this->user = new User();
        $this->ride = new Ride();
        $this->booking = new Booking();
        if (!isset($_SESSION['user_id'])) {
            header('Location: ?controller=auth&action=login');
            exit;
        }
    }

    public function dashboard() {
        $user = $this->user->getUserById($_SESSION['user_id']);
        $rides = $this->ride->getRidesByUser($_SESSION['user_id']);
        require_once '../views/dashboard.php';
    }

    public function profile() {
        $user = $this->user->getUserById($_SESSION['user_id']);
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'id' => $_SESSION['user_id'],
                'name' => $_POST['name'],
                'phone' => $_POST['phone']
            ];
            require_once '../views/user/profile.php';
        } else {
            require_once '../views/user/profile.php';
        }
    }

    public function myRides() {
        $user = $this->user->getUserById($_SESSION['user_id']);
        $created_rides = $this->ride->getRidesByUser($_SESSION['user_id']);
        $booked_rides = $this->booking->getUserBookings($_SESSION['user_id']);
        require_once '../views/user/my_rides.php';
    }

    public function myConnections() {
        $user = $this->user->getUserById($_SESSION['user_id']);
        $incoming_requests = $this->booking->getIncomingRequests($_SESSION['user_id']);
        $outgoing_requests = $this->booking->getUserBookings($_SESSION['user_id']);
        require_once '../views/user/my_connections.php';
    }
}
?>