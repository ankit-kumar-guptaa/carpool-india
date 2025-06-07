<?php
require_once 'vendor/autoload.php';

session_start();

$client = new Google_Client();
$client->setClientId('479939149109-cp76ji0vvbna10htqtlbpq8o9h0adaec.apps.googleusercontent.com');
$client->setClientSecret('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');
$client->setRedirectUri('https://carpool.greencarcarpool.com/auth/google-callback.php');
$client->addScope('email');
$client->addScope('profile');

$authUrl = $client->createAuthUrl();
header('Location: ' . $authUrl);
exit;
?>