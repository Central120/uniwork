<?php
include "inc/dbconnect.php";
ini_set('display_errors', 1);

$username = mysqli_real_escape_string($conn, $_POST['username']);
$password = mysqli_real_escape_string($conn, $_POST['password']);
$salt = "£$%";
$hashpw = md5($salt . $password);
$secq1 = mysqli_real_escape_string($conn, $_POST['SecQ1']);
$seca1 = mysqli_real_escape_string($conn, $_POST['SecA1']);
$secq2 = mysqli_real_escape_string($conn, $_POST['SecQ2']);
$seca2 = mysqli_real_escape_string($conn, $_POST['SecA2']);

$checkforuser = mysqli_query($conn, "SELECT * FROM `accounts` WHERE `username` = '$username'");
$countcheckuser = mysqli_num_rows($checkforuser);
if ($countcheckuser != 0)
{
    echo "The username you have selected already exists. Please try again later.";
}
else
{
    $sa1 = md5($salt . $seca1);
    $sa2 = md5($salt . $seca2);
    $inserttodb = mysqli_query($conn, "INSERT INTO `accounts` VALUES (DEFAULT, '$username', '$hashpw', '$secq1','$secq2', '$sa1','$sa2', '0')");
    if ($inserttodb)
    {
        echo "Account has been created";
    }
    else
    {
        echo "An error occured when trying to create your account.";
    }
}


?>