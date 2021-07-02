
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

$jwt=isset($data->jwt) ? $data->jwt : "";
 
if($jwt){ 
    try
    {
        $decoded = JWT::decode($jwt, $key, array('HS256'));        
        $admin->password = $data->password;  
        $admin->Id = $decoded->data->Id;    
       
        if($admin->updatePassword() == true)
        {
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
                  "message" => "Password Admin was updated.",
                  "jwt" => $jwt
                  )
            );  
        }
        else
        {
            http_response_code(401);

            echo json_encode(array("message" => "Update Password failed."));
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