<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header('Access-Control-Allow-Credentials: true');
header("Access-Control-Allow-Methods: GET,POST,OPTIONS,DELETE");
header("Content-Type:application/json");

require('config/database.php');
$data = json_decode(file_get_contents("php://input"), true);

$Project_ID = $data['Project_ID'];
$project_name = $data['Project_Title'];
$Personal_Statement = $data['Personal_Statement'];
$app_title = $data['application_title'];
$cv = $data['cv'];
$staff_id = $data['staff_id'];
$student_id = $data['student_id'];
$student_name = $data['student_name'];
$student_email = $data['student_email'];
$project_name = $data['Project_Title'];


$query = "INSERT INTO application SET app_title = '$app_title', project_id = '$Project_ID', personal_statement='$Personal_Statement', project_name = '$project_name', student_id = '$student_id', student_name = '$student_name', student_email = '$student_email', cv = '$cv', staff_id = '$staff_id'";
$result = mysqli_query($conn, $query);

if($result){
    $arr = ['msg' => 'Successfully Applied', 'status' => 200];
    echo json_encode($arr);
}else{
    $arr = ['msg' => 'Unable to Apply', 'status' => 400];
    echo json_encode($arr);
}

?>