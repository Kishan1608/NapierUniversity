<?php
header("Access-Control-Allow-Origin: http://localhost:3000");
header("Access-Control-Allow-Headers: Content-Type, X-Auth-Token, Authorization, Origin");
header('Access-Control-Allow-Credentials: true');
header("Access-Control-Allow-Methods: GET,POST,OPTIONS");
header("Content-Type:application/json");

require('config/database.php');
require('php-jwt-main/src/BeforeValidException.php');
require('php-jwt-main/src/CachedKeySet.php');
require('php-jwt-main/src/ExpiredException.php');
require('php-jwt-main/src/JWK.php');
require('php-jwt-main/src/JWT.php');
require('php-jwt-main/src/Key.php');
require('php-jwt-main/src/SignatureInvalidException.php');
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

$data = json_decode(file_get_contents("php://input"), true);

$jwt = $data['token'];
$key = "EdinburghNapier";


try {
    $decode = JWT::decode($jwt, new Key($key, 'HS256'));
    $arr = $decode;
    echo json_encode($arr);
} catch (Exception $e) {
    $arr = ['msg' => 'Access Denied', 'status' => 400, 'data' => $e->getMessage()];
    echo json_encode($arr);
}
?>