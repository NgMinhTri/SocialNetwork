<?php
// required header
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
  
// include database and object files
include_once '../config/database.php';
include_once '../objects/users.php';
  
// instantiate database and category object
$database = new Database();
$db = $database->getConnection();
  
// initialize object
$user = new User($db);
// query categorys
$stmt = $user->readListUserForAdmin();
$num = $stmt->rowCount();
  
// check if more than 0 record found
if($num>0){
  
    // products array
    $user_arr=array();
    $user_arr["records"]=array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row); 

        $user_item=array(
            "ID" => $ID,
            "firstname" => $firstname,
            "lastname" => $lastname,
            "username" => $username,
            "email" => $email,
            "phonenumber" => $phonenumber

        );
        array_push($user_arr["records"], $user_item);
    }
    // set response code - 200 OK
    http_response_code(200);
    // show categories data in json format
    echo json_encode($user_arr);
}
  
else{
  
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user no categories found
    echo json_encode(
        array("message" => "No users found.")
    );
}
?>
