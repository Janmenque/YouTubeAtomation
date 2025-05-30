<?php
require_once __DIR__ . '/../../config/youtube.php';
require_once __DIR__ . '/../../lib/Google/vendor/autoload.php';

$client = new Google_Client();
$client->setClientId(YOUTUBE_CONFIG['client_id']);
$client->setClientSecret(YOUTUBE_CONFIG['client_secret']);
$client->setRedirectUri(YOUTUBE_CONFIG['redirect_uri']);
$client->setScopes(YOUTUBE_CONFIG['scopes']);
$client->setAccessType('offline');
$client->setPrompt('consent');

$authUrl = $client->createAuthUrl();

header('Content-Type: application/json');
echo json_encode(['auth_url' => $authUrl]);