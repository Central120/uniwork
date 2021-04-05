<?php
include_once '../inc/dbconnect.php';
session_start();

if(isset($_SESSION['admin']))
{
    $session_usern = $_SESSION['admin'];
}
else
{
    echo "<script>window.location.replace('../index');</script>";
}

$sqlcheckforschedule = mysqli_query($conn, "SELECT * FROM `staff_availability` WHERE `staff_name` = '$session_usern'");
$countcheckforschedule = mysqli_num_rows($sqlcheckforschedule);

if ($countcheckforschedule != 0)
{
    $start_date = mysqli_real_escape_string($conn, $_POST['start']);
    $end_date = mysqli_real_escape_string($conn, $_POST['end']);
    $start_time = mysqli_real_escape_string($conn, $_POST['start_time']);
    $end_time = mysqli_real_escape_string($conn, $_POST['end_time']);

    $sd = strtotime("this $start_date");
    $ed = strtotime("this $end_date");

    

    if ($start_date == $end_date || $start_time == $end_time || $sd < $ed)
    {
        echo "<div class='alert alert-danger alert-dismissable fade show' role='alert'><strong>An error occured.</strong> Please ensure the values you have entered are valid. <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
        <span aria-hidden='true'>&times;</span>
      </button></div>";
    }
    else
    {
        $sqlupdate = mysqli_query($conn, "UPDATE `staff_availability` SET `start_time` = '$start_time',`end_time` = '$end_time', `first_date` = '$start_date', `last_date` = '$end_date' WHERE `staff_name` = '$session_usern'");
        if ($sqlupdate)
        {
            echo "<script>window.location.replace('index')</script>";
        }
        else
        {
            echo "<div class='alert alert-danger alert-dismissable fade show' role='alert'><strong>An error occured.</strong> Your schedule has not been updated. <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
        </button></div>";
            
        }
    }
}
else
{
    $start_date = mysqli_real_escape_string($conn, $_POST['start']);
    $end_date = mysqli_real_escape_string($conn, $_POST['end']);
    $start_time = mysqli_real_escape_string($conn, $_POST['start_time']);
    $end_time = mysqli_real_escape_string($conn, $_POST['end_time']);
    if ($start_date == $end_date || $start_time == $end_time)
    {
        echo "<div class='alert alert-danger alert-dismissable fade show' role='alert'><strong>An error occured.</strong> Please ensure the values you have entered are not the same. <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
        <span aria-hidden='true'>&times;</span>
      </button></div>";
       
    }
    else
    {
        $sqlupdate = mysqli_query($conn, "INSERT INTO `staff_availability` VALUES (DEFAULT,'$session_usern','$start_time','$end_time','$start_date','$end_date')");
        if ($sqlupdate)
        {
            echo "<script>window.location.replace('index')</script>";
        }
        else
        {
            echo "<div class='alert alert-danger alert-dismissable fade show' role='alert'><strong>An error occured.</strong> Your schedule has not been updated. <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
        </button></div>";
            
        }
    }
}

?>