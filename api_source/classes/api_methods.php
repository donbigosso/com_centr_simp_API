<?php

class ApiMethods extends Core
{
    /**
     * Create a standardized API response array
     */
    protected function create_api_response_array(
        bool $success,
        string $message = "",
        string $warning = "",
        string $error = "",
        array $data = []
    ): array {
        return [
            "success" => $success,
            "message" => $message,
            "warning" => $warning,
            "error"   => $error,
            "data"    => $data
        ];
    }

    /**
     * Main entry point: Process the incoming request and route accordingly
     */
    public function processRequest(): void
    {
        // Ensure a request method exists
        if (!isset($_SERVER['REQUEST_METHOD'])) {
            $this->sendResponse(false, "", "", "No request method detected.");
            return;
        }

        $method = $_SERVER['REQUEST_METHOD'];

        switch ($method) {
            case 'GET':
                $this->handleGetRequest();
                break;
            case 'POST':
                $this->handlePostRequest();
                break;
            case 'PUT':
            case 'DELETE':
            case 'PATCH':
                $this->sendResponse(false, "", "", "Method $method not implemented.");
                break;
            default:
                $this->sendResponse(false, "", "", "Invalid request method: $method");
                break;
        }
    }

    /**
     * Handle GET requests - override or extend this in child classes
     */
    protected function handleGetRequest(): void
    {
        // Example: Fetch data, list resources, etc.
        // You can access $_GET here safely
        $input = $_GET;

        // Example logic (replace with your actual needs)
        if (empty($input)) {
            $this->sendResponse(false, "", "", "No GET parameters provided.");
            return;
        }

        // Dummy example request
        if (isset($input['request']) && $input['request'] === 'list_users') {
            $users = ['Alice', 'Bob', 'Charlie']; // Replace with real data
            $this->sendResponse(true, "Users retrieved successfully.", "", "", ['users' => $users]);
        } else if ((isset($input['show_gallery']) && $input['show_gallery'] === 'czarnolas')){
            $gallery = ['image1.jpg', 'image2.jpg', 'image3.jpg']; // Replace with real data
            $this->sendResponse(true, "Gallery retrieved successfully.", "", "", ['gallery' => $gallery]);
        } 
        else
        {
            $this->sendResponse(false, "", "", "Unknown or missing 'request' parameter.");
        }
    }

    /**
     * Handle POST requests - override or extend this in child classes
     */
    protected function handlePostRequest(): void
    {
        // For POST, prefer JSON input (common in APIs), fallback to $_POST
        $input = $this->getInputData();

        // Example validation
        if (empty($input)) {
            $this->sendResponse(false, "", "", "No data received in request body.");
            return;
        }

        // Dummy example request
        if (isset($input['request'])) {
            switch ($input['request']) {
                case 'create_user':
                    if (empty($input['name'])) {
                        $this->sendResponse(false, "", "", "Name is required.");
                        return;
                    }
                    // Simulate creation
                    $newUser = ['id' => 123, 'name' => $input['name']];
                    $this->sendResponse(true, "User created successfully.", "", "", $newUser);
                    break;

                case 'login':
                    // Add login logic here
                    $this->sendResponse(true, "Login successful (mock).", "", "", ['token' => 'abc123']);
                    break;

                default:
                    $this->sendResponse(false, "", "", "Unknown request: " . $input['request']);
                    break;
            }
        } else {
            $this->sendResponse(false, "", "", "Missing 'request' field.");
        }
    }

    /**
     * Helper: Get input data (supports JSON body for POST/PUT etc.)
     */
    private function getInputData(): array
    {
        $rawInput = file_get_contents('php://input');
        $data = json_decode($rawInput, true);

        if (json_last_error() === JSON_ERROR_NONE && is_array($data)) {
            return $data;
        }

        // Fallback to $_POST if not JSON
        return $_POST;
    }

    /**
     * Send JSON response and exit
     */
    protected function sendResponse(
        bool $success,
        string $message = "",
        string $warning = "",
        string $error = "",
        array $data = []
    ): void {
        header('Content-Type: application/json');

        $response = $this->create_api_response_array($success, $message, $warning, $error, $data);

        echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        exit;
    }
}