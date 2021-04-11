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

$reporter = mysqli_real_escape_string($conn, $_POST['reporter']);
$reporting = mysqli_real_escape_string($conn, $_POST['reporting']);
$reportoption = mysqli_real_escape_string($conn, $_POST['report_option']);
$reportinformation = mysqli_real_escape_string($conn, $_POST['report_information']);

$reportsql = "INSERT INTO image_report VALUES(DEFAULT, '$reporter', '$reporting', $reportoption', '$reportinformation', 'pending', 'pending')";
$reportresult = mysqli_query($conn, $reportsql);

if($reportrow = mysqli_fetch_array($reportresult))
{
    echo "success";
}
else
{
    echo "failed";
}



?>