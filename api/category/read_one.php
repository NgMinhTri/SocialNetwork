<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
  
// include database and object files
include_once '../config/database.php';
include_once '../objects/category.php';
  
$database = new Database();
$db = $database->getConnection();
  
$category = new Category($db);
  
$category->ID = isset($_GET['ID']) ? $_GET['ID'] : die();
  
$category->readOne();
  
if($category->catName != null){
    // create array
    $category_arr = array(
        "ID" =>  $category->ID,
        "catName" => $category->catName,
        "description" => $category->description 
    );
  

    http_response_code(200);
  
    echo json_encode($category_arr);
}
  
else{
    http_response_code(404);

    echo json_encode(array("message" => "Category does not exist."));
}
?>