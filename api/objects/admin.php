
<?php
class Admin{
 
    // database connection and table name
    private $conn;
    private $table_name = "admin";
 
    // object properties
    public $Id;
    public $firstname;
    public $lastname;
    public $email;
    public $password;
 
    // constructor
    public function __construct($db){
        $this->conn = $db;
    }

    // function readOneByEmail(){      
    //     $email = $_COOKIE['email'];
    //     $query = "SELECT Id, firstname, lastname,email
    //     FROM " . $this->table_name . " WHERE email = '" . $email. "'";
      
    //     $stmt = $this->conn->prepare($query);
      
    //     $stmt->execute();
      
    //     return $stmt;
    // }

    function readOne(){
        
        $query = "SELECT
                    Id, firstname, lastname, email
                FROM
                    " . $this->table_name . " 
                           
                WHERE
                    Id =  ?
                LIMIT
                    0,1";
      
        $stmt = $this->conn->prepare( $query );
      
        $stmt->bindParam(1, $this->Id);
      
        $stmt->execute();
      
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
      
        $this->firstname = $row['firstname'];
        $this->lastname = $row['lastname'];
        $this->email = $row['email'];
    }

    public function create(){
     
        $query = "INSERT INTO " . $this->table_name . "
                SET
                    firstname = :firstname,
                    lastname = :lastname,
                    email = :email,
                    password = :password";
     
        $stmt = $this->conn->prepare($query);
     
        $this->firstname=htmlspecialchars(strip_tags($this->firstname));
        $this->lastname=htmlspecialchars(strip_tags($this->lastname));
        $this->email=htmlspecialchars(strip_tags($this->email));
        $this->password=htmlspecialchars(strip_tags($this->password));
     
        $stmt->bindParam(':firstname', $this->firstname);
        $stmt->bindParam(':lastname', $this->lastname);
        $stmt->bindParam(':email', $this->email);
     
        $password_hash = password_hash($this->password, PASSWORD_BCRYPT);
        $stmt->bindParam(':password', $password_hash);
     
        if($stmt->execute()){
            return true;          
        }
     
        return false;
    }
 
    public function emailExists(){
     
        $query = "SELECT Id, firstname, lastname, password
                FROM " . $this->table_name . "
                WHERE email = ?
                LIMIT 0,1";
     
        $stmt = $this->conn->prepare( $query );
     
        $this->email=htmlspecialchars(strip_tags($this->email));
     
        $stmt->bindParam(1, $this->email);
     
        $stmt->execute();
     
        $num = $stmt->rowCount();
     
        if($num>0){
     
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
     
            $this->Id = $row['Id'];
            $this->firstname = $row['firstname'];
            $this->lastname = $row['lastname'];
            $this->password = $row['password'];
            return true;
        }
        return false;
    }

    public function passwordExists(){
     
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
     
            $this->id = $row['Id'];
            $this->firstname = $row['firstname'];
            $this->lastname = $row['lastname'];
            $this->email = $row['email'];
            return true;
        }
        return false;
    }
 

    public function updatePassword(){
     
        $query = "UPDATE " . $this->table_name . "
                SET
                    password = :password

                WHERE Id = :Id";
     
        $stmt = $this->conn->prepare($query);

        $this->Id =htmlspecialchars(strip_tags($this->Id));

        $this->password=htmlspecialchars(strip_tags($this->password));  
        $password_hash = password_hash($this->password, PASSWORD_BCRYPT);

        $stmt->bindParam(':password', $password_hash);    
        $stmt->bindParam(':Id', $this->Id);

        if($stmt->execute()){
            return true;          
        }
     
        return false;
    }

    public function update(){
     
        $query = " UPDATE 
                    " . $this->table_name . "
                SET
                    firstname = :firstname,
                    lastname = :lastname,
                    email = :email
                    
                WHERE Id = :Id ";
     
        $stmt = $this->conn->prepare($query);
    
        $this->firstname =htmlspecialchars(strip_tags($this->firstname));
        $this->lastname =htmlspecialchars(strip_tags($this->lastname));
        $this->email =htmlspecialchars(strip_tags($this->email));
        $this->Id =htmlspecialchars(strip_tags($this->Id)); 
   
        
        $stmt->bindParam(':firstname', $this->firstname);
        $stmt->bindParam(':lastname', $this->lastname);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':Id', $this->Id);

        if($stmt->execute()){
            return true;          
        }
     
        return false;
    }
}