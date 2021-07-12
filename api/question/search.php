<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
  

// files for decoding jwt will be here

// required to encode json web token
include_once '../config/core.php';
 
// database connection will be here

// files needed to connect to database
include_once '../config/database.php';
include_once '../objects/question.php';
  
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
  
// initialize object
$question = new Question($db);
  
// get keywords
$keywords=isset($_GET["s"]) ? $_GET["s"] : "";
  
// query products
$stmt = $question->search($keywords);
$num = $stmt->rowCount();
  
// check if more than 0 record found
if($num>0){
  
    // products array
    $questions_array=array();
    $questions_array["records"]=array();
  
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
  //q.Title, q.Description, q.CreateDate, q.NumberOfComments, q.NumberOfVotes,q.Status
        $question_item=array(
            "id" => $id,
            "category_name"=> $row['category_name'], 
            "Title" => $Title,
            "Description" => $Description,
            "CreateDate" => $CreateDate,
            "NumberOfComments" => $NumberOfComments,
            "NumberOfVotes" => $NumberOfVotes, 
            "Status" => $Status 
        );
  
        array_push($questions_array["records"], $question_item);
    }
  
    // set response code - 200 OK
    http_response_code(200);
  
    // show products data
    echo json_encode($questions_array);
}
  
else{
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user no products found
    echo json_encode(
        array("message" => "No question found.")
    );
}
?>