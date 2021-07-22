<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
  
// include database and object files
include_once '../config/database.php';
include_once '../objects/users.php';
  
$database = new Database();
$db = $database->getConnection();
  
$user = new User($db);
  
$user->ID = isset($_GET['ID']) ? $_GET['ID'] : die();
  
$user->readOne();
  
if($user->username != null){
    // create array
    $user_arr = array(
        "ID" =>  $user->ID,
        "firstname" => $user->firstname,
        "lastname" => $user->lastname,
        "username" => $user->username,
        "email" => $user->email,
        "phonenumber" => $user->phonenumber
    );
  
    http_response_code(200);
  
    echo json_encode($user_arr);
}
  
else{
    http_response_code(404);

    echo json_encode(array("message" => "User does not exist."));
}
?>