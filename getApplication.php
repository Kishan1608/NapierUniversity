<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header('Access-Control-Allow-Credentials: true');
header("Access-Control-Allow-Methods: GET,POST,OPTIONS,DELETE");
header("Content-Type:application/json");

require('config/database.php');
$data = json_decode(file_get_contents("php://input"), true);
$id = $data;

$query = "SELECT * FROM applications WHERE staff_id = '$id'";
$result = mysqli_query($conn, $query);
$count = mysqli_num_rows($result);

$myarray = array();
if($count >= 1){
    while($row = mysqli_fetch_assoc($result)){
        $myarray[] = $row;
    }
    $arr = json_encode($myarray);
    print_r($arr);
}else{
    $arr = NULL;
    print_r($arr);
}

?>