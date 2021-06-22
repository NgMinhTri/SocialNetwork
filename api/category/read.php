<?php
// required header
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
  
// include database and object files
include_once '../config/database.php';
include_once '../objects/category.php';
  
$database = new Database();
$db = $database->getConnection();
  
// initialize object
$category = new Category($db);
// query categorys
$stmt = $category->readAll();
$num = $stmt->rowCount();
  
// check if more than 0 record found
if($num>0){
  
    // products array
    $categories_arr=array();
    $categories_arr["records"]=array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row); 
        $category_item=array(
            "ID" => $ID,
            "catName" => $catName,
            "numberOfQuestions" => html_entity_decode($numberOfQuestions)
        );
        array_push($categories_arr["records"], $category_item);
    }
    // set response code - 200 OK
    http_response_code(200);
    // show categories data in json format
    echo json_encode($categories_arr);
}
  
else{
  
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user no categories found
    echo json_encode(
        array("message" => "No categories found.")
    );
}
?>