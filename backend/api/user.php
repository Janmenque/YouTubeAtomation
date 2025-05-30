<?php
require_once __DIR__ . '/../lib/helpers.php';

header('Content-Type: application/json');

session_start();
if (!isset($_SESSION['user_id'])) {
    http_response_code(401);
    echo json_encode(['error' => 'Unauthorized']);
    exit;
}

$userId = $_SESSION['user_id'];
$user = getUserData($userId); // Implement this function

if (!$user) {
    http_response_code(404);
    echo json_encode(['error' => 'User not found']);
    exit;
}

echo json_encode([
    'id' => $user['id'],
    'email' => $user['email'],
    'name' => $user['name'],
    'channel_id' => $user['youtube_channel_id'],
    'channel_name' => $user['youtube_channel_name']
]);