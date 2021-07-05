<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/core.php';
include_once '../libs/php-jwt-master/src/BeforeValidException.php';
include_once '../libs/php-jwt-master/src/ExpiredException.php';
include_once '../libs/php-jwt-master/src/SignatureInvalidException.php';
include_once '../libs/php-jwt-master/src/JWT.php';
use \Firebase\JWT\JWT;

include_once '../config/database.php';
include_once '../objects/admin.php';
  
$database = new Database();
$db = $database->getConnection();
  
$admin = new Admin($db);
  
$data = json_decode(file_get_contents("php://input"));
  
$admin->firstname = $data->firstname;
$admin->lastname = $data->lastname;
$admin->email = $data->email;
$admin->Id = $data->Id;

if($admin->update()){
	$token = array(
        "iat" => $issued_at,
        "exp" => $expiration_time,
        "iss" => $issuer,
        "data" => array(
            "Id" => $admin->Id,
            "firstname" => $admin->firstname,
            "lastname" => $admin->lastname,
            "email" => $admin->email
        )
	);
    $jwt = JWT::encode($token, $key);

    http_response_code(200);
                
    echo json_encode(
        array(
            "message" => "Thông tin Admin đã được cập nhật.",
            "jwt" => $jwt
        )
    );

}
  
else{
  
    http_response_code(503);
  
    echo json_encode(array("message" => "Không thể cập nhật thông tin Admin."));
}
