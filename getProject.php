<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header('Access-Control-Allow-Credentials: true');
header("Access-Control-Allow-Methods: GET,POST,OPTIONS");
header("Content-Type:application/json");

require('config/database.php');

$sql = "SELECT * FROM project_detail";

$result = mysqli_query($conn, $sql);
$count = mysqli_num_rows($result);

$myarray = array();
if($count > 0){
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