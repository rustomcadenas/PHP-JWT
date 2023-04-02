<?php

header("Access-Control-Allow-Origin:*");
// header("Access-Control-Allow-Credentials:true");
// header("Access-Control-Allow-Methods:GET,POST,OPTIONS");
header("Access-Control-Allow-Headers:*");
header("Content-Type: application/json");



require("vendor/autoload.php"); 

use Firebase\JWT\JWT; 
use Firebase\JWT\Key;


$sample_database = [
    "username"  => "tom",
    "password"  => "123"
];

$received_data  = json_decode(file_get_contents("php://input"));

// $username   = $received_data -> username;
// $password   = $received_data -> password;

$key = "test123";
$data = [
    "username"  => $received_data -> username,
    "password"  => $received_data -> password
];

$payload = [
    'iat' => time(),
    'exp' => time()+500,
    'data' => $data
];

// echo json_encode(["username"=>$username, "password"=>$password]);
if(
    $data['username'] == $sample_database['username'] && 
    $data['password'] == $sample_database['password']){
   
    $jwt = JWT::encode($payload, $key, 'HS256'); 
   
   
    echo json_encode([
        "message"  => "Username and password are correct.",
        "jwt"   => $jwt

    ]);
}else{
    echo json_encode([
        "message"  =>"Username or password is incorrect.`"
    ]);
}