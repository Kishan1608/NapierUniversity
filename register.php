<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header('Access-Control-Allow-Credentials: true');
header("Access-Control-Allow-Methods: GET,POST,OPTIONS");
header("Content-Type:application/json");

require('config/database.php');

$data = json_decode(file_get_contents("php://input"), true);

$fName=$data['Student_FirstName'];
$lName=$data['Student_LastName'];
$email=$data['Student_Email'];
$password= password_hash($data['Student_Password'],PASSWORD_BCRYPT) ;
$programTitle=$data['Student_Programmtitle'];
$entryYear=$data['Student_enteryyear'];

$sql = "SELECT * FROM student_registration WHERE Student_Email = '$email' ";
$result = mysqli_query($conn, $sql);
$count = mysqli_num_rows($result);

if($count > 0){
    $arr = ['msg' => 'User Already exist', 'status' => 400];
    echo json_encode($arr);
}else{
    $query = "INSERT INTO student_registration SET Student_FirstName='$fName', Student_LastName='$lName', Student_Email='$email', Student_Password='$password', Student_Programmtitle='$programTitle', Student_enteryyear='$entryYear'";

    $res = mysqli_query($conn, $query);

    if($res){
        $arr = ['msg' => 'Registered Successfully', 'status' => 200];
        echo json_encode($arr);
    }else{
        $arr = ['msg' => 'Error In Registering User', 'status' => 400];
        echo json_encode($arr);
    }
}

?>