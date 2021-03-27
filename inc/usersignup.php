<?php
include_once "dbconnect.php";
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
    echo "<div class='alert alert-danger alert-dismissable fade show' role='alert'><strong>An error occured.</strong> The username you have selected already exists. <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span>
  </button></div>";
}
else
{
    $sa1 = md5($salt . $seca1);
    $sa2 = md5($salt . $seca2);
    $inserttodb = mysqli_query($conn, "INSERT INTO `accounts` VALUES (DEFAULT, '$username', '$hashpw', '$secq1','$secq2', '$sa1','$sa2', '1')");
    if ($inserttodb)
    {
        echo "<script>window.location.replace('../login');</script>";
    }
    else
    {
        echo "<div class='alert alert-danger alert-dismissable fade show' role='alert'><strong>An error occured.</strong> Your account could not be created. <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
        <span aria-hidden='true'>&times;</span>
      </button></div>";
        
    }
}


?>