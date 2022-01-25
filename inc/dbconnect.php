<?php

$serverhost = "localhost";
$username = "root";
$password = "toonarmy11";
$dbname = "site";

$conn = mysqli_connect("$serverhost", "$username", "$password", "$dbname");

// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}
?>
