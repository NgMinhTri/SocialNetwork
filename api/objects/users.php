<?php
// 'user' object
class User{
 
    // database connection and table name
    private $conn;
    private $table_name = "DBUser";
 
    // object properties
    public $id;
    public $firstname;
    public $lastname;
    public $email;
    public $username;
    public $phonenumber;
    public $password;

 
    // constructor
    public function __construct($db){
        $this->conn = $db;
    }
     public function readListUserForAdmin(){
        //select all data
        $query = "SELECT
                    ID, firstname, lastname, username, email, phonenumber
                FROM
                    " . $this->table_name . "
                ORDER BY
                    firstname";
  
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
  
        return $stmt;
    }

    function read(){
        // select all query
        $query = "SELECT id, firstname, lastname, username, email, password, phonenumber
        FROM " . $this->table_name . " WHERE id = :id";
      
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $this->id);
        // execute query
        $stmt->execute();
      
        return $stmt;
    }

// create() method will be here

// create new user record
    function create(){
    
        // insert query
        $query = "INSERT INTO " . $this->table_name . "
                SET
                    firstname  = :firstname,
                    lastname  = :lastname,
                    username = :username,
                    password  = :password,
                    email = :email,
                    phonenumber= :phonenumber";
    
        // prepare the query
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->firstname=htmlspecialchars(strip_tags($this->firstname));
        $this->lastname=htmlspecialchars(strip_tags($this->lastname));
        $this->email=htmlspecialchars(strip_tags($this->email));
        $this->password=htmlspecialchars(strip_tags($this->password));
        $this->username=htmlspecialchars(strip_tags($this->username));
        $this->phonenumber=htmlspecialchars(strip_tags($this->phonenumber));
        // bind the values
        $stmt->bindParam(':firstname', $this->firstname);
        $stmt->bindParam(':lastname', $this->lastname);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':username', $this->username);
        $stmt->bindParam(':phonenumber', $this->phonenumber);
    
        // hash the password before saving to database
        $password_hash = password_hash($this->password, PASSWORD_BCRYPT);
        $stmt->bindParam(':password', $password_hash);
    
        // execute the query, also check if query was successful
        if($stmt->execute()){
            return true;
        }

        return false;
    }

    // emailExists() method will be here
    // check if given email exist in the database
    function emailExists(){
    
        // query to check if email exists
        $query = "SELECT id, username, lastname, password, firstname, phonenumber
                FROM " . $this->table_name . "
                WHERE email = ?
                LIMIT 0,1";
    
        // prepare the query
        $stmt = $this->conn->prepare( $query );
    
        // sanitize
        $this->email=htmlspecialchars(strip_tags($this->email));
    
        // bind given email value
        $stmt->bindParam(1, $this->email);
    
        // execute the query
        $stmt->execute();
    
        // get number of rows
        $num = $stmt->rowCount();
    
        // if email exists, assign values to object properties for easy access and use for php sessions
        if($num>0){
    
            // get record details / values
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
            // assign values to object properties
            $this->id = $row['id'];
            $this->username = $row['username'];
            $this->password = $row['password'];
            $this->lastname = $row['lastname'];
            $this->firstname = $row['firstname'];
            $this->phonenumber = $row['phonenumber'];
            // return true because email exists in the database
            return true;
        }
    
        // return false if email does not exist in the database
        return false;
    }

// update() method will be here


    function passwordExists(){
    
        $query = "SELECT Id, firstname, lastname, email
                FROM " . $this->table_name . "
                WHERE password = ?
                LIMIT 0,1";
    
        $stmt = $this->conn->prepare( $query );
    
        $this->password=htmlspecialchars(strip_tags($this->password));
    
        $stmt->bindParam(1, $this->password);
    
        $stmt->execute();
    
        $num = $stmt->rowCount();
    
        if($num>0){
    
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
            $this->id = $row['id'];
            $this->firstname = $row['firstname'];
            $this->lastname = $row['lastname'];
            $this->email = $row['email'];
            return true;
        }
        return false;
    }
// update a user record
    public function update(){
    
        // if password needs to be updated    
        // if no posted password, do not update the password
        $query = "UPDATE " . $this->table_name . "
                SET
                    password = :password
                WHERE id = :id";
    
        // prepare the query
        $stmt = $this->conn->prepare($query);
        // sanitize
        // $this->firstname=htmlspecialchars(strip_tags($this->firstname));
        // $this->lastname=htmlspecialchars(strip_tags($this->lastname));
        // $this->email=htmlspecialchars(strip_tags($this->email));
    
        // // bind the values from the form
        // $stmt->bindParam(':firstname', $this->firstname);
        // $stmt->bindParam(':lastname', $this->lastname);
        // $stmt->bindParam(':email', $this->email);
    
        // hash the password before saving to database
        if(!empty($this->password)){
            $this->password=htmlspecialchars(strip_tags($this->password));
            $password_hash = password_hash($this->password, PASSWORD_BCRYPT);
            $stmt->bindParam(':password', $password_hash);
        }
    
        // unique ID of record to be edited
        $stmt->bindParam(':id', $this->id);
    
        // execute the query
        if($stmt->execute()){
            return true;
        }
    
        return false;
    }

    public function questionOfUser(){
        $query = "SELECT
        q.id, q.Title, q.Description, q.CreateDate, q.NumberOfComments , q.Status
        FROM
            questions q,
            " . $this->table_name . " u 
            WHERE q.userId=u.id AND u.id = ? 
        ORDER BY
            q.CreateDate DESC";
      
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);        

        
        // execute query
        $stmt->execute();
      
        return $stmt;
    }

    public function answerOfUser(){
        $query = "SELECT comments.createdDate,comments.content, questions.ID as questionID,questions.Title, questions.Description 
        FROM comments," . $this->table_name . ", questions  
        WHERE comments.questionId=questions.ID and comments.ownerUserId=" . $this->table_name . ".ID and " . $this->table_name . ".ID=? 
        ORDER BY
        comments.createdDate DESC";
      
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);        

        
        // execute query
        $stmt->execute();
      
        return $stmt;
    }

      function readOne(){      
        $query = "SELECT
                    ID, firstname, lastname, username, email, phonenumber 
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
      
        $this->firstname = $row['firstname'];
        $this->lastname = $row['lastname'];
        $this->username = $row['username'];
        $this->email = $row['email'];
        $this->phonenumber = $row['phonenumber'];
    }

        function search($keywords){
      
        $query = "SELECT
                    ID, firstname, lastname, username, email, phonenumber 
                FROM
                    " . $this->table_name . " 
                    
                WHERE
                    firstname LIKE ? OR lastname LIKE ? OR username LIKE ? OR email LIKE ? OR phonenumber LIKE ?
                ";
      
        // prepare query statement
        $stmt = $this->conn->prepare($query);
      
        // sanitize
        $keywords=htmlspecialchars(strip_tags($keywords));
        $keywords = "%{$keywords}%";
      
        // bind
        $stmt->bindParam(1, $keywords);
        $stmt->bindParam(2, $keywords);
        $stmt->bindParam(3, $keywords);
        $stmt->bindParam(4, $keywords);
        $stmt->bindParam(5, $keywords);
      
        // execute query
        $stmt->execute();
      
        return $stmt;
    }
}