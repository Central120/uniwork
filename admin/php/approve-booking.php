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

$booking_id = mysqli_real_escape_string($conn, $_POST['id']);
$ts = mysqli_real_escape_string($conn, $_POST['ts']);

$sqlfindbooking = mysqli_query($conn, "SELECT * FROM `bookings` WHERE `id` = '$booking_id'");
$rowfindbooking = mysqli_fetch_assoc($sqlfindbooking);

if ($ts == 'none')
{
    $username = $rowfindbooking['username'];
    $tsc = "None accepted";
    $handlerstr = $session_usern;

    // insert into cancelled.
    $movebookingtocancelled = mysqli_query($conn, "INSERT INTO `cancelled_bookings` VALUES (DEFAULT, '$username', '$tsc', '$handlerstr', '$current_timestamp', 'Denied')");
    if ($movebookingtocancelled)
    {
        $deletefrombookings = mysqli_query($conn, "DELETE FROM `bookings` WHERE `id` = '$booking_id'");
        if ($deletefrombookings)
        {
            echo "<script>window.location.replace('../pending-bookings');</script>";
        }
        else
        {
            echo "<div class='alert alert-danger alert-dismissable fade show' role='alert'><strong>An error occured.</strong> The booking was not deleted. <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
          </button></div>";
        }
    }   
    else
    {
        echo "<div class='alert alert-danger alert-dismissable fade show' role='alert'><strong>An error occured.</strong> The booking was not denied. <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span>
  </button></div>";
    }
}
else
{
    $checktsentered = mysqli_query($conn, "SELECT * FROM `bookings` WHERE `id` = '$booking_id' AND `timeslot_1` = '$ts'");
    $countcheckentered = mysqli_num_rows($checktsentered);
    if ($countcheckentered != 0)
    {
        $updatebooking = mysqli_query($conn, "UPDATE `bookings` SET `approver` = '$session_usern', `approved_timestamp` = '$ts' WHERE `id` = '$booking_id'");
        if ($updatebooking)
        {
            echo "<script>window.location.replace('../pending-bookings');</script>";
        }
        else
        {
            echo "<div class='alert alert-danger alert-dismissable fade show' role='alert'><strong>An error occured.</strong> Approving timeslot 1 did not work. <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span>
  </button></div>";
        }
    }
    else
    {
        $checkts2entered = mysqli_query($conn, "SELECT * FROM `bookings` WHERE `id` = '$booking_id' AND `timeslot_2` = '$ts'");
        $countcheckentered2 = mysqli_num_rows($checkts2entered);
        if ($countcheckentered2 != 0)
        {
            $updatebooking = mysqli_query($conn, "UPDATE `bookings` SET `approver` = '$session_usern', `approved_timestamp` = '$ts' WHERE `id` = '$booking_id'");
            if ($updatebooking)
            {
                echo "<script>window.location.replace('../pending-bookings');</script>";
            }
            else
            {
                echo "<div class='alert alert-danger alert-dismissable fade show' role='alert'><strong>An error occured.</strong> Approving timeslot 1 did not work. <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
        <span aria-hidden='true'>&times;</span>
    </button></div>";
            }
        }
        else
        {
            echo "<div class='alert alert-danger alert-dismissable fade show' role='alert'><strong>An error occured.</strong> The timeslot entered does not match our records. <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span>
  </button></div>";
        }
    }

    
}