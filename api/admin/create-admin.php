<?php
// required headers
header("Access-Control-Allow-Origin: http://localhost/rest-api-authentication-example/");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// files needed to connect to database
include_once '../config/database.php';
include_once '../objects/admin.php';
 
$database = new Database();
$db = $database->getConnection();
 
$admin = new Admin($db);
 
$data = json_decode(file_get_contents("php://input"));
 
$admin->firstname = $data->firstname;
$admin->lastname = $data->lastname;
$admin->email = $data->email;
$admin->password = $data->password;
 
if(
    !empty($admin->firstname) &&
    !empty($admin->lastname) &&
    !empty($admin->email) &&
    !empty($admin->password) &&
    $admin->create()
){
 
    http_response_code(200);
 
    echo json_encode(array("message" => "Admin was created."));
}
 
else{
 
    http_response_code(400);
 
    echo json_encode(array("message" => "Unable to create Admin."));
}
?>