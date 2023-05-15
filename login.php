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

$data = json_decode(file_get_contents("php://input"), true);

$email=$data['Student_Email'];
$password=$data['Student_Password'];

$query = "SELECT * FROM student_registration WHERE Student_Email = '$email'";
$result = mysqli_query($conn, $query);
$countrow = mysqli_num_rows($result);
$row = mysqli_fetch_array($result);

if($countrow > 0){
    $verify = password_verify($password, $row['Student_Password']);

    $key = "EdinburghNapier";
    $payload = array(
        "ID" => $row['Student_ID'],
        "firstName" => $row['Student_FirstName'],
        "lastName" => $row['Student_LastName'],
        "email" => $row['Student_Email'],
        "role" => $row['role']
    );

    if($verify == true){
        $jwt = JWT::encode($payload, $key, 'HS256');
        $cookie_name = "token";
        $cookie_value = $jwt;
        setcookie($cookie_name, $cookie_value, time() + (860 * 30), "/");
        $myarray['jwt'] = $jwt;

        http_response_code(200);
        $arr = ['msg' => 'Login Successfully', 'status' => 200, 'data' => $myarray];
        echo json_encode($arr);
    }else{
        http_response_code(401);
        $arr = ['msg' => 'Error In Login User', 'status' => 400];
        echo json_encode($arr);
    }
}else{
    $arr = ['msg' => 'No User Found', 'status' => 400];
    echo json_encode($arr);
}

?>