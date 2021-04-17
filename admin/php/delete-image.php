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

$approvesql = "DELETE FROM photo_sharing WHERE id='$imageid'";

if(mysqli_query($conn,$approvesql))
{
  echo "<script>window.location.reload();</script>";
}
else
{
  echo "<script>window.location.reload();</script>";
}
?>