<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
  
// include database and object files
include_once '../config/core.php';
include_once '../shared/utilities.php';
include_once '../config/database.php';
include_once '../objects/comment.php';
  
$utilities = new Utilities();
  
$database = new Database();
$db = $database->getConnection();
  
$comment = new Comment($db);

$comment->ID = isset($_GET['ID']) ? $_GET['ID'] : die();

$stmt = $comment->readOneIsReported();
$num = $stmt->rowCount();
  
if($num>0){
  
    $comment_arr=array();
    $comment_arr["records"]=array();
  
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row); 
        $comment_item=array(
            "ID" => $ID,
            "questionId" => $questionId,
            "ownerUserId" => $ownerUserId,
            "content" => $content,
            "createdDate" => $createdDate,
            "UserName" => $UserName
        );
        array_push($comment_arr["records"], $comment_item);
    }
  
  
    // include paging
    $total_rows=$comment->count();
    $page_url="{$home_url}comment/read_paging.php?questionId=$comment->questionId&";
    $paging=$utilities->getPaging($page, $total_rows, $records_per_page, $page_url);
    $comment_arr["paging"]=$paging;
  
    http_response_code(200);
  
    echo json_encode($comment_arr);
}
  
else{
  
    http_response_code(404);
  
    echo json_encode(
        array("message" => "No comments found.")
    );
}
?>