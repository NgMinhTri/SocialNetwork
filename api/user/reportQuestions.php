<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// files for decoding jwt will be here

// required to encode json web token
include_once '../config/core.php';
include_once '../../lib/php-jwt-master/src/BeforeValidException.php';
include_once '../../lib/php-jwt-master/src/ExpiredException.php';
include_once '../../lib/php-jwt-master/src/SignatureInvalidException.php';
include_once '../../lib/php-jwt-master/src/JWT.php';
use \Firebase\JWT\JWT;
 
// database connection will be here

// files needed to connect to database
include_once '../config/database.php';
include_once '../objects/users.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// instantiate user object
$user = new User($db);
 
// retrieve given jwt here
$user->id = isset($_GET['id']) ? $_GET['id'] : die();
// get posted data

$stmt = $user->questionOfUser();

$num = $stmt->rowCount();
// update user will be here
// update the user record
if ($num>0) {
    $question_arr=array();
    $question_arr["records"]=array();
    // regenerate jwt will be here
    // we need to re-generate jwt because user details might be different
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
    //q.id, q.Title, q.Description, q.CreateDate, q.NumberOfComments , q.Status 
        $question_item=array(
            "id" => $row['id'],
            "Title" => $row['Title'],
            "Description" => $row['Description'],
            "CreateDate" => $row['CreateDate'],
            "NumberOfComments" => $row['NumberOfComments'],
            "Status" => $row['Status'], 
        );
        array_push($question_arr["records"], $question_item);
    }
    
    // set response code - 200 OK
    http_response_code(200);
    
    // show products data in json format
    echo json_encode($question_arr);
}
    
// no products found will be here
else {
    
    // set response code - 404 Not found
    http_response_code(404);
    
    // tell the user no products found
    echo json_encode(
        array("message" => "No question found.")
    );
}
 
    // catch failed decoding will be here
    // if decode fails, it means jwt is invalid

// error message if jwt is empty will be here
// show error message if jwt is empty
?>