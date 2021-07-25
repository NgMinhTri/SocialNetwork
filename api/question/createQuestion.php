<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
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

$data = json_decode(file_get_contents("php://input"), true);
$jwt=isset($data->jwt) ? $data->jwt : "";

// $fileName  =  $_FILES['sendimage']['name'];
// $tempPath  =  $_FILES['sendimage']['tmp_name'];
// $fileSize  =  $_FILES['sendimage']['size'];


if($jwt){
    if(empty($fileName)){
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
            echo json_encode(array(
                "message" => "Access denied.",
                "error" => $e->getMessage()
            ));
        }
    }
    else{
        $upload_path = '../images/';
        $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        $valid_extensions = array('jpeg', 'jpg', 'png', 'gif');
        if(in_array($fileExt, $valid_extensions))
        {
            if(!file_exists($upload_path . $fileName))
            {
                if($fileSize < 5000000){
                    move_uploaded_file($tempPath, $upload_path . $fileName);
                }
                else{
                    $errorMSG = json_encode(array("message" => "file quá lớn, vui lòng upload file 5MB trở xuống", "status" => false));
                    echo $errorMSG;
                }
            }
            else{
                $errorMSG = json_encode(array("message" => "file đã tồn tại", "status" => false));
                echo $errorMSG;
            }
        }
        else{
            $errorMSG = json_encode(array("message" => "Chỉ loại file .JPG, .JPEG, .PNG, .GIF mới được upload", "status" => false));
            echo $errorMSG;
        }

        //Nếu tất cả lỗi trên ko có
        if(!isset($errorMSG))
        {
            try {
                $decoded = JWT::decode($jwt, $key, array('HS256'));
                $question->Title = $data->Title;
                $question->Description = $data->Description;
                $question->catId = $data->catId;
                $question->userId = $decoded->data->id;
                $question->labelName = $data->labelName;  
                $question->fileName = $fileName;       
                if($question->createQuestion()){             
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
                echo json_encode(array(
                    "message" => "Access denied.",
                    "error" => $e->getMessage()
                ));
            }
        }
    }
}
 
else{
 
    http_response_code(401);
    echo json_encode(array("message" => "Access denied."));
}
?>
    