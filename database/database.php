<?php
$servername = "localhost";
$db_name = "group_ten_midproject";
$username = "root";
$password = "";

// Create connection
$conn = new mysqli($servername,$username,$password,$db_name);

// Check connection
if($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
}else{
    die("Connection Succesfull");
}


?>
