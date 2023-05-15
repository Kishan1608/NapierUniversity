<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header('Access-Control-Allow-Credentials: true');
header("Access-Control-Allow-Methods: GET,POST,OPTIONS");
header("Content-Type:application/json");

require('config/database.php');

$data = json_decode(file_get_contents("php://input"), true);

$fName=$data['Staff_FirstName'];
$lName=$data['Staff_LastName'];
$email=$data['Staff_email'];
$password=password_hash($data['Staff_Paasword'],PASSWORD_BCRYPT);
$department=$data['Staff_Department'];
$moduleCode=$data['module_code'];
$moduleLeader=$data['module_leader'];
$moduleTitle=$data['module_title'];

$sql = "SELECT * FROM staff_registration WHERE Staff_email = '$email' ";
$result = mysqli_query($conn, $sql);
$count = mysqli_num_rows($result);

if($count > 0){
    $arr = ['msg' => 'User Already exist', 'status' => 400];
    echo json_encode($arr);
}else{
    $query = "INSERT INTO staff_registration SET Staff_FirstName='$fName', Staff_LastName='$lName', Staff_email='$email', Staff_Paasword='$password', Staff_Department = '$department', module_code='$moduleCode', module_leader='$moduleLeader', module_title='$moduleTitle'";

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