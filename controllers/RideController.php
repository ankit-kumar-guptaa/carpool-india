<?php
require_once '../models/Ride.php';
require_once '../models/Booking.php';
require_once '../config/database.php';

class RideController {
    private $ride;
    private $booking;
    private $db;

    public function __construct() {
        $this->ride = new Ride();
        $this->booking = new Booking();
        $database = new Database();
        $this->db = $database->connect();
    }

    public function create() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ?controller=auth&action=login');
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'user_id' => $_SESSION['user_id'],
                'source' => $_POST['source'],
                'destination' => $_POST['destination'],
                'ride_date' => $_POST['ride_date'],
                'ride_time' => $_POST['ride_time'],
                'seats_available' => $_POST['seats_available'],
                'comment' => $_POST['comment'],
                'ride_type' => $_POST['ride_type']
            ];
            if ($this->ride->create($data)) {
                header('Location: ?controller=user&action=my_rides');
            } else {
                $error = "Failed to create ride!";
                require_once '../views/ride/create.php';
            }
        } else {
            require_once '../views/ride/create.php';
        }
    }

    public function search() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $source = $_POST['source'];
            $destination = $_POST['destination'];
            $ride_date = $_POST['ride_date'];
            $rides = $this->ride->search($source, $destination, $ride_date);
            require_once '../views/ride/list.php';
        } else {
            require_once '../views/ride/list.php';
        }
    }

    public function listRides() {
        $rides = $this->ride->search('', '', date('Y-m-d'));
        require_once '../views/home.php';
    }

    public function book() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ?controller=auth&action=login');
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'user_id' => $_SESSION['user_id'],
                'ride_id' => $_POST['ride_id'],
                'seats_booked' => $_POST['seats_booked']
            ];
            $ride = $this->ride->getRideById($_POST['ride_id']);
            if (!$ride) {
                $error = "Ride not found!";
                require_once '../views/ride/details.php';
                return;
            }
            if ($data['seats_booked'] > $ride['seats_available']) {
                $error = "Not enough seats available!";
                require_once '../views/ride/details.php';
                return;
            }
            if ($this->booking->book($data)) {
                header('Location: ?controller=user&action=my_rides');
            } else {
                $error = "Booking failed!";
                require_once '../views/ride/details.php';
            }
        } else {
            $ride_id = isset($_GET['ride_id']) ? $_GET['ride_id'] : null;
            if (!$ride_id) {
                $error = "Invalid ride ID!";
                require_once '../views/ride/details.php';
                return;
            }
            $ride = $this->ride->getRideWithUserDetails($ride_id);
            if (!$ride) {
                $error = "Ride not found!";
                require_once '../views/ride/details.php';
                return;
            }
            $booking_status = $this->booking->getBookingStatus($ride_id, $_SESSION['user_id']);
            require_once '../views/ride/details.php';
        }
    }

    public function manageBookings() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ?controller=auth&action=login');
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $booking_id = $_POST['booking_id'];
            $status = $_POST['status'];
            if ($status == 'accepted') {
                $booking = $this->booking->getBookingsByRide($_POST['ride_id']);
                $seats_booked = 0;
                foreach ($booking as $b) {
                    if ($b['id'] == $booking_id) {
                        $seats_booked = $b['seats_booked'];
                        break;
                    }
                }
                $this->ride->updateSeats($_POST['ride_id'], $seats_booked);
            }
            $this->booking->updateStatus($booking_id, $status);
            header('Location: ?controller=ride&action=manageBookings&ride_id=' . $_POST['ride_id']);
        } else {
            $ride_id = isset($_GET['ride_id']) ? $_GET['ride_id'] : null;
            if ($ride_id) {
                $ride = $this->ride->getRideById($ride_id);
                if ($ride && $ride['user_id'] == $_SESSION['user_id']) {
                    $bookings = $this->booking->getBookingsByRide($ride_id);
                } else {
                    $ride = null;
                    $bookings = [];
                }
            } else {
                $ride = null;
                $bookings = [];
            }
            require_once '../views/ride/manage_bookings.php';
        }
    }

    public function cancelRide() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ?controller=auth&action=login');
            exit;
        }
        $ride_id = $_GET['ride_id'];
        if ($this->ride->cancelRide($ride_id, $_SESSION['user_id'])) {
            header('Location: ?controller=user&action=my_rides');
        } else {
            header('Location: ?controller=user&action=my_rides&error=cancel_failed');
        }
    }

    public function getUserRides() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ?controller=auth&action=login');
            exit;
        }
        $created_rides = $this->ride->getRidesByUser($_SESSION['user_id']);
        $booked_rides = $this->booking->getBookedRidesByUser($_SESSION['user_id']);
        require_once '../views/user/my_rides.php';
    }

    public function getUserConnections() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ?controller=auth&action=login');
            exit;
        }
        $incoming_requests = $this->booking->getIncomingRequests($_SESSION['user_id']);
        $outgoing_requests = $this->booking->getOutgoingRequests($_SESSION['user_id']);
        require_once '../views/user/my_connections.php';
    }
}
?>