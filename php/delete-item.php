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
    echo "<script>window.location.replace('index');</script>";
}

$id = mysqli_real_escape_string($conn, $_POST['id']);
$sqlfindcart = "SELECT * FROM `cart` WHERE `id` = '$id'";
$findcart = mysqli_query($conn, $sqlfindcart);
$countfindcart = mysqli_num_rows($findcart);

if($countfindcart !=0){
    $rowfindcart = mysqli_fetch_assoc($findcart);
$product = $rowfindcart['product'];
$quantity = $rowfindcart['quantity'];

$sqlfinditem = "SELECT * FROM `products` WHERE `product_name` = '$product'";
$finditem = mysqli_query($conn, $sqlfinditem);
$countfinditem = mysqli_num_rows($finditem)
if ($countfinditem != 0)
{
$rowfinditem = mysqli_fetch_assoc($finditem)
$stock = $rowfinditem['stock'];
$product_id = $rowfinditem['id'];
$ns = $stock + $quantity;

$sqladdstock = "UPDATE `products` SET `stock` = '$ns' WHERE `id` = '$product_id'";
$addstock = mysqli_query($conn, $sqladdstock);
$sqldeletecart = "DELETE FROM `cart` WHERE `id` = '$id'";
$deletecart = mysqli_query($conn, $sqldeletecart);
if ($addstock && $deletecart)
{
echo "<script>window.location.replace('../cart');</script>";
}
else
{
    echo "<div class='alert alert-danger alert-dismissable fade show' role='alert'><strong>Error 404.</strong>Your item could not be deleted <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span>
    </button></div>";
}
}
else
{
    echo "<div class='alert alert-danger alert-dismissable fade show' role='alert'><strong>Error 404.</strong>We could not find your item<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span>
    </button></div>";
}
}
else
{
    echo "<div class='alert alert-danger alert-dismissable fade show' role='alert'><strong>Error 404.</strong>Your cart could not be found<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span>
    </button></div>";
}
?>