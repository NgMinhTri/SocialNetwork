<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
  
// include database and object files
// include_once '../config/core.php';
include_once '../config/database.php';
include_once '../objects/category.php';
  
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
  
$category = new Category($db);
  
$keywords=isset($_GET["s"]) ? $_GET["s"] : "";
  
$stmt = $category->search($keywords);
$num = $stmt->rowCount();
  
if($num>0){
  
    $category_arr=array();
    $category_arr["records"]=array();
  
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
  
        $category_item=array(
            "ID" => $ID,
            "catName" => $catName,
            "description" => html_entity_decode($description)

        ); 
        array_push($category_arr["records"], $category_item);
    }

    http_response_code(200);
  
    echo json_encode($category_arr);
}
  
else{ 

    http_response_code(404);
  
    echo json_encode(
        array("message" => "Không có danh mục nào được tìm thấy.")
    );
}
?>