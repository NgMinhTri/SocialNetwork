<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
  
// include database and object files
include_once '../config/database.php';
include_once '../objects/vote.php';
  
$database = new Database();
$db = $database->getConnection();
  
$vote = new Vote($db);
  
$vote->questionId = isset($_GET['questionId']) ? $_GET['questionId'] : die();
  
$stmt = $vote->countNumberVotesPerQuestion();
  
$num = $stmt->rowCount();
  
if($num>0){

    http_response_code(200);

    echo json_encode($num);
}
  
else{
    http_response_code(404);

    echo json_encode(array("message" => "Vote does not exist."));
}
?>