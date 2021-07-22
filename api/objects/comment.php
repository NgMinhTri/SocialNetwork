<?php
// 'user' object
class Comment{
    private $conn;
    private $table_name = "comments";
 
    public $ID;
    public $questionId;
    public $ownerUserId;
    public $content;
    public $createDate;
    public $LastModifiedDate;
    public $UserName;

    // constructor
    public function __construct($db){
        $this->conn = $db;
    }
 
    public function read(){
        $query = "SELECT
                    u.UserName,c.ID, c.questionId, c.ownerUserId, c.content, c.CreateDate, c.LastModifiedDate
                FROM
                    " . $this->table_name . " c
                    LEFT JOIN
                        questions q
                            ON c.questionId = q.ID
                    LEFT JOIN
                        dbuser u
                            ON c.ownerUserId = u.ID
                    WHERE c.questionId = ?
                ORDER BY
                    c.CreateDate DESC";
      
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->questionId);
        $stmt->execute();
      
        return $stmt;
    }

     public function readIsReported(){
        $query = "SELECT distinct
                    c.ID, c.questionId, c.ownerUserId, c.content, c.createdDate 
                FROM
                    " . $this->table_name . " c
                    LEFT JOIN
                        reports r
                            ON c.ID = r.commentId
                    WHERE c.ID = r.commentId

                ORDER BY
                    c.createdDate DESC";
      
        $stmt = $this->conn->prepare($query);

      
        $stmt->execute();
      
        return $stmt;
    }

    public function readCommentsByQuestionId(){
        $query = "SELECT
                    u.UserName,c.ID, c.questionId, c.ownerUserId, c.content, c.createdDate, c.LastModifiedDate
                FROM
                    " . $this->table_name . " c
                    LEFT JOIN
                        questions q
                            ON c.questionId = q.ID
                    LEFT JOIN
                        dbuser u
                            ON c.ownerUserId = u.ID
                WHERE c.questionId = ?
                ORDER BY
                    c.createdDate DESC";
      
        $stmt = $this->conn->prepare( $query );
      
        $stmt->bindParam(1, $this->questionId);
      
        $stmt->execute();
      
        return $stmt;
    }
    function create(){
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    content=:content, questionId=:questionId, ownerUserId=:ownerUserId,
                    createdDate = NOW()";
      
        $stmt = $this->conn->prepare($query);
      
        $this->content=htmlspecialchars(strip_tags($this->content));;
        $this->questionId=htmlspecialchars(strip_tags($this->questionId));
        $this->ownerUserId=htmlspecialchars(strip_tags($this->ownerUserId));
      
        $stmt->bindParam(":content", $this->content);
        $stmt->bindParam(":questionId", $this->questionId);
        $stmt->bindParam(":ownerUserId", $this->ownerUserId);
      
        if($stmt->execute()){
            return true;
        }     
        return false;
          
    }
    

    function readOne(){

        $query = "SELECT
                    u.UserName,c.ID, c.questionId, c.ownerUserId, c.content, c.createdDate, c.lastModifiedDate
                FROM
                    " . $this->table_name . " c
                    LEFT JOIN
                        dbuser u
                            ON c.ownerUserId = u.ID
                     WHERE
                        c.ID =  ?
                    LIMIT
                        0,1";     
      
        $stmt = $this->conn->prepare( $query );
      
        $stmt->bindParam(1, $this->ID);
      
        $stmt->execute();
      
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
      
        // set values to object properties
        $this->ID = $row['ID'];
        $this->questionId = $row['questionId'];
        $this->ownerUserId = $row['ownerUserId'];
        $this->content = $row['content'];
        $this->createDate = $row['createdDate'];
        $this->lastModifiedDate = $row['lastModifiedDate'];
    }  

        
    function update(){
      
        $query = "UPDATE
                    " . $this->table_name . "
                SET
                    content = :content,
                    lastModifiedDate = NOW()
                WHERE
                    ID = :ID";
      
        $stmt = $this->conn->prepare($query);
      
        $this->content=htmlspecialchars(strip_tags($this->content));
        $this->ID=htmlspecialchars(strip_tags($this->ID));
        
        $stmt->bindParam(':content', $this->content);
        $stmt->bindParam(':ID', $this->ID);
        
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


    // read products with pagination
    public function readPaging($from_record_num, $records_per_page){

        $query = "SELECT
                    u.UserName,c.ID, c.questionId, c.ownerUserId, c.content, c.createdDate, c.LastModifiedDate
                FROM
                    " . $this->table_name . " c
                    LEFT JOIN
                        questions q
                            ON c.questionId = q.ID
                    LEFT JOIN
                        dbuser u
                            ON c.ownerUserId = u.ID
                WHERE c.questionId = ?
                ORDER BY
                    c.createdDate DESC
                 LIMIT ?, ?";
            
      
        // prepare query statement
        $stmt = $this->conn->prepare( $query );
      
        // bind variable values
        $stmt->bindParam(1, $this->questionId);
        $stmt->bindParam(2, $from_record_num, PDO::PARAM_INT);
        $stmt->bindParam(3, $records_per_page, PDO::PARAM_INT);
      
        // execute query
        $stmt->execute();
      
        // return values from database
        return $stmt;
    }


    public function count(){
        $query = "SELECT COUNT(*) as total_rows 
                  FROM " . $this->table_name . "
                  WHERE questionId = ? ";
      
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(1, $this->questionId);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
      
        return $row['total_rows'];
    }

    function deleteCommentIsReported(){
      
        $query = "DELETE FROM reports WHERE commentId = ?";
      
        $stmt = $this->conn->prepare($query);
      
        $this->ID=htmlspecialchars(strip_tags($this->ID));
      
        $stmt->bindParam(1, $this->ID);
      
        if($stmt->execute()){
            $query = "DELETE FROM " . $this->table_name . " WHERE ID = ?";
      
            $stmt = $this->conn->prepare($query);
          
            $this->ID=htmlspecialchars(strip_tags($this->ID));
          
            $stmt->bindParam(1, $this->ID);
            if($stmt->execute()){
                return true;
            }
            return false;
        }
      
        return false;
    } 
    
}

