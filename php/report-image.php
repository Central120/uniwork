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

$reporting = mysqli_real_escape_string($conn, $_POST['reporting']);
$reporter = mysqli_real_escape_string($conn, $_POST['reporter']);
$report_option = mysqli_real_escape_string($conn, $_POST['report_option']);
$report_information = mysqli_real_escape_string($conn, $_POST['report_information']);

$reportsql = "INSERT INTO image_report VALUES(DEFAULT, '$reporter', '$reporting', '$report_option', '$reportinformation', 'pending', 'open')";
$reportresult = mysqli_query($conn, $reportsql);

if($reportrow = mysqli_fetch_array($reportresult))
{
    echo "<div class='alert alert-success alert-dismissable fade show' role='alert'><strong>Done!</strong> Your report has been sent. Our moderation team has received the report and will handle the report. <button type='button' class='close' data-dismiss='alert' aria-label='Close'> <span aria-hidden='true'>&times;</span></button></div>"
}
else
{
    echo "<div class='alert alert-danger alert-dismissable fade show' role='alert'><strong>Uhh ohh.</strong> Somehow we couldn't process your report. Try again; if you continue to receive this error, please contact our team. <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>"
}

?>