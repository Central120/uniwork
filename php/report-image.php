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
    echo "<div class='alert alert-success alert-dismissable fade show' role='alert'><strong>Reported!</strong> Our moderation team will review the report and take the appropriate action. Thank you for the report! <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span>
    </button></div>";
}
else
{
    echo "<div class='alert alert-danger alert-dismissable fade show' role='alert'><strong>Uhh ohh!</strong> We failed to submit your report. Please try again. If this problem persists, please contact our team as soon as possible. <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span>
    </button></div>";
}



?>