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

$product_id = mysqli_real_escape_string($conn, $_POST['id']);
$sqlfindproduct = "SELECT * FROM `products` WHERE `id` = '$product_id'";
$findproduct = mysqli_query($conn, $sqlfindproduct);
$countfindproduct = mysqli_num_rows($findproduct);

if ($countfindproduct != 0){
    $sqldeletediscount = "UPDATE `products` SET `discount` = '0' WHERE `id` = '$product_id'";
    $deletediscount = mysqli_query($conn, $sqldeletediscount);
    if ($deletediscount){
        echo "<script>window.location.replace('../modify-products');</script>";
    }
    else{
        echo "<div class='alert alert-danger alert-dismissable fade show' role='alert'><strong>An error occured.</strong> We could not delete the discount. <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
        <span aria-hidden='true'>&times;</span>
      </button></div>";
    }
}
else{
    echo "<div class='alert alert-danger alert-dismissable fade show' role='alert'><strong>An error occured.</strong> We could not find the product. <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span>
  </button></div>";
}
