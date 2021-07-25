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
  
$question->catId = isset($_GET['catId']) ? $_GET['catId'] : die();
  
$stmt = $question->readByCatIdFromOldest();
  
$num = $stmt->rowCount();
  
if($num>0){
  
    $question_arr=array();
    $question_arr["records"]=array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row); 
        $question_item=array(
            "ID" => $ID,
            "catId" => $catId,
            "Title" => $Title,
            "Description" => $Description,
            "CreateDate" => $CreateDate,
            "LastModifiedDate" => $LastModifiedDate,
            "NumberOfComments" => $NumberOfComments,
            "NumberOfVotes" => $NumberOfVotes,
            "NumberOfReports" => $NumberOfReports,
            "catName" => $catName
            );
        array_push($question_arr["records"], $question_item);
    }

    http_response_code(200);

    echo json_encode($question_arr);
}
  
else{
    http_response_code(404);

    echo json_encode(array("message" => "Question does not exist."));
}
?>