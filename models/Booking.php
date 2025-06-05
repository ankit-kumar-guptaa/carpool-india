<?php
require_once '../config/database.php';

class Booking {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->connect();
    }

    public function book($data) {
        $query = "INSERT INTO bookings (user_id, ride_id, seats_booked, status) VALUES (:user_id, :ride_id, :seats_booked, 'pending')";
        $stmt = $this->db->prepare($query);
        return $stmt->execute($data);
    }

    public function updateSeats($ride_id, $seats_booked) {
        $query = "UPDATE rides SET seats_available = seats_available - :seats_booked WHERE id = :ride_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':seats_booked', $seats_booked);
        $stmt->bindParam(':ride_id', $ride_id);
        return $stmt->execute();
    }

    public function updateStatus($booking_id, $status) {
        $query = "UPDATE bookings SET status = :status WHERE id = :booking_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':booking_id', $booking_id);
        return $stmt->execute();
    }

    public function getBookingsByRide($ride_id) {
        $query = "SELECT bookings.*, users.name, users.email FROM bookings JOIN users ON bookings.user_id = users.id WHERE ride_id = :ride_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':ride_id', $ride_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUserBookings($user_id) {
        $query = "SELECT bookings.*, rides.source, rides.destination, rides.ride_date, rides.ride_time, rides.ride_type, users.name as pooler_name FROM bookings JOIN rides ON bookings.ride_id = rides.id JOIN users ON rides.user_id = users.id WHERE bookings.user_id = :user_id ORDER BY rides.ride_date DESC";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getIncomingRequests($user_id) {
        $query = "SELECT bookings.*, rides.source, rides.destination, rides.ride_date, rides.ride_time, users.name as seeker_name FROM bookings JOIN rides ON bookings.ride_id = rides.id JOIN users ON bookings.user_id = users.id WHERE rides.user_id = :user_id ORDER BY rides.ride_date DESC";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>