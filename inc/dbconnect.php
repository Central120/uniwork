<?php

$serverhost = "localhost";
$username = "u898383871_root";
$password = "DatabasePassword123!";
$dbname = "u898383871_uni";

$conn = mysqli_connect("$serverhost", "$username", "$password", "$dbname");

// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}
?>
