<?php
include_once '../inc/dbconnect.php';
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

$newpw = mysqli_real_escape_string($conn, $_POST['password']);
$confnewpw = mysqli_real_escape_string($conn, $_POST['conf_pw']);
$prevpw = mysqli_real_escape_string($conn, $_POST['prev_pw']);
$salt = "£$%";
$npw = md5($salt . $newpw);
$cnpw = md5($salt . $confnewpw); 
$prev = md5($salt . $prevpw);



$findaccount = mysqli_query($conn, "SELECT * FROM `accounts` WHERE `username` = '$session_usern' AND `password` = '$prev'");
$countfindaccount = mysqli_num_rows($findaccount);
if ($countfindaccount != 0)
{
    if ($npw == $cnpw)
    {
        $updatesecurityquestions = mysqli_query($conn, "UPDATE `accounts` SET `secq1` = '$secq1', `secq2` = '$secq2', `seca1` = '$sa1', `seca2` = '$sa2' WHERE `username` = '$session_usern'");
        if ($updatesecurityquestions)
        {
            echo "<script>window.location.replace('../account-settings');</script>";
        }
        else
        {
            echo "<div class='alert alert-danger alert-dismissable fade show' role='alert'><strong>An error occured.</strong> Your password could not be updated. <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
        </button></div>";
        }
    }
    else
    {
        echo "<div class='alert alert-danger alert-dismissable fade show' role='alert'><strong>An error occured.</strong> Your new passwords do not match. <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
        <span aria-hidden='true'>&times;</span>
    </button></div>";
    }
}
else
{
    echo "<div class='alert alert-danger alert-dismissable fade show' role='alert'><strong>An error occured.</strong> The previous password you provided did not match our records. <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span>
  </button></div>";
}


?>