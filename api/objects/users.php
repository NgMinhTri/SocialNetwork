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
    $query = "SELECT id, username, lastname, password
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
        // return true because email exists in the database
        return true;
    }
 
    // return false if email does not exist in the database
    return false;
}
}
// update() method will be here
