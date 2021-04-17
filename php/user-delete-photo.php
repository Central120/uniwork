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

$imageid = mysqli_real_escape_string($conn, $_POST['imageid']);

$deletesql = "DELETE FROM photo_sharing WHERE id='$imageid'";

if(mysqli_query($conn,$deletesql))
{
    echo "<script>window.location.replace('../gallery');</script>";
}
else
{
    echo "<script>window.location.replace('../gallery');</script>";
}



?>