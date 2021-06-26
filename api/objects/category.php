<?php
class Category{
  
    // database connection and table name
    private $conn;
    private $table_name = "categoryquestions";
  
    // object properties
    public $ID;
    public $catName;
    public $description;
    public $numberOfQuestions;

  
    public function __construct($db){
        $this->conn = $db;
    }
  
    // used by select drop-down list
    public function readAll(){
        //select all data
        $query = "SELECT
                    ID, catName, numberOfQuestions, description
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
      
        // // query to insert record
        // $query = "INSERT INTO
        //             " . $this->table_name . "
        //         SET
        //             catName=:catName
        //         where catName != catName";
      
        // // prepare query
        // $stmt = $this->conn->prepare($query);
      
        // // sanitize
        // $this->catName=htmlspecialchars(strip_tags($this->catName));
      
        // // bind values
        // $stmt->bindParam(":catName", $this->catName);
      
        // // execute query
        // if($stmt->execute()){
        //     return true;
        // }
      
        // return false;
        $query = "SELECT
                    catName
                FROM
                    " . $this->table_name . "
                WHERE
                    catName = :catName";
        $stmt = $this->conn->prepare($query);
        $this->catName=htmlspecialchars(strip_tags($this->catName));
        $stmt->bindParam(":catName", $this->catName);
        $stmt->execute();
        if($stmt->rowCount() > 0){
            return 2;
        }
        else{
            $sql = "INSERT INTO
                    " . $this->table_name . "
                SET
                    catName =:catName, description =:description";
            $cat = $this->conn->prepare($sql);
            $this->catName=htmlspecialchars(strip_tags($this->catName));
            $this->description=htmlspecialchars(strip_tags($this->description));
            $cat->bindParam(":catName", $this->catName);
            $cat->bindParam(":description", $this->description);
            if($cat->execute()){
                return 1;
            }           
        }
    }

    // update the product
    function update(){
      
        // update query
        $query = "UPDATE
                    " . $this->table_name . "
                SET
                    catName = :catName
                WHERE
                    ID = :ID";
      
        // prepare query statement
        $stmt = $this->conn->prepare($query);
      
        // sanitize
        $this->catName=htmlspecialchars(strip_tags($this->catName));
        $this->ID=htmlspecialchars(strip_tags($this->ID));
      
        // bind new values
        $stmt->bindParam(':catName', $this->catName);
        $stmt->bindParam(':ID', $this->ID);
      
        // execute the query
        if($stmt->execute()){
            return true;
        }
      
        return false;
    }

    // delete the product
    function delete(){
      
        // delete query
        $query = "DELETE FROM " . $this->table_name . " WHERE ID = ?";
      
        // prepare query
        $stmt = $this->conn->prepare($query);
      
        // sanitize
        $this->ID=htmlspecialchars(strip_tags($this->ID));
      
        // bind id of record to delete
        $stmt->bindParam(1, $this->ID);
      
        // execute query
        if($stmt->execute()){
            return true;
        }
      
        return false;
    }

            
}
?>