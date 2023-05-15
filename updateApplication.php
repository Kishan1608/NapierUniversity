<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header('Access-Control-Allow-Credentials: true');
header("Access-Control-Allow-Methods: GET,POST,OPTIONS,DELETE");
header("Content-Type:application/json");

require('config/database.php');
$data = json_decode(file_get_contents("php://input"), true);

$id = $data['application_id'];
$status = $data['application_status'];

if($status === '1'){
    $query = "UPDATE applications SET status = 0 WHERE application_id = '$id'";    
}else{
    $query = "UPDATE applications SET status = 1 WHERE application_id = '$id'";
}

$result = mysqli_query($conn, $query);

if($result){
    $arr = ['msg' => 'Updated', 'status' => 200];
    echo json_encode($arr);
}else{
    $arr = ['msg' => 'Error In Updating', 'status' => 400];
    echo json_encode($arr);
}
?>