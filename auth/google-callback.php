<?php
require_once 'vendor/autoload.php';
require_once 'models/User.php';

session_start();

$client = new Google_Client();
$client->setClientId('479939149109-cp76ji0vvbna10htqtlbpq8o9h0adaec.apps.googleusercontent.com');
$client->setClientSecret('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');
$client->setRedirectUri('https://carpool.greencarcarpool.com/auth/google-callback.php');

if (isset($_GET['code'])) {
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    if (isset($token['error'])) {
        header('Location: ?controller=auth&action=login');
        exit;
    }
    
    $client->setAccessToken($token['access_token']);
    
    // Get user info
    $googleService = new Google_Service_Oauth2($client);
    $userInfo = $googleService->userinfo->get();
    
    $email = $userInfo->email;
    $name = $userInfo->name;
    
    // Check if user exists in database
    $userModel = new User();
    $user = $userModel->getUserByEmail($email);
    
    if ($user) {
        // User exists, log them in
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];
    } else {
        // Register new user
        $data = [
            'name' => $name,
            'email' => $email,
            'password' => password_hash(uniqid(), PASSWORD_DEFAULT), // Random password
            'phone' => '',
            'role' => 'rider',
            'verified' => 1
        ];
        $userModel->signup($data);
        $user = $userModel->getUserByEmail($email);
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];
    }
    
    // Redirect after login
    if (isset($_SESSION['redirect_ride_id'])) {
        $ride_id = $_SESSION['redirect_ride_id'];
        unset($_SESSION['redirect_ride_id']);
        header("Location: ?controller=ride&action=book&ride_id=$ride_id");
    } else {
        header('Location: ?controller=user&action=dashboard');
    }
    exit;
} else {
    header('Location: ?controller=auth&action=login');
    exit;
}
?>