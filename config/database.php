<?php
class Database {
    private $host = 'localhost';
    private $db_name = 'carpool_india';
    private $username = 'root'; // Apna MySQL username daal
    private $password = '';     // Apna MySQL password daal
    // private $db_name = 'u141142577_carpool';
    // private $username = 'u141142577_carpool'; // Apna MySQL username daal
    // private $password = 'Pink@1234!';     // Apna MySQL password daal
    private $conn;

    public function connect() {
        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host=$this->host;dbname=$this->db_name", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            echo "Connection Error: " . $e->getMessage();
        }
        return $this->conn;
    }
}
?>