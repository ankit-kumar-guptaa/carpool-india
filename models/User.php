<?php
require_once 'config/database.php';
require_once 'vendor/autoload.php'; // For PHPMailer

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class User {
    private $db;

    public function __construct() {
        // Set timezone to IST
        date_default_timezone_set('Asia/Kolkata');
        $database = new Database();
        $this->db = $database->connect();
    }

    public function generateOTP() {
        return str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);
    }

    public function sendOTP($email, $otp) {
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.office365.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'noreploy@carpoolindia.com';
            $mail->Password = 'rN0RiXVw';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $mail->setFrom('noreploy@carpoolindia.com', 'Carpool India');
            $mail->addAddress($email);
            $mail->isHTML(true);
            $mail->Subject = 'Your OTP for Carpool India Signup';
            $mail->Body = "Your OTP for signup is: <b>$otp</b>. Please verify within 10 minutes.";
            $mail->send();
            return true;
        } catch (Exception $e) {
            error_log("Email sending failed: " . $mail->ErrorInfo);
            return false;
        }
    }

    public function saveOTP($email, $otp) {
        // Calculate expiry time (10 minutes from now)
        $expires_at = date('Y-m-d H:i:s', strtotime('+10 minutes'));
        error_log("Saving OTP for email: $email, OTP: $otp, Expires at: $expires_at");

        // Check if email already has an OTP entry
        $query = "SELECT * FROM otp_verifications WHERE email = :email";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            // Update existing OTP
            $query = "UPDATE otp_verifications SET otp = :otp, created_at = NOW(), expires_at = :expires_at WHERE email = :email";
        } else {
            // Insert new OTP
            $query = "INSERT INTO otp_verifications (email, otp, expires_at) VALUES (:email, :otp, :expires_at)";
        }

        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':otp', $otp);
        $stmt->bindParam(':expires_at', $expires_at);
        $result = $stmt->execute();

        if (!$result) {
            error_log("Failed to save OTP for email: $email");
        }
        return $result;
    }

    public function signup($data) {
        $query = "INSERT INTO users (name, email, password, phone, role, verified) VALUES (:name, :email, :password, :phone, :role, 1)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':name', $data['name']);
        $stmt->bindParam(':email', $data['email']);
        $stmt->bindParam(':password', $data['password']);
        $stmt->bindParam(':phone', $data['phone']);
        $stmt->bindParam(':role', $data['role']);
        return $stmt->execute();
    }

    public function verifyOTP($email, $otp) {
        $query = "SELECT * FROM otp_verifications WHERE email = :email AND otp = :otp";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':otp', $otp);
        $stmt->execute();
        $record = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($record) {
            // Check if OTP is expired
            if ($record['expires_at'] === null) {
                error_log("No expiry set for OTP for email: $email");
                return false;
            }
            $expires_at = new DateTime($record['expires_at']);
            $now = new DateTime(); // Use dynamic current time
            error_log("Verifying OTP for email: $email, Current time: " . $now->format('Y-m-d H:i:s') . ", Expires at: " . $expires_at->format('Y-m-d H:i:s'));

            if ($now > $expires_at) {
                error_log("OTP expired for email: $email");
                return false;
            }
            return true;
        }
        error_log("OTP verification failed for email: $email, OTP: $otp");
        return false;
    }

    public function deleteOTP($email) {
        $query = "DELETE FROM otp_verifications WHERE email = :email";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':email', $email);
        return $stmt->execute();
    }

    public function verifyEmail($email) {
        $query = "UPDATE users SET verified = 1 WHERE email = :email";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':email', $email);
        return $stmt->execute();
    }

    public function login($email, $password) {
        $query = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user && password_verify($password, $user['password']) && $user['verified'] == 1) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = $user['role'];
            return $user;
        }
        return false;
    }

    public function getUserById($id) {
        $query = "SELECT * FROM users WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>