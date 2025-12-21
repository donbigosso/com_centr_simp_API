<?php
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: Content-Type");
    include 'classes/db_access.php';
    include 'classes/user_model.php';
    include 'classes/core.php';
    include 'classes/api_methods.php';
    include 'classes/api_request_handler.php';
    $db   = getenv('MYSQL_DATABASE');
    $user = getenv('MYSQL_USER');
    $pass = getenv('MYSQL_PASSWORD');
    $db = new DatabaseAccess('mysql', $db, $user, $pass);
    $req_han = new ApiRequestHandler();
    $userModel = new UserModel($db);
    echo JSON_encode($req_han->handleRequest("verify_user"));
?>