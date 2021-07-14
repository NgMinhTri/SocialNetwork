<?php
class Label{
    private $conn;
    private $table_name = "labels";
  
    public $ID;
    public $labelName;
 
    public function __construct($db){
        $this->conn = $db;
    }
  
    public function read(){
        $query = "SELECT
                    ID, labelName
                FROM
                    " . $this->table_name . "
                ORDER BY
                    labelName";
  
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
  
        return $stmt;
    }

    function create(){
      
        $query = "SELECT
                    labelName
                FROM
                    " . $this->table_name . "
                WHERE
                    labelName = :labelName";

        $stmt = $this->conn->prepare($query);
        $this->labelName=htmlspecialchars(strip_tags($this->labelName));
        $stmt->bindParam(":labelName", $this->labelName);
        $stmt->execute();

        if($stmt->rowCount() > 0){
            return 2;
        }
        
        else{
            $sql = "INSERT INTO
                    " . $this->table_name . "
                SET
                    labelName =:labelName";
            $cat = $this->conn->prepare($sql);
            $this->labelName=htmlspecialchars(strip_tags($this->labelName));
            $cat->bindParam(":labelName", $this->labelName);

            if($cat->execute()){
                return 1;
            }           
        }
    }

    function update(){
      
        $query = "UPDATE
                " . $this->table_name . "
            SET
                labelName = :labelName
            WHERE
                ID = :ID";
        $stmt = $this->conn->prepare($query);
      
        $this->ID=htmlspecialchars(strip_tags($this->ID));
        $this->catName=htmlspecialchars(strip_tags($this->catName));
        
      
        $stmt->bindParam(':ID', $this->ID);
        $stmt->bindParam(':catName', $this->catName);
        
        if($stmt->execute()){
            return true;
        }
      
        return false;
    }

    function delete(){
      
        $query = "DELETE FROM " . $this->table_name . " WHERE ID = ?";
      
        $stmt = $this->conn->prepare($query);
      
        $this->ID=htmlspecialchars(strip_tags($this->ID));
      
        $stmt->bindParam(1, $this->ID);
      
        if($stmt->execute()){
            return true;
        }     
        return false;
    }

    function readOne(){
        $query = "SELECT
                    ID, labelName
                FROM
                    " . $this->table_name . "                           
                WHERE
                    ID =  ?
                LIMIT
                    0,1";
      
        $stmt = $this->conn->prepare( $query );
      
        $stmt->bindParam(1, $this->ID);
      
        $stmt->execute();
      
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
      
        $this->labelName = $row['labelName'];
    } 

    function search($keywords){
      
        $query = "SELECT
                    ID, labelName
                FROM
                    " . $this->table_name . " 
                    
                WHERE
                    labelName LIKE ? ";
      
        $stmt = $this->conn->prepare($query);
      
        $keywords=htmlspecialchars(strip_tags($keywords));
        $keywords = "%{$keywords}%";
      
        $stmt->bindParam(1, $keywords);
      
        $stmt->execute();
        return $stmt;
    }          
}
?>
