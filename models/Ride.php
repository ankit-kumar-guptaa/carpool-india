<?php
require_once 'config/database.php';

class Ride {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->connect();
    }

    public function create($data) {
        $query = "INSERT INTO rides (user_id, source, destination, source_lat, source_lon, dest_lat, dest_lon, ride_date, ride_time, seats_available, comment, ride_type) 
                  VALUES (:user_id, :source, :destination, :source_lat, :source_lon, :dest_lat, :dest_lon, :ride_date, :ride_time, :seats_available, :comment, :ride_type)";
        $stmt = $this->db->prepare($query);
        return $stmt->execute($data);
    }

    public function search($source, $destination, $ride_date, $source_lat = null, $source_lon = null, $dest_lat = null, $dest_lon = null) {
        $query = "SELECT * FROM rides WHERE seats_available > 0 AND ride_date >= :ride_date";
        $params = [':ride_date' => $ride_date];

        if ($source_lat && $source_lon && $dest_lat && $dest_lon) {
            // Route matching logic using a radius of 50km
            $query .= " AND (
                (6371 * acos(cos(radians(:source_lat)) * cos(radians(source_lat)) * cos(radians(source_lon) - radians(:source_lon)) + sin(radians(:source_lat)) * sin(radians(source_lat)))) < 50
                OR
                (6371 * acos(cos(radians(:dest_lat)) * cos(radians(dest_lat)) * cos(radians(dest_lon) - radians(:dest_lon)) + sin(radians(:dest_lat)) * sin(radians(dest_lat)))) < 50
            )";
            $params[':source_lat'] = $source_lat;
            $params[':source_lon'] = $source_lon;
            $params[':dest_lat'] = $dest_lat;
            $params[':dest_lon'] = $dest_lon;
        }

        if (!empty($source)) {
            $query .= " AND source LIKE :source";
            $params[':source'] = "%$source%";
        }
        if (!empty($destination)) {
            $query .= " AND destination LIKE :destination";
            $params[':destination'] = "%$destination%";
        }

        $query .= " ORDER BY ride_date, ride_time LIMIT 10";
        $stmt = $this->db->prepare($query);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getRideById($id) {
        $query = "SELECT * FROM rides WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getRideWithUserDetails($id) {
        $query = "SELECT r.*, u.name, u.phone 
                  FROM rides r 
                  JOIN users u ON r.user_id = u.id 
                  WHERE r.id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function cancelRide($ride_id, $user_id) {
        $query = "DELETE FROM rides WHERE id = :ride_id AND user_id = :user_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':ride_id', $ride_id);
        $stmt->bindParam(':user_id', $user_id);
        return $stmt->execute();
    }

    public function getRidesByUser($user_id) {
        $query = "SELECT * FROM rides WHERE user_id = :user_id ORDER BY ride_date DESC";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateSeats($ride_id, $seats_booked) {
        $query = "UPDATE rides SET seats_available = seats_available - :seats_booked WHERE id = :ride_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':ride_id', $ride_id);
        $stmt->bindParam(':seats_booked', $seats_booked);
        $stmt->execute();
    }
}
?>