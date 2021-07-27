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
include_once '../objects/question.php';
  
$database = new Database();
$db = $database->getConnection();
  
$question = new Question($db);

$data = json_decode(file_get_contents("php://input"));

$jwt=isset($data->jwt) ? $data->jwt : "";

if($jwt){
 
    try {
        $decoded = JWT::decode($jwt, $key, array('HS256'));
        $question->Title = $data->Title;
        $question->Description = $data->Description;
        $question->catId = $data->catId;
        $question->userId = $decoded->data->id;
        
        if($question->create()){
               
            http_response_code(201);
         
            $to_email = "buingocbaohan75@gmail.com";
            $subject = "A question created";
            $body = "A question with title = `$data->Title` is just created!";
            $headers = "From: sender\'s email";

            if (mail($to_email, $subject, $body, $headers)){$result= "success";} 
            else {$result= "fail";}
            echo json_encode(array("message" => "Question đã được tạo.", "sendmail"=>$result));
        }                       
        else{
            http_response_code(401);
        
            echo json_encode(array("message" => "Không thể tạo question."));
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