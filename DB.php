<?php
class DB{
    private $conn;
    private $servername;
    private $username;
    private $dbname ;
    public function __construct(){
        $this->servername = "localhost";
        $this->username = "root";
        $this->password = "";
        $this->dbname ='abchosting';
        
        $conn = new mysqli($this->servername, $this->username, $this->password);
        $this->conn=$conn;
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
            echo"NO database";
        } 
        else{
            //check if database doesn't exist
            $sql="SHOW DATABASES LIKE 'abchosting'";
            $result= $conn->query($sql);
            //print_r($result);
            $dbExists= $result->num_rows;
            //print_r($result);
            //echo $dbExists;
           
            if($dbExists!=0){
                $conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
                $this->conn=$conn;
            }
            else{
                $this->CreateDB();
                $this->createTables();
                $this->populate();
            }    
        }
    }
    public function CreateDB(){

    // Create database
    $sql = "CREATE DATABASE IF NOT EXISTS abchosting";
    if ($this->conn->query($sql) === TRUE){
        //echo "Database created successfully";
        $conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        $this->conn=$conn;
    } else{
        echo "Error creating database: " . $conn->error;
    }
    }

    public function createTables(){
        
    // Check connection
    if ($this->conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 

    $sql = "CREATE TABLE IF NOT EXISTS Ratings (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
    productName VARCHAR(30) NOT NULL,
    rating FLOAT(5) DEFAULT 5,
    numOfRatings INT DEFAULT 1,
    reg_date TIMESTAMP
    )";
    
    if ($this->conn->query($sql) === TRUE) {
        //echo "Table ratings created successfully";
    } else {
        echo "Error creating table: " . $conn->error;
    }
    }
    public function populate(){
        
    // fill the ratings table with the products
    $sql="INSERT INTO `ratings` (`id`, `productName`, `rating`, `numOfRatings`, `reg_date`) VALUES ('0', 'apple', '5', '1', CURRENT_TIMESTAMP)";
    $this->execQuery($sql);
    $sql="INSERT INTO `ratings` (`id`, `productName`, `rating`, `numOfRatings`, `reg_date`) VALUES ('0', 'beer', '5', '1', CURRENT_TIMESTAMP)";
    $this->execQuery($sql);
    $sql="INSERT INTO `ratings` (`id`, `productName`, `rating`, `numOfRatings`, `reg_date`) VALUES ('0', 'water', '5', '1', CURRENT_TIMESTAMP)";
    $this->execQuery($sql);
    $sql="INSERT INTO `ratings` (`id`, `productName`, `rating`, `numOfRatings`, `reg_date`) VALUES ('0', 'cheese', '5', '1', CURRENT_TIMESTAMP)";
    $this->execQuery($sql);

    //initialized the ratings table
    }
    public function getConn(){
        return $this->conn;
    }
    public function execQuery($sql){
        return($this->conn->query($sql));
    }
}
?>