<?php
include_once 'dbconnect.php';
session_start();


$username = mysqli_real_escape_string($conn, $_POST['username']);
$password = mysqli_real_escape_string($conn, $_POST['password']);
$salt = "£$%";
$passencrypt = md5($salt . $password);

$findaccount = mysqli_query($conn, "SELECT * FROM `accounts` WHERE `username` = '$username' AND `password` = '$passencrypt'");
$countfindaccount = mysqli_num_rows($findaccount);

if ($countfindaccount != 0)
{
    $rowfindaccount = mysqli_fetch_assoc($findaccount);
    $usertype = $rowfindaccount['admin_id'];

    if ($usertype == '0')
    {
        $_SESSION['suspended'] = $username;
        echo "<div class='alert alert-danger alert-dismissable fade show' role='alert'><strong>An error occured.</strong> Unfortunately, your account has been suspended. Please email customer support quoting: 'My account has been suspended' <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
        <span aria-hidden='true'>&times;</span>
      </button></div>";
    }
    else if ($usertype == '1')
    {
        $_SESSION['user'] = $username; 
       
        echo '<meta http-equiv="refresh" content="3; url=../login" />';
 echo "<div class='alert alert-success' role='alert'>Logged in successfully, redirecting you in 3 seconds.</div>";

    }
    else if ($usertype == '2')
    {
        $_SESSION['admin'] = $username; 
        
        echo "<script>window.location.replace('../index');</script>";
    }
    else
    {
        echo "<div class='alert alert-danger alert-dismissable fade show' role='alert'><strong>An error occured.</strong> Please email customer support quoting: 'My user type is wrong' <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
        <span aria-hidden='true'>&times;</span>
      </button></div>";
    }
}
else
{
    echo "<div class='alert alert-danger alert-dismissable fade show' role='alert'><strong>An error occured.</strong> The details you provided were incorrect. <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
        <span aria-hidden='true'>&times;</span>
      </button></div>";
}

?>
