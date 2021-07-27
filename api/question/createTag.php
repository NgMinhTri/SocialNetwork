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
include_once '../objects/admin.php';

include "../mailclass/class.phpmailer.php"; 
include "../mailclass/class.smtp.php";


  
$database = new Database();
$db = $database->getConnection();
  
$question = new Question($db);
$admin=new Admin($db);

$data = json_decode(file_get_contents("php://input"));


$jwt=isset($data->jwt) ? $data->jwt : "";

if($jwt){
 
    try {
        $decoded = JWT::decode($jwt, $key, array('HS256'));
        $question->Title = $data->Title;
        $question->Description = $data->Description;
        $question->catId = $data->catId;
        $question->userId = $decoded->data->id;
        $question->labelName = $data->labelName;

        if($question->createQuestionTag()){
                http_response_code(201);
                $mail = new PHPMailer();
                $mail->IsSMTP(); // set mailer to use SMTP
                $mail->Host = "smtp.gmail.com"; // specify main and backup server
                $mail->Port = 465; // set the port to use
                $mail->SMTPAuth = true; // turn on SMTP authentication
                $mail->SMTPSecure = 'ssl';
                $mail->Username = "udptnhom4@gmail.com"; // your SMTP username or your gmail username
                $mail->Password = "UdptNhom4@"; // your SMTP password or your gmail password
                $from = "udptnhom4@gmail.com"; // Reply to this email
                $to=$admin->getAdmin(); // Recipients email ID
                $name="Nhom 4"; // Recipient's name
                $mail->From = $from;
                $mail->FromName = "Nhom 4"; // Name to indicate where the email came from when the recepient received
                $mail->AddAddress($to,$name);
                $mail->AddReplyTo($from,"Nhom 4");
                $mail->WordWrap = 50; // set word wrap
                $mail->IsHTML(true); // send as HTML
                $mail->Subject = "Question created Notification";
                $mail->Body = "<b>A question with the info below has been created.</b>
                <h5>Title: $data->Title</h5>
                <h5>Description: $data->Description</h5>
                <h5>Category ID: $data->catId</h5>
                <p>Please take a look!</p>"; //HTML Body
                $mail->AltBody = "This mail is sent from Nhom 4"; //Text Body
                //$mail->SMTPDebug = 2;
                if(!$mail->Send())
                {
                    $result="fail";
                }
                else
                {
                    $result="success";
                }
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