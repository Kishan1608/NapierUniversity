<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header('Access-Control-Allow-Credentials: true');
header("Access-Control-Allow-Methods: GET,POST,OPTIONS,DELETE");
header("Content-Type:application/json");

require('config/database.php');
$data = json_decode(file_get_contents("php://input"), true);
$id = $data;

$result = "";
if($id){
    $query = "DELETE FROM project_detail WHERE Project_ID = '$id' ";
    $result = mysqli_query($conn, $query);
}


if($result){
    $arr = ['msg' => 'Project Deleted', 'status' => 200];
    echo json_encode($arr);
}else{
    $arr = ['msg' => 'Error In Deleting Project', 'status' => 400];
    echo json_encode($arr);
}
?>