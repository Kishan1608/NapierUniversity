<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header('Access-Control-Allow-Credentials: true');
header("Access-Control-Allow-Methods: GET,POST,OPTIONS");
header("Content-Type:application/json");

require('config/database.php');
$data = json_decode(file_get_contents("php://input"), true);

$Project_ID = $data['Project_ID'];
$Project_Title = $data['Project_Title'];
$Description = $data['Project_Description'];
$supervisor = $data['supervisor'];
$tools = $data['require_tools'];
$difficulty = $data['difficulty_level'];
$capacity = $data['capacity'];
$staff_id = $data['staff_id'];

$query = "UPDATE project_detail SET Project_Title = '$Project_Title', Project_Description = '$Description', supervisor='$supervisor', require_tools = '$tools', difficulty_level = '$difficulty', capacity = '$capacity', staff_id = '$staff_id' WHERE Project_ID = '$Project_ID' ";
$result = mysqli_query($conn, $query);

if($result){
    $arr = ['msg' => 'Project Updated', 'status' => 200];
    echo json_encode($arr);
}else{
    $arr = ['msg' => 'Error In Updating Project', 'status' => 400];
    echo json_encode($arr);
}
?>