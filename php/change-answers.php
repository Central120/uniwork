<?php
include_once 'inc/dbconnect.php';
session_start();
$current_timestamp = date('Y-m-d H:i:s');

if (isset($_SESSION['user']))
{
    $session_usern = $_SESSION['user'];
}
else if(isset($_SESSION['admin']))
{
    $session_usern = $_SESSION['admin'];
}
else
{
    echo "<script>window.location.replace('index');</script>";
}

$secq1 = mysqli_real_escape_string($conn, $_POST['secq1']);
$secq2 = mysqli_real_escape_string($conn, $_POST['secq2']);
$seca1 = mysqli_real_escape_string($conn, $_POST['seca1']);
$seca2 = mysqli_real_escape_string($conn, $_POST['seca2']);
$conf_pw = mysqli_real_escape_string($conn, $_POST['conf_pw']);
$salt = "£$%";
$sa1 = md5($salt . $seca1);
$sa2 = md5($salt . $seca2); 
$cpw = md5($salt . $conf_pw);

$findaccount = mysqli_query($conn, "SELECT * FROM `accounts` WHERE `username` = '$session_usern' AND `password` = '$cpw'");
$countfindaccount = mysqli_num_rows($findaccount);
if ($countfindaccount != 0)
{
    $updatesecurityquestions = mysqli_query($conn, "UPDATE `accounts` SET `secq1` = '$secq1', `secq2` = '$secq2', `seca1` = '$sa1', `seca2` = '$sa2' WHERE `username` = '$session_usern'");
    if ($updatesecurityquestions)
    {
        echo "<script>window.location.replace('../account-settings');</script>";
    }
    else
    {
        echo "<div class='alert alert-danger alert-dismissable fade show' role='alert'><strong>An error occured.</strong> Your security questions could not be updated. <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
        <span aria-hidden='true'>&times;</span>
      </button></div>";
    }
}
else
{
    echo "<div class='alert alert-danger alert-dismissable fade show' role='alert'><strong>An error occured.</strong> The confirmation password you provided did not match our records. <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span>
  </button></div>";
}


?>