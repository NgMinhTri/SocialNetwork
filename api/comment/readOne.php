<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
  
// include database and object files
include_once '../config/database.php';
include_once '../objects/comment.php';
  
$database = new Database();
$db = $database->getConnection();
  
$comment = new Comment($db);
  
$comment->ID = isset($_GET['ID']) ? $_GET['ID'] : die();
  
$comment->readOne();
  
if($comment->content != null){
    $comment_arr = array(
        "ID" =>  $comment->ID,
        "questionId" => $comment->questionId,
        "ownerUserId" => $comment->ownerUserId,
        "content" => $comment->content,
        "createDate" => $comment->createDate,
        "lastModifiedDate" => $comment->lastModifiedDate
    );
  
    http_response_code(200);
  
    echo json_encode($comment_arr);
}
  
else{
    http_response_code(404);

    echo json_encode(array("message" => "comment does not exist."));
}
?>