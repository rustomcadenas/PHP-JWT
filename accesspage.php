<?php

header("Access-Control-Allow-Origin:*");
// header("Access-Control-Allow-Credentials:true");
// header("Access-Control-Allow-Methods:GET,POST,OPTIONS");
header("Access-Control-Allow-Headers:*");
header("Content-Type: application/json");

require("vendor/autoload.php"); 
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
 

$headers    = getallheaders(); 
$authcode   = trim($headers['Authorization']);
$token      = substr($authcode, 7);
$key = "test123"; 


try {
    $decoded = JWT::decode($token, new Key($key, 'HS256'));
    $message = [
        'status'    => 200,
        'data'      => $decoded,
        'message'   => "Access Allow"
    ];

} catch (Exception $e) {
    $message = [
        "Status"    => 400,
        'data'      => $e->getMessage(),
        'message'   => 'Access Denied'
    ];
}
 

echo json_encode([
    "Bearer"    => $authcode,
    "Token"     => $token,
    'Result'    => $message
]);