<?php
// 'user' object
class Question{
 
    // database connection and table name
    private $conn;
    private $table_name = "questions";
 
    // object properties
    public $ID;
    public $catId;
    public $userId;
    public $Title;
    public $Description;
    public $CreateDate;
    public $LastModifiedDate;
    public $NumberOfComments;
    public $NumberOfVotes;
    public $NumberOfReports;
    public $Status;
    public $catName;
    public $UserName;

 
    // constructor
    public function __construct($db){
        $this->conn = $db;
    }
 
    // create() method will be here
    // used by select drop-down list
    public function read(){
        // select all query
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
                ORDER BY
                    q.CreateDate DESC";
      
        // prepare query statement
        $stmt = $this->conn->prepare($query);
      
        // execute query
        $stmt->execute();
      
        return $stmt;
    }

    // create question
    function create(){
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    Title=:Title, Description=:Description, catId=:catId, userId=:userId,
                    CreateDate = NOW() , Status = 0 ";
      
        $stmt = $this->conn->prepare($query);
      
        // sanitize
        $this->Title=htmlspecialchars(strip_tags($this->Title));;
        $this->Description=htmlspecialchars(strip_tags($this->Description));
        $this->catId=htmlspecialchars(strip_tags($this->catId));
        $this->userId=htmlspecialchars(strip_tags($this->userId));
        // $this->CreateDate=htmlspecialchars(strip_tags($this->CreateDate));
      
        // bind values
        $stmt->bindParam(":Title", $this->Title);
        $stmt->bindParam(":Description", $this->Description);
        $stmt->bindParam(":catId", $this->catId);
        $stmt->bindParam(":userId", $this->userId);
        // $stmt->bindParam(":CreateDate", $this->CreateDate);
      
        if($stmt->execute()){
            return true;
        }     
        return false;
          
    }
    public function readQuestionNotApprove(){
        // select all query
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
                    WHERE q.Status = 0
                    ORDER BY
                        q.CreateDate DESC";
      
        // prepare query statement
        $stmt = $this->conn->prepare($query);
      
        // execute query
        $stmt->execute();
      
        return $stmt;
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

      // search products
    function search($keywords){     
      $query = "SELECT
                    q.ID, c.catName, u.UserName, q.Title, q.Description, q.CreateDate, q.LastModifiedDate, q.Status, q.NumberOfComments, q.NumberOfReports, q.NumberOfVotes
                FROM
                    " . $this->table_name . " q
                    
                    LEFT JOIN
                        categoryquestions c
                            ON q.catId = c.ID
                    LEFT JOIN
                        dbuser u
                            ON q.userId = u.ID
                     WHERE
                       q.Title LIKE ?  
                       OR q.Description LIKE ? OR q.CreateDate LIKE ? OR q.LastModifiedDate LIKE ? OR c.catName LIKE ? OR u.UserName LIKE ?

                    ORDER BY
                    q.CreateDate DESC"; 
       
        $stmt = $this->conn->prepare($query);
      
        $keywords=htmlspecialchars(strip_tags($keywords));
        $keywords = "%{$keywords}%";
      
        $stmt->bindParam(1, $keywords);
        $stmt->bindParam(2, $keywords);
        $stmt->bindParam(3, $keywords);
        $stmt->bindParam(4, $keywords);
        $stmt->bindParam(5, $keywords);
        $stmt->bindParam(6, $keywords);
      
        $stmt->execute();     
        return $stmt;
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

    // approve the product
    function approve(){
      
        // update query
        $query = "UPDATE
                    " . $this->table_name . "
                SET
                    Status = 1
                WHERE
                    ID = :ID";
      
        $stmt = $this->conn->prepare($query);
      
        $this->ID=htmlspecialchars(strip_tags($this->ID));
       
        $stmt->bindParam(':ID', $this->ID);
            
        if($stmt->execute()){
            return true;
        }
      
        return false;
    }
}

