<?php
include_once '../inc/dbconnect.php';
session_start();
$current_timestamp = date('Y-m-d H:i:s');

if(isset($_SESSION['admin']))
{
    $session_usern = $_SESSION['admin'];
}
else
{
    echo "<script>window.location.replace('../index');</script>";
}

$user_id = mysqli_real_escape_string($conn, $_POST['id']);

$sqlfinduser = mysqli_query($conn, "SELECT * FROM `accounts` WHERE `id` = '$user_id'");

$countuser = mysqli_num_rows($sqlfinduser);

if($countuser != 0){
    $updateuser = mysqli_query($conn, "UPDATE `accounts` SET `admin_id` = '2' WHERE `id` = '$user_id'" );
    if ($updateuser){
        echo "<script>window.location.replace('../users');</script>";
    }
    else {
        echo "<div class='alert alert-danger alert-dismissable fade show' role='alert'><strong>An error occured.</strong> The user was not made an admin. <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
          </button></div>";
    }
}
else {
    echo "<div class='alert alert-danger alert-dismissable fade show' role='alert'><strong>An error occured.</strong> The user was not found. <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
          </button></div>";
}


?>