<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8;");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Acess-Control-Allow-Headers: Acess-Control-Allow-Headers,Content-Type,Acess-Control-Allow-Methods, Authorization");
 
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

$target_dir = $_SERVER['DOCUMENT_ROOT'].'/socialnetwork/images/';

$data = json_decode(file_get_contents("php://input"));
print_r($data);

$jwt=isset($data->jwt) ? $data->jwt : "";

// if($jwt){
    if(!$_FILES['filetoupload']['name'] ){
        try {
            $decoded = JWT::decode($jwt, $key, array('HS256'));
            $question->Title = $data->Title;
            $question->Description = $data->Description;
            $question->catId = $data->catId;
            $question->userId = $decoded->data->id;
            $question->labelName = $data->labelName;      
            if($question->createQuestionTag()){             
                http_response_code(201);
                echo json_encode(array("message" => "Question đã được tạo."));             
            }                       
            else{
                http_response_code(401);           
                echo json_encode(array("message" => "Không thể tạo question."));
            }                    
        }
        catch (Exception $e){   
            http_response_code(401);   
            echo json_encode(array("message" => "Access denied.","error" => $e->getMessage()));
        }
    }
    else{
        $image_name = basename($_FILES["filetoupload"]["name"]); 
        $target_file = $target_dir . $image_name; 
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION)); 
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) 
        { 
            $res['data'] = array();
            $res['message'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $res['status'] = 'fail';
        }
        else{

            if (move_uploaded_file($_FILES["filetoupload"]["tmp_name"], $target_file)) {

                try {
                    $decoded = JWT::decode($jwt, $key, array('HS256'));
                    $question->Title = $data->Title;
                    $question->Description = $data->Description;
                    $question->catId = $data->catId;
                    $question->userId = $decoded->data->id;
                    $question->labelName = $data->labelName;
                    $question->fileName = $image_name;

                    if($question->createQuestion()){             
                        http_response_code(201);
                        echo json_encode(array("message" => "Question đã được tạo."));  
                        $res['data']['image'] = $image_name;
                        $res['status'] = 'success';
                        $res['message'] = 'Base64 image uploaded';           
                    }                       
                    else{
                        http_response_code(401);           
                        echo json_encode(array("message" => "Không thể tạo question."));
                    }                    
                }   
                catch (Exception $e){   
                    http_response_code(401);   
                    echo json_encode(array("message" => "Access denied.","error" => $e->getMessage()));
                }
            }
            else{
                $res['data'] = array();
                $res['message'] = "Sorry, there was an error uploading your file.";
                $res['status'] = 'fail';
            }
        }
    }
// }
// else{
 
//     http_response_code(401);
//     echo json_encode(array("message" => "Access denied.", "jwt"=> $data));
// }
?>