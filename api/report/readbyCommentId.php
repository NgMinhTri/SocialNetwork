<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
  
// include database and object files
include_once '../config/database.php';
include_once '../objects/report.php';
  
$database = new Database();
$db = $database->getConnection();
  
$report = new Report($db);
  
$report->commentId = isset($_GET['commentId']) ? $_GET['commentId'] : die();
  
$stmt = $report->readByCommentId();
  
$num = $stmt->rowCount();
  
if($num>0){
  
    $report_arr=array();
    $report_arr["records"]=array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row); 
        $report_item=array(
            "ID" => $ID,
            "content" => $content,
            "CreatedDate" => $CreatedDate,
            "Type" => $Type,
            "UserName" => $UserName
        );
        array_push($report_arr["records"], $report_item);
    }

    http_response_code(200);

    echo json_encode($report_arr);
}
  
else{
    http_response_code(404);

    echo json_encode(array("message" => "report does not exist."));
}
?>