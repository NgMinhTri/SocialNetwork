<?php
class Category{
  
    // database connection and table name
    private $conn;
    private $table_name = "categoryquestions";
  
    // object properties
    public $ID;
    public $catName;
    public $numberOfQuestions;

  
    public function __construct($db){
        $this->conn = $db;
    }
  
    // used by select drop-down list
    public function readAll(){
        //select all data
        $query = "SELECT
                    ID, catName, numberOfQuestions
                FROM
                    " . $this->table_name . "
                ORDER BY
                    catName";
  
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
  
        return $stmt;
    }
     // create product
    function create(){
      
        // query to insert record
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    catName=:catName";
      
        // prepare query
        $stmt = $this->conn->prepare($query);
      
        // sanitize
        $this->catName=htmlspecialchars(strip_tags($this->catName));
      
        // bind values
        $stmt->bindParam(":catName", $this->catName);
      
        // execute query
        if($stmt->execute()){
            return true;
        }
      
        return false;
    }
            
}
?>
