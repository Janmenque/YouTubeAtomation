<?php
require_once __DIR__ . '/../../config/youtube.php';
require_once __DIR__ . '/../../lib/Google/vendor/autoload.php';
require_once __DIR__ . '/../../lib/helpers.php';

$client = new Google_Client();
$client->setClientId(YOUTUBE_CONFIG['client_id']);
$client->setClientSecret(YOUTUBE_CONFIG['client_secret']);
$client->setRedirectUri(YOUTUBE_CONFIG['redirect_uri']);
$client->setScopes(YOUTUBE_CONFIG['scopes']);

if (isset($_GET['code'])) {
    try {
        $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
        
        // Store the token in database or session
        $userId = storeUserToken($token); // Implement this function
        
        // Start session and store user ID
        session_start();
        $_SESSION['user_id'] = $userId;
        
        // Return success response
        header('Content-Type: application/json');
        echo json_encode(['success' => true, 'user_id' => $userId]);
    } catch (Exception $e) {
        header('Content-Type: application/json');
        http_response_code(400);
        echo json_encode(['error' => 'Authentication failed: ' . $e->getMessage()]);
    }
} else {
    header('Content-Type: application/json');
    http_response_code(400);
    echo json_encode(['error' => 'Authorization code not found']);
}