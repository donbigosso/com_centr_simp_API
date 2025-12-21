<?php
    class ApiRequestHandler extends ApiMethods
    {
        public function handleRequest(string $method, array $params=[]): array
        {
            $method = strtolower($method);
            $test_response=["request_accepted" => true, "method" => $method, "test" => "test_result"];
            return $test_response;
        }
    }
?>