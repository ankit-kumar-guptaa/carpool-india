<?php
require_once '../config/database.php';

class Booking {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->connect();
    }

    public function book($data) {
        $query = "INSERT INTO bookings (user_id, ride_id, seats_booked) VALUES (:user_id, :ride_id, :seats_booked)";
        $stmt = $this->db->prepare($query);
        return $stmt->execute($data);
    }

    public function getBookingsByRide($ride_id) {
        $query = "SELECT b.*, u.name as seeker_name 
                  FROM bookings b 
                  JOIN users u ON b.user_id = u.id 
                  WHERE b.ride_id = :ride_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':ride_id', $ride_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateStatus($booking_id, $status) {
        $query = "UPDATE bookings SET status = :status WHERE id = :booking_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':booking_id', $booking_id);
        $stmt->bindParam(':status', $status);
        return $stmt->execute();
    }

    public function getBookedRidesByUser($user_id) {
        $query = "SELECT r.*, b.status, b.ride_id 
                  FROM bookings b 
                  JOIN rides r ON b.ride_id = r.id 
                  WHERE b.user_id = :user_id 
                  ORDER BY r.ride_date DESC";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getIncomingRequests($user_id) {
        $query = "SELECT b.*, r.source, r.destination, r.ride_date, r.ride_time, u.name as seeker_name 
                  FROM bookings b 
                  JOIN rides r ON b.ride_id = r.id 
                  JOIN users u ON b.user_id = u.id 
                  WHERE r.user_id = :user_id 
                  ORDER BY b.created_at DESC";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getOutgoingRequests($user_id) {
        $query = "SELECT b.*, r.source, r.destination, r.ride_date, r.ride_time, u.name as pooler_name 
                  FROM bookings b 
                  JOIN rides r ON b.ride_id = r.id 
                  JOIN users u ON r.user_id = u.id 
                  WHERE b.user_id = :user_id 
                  ORDER BY b.created_at DESC";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getBookingStatus($ride_id, $user_id) {
        $query = "SELECT status FROM bookings WHERE ride_id = :ride_id AND user_id = :user_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':ride_id', $ride_id);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        $booking = $stmt->fetch(PDO::FETCH_ASSOC);
        return $booking ? $booking['status'] : null;
    }
}
?>