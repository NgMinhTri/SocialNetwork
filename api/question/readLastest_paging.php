<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
  
// include database and object files
include_once '../config/core.php';
include_once '../shared/utilities.php';
include_once '../config/database.php';
include_once '../objects/question.php';
  
$utilities = new Utilities();
  
$database = new Database();
$db = $database->getConnection();
  
$question = new Question($db);
  
$stmt = $question->readLastestApprovedPaging($from_record_num, $records_per_page);
$num = $stmt->rowCount();
  
if($num>0){
  
    $question_arr=array();
    $question_arr["records"]=array();
    $question_arr["paging"]=array();
  
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row); 
        $question_item=array(
            "ID" => $ID,
            "catId" => $catId,
            "userId" => $userId,
            "Title" => $Title,
            "Description" => $Description,
            "CreateDate" => $CreateDate,
            "LastModifiedDate" => $LastModifiedDate,
            "NumberOfComments" => $NumberOfComments,
            "NumberOfVotes" => $NumberOfVotes,
            "NumberOfReports" => $NumberOfReports,
            "catName" => $catName,
            "UserName" => $UserName
        );
        array_push($question_arr["records"], $question_item);
    }
  
  
    // include paging
    $total_rows=$question->countLastest();
    $page_url="{$home_url}question/readLastest_paging.php?";
    $paging=$utilities->getPaging($page, $total_rows, $records_per_page, $page_url);
    $question_arr["paging"]=$paging;
  
    http_response_code(200);
  
    echo json_encode($question_arr);
}
  
else{
  
    http_response_code(404);
  
    echo json_encode(
        array("message" => "No questions found.")
    );
}
?>