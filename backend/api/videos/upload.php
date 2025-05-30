<?php
require_once __DIR__ . '/../../config/youtube.php';
require_once __DIR__ . '/../../lib/Google/vendor/autoload.php';
require_once __DIR__ . '/../../lib/helpers.php';

header('Content-Type: application/json');

try {
    // Check authentication
    session_start();
    if (!isset($_SESSION['user_id'])) {
        http_response_code(401);
        echo json_encode(['error' => 'Unauthorized']);
        exit;
    }

    // Get user token from database
    $userId = $_SESSION['user_id'];
    $token = getUserToken($userId); // Implement this function
    
    if (!$token) {
        http_response_code(401);
        echo json_encode(['error' => 'User not authenticated with YouTube']);
        exit;
    }

    // Initialize Google Client
    $client = new Google_Client();
    $client->setClientId(YOUTUBE_CONFIG['client_id']);
    $client->setClientSecret(YOUTUBE_CONFIG['client_secret']);
    $client->setAccessToken($token);
    
    // Refresh token if expired
    if ($client->isAccessTokenExpired()) {
        $newToken = $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
        updateUserToken($userId, $newToken); // Implement this function
        $client->setAccessToken($newToken);
    }

    // Handle file upload
    if (!isset($_FILES['videoFile'])) {
        throw new Exception('No video file uploaded');
    }

    $videoFile = $_FILES['videoFile'];
    $uploadPath = __DIR__ . '/../../uploads/' . basename($videoFile['name']);
    
    if (!move_uploaded_file($videoFile['tmp_name'], $uploadPath)) {
        throw new Exception('Failed to move uploaded file');
    }

    // Create YouTube service
    $youtube = new Google_Service_YouTube($client);
    
    // Create snippet
    $snippet = new Google_Service_YouTube_VideoSnippet();
    $snippet->setTitle($_POST['title']);
    $snippet->setDescription($_POST['description']);
    
    if (!empty($_POST['tags'])) {
        $tags = explode(',', $_POST['tags']);
        $tags = array_map('trim', $tags);
        $snippet->setTags($tags);
    }

    // Create status
    $status = new Google_Service_YouTube_VideoStatus();
    $status->setPrivacyStatus($_POST['privacyStatus']);
    
    // Set scheduled time if provided
    if (!empty($_POST['scheduleDate'])) {
        $scheduleTime = new DateTime($_POST['scheduleDate']);
        $status->setPublishAt($scheduleTime->format(DateTime::ATOM));
    }

    // Create YouTube video
    $video = new Google_Service_YouTube_Video();
    $video->setSnippet($snippet);
    $video->setStatus($status);

    // Upload video
    $chunkSizeBytes = 1 * 1024 * 1024; // 1MB chunks
    $client->setDefer(true);
    
    $insertRequest = $youtube->videos->insert('status,snippet', $video);
    $media = new Google_Http_MediaFileUpload(
        $client,
        $insertRequest,
        'video/*',
        null,
        true,
        $chunkSizeBytes
    );
    $media->setFileSize(filesize($uploadPath));

    // Upload in chunks
    $status = false;
    $handle = fopen($uploadPath, "rb");
    $uploadedBytes = 0;
    
    while (!$status && !feof($handle)) {
        $chunk = fread($handle, $chunkSizeBytes);
        $status = $media->nextChunk($chunk);
        
        // Calculate progress
        $uploadedBytes += strlen($chunk);
        $progress = ($uploadedBytes / filesize($uploadPath)) * 100;
        
        // Send progress to client (for real-time updates you might use WebSockets)
        // For simplicity, we'll just log it here
        error_log("Upload progress: " . round($progress, 2) . "%");
    }
    
    fclose($handle);
    $client->setDefer(false);

    // Clean up
    unlink($uploadPath);

    // Return success response
    echo json_encode([
        'success' => true,
        'video_id' => $status['id'],
        'title' => $status['snippet']['title'],
        'url' => 'https://youtube.com/watch?v=' . $status['id']
    ]);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}