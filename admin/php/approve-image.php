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

$imageid = mysqli_real_escape_string($conn, $_POST['imageid']);

$approvesql = "UPDATE photo_staring SET approver='$session_usern' WHERE id='$imageid'";

if(mysqli_query($conn,$approvesql))
{
    echo "<div class='alert alert-success alert-dismissable fade show' role='alert'><strong>Complete!</strong> Image approved. <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span>
  </button></div>";
}
else
{
    echo "<div class='alert alert-danger alert-dismissable fade show' role='alert'><strong>An error occured.</strong> The image couldn't be approved. {$imageid} <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span>
  </button></div>";
}
?>