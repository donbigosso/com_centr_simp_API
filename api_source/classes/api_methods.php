<?php
class ApiMethods extends Core
{
public function create_api_response_array(bool $success, string $message="", string $warning="", string $error="", array $data=[]): array
{
    $response = [
        "success" => $success,
        "message" => $message,
        "warning" => $warning,
        "error" => $error,
        "data" => $data
    ];
    return $response;
}

public function checkRequestMethod() {
    // Check if a request has been initiated
    if (!isset($_SERVER['REQUEST_METHOD'])) {
        return false;
    }
    
    // Check the request method
    $method = $_SERVER['REQUEST_METHOD'];
    
    if ($method === 'POST') {
        return 'POST';
    } elseif ($method === 'GET') {
        
        return 'GET';
    } else {
        // Handle other HTTP methods if needed
        return $method; // Returns PUT, DELETE, PATCH, etc.
    }
}
}

?>