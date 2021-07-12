<?php
class Question
{
  
    // database connection and table name
    private $conn;
    private $table_name = "questions";
  
    // object properties
    public $id;
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
  
    // constructor with $db as database connection
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // search products
    function search($keywords){
    
        // select all query
        $query = "SELECT
                    c.catName as category_name, q.id, q.Title, q.Description, q.CreateDate, q.NumberOfComments, q.NumberOfVotes,q.Status
                FROM
                    " . $this->table_name . " q
                    LEFT JOIN
                    categoryquestions c
                            ON q.catId = c.id
                WHERE
                    q.Title LIKE ? OR q.Description LIKE ? OR c.catName LIKE ?
                ORDER BY
                    q.CreateDate DESC";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $keywords=htmlspecialchars(strip_tags($keywords));
        $keywords = "%{$keywords}%";
    
        // bind
        $stmt->bindParam(1, $keywords);
        $stmt->bindParam(2, $keywords);
        $stmt->bindParam(3, $keywords);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }
}
?>