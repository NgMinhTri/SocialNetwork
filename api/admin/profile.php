<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
  
include_once '../config/database.php';
include_once '../objects/admin.php';
  
$database = new Database();
$db = $database->getConnection();
  
$admin = new Admin($db);
  
$stmt = $admin->readOneByEmail();
$num = $stmt->rowCount();

if($num>0){

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
  
        $admin_item=array(
            "Id" => $Id,
            "firstname" => $firstname,
            "lastname" => $lastname,
            "email" => $email
        );
  
    }
    http_response_code(200);

    echo json_encode($admin_item);
}
  
else{
  
    http_response_code(404);
  
    echo json_encode(
        array("message" => "No Admin found.")
    );
}