<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
 // required to decode jwt
include_once '../config/core.php';
include_once '../libs/php-jwt-master/src/BeforeValidException.php';
include_once '../libs/php-jwt-master/src/ExpiredException.php';
include_once '../libs/php-jwt-master/src/SignatureInvalidException.php';
include_once '../libs/php-jwt-master/src/JWT.php';
use \Firebase\JWT\JWT;

include_once '../config/database.php';
include_once '../objects/comment.php';
  
$database = new Database();
$db = $database->getConnection();
  
$comment = new Comment($db);

$data = json_decode(file_get_contents("php://input"));

$jwt=isset($data->jwt) ? $data->jwt : "";

if($jwt){
 
    try {
        $decoded = JWT::decode($jwt, $key, array('HS256'));
        $comment->ownerUserId = $decoded->data->id;
        $comment->content = $data->content;
        $comment->questionId = $data->questionId;
       
        
        if($comment->create()){
               
            http_response_code(201);
            
            echo json_encode(array("message" => "Comment đã được tạo."));
        }                       
        else{
            http_response_code(401);
        
            echo json_encode(array("message" => "Không thể tạo comment."));
        }
    }
    catch (Exception $e){
    
        http_response_code(401);
    
        echo json_encode(array(
            "message" => "Access denied.",
            "error" => $e->getMessage()
        ));
    }
}
 
else{
 
    http_response_code(401);
 
    echo json_encode(array("message" => "Access denied."));
}

?>
    