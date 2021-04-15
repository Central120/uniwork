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
else
{
    echo "<script>window.location.replace('../index');</script>";
}

$star = mysqli_real_escape_string($conn, $_POST['star']);
$comments = mysqli_real_escape_string($conn, $_POST['comments']);

$sqlreviewquery = "INSERT INTO reviews VALUES (DEFAULT, '$session_usern', '$star', '$comments', 'pending', '$current_timestamp')";
$review = mysqli_query($conn, $sqlreviewquery);

if($review){
    echo "<div class='alert alert-success alert-dismissable fade show' role='alert'><strong>Success, your review has been submitted.</strong> It will now be moderated by staff before being posted. <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span>
  </button></div>";
} else {
    echo "<div class='alert alert-danger alert-dismissable fade show' role='alert'><strong>An error occured.</strong> Your review did not get posted. <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span>
  </button></div>";
}



















?>