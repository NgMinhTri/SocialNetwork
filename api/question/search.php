<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
  
include_once '../config/database.php';
include_once '../objects/question.php';
  
$database = new Database();
$db = $database->getConnection();
  
$question = new Question($db);
  
$keywords=isset($_GET["s"]) ? $_GET["s"] : "";
  
$stmt = $question->search($keywords);
$num = $stmt->rowCount();
  
if($num>0){
  
    $question_arr=array();
    $question_arr["records"]=array();
  
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
  
        $question_item = array(
            "ID" =>  $ID,
            "catName" => $catName,
            "UserName" => $UserName,
            "Title" => $Title,
            "Description" => $Description,
            "CreateDate" => $CreateDate,
            "LastModifiedDate" => $LastModifiedDate,
            "NumberOfComments" => $NumberOfComments,
            "NumberOfVotes" => $NumberOfVotes,
            "NumberOfReports" => $NumberOfReports,
            "Status" => $Status 
        ); 
        array_push($question_arr["records"], $question_item);
    }

    http_response_code(200);
  
    echo json_encode($question_arr);
}
  
else{ 

    http_response_code(404);
  
    echo json_encode(
        array("message" => "Không có câu hỏi nào được tìm thấy.")
    );
}
?>