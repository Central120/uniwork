<?php
include_once 'inc/dbconnect.php';
session_start();
$current_timestamp = date('Y-m-d H:i:s');
ini_set('display_errors', 1);

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

$day1 = mysqli_real_escape_string($conn, $_POST['day1']);
$time1 = mysqli_real_escape_string($conn, $_POST['time1']);
$day2 = mysqli_real_escape_string($conn, $_POST['day2']);
$time2 = mysqli_real_escape_string($conn, $_POST['time2']);
$petname = mysqli_real_escape_string($conn, $_POST['petname']);
$em1 = mysqli_real_escape_string($conn, $_POST['emergency1']);
$em2 = mysqli_real_escape_string($conn, $_POST['emergency2']);
$additional = mysqli_real_escape_string($conn, $_POST['additional']);

$tz1 = "$day1 $time1";
$tz2 = "$day2 $time2";

$addtobookings = mysqli_query($conn, "INSERT INTO `bookings` VALUES (DEFAULT,'$session_usern','$tz1','$tz2','$petname','$em1','$em2','$additional','$current_timestamp')");
if ($addtobookings)
{
    echo "<script>window.location.replace('new-booking');</script>";
}
else
{
    echo "<div class='alert alert-danger alert-dismissable fade show' role='alert'><strong>An error occured.</strong> Your booking could not be created. <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span>
  </button></div>";
}
?>