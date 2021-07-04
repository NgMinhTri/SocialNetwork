<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
include_once '../config/database.php';
include_once '../objects/admin.php';
  
$database = new Database();
$db = $database->getConnection();
  
$admin = new Admin($db);
  
$data = json_decode(file_get_contents("php://input"));
  
$admin->Id = $data->Id;
$admin->firstname = $data->firstname;
$admin->lastname = $data->lastname;
$admin->email = $data->email;

if($admin->update()){

    http_response_code(200);
    echo json_encode(array("message" => "Thông tin Admin đã được cập nhật."));

}
  
else{
  
    http_response_code(503);
  
    echo json_encode(array("message" => "Không thể cập nhật thông tin Admin."));
}
?>