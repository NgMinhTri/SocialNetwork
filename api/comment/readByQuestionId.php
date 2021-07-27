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
  
$comment->questionId = isset($_GET['questionId']) ? $_GET['questionId'] : die();
  
$stmt = $comment->readCommentsByQuestionId();
  
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

    http_response_code(200);

    echo json_encode($comment_arr);
}
  
else{
    http_response_code(404);

    echo json_encode(array("message" => "Comment does not exist."));
}
?>