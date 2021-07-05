<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
  
include_once '../config/database.php';
include_once '../objects/admin.php';
  
$database = new Database();
$db = $database->getConnection();
  
$admin = new Admin($db);
  
$admin->Id = isset($_GET['Id']) ? $_GET['Id'] : die();
  
$admin->readOne();
  
if($admin->email != null){

    $admin_arr = array(
        "Id" =>  $admin->Id,
        "firstname" => $admin->firstname,
        "lastname" => $admin->lastname,
        "email" =>$admin->email 
    );
  

    http_response_code(200);
  
    echo json_encode($admin_arr);
}
  
else{
    http_response_code(404);

    echo json_encode(array("message" => "Admin does not exist."));
}
?>