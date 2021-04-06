<?php
include_once '../inc/dbconnect.php';


$newpw = mysqli_real_escape_string($conn, $_POST['newpw']);
$confnewpw = mysqli_real_escape_string($conn, $_POST['r_newpw']);
$username = mysqli_real_escape_string($conn, $_POST['usern']);
$salt = "£$%";
$npw = md5($salt . $newpw);
$cnpw = md5($salt . $confnewpw); 

$findaccount = mysqli_query($conn, "SELECT * FROM `accounts` WHERE `username` = '$username'");
$countfindaccount = mysqli_num_rows($findaccount);
if ($countfindaccount != 0)
{
    if ($npw == $cnpw)
    {
        $updatepw = mysqli_query($conn, "UPDATE `accounts` SET `password` = '$npw' WHERE `username` = '$session_usern'");
        if ($updatepw)
        {
            echo "<script>window.location.replace('../login');</script>";
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
    echo "<div class='alert alert-danger alert-dismissable fade show' role='alert'><strong>An error occured.</strong> Your account could no longer be found. <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span>
  </button></div>";
}


?>