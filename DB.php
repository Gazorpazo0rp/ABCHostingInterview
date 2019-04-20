<?php
function OpenCon(){   
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname ='abchosting';
    
    // Create connection
    $conn = new mysqli($servername, $username, $password);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 
    
    // Create database
    $sql = "CREATE DATABASE IF NOT EXISTS abchosting";
    if ($conn->query($sql) === TRUE) {
        //echo "Database created successfully";
    } else {
        echo "Error creating database: " . $conn->error;
    }
   

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 



    $sql = "CREATE TABLE IF NOT EXISTS Ratings (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
    productName VARCHAR(30) NOT NULL,
    rating FLOAT DEFAULT 5,
    numOfRatings INT DEFAULT 1,
    reg_date TIMESTAMP
    )";
    
    if ($conn->query($sql) === TRUE) {
        //echo "Table ratings created successfully";
    } else {
        echo "Error creating table: " . $conn->error;
    }
    // fill the ratings table with the products
    $sql="INSERT INTO `ratings` (`id`, `productName`, `rating`, `numOfRatings`, `reg_date`) VALUES ('0', 'apple', '5', '1', CURRENT_TIMESTAMP)";
    $conn->query($sql);
    $sql="INSERT INTO `ratings` (`id`, `productName`, `rating`, `numOfRatings`, `reg_date`) VALUES ('0', 'beer', '5', '1', CURRENT_TIMESTAMP)";
    $conn->query($sql);
    $sql="INSERT INTO `ratings` (`id`, `productName`, `rating`, `numOfRatings`, `reg_date`) VALUES ('0', 'water', '5', '1', CURRENT_TIMESTAMP)";
    $conn->query($sql);
    $sql="INSERT INTO `ratings` (`id`, `productName`, `rating`, `numOfRatings`, `reg_date`) VALUES ('0', 'cheese', '5', '1', CURRENT_TIMESTAMP)";
    $conn->query($sql);

    //initialized the ratings table
    return;
}
?>