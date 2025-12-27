<?php
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: Content-Type");
    // Check for download request first
if (isset($_GET['request']) && $_GET['request'] === 'download' && isset($_GET['file'])) {
    $file = 'uploads/' . basename($_GET['file']);  // Security: prevent directory traversal
    
    if (file_exists($file)) {
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . basename($file) . '"');
        header('Content-Length: ' . filesize($file));
        header('Cache-Control: no-cache');
        
        readfile($file);
        exit;  // Stop all further processing
    } else {
        http_response_code(404);
        echo json_encode(['error' => 'File not found']);
        exit;
    }
}

// Rest of your existing code
        include 'classes/core.php';
    include 'classes/db_access.php';
        include 'classes/api_methods.php';
    include 'classes/user_model.php';

    include 'classes/api_request_handler.php';
    $core = new Core();
    $db   = getenv('MYSQL_DATABASE');
    $user = getenv('MYSQL_USER');
    $pass = getenv('MYSQL_PASSWORD');
    $db = new DatabaseAccess('mysql', $db, $user, $pass);
    $api = new ApiMethods();
    $api->processRequest($core); // This will handle everything and output JSON
?>