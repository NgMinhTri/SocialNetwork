<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
  
include_once '../config/database.php';
include_once '../objects/users.php';
  
$database = new Database();
$db = $database->getConnection();
  
$user = new User($db);
  
$keywords = isset($_GET["s"]) ? $_GET["s"] : "";
  
$stmt = $user->search($keywords);
$num = $stmt->rowCount();
  
if($num>0){
  
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

    http_response_code(200);
  
    echo json_encode($user_arr);
}
  
else{ 

    http_response_code(404);
  
    echo json_encode(
        array("message" => "Không có User nào được tìm thấy.")
    );
}
?>