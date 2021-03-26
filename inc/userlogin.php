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
        echo "Unfortunately, your account has been suspended. Please email customer support quoting: 'My account has been suspended'";
    }
    else if ($usertype == '1')
    {
        $_SESSION['user'] = $username; 
        echo "Welcome to Kerrys K9s $username!";
    }
    else if ($usertype == '2')
    {
        $_SESSION['admin'] = $username; 
        echo "Welcome $username! - You are an admin";
    }
    else
    {
        echo "An error occured. Please email customer support quoting: 'My user type is wrong'";
    }
}
else
{
    echo "Your details were incorrect. Please try again.";
}

?>
