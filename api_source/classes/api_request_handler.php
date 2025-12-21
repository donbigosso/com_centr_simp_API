<?php
    class ApiRequestHandler extends ApiMethods
    {
        public function handleRequest(string $method, array $params=[]): array
        {
            $method = strtolower($method);
            $test_response=["method" => $method, "test" => "test_result"];
            return $test_response;
        }
    }
?>