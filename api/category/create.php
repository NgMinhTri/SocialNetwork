<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
// get database connection
include_once '../config/database.php';
  
// instantiate product object
include_once '../objects/category.php';
  
$database = new Database();
$db = $database->getConnection();
  
$category = new Category($db);
  
// get posted data
$data = json_decode(file_get_contents("php://input"));
  
// make sure data is not empty
if(
    !empty($data->catName) &&
    !empty($data->description)
){
  
    // set product property values
    $category->catName = $data->catName;
    $category->description = $data->description;
  
    // create the product
    if($result = $category->create()){
  
        // set response code - 201 created
        http_response_code(201);
  
        // tell the user
        echo $result;
    }
  
    // if unable to create the product, tell the user
    // else{
    //     http_response_code(503);
    //     echo json_encode(array("message" => "Unable to create category."));
    // }
}
  
// tell the user data is incomplete
else{
  
    // set response code - 400 bad request
    http_response_code(400);
  
    // tell the user
    echo json_encode(array("message" => "Unable to create category. Data is incomplete."));
}
?>