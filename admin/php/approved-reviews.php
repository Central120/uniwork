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

$review_id = mysqli_real_escape_string($conn, $_POST['id']);

$sqlfindreview = mysqli_query($conn, "SELECT * FROM `reviews` WHERE `id` = '$review_id'");

$countreview = mysqli_num_rows($sqlfindreview);

if($countreview != 0){
    $updatereview = mysqli_query($conn, "UPDATE `reviews` SET `status` = 'approved', `managed_by` = '$session_usern' WHERE `id` = '$review_id'" );
    if ($updatereview){
        echo "<script>window.location.replace('../approved-reviews');</script>";
    }
    else {
        echo "<div class='alert alert-danger alert-dismissable fade show' role='alert'><strong>An error occured.</strong> The review was not approved. <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
          </button></div>";
    }
}
else {
    echo "<div class='alert alert-danger alert-dismissable fade show' role='alert'><strong>An error occured.</strong> The review was not found. <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
          </button></div>";
}


?>