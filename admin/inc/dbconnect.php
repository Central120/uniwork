<?php

error_reporting(0);


$host = "localhost";
$username = "root";
$password = "toonarmy11";
$table = "site";

$conn = new mysqli($host, $username, $password, $table);

if($conn->connection_error){
    die("Connection error, please see error." . $conn->connect_error);
}

?>