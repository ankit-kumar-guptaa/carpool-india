<?php
require_once 'models/User.php';
require_once 'config/database.php';

class AuthController {
    private $user;
    private $db;

    public function __construct() {
        $this->user = new User();
        $database = new Database();
        $this->db = $database->connect();
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];
            $user = $this->user->login($email, $password);
            if ($user) {
                if ($user['verified'] == 1) {
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['user_name'] = $user['name'];
                    // Check if there's a ride to redirect to
                    if (isset($_SESSION['redirect_ride_id'])) {
                        $ride_id = $_SESSION['redirect_ride_id'];
                        unset($_SESSION['redirect_ride_id']);
                        header("Location: ?controller=ride&action=book&ride_id=$ride_id");
                    } else {
                        header('Location: ?controller=user&action=dashboard');
                    }
                    exit;
                } else {
                    $error = "Please verify your email first!";
                    require_once 'views/auth/login.php';
                }
            } else {
                $error = "Invalid email or password!";
                require_once 'views/auth/login.php';
            }
        } else {
            require_once 'views/auth/login.php';
        }
    }

    public function signup() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['otp'])) {
                $email = $_SESSION['signup_email'] ?? '';
                $otp = trim($_POST['otp']);
                if (empty($email)) {
                    $error = "Session expired. Please try signing up again.";
                    require_once 'views/auth/signup.php';
                    return;
                }

                if ($this->user->verifyOTP($email, $otp)) {
                    $data = $_SESSION['signup_data'];
                    if ($this->user->signup($data)) {
                        $this->user->deleteOTP($email);
                        unset($_SESSION['signup_data']);
                        unset($_SESSION['signup_email']);
                        header('Location: ?controller=auth&action=login');
                    } else {
                        $error = "Signup failed! Try again.";
                        require_once 'views/auth/verify_otp.php';
                    }
                } else {
                    $error = "Invalid or expired OTP! Please check and try again.";
                    require_once 'views/auth/verify_otp.php';
                }
            } else {
                $data = [
                    'name' => $_POST['name'],
                    'email' => $_POST['email'],
                    'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
                    'phone' => $_POST['phone'],
                    'role' => $_POST['role']
                ];
                $otp = $this->user->generateOTP();
                if ($this->user->saveOTP($data['email'], $otp) && $this->user->sendOTP($data['email'], $otp)) {
                    $_SESSION['signup_data'] = $data;
                    $_SESSION['signup_email'] = $data['email'];
                    require_once 'views/auth/verify_otp.php';
                } else {
                    $error = "Failed to send OTP! Check your email or try again.";
                    require_once 'views/auth/signup.php';
                }
            }
        } else {
            require_once 'views/auth/signup.php';
        }
    }

    public function logout() {
        session_unset();
        session_destroy();
        header('Location: ?controller=ride&action=listRides');
        exit;
    }
}
?>