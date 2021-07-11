<?php
class Vote{
 
    private $conn;
    private $table_name = "votes";
 
    public $ID;
    public $questionId;
    public $userId;

    public function __construct($db){
        $this->conn = $db;
    }
 
    function create(){

        $checkExits = "SELECT
                    userId,questionId
                FROM
                    " . $this->table_name . "
                WHERE
                    userId = :userId AND
                    questionId = :questionId";

        $stmt = $this->conn->prepare($checkExits);
        $this->userId=htmlspecialchars(strip_tags($this->userId));
        $stmt->bindParam(":userId", $this->userId);

        $this->questionId=htmlspecialchars(strip_tags($this->questionId));
        $stmt->bindParam(":questionId", $this->questionId);
        $stmt->execute();

        if($stmt->rowCount() > 0)
        {
            return false;
        }
        else
        {    
            $query = "INSERT INTO " . $this->table_name . "
                    SET
                        questionId  = :questionId,
                        userId  = :userId ";
         
            $stmt = $this->conn->prepare($query);
         
            $this->questionId=htmlspecialchars(strip_tags($this->questionId));
            $this->userId=htmlspecialchars(strip_tags($this->userId));

            $stmt->bindParam(':questionId', $this->questionId);
            $stmt->bindParam(':userId', $this->userId);
         
            if($stmt->execute()){
                return true;
            }
            return false;
        }
    }


      public function countNumberVotesPerQuestion(){
        $query = "SELECT
                    * 
                FROM
                    " . $this->table_name . " 
                WHERE questionId = ? ";
      
        $stmt = $this->conn->prepare( $query );
      
        $stmt->bindParam(1, $this->questionId);
      
        $stmt->execute();
        return $stmt;
    }                
}

