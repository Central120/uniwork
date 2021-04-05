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


$booking_id = mysqli_real_escape_string($conn, $_POST['id']);
$findbooking = mysqli_query($conn, "SELECT * FROM `bookings` WHERE `id` = '$booking_id'");
$countfindbooking = mysqli_num_rows($findbooking);

if ($countfindbooking != 0)
{
    $rowfindbooking = mysqli_fetch_assoc($findbooking);
    $username = $rowfindbooking['username'];
    $tscancelled = $rowfindbooking['approved_timestamp'];
    if ($tscancelled == '0000-00-00 00:00:00')
    {
        $tsc = "None allocated";
    }
    else
    {
        $tsc = $tscancelled; 
    }
    $handler = $rowfindbooking['approver'];
    if ($handler == '')
    {
        $handlerstr = "$session_usern";
    }
    else
    {
        $handlerstr = $handler;
    }

    $movebookingtocancelled = mysqli_query($conn, "INSERT INTO `cancelled_bookings` VALUES (DEFAULT, '$session_usern', '$tsc', '$handlerstr', '$current_timestamp', 'Completed')");
    if ($movebookingtocancelled)
    {
        $deletefrombookings = mysqli_query($conn, "DELETE FROM `bookings` WHERE `id` = '$booking_id'");
        if ($deletefrombookings)
        {
            echo "<script>window.location.replace('../pending-bookings');</script>";
        }
        else
        {
            echo "<div class='alert alert-danger alert-dismissable fade show' role='alert'><strong>An error occured.</strong> The booking did not get completed. <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
          </button></div>";
        }
    }   
    else
    {
        echo "<div class='alert alert-danger alert-dismissable fade show' role='alert'><strong>An error occured.</strong> The booking did not get completed. <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span>
  </button></div>";
    }
}
else
{
    echo "<div class='alert alert-danger alert-dismissable fade show' role='alert'><strong>An error occured.</strong> The booking could not be found. <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span>
  </button></div>";
}

?>