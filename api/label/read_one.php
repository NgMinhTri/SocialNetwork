<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
  
include_once '../config/database.php';
include_once '../objects/label.php';
  
$database = new Database();
$db = $database->getConnection();
  
$label = new Label($db);
  
$label->ID = isset($_GET['ID']) ? $_GET['ID'] : die();
  
$label->readOne();
  
if($label->labelName != null){

    $label_arr = array(
        "ID" =>  $label->ID,
        "labelName" => $label->labelName
    );
    http_response_code(200);
  
    echo json_encode($label_arr);
}
  
else{
    http_response_code(404);

    echo json_encode(array("message" => "Label does not exist."));
}
?>