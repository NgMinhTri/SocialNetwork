<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
  
include_once '../config/database.php';
include_once '../objects/label.php';
  
$database = new Database();
$db = $database->getConnection();
  
$label = new Label($db);
$stmt = $label->read();
$num = $stmt->rowCount();
  
if($num>0){
  
    $label_arr=array();
    $label_arr["records"]=array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row); 
        $label_item=array(
            "ID" => $ID,
            "labelName" => $labelName
        );
        array_push($label_arr["records"], $label_item);
    }
    http_response_code(200);

    echo json_encode($label_arr);
}
  
else{
  
    http_response_code(404);
  
    echo json_encode(
        array("message" => "No labels found.")
    );
}
?>
