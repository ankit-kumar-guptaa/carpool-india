<?php
require_once '../config/database.php';

class Ride {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->connect();
    }

    public function create($data) {
        $query = "INSERT INTO rides (user_id, source, destination, ride_date, ride_time, seats_available, comment, ride_type) VALUES (:user_id, :source, :destination, :ride_date, :ride_time, :seats_available, :comment, :ride_type)";
        $stmt = $this->db->prepare($query);
        return $stmt->execute($data);
    }

    public function search($source, $destination, $ride_date) {
        $query = "SELECT rides.*, users.name FROM rides JOIN users ON rides.user_id = users.id WHERE source LIKE :source AND destination LIKE :destination AND ride_date = :ride_date AND seats_available > 0 AND rides.user_id != :user_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':source', "%$source%");
        $stmt->bindValue(':destination', "%$destination%");
        $stmt->bindParam(':ride_date', $ride_date);
        $stmt->bindParam(':user_id', $_SESSION['user_id']);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getRideById($id) {
        $query = "SELECT rides.*, users.name, users.phone FROM rides JOIN users ON rides.user_id = users.id WHERE rides.id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getRidesByUser($user_id) {
        $query = "SELECT * FROM rides WHERE user_id = :user_id ORDER BY ride_date DESC";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function cancelRide($ride_id, $user_id) {
        $query = "DELETE FROM rides WHERE id = :ride_id AND user_id = :user_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':ride_id', $ride_id);
        $stmt->bindParam(':user_id', $user_id);
        return $stmt->execute();
    }
}
?>