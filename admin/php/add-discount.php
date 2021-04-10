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
$discount_applied = mysqli_real_escape_string($conn, $_POST['discount']);

if ($discount_applied > '0' && $discount_applied <= '100') //checks if discount sent is more than 0 and less than or equal to 100
{
$discount = $discount_applied;
$sqlfindproduct = "SELECT * FROM `products` WHERE `id` = '$product_id'";
$findproduct = mysqli_query($conn, $sqlfindproduct);
$countfindproduct = mysqli_num_rows($findproduct);

if ($countfindproduct != 0)
{
    $rowfindproduct = mysqli_fetch_assoc($findproduct);
    $product = $rowfindproduct['product_name'];

    $sqladddiscount = "UPDATE `products` SET `discount` = '$discount' WHERE `id` = '$product_id'";
    $adddiscount = mysqli_query($conn, $sqladddiscount);
    if ($adddiscount)
    {
        echo "<script>window.location.replace('../modify-products');</script>";
    }
    else
    {
        echo "<div class='alert alert-danger alert-dismissable fade show' role='alert'><strong>An error occured.</strong> The discount could not be added. <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span>
  </button></div>";
    }
}
else
{
    echo "<div class='alert alert-danger alert-dismissable fade show' role='alert'><strong>An error occured.</strong> We failed to find the product. <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span>
  </button></div>";
}
}
else
{
    echo "<div class='alert alert-danger alert-dismissable fade show' role='alert'><strong>An error occured.</strong> The discount you applied is not applicable. <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span>
  </button></div>";
}