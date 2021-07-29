<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
  
// include database and object files
include_once '../config/database.php';
include_once '../objects/question.php';
  
$database = new Database();
$db = $database->getConnection();
  
$question = new Question($db);
  
$question->ID = isset($_GET['ID']) ? $_GET['ID'] : die();
  
$question->readOne();
  
if($question->Title != null){
    // create array
    $question_arr = array(
        "ID" =>  $question->ID,
        "catName" => $question->catName,
        "catId" => $question->catId,
        "UserName" => $question->UserName,
        "Title" => $question->Title,
        "Description" => $question->Description,
        "CreateDate" => $question->CreateDate,
        "LastModifiedDate" => $question->LastModifiedDate,
        "NumberOfComments" => $question->NumberOfComments,
        "NumberOfVotes" => $question->NumberOfVotes,
        "NumberOfReports" => $question->NumberOfReports,
        "Status" => $question->Status 
    );
  

    http_response_code(200);
  
    echo json_encode($question_arr);
}
  
else{
    http_response_code(404);

    echo json_encode(array("message" => "Question does not exist."));
}
?>