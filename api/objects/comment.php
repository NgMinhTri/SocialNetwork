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
                ORDER BY
                    c.CreateDate DESC";
      
        $stmt = $this->conn->prepare($query);
      
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
                    c.catName, u.ID, u.UserName, q.ID, q.catId, q.userId, q.Title, q.Description, q.CreateDate, q.LastModifiedDate, q.NumberOfComments, q.NumberOfReports, q.NumberOfVotes, q.Status
                FROM
                    " . $this->table_name . " q
                    LEFT JOIN
                        categoryquestions c
                            ON q.catId = c.ID
                    LEFT JOIN
                        dbuser u
                            ON q.userId = u.ID
                     WHERE
                        q.ID =  ?
                    LIMIT
                        0,1";     
      
        $stmt = $this->conn->prepare( $query );
      
        $stmt->bindParam(1, $this->ID);
      
        $stmt->execute();
      
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
      
        // set values to object properties
        $this->catName = $row['catName'];
        $this->Description = $row['Description'];
        $this->Title = $row['Title'];
        $this->UserName = $row['UserName'];
        $this->CreateDate = $row['CreateDate'];
        $this->LastModifiedDate = $row['LastModifiedDate'];
        $this->NumberOfVotes = $row['NumberOfVotes'];
        $this->NumberOfReports = $row['NumberOfReports'];
        $this->NumberOfComments = $row['NumberOfComments'];
        $this->Status = $row['Status'];
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

