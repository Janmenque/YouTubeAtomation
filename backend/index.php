<?php
// Backend/index.php - Main Entry Point

// 1. Setup and Configuration
require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/config/database.php';
require __DIR__ . '/lib/helpers.php';

// 2. Security Headers
header("Content-Type: application/json");
header("X-Content-Type-Options: nosniff");
header("X-Frame-Options: DENY");

// 3. CORS Configuration (Adjust for your React app URL)
$allowedOrigins = [
    "http://localhost:3000",          // React dev server
    "https://your-production-domain.com"
];

if (isset($_SERVER['HTTP_ORIGIN']) && in_array($_SERVER['HTTP_ORIGIN'], $allowedOrigins)) {
    header("Access-Control-Allow-Origin: " . $_SERVER['HTTP_ORIGIN']);
    header("Access-Control-Allow-Credentials: true");
    header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
    header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
}

// 4. Handle Preflight Requests
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    exit(0);
}

// 5. Session Management
session_set_cookie_params([
    'lifetime' => 86400,
    'path' => '/',
    'domain' => $_SERVER['HTTP_HOST'],
    'secure' => true,
    'httponly' => true,
    'samesite' => 'Strict'
]);

session_start();

// 6. Routing System
$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$requestUri = str_replace('/backend/', '', $requestUri); // Adjust if using subfolder
$requestMethod = $_SERVER['REQUEST_METHOD'];

try {
    // 7. Route Definitions
    $routes = [
        'auth/youtube' => ['method' => 'GET', 'file' => 'api/auth/youtube.php'],
        'auth/callback' => ['method' => 'GET', 'file' => 'api/auth/callback.php'],
        'videos/upload' => ['method' => 'POST', 'file' => 'api/videos/upload.php'],
        'user' => ['method' => 'GET', 'file' => 'api/user.php'],
        'logout' => ['method' => 'POST', 'file' => 'api/logout.php']
    ];

    // 8. Find Matching Route
    $matched = false;
    foreach ($routes as $route => $config) {
        if (strpos($requestUri, $route) === 0 && $requestMethod === $config['method']) {
            $matched = true;
            require __DIR__ . '/' . $config['file'];
            break;
        }
    }

    // 9. Handle 404 if no route matched
    if (!$matched) {
        http_response_code(404);
        echo json_encode(['error' => 'Endpoint not found', 'request' => $requestUri]);
    }

} catch (Exception $e) {
    // 10. Error Handling
    http_response_code(500);
    echo json_encode([
        'error' => 'Internal Server Error',
        'message' => $e->getMessage(),
        'trace' => (getenv('APP_ENV') === 'development') ? $e->getTrace() : null
    ]);
}