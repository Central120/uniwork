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

$reportid = mysqli_real_escape_string($conn, $_POST['reportid']);
$imageid = mysqli_real_escape_string($conn, $_POST['imageid']);
$handleoption = mysqli_real_escape_string($conn, $_POST['handle-option']);

if($handleoption == "close")
{
    $reportsql = mysqli_query($conn, "UPDATE image_report SET outcome='Closed without action', status='closed' WHERE id='$reportid'");
    echo "<div class='alert alert-success alert-dismissable fade show' role='alert'><strong>Closed!</strong> The report has been closed with no action taken. <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span>
    </button></div>";
}
else if($handleoption == "delete")
{
    $reportsql1 = mysqli_query($conn, "UPDATE image_report SET outcome='Closed and deleted image', status='closed' WHERE id='$reportid'");
    $imagesql = mysqli_query($conn, "DELETE FROM photo_sharing WHERE id='$imageid'");
    echo "<div class='alert alert-success alert-dismissable fade show' role='alert'><strong>Closed & Deleted!</strong> The report has been closed with the action of deleting the image! <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span>
    </button></div>"; 
}
else
{
    echo "<div class='alert alert-danger alert-dismissable fade show' role='alert'><strong>Uhh oh!</strong> Our moderation team will review the report and take the appropriate action. Thank you for the report! <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span>
    </button></div>";
}