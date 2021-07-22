<?php
// 'user' object
class Report{
    private $conn;
    private $table_name = "reports";
 
    public $ID;
    public $commentId;
    public $reportUserId;
    public $content;
    public $createDate;
    public $lastModifiedDate;
    public $isProcessed;
    public $Type;

    // constructor
    public function __construct($db){
        $this->conn = $db;
    }
 
    
    function create(){
        $query = "INSERT INTO
        " . $this->table_name . "
        SET
            content=:content, commentId=:commentId, reportUserId=:reportUserId, isProcessed=0,Type=:Type,lastModifiedDate=NOW(),
            createdDate = NOW()";
      
        $stmt = $this->conn->prepare($query);
      
        $this->content=htmlspecialchars(strip_tags($this->content));;
        $this->commentId=htmlspecialchars(strip_tags($this->commentId));
        $this->reportUserId=htmlspecialchars(strip_tags($this->reportUserId));
        $this->Type=htmlspecialchars(strip_tags($this->Type));;
      
        $stmt->bindParam(":content", $this->content);
        $stmt->bindParam(":commentId", $this->commentId);
        $stmt->bindParam(":reportUserId", $this->reportUserId);
        $stmt->bindParam(":Type", $this->Type);
      
        if($stmt->execute()){
            return true;
        }     
        return false;
          
    }

    public function readByCommentId(){
        $query = "SELECT
                    r.ID, r.CreatedDate, r.content, r.Type, u.UserName
                FROM
                    " . $this->table_name . " r

                    LEFT JOIN
                        dbuser u
                            ON r.reportUserId = u.ID

                    WHERE r.commentId = ?

                ORDER BY
                    r.CreatedDate DESC";
      
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->commentId);
      
        // execute query
        $stmt->execute();
      
        return $stmt;
    }
    

    
}

