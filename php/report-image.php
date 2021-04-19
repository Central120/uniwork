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

$imageid = mysqli_real_escape_string($conn, $_POST['imageid']);
$reporter = mysqli_real_escape_string($conn, $_POST['reporter']);
$reporting = mysqli_real_escape_string($conn, $_POST['reporting']);
$reportoption = mysqli_real_escape_string($conn, $_POST['reportoption']);
$reportinformation = mysqli_real_escape_string($conn, $_POST['reportinformation']);
$other = mysqli_real_escape_string($conn, $_POST['otheroption']);

if(!$other)
{
    $other = "N/A";
}


$reportsql = "INSERT INTO image_report VALUES(DEFAULT, '$reporter', '$reporting', '$reportoption', '$reportinformation', '$other', 'pending', 'open', '$imageid')";

if(mysqli_query($conn,$reportsql))
{
    echo "<script>window.location.replace('../gallery');</script>";
}
else
{
    echo "<script>window.location.replace('../gallery');</script>";
}



?>