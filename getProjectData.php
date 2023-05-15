<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header('Access-Control-Allow-Credentials: true');
header("Access-Control-Allow-Methods: GET,POST,OPTIONS");
header("Content-Type:application/json");

require('config/database.php');
$data = json_decode(file_get_contents("php://input"), true);

$id = $data['ID'];

if($data){
    $sql = "SELECT * FROM project_detail WHERE Project_ID = '$id' ";
}
$result = mysqli_query($conn, $sql);
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