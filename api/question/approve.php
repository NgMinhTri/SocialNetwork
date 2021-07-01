<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
include_once '../config/database.php';
include_once '../objects/question.php';
  
$database = new Database();
$db = $database->getConnection();
  
$question = new Question($db);
  
$data = json_decode(file_get_contents("php://input"));
  
$question->ID = $data->ID;
  
if($question->approve()){
  
    http_response_code(200);
  
    echo json_encode(array("message" => "Câu hỏi đã được duyệt."));

}
  
else{
  
    http_response_code(503);
  
    echo json_encode(array("message" => "Lỗi duyệt câu hỏi."));
}
?>