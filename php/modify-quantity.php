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
$quantity = mysqli_real_escape_string($conn, $_POST['quantity']);

$sqlfindcart = "SELECT * FROM `cart` WHERE `id` = '$id'";
$findcart = mysqli_query($conn, $sqlfindcart);
$countfindcart = mysqli_num_rows($findcart);

if($countfindcart !=0){
    $rowfindcart = mysqli_fetch_assoc($findcart);
    $product = $rowfindcart['product'];
    $currentquantity = $rowfindcart['quantity'];
    $sqlfindstock = "SELECT * FROM `products` WHERE `product_name` = '$product'";
    $findstock = mysqli_query($conn, $sqlfindstock);
    $countfindstock = mysqli_num_rows($findstock);
    if($countfindstock !=0){
    $rowfindstock = mysqli_fetch_assoc($findstock);
    $cstock = $rowfindstock['stock'];
    $product_id = $rowfindstock['id'];

    $tempquant = $currentquantity + $cstock;
    $newstock = $tempquant - $quantity;
    if($tempquant<$quantity){
        echo "<div class='alert alert-danger alert-dismissable fade show' role='alert'><strong>Error 404.</strong>There isn't enough quantity of $product <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
<span aria-hidden='true'>&times;</span>
</button></div>";
    }
    else{
        $sqlupdatecart = "UPDATE `cart` SET `quantity` = '$quantity' WHERE `id` = '$id'";
        $sqlupdatestock = "UPDATE `product` SET `stock` = '$newstock' WHERE `id` = '$product_id'";
        $updatecart = mysqli_query($conn, $sqlupdatecart);
        $updatestock = mysqli_query($conn, $sqlupdatestock);
        if($updatecart && $updatestock){
            echo "<script>window.location.replace('cart');</script>";
        }
        else{
            echo "<div class='alert alert-danger alert-dismissable fade show' role='alert'><strong>Error 404.</strong>The was an error updating your cart. <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
<span aria-hidden='true'>&times;</span>
</button></div>";
        }
    }
}
else{
echo "<div class='alert alert-danger alert-dismissable fade show' role='alert'><strong>Error 404.</strong>The product was not found. <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
<span aria-hidden='true'>&times;</span>
</button></div>";
} 
}
else{
echo "<div class='alert alert-danger alert-dismissable fade show' role='alert'><strong>Error 404.</strong>The cart was not found. <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
<span aria-hidden='true'>&times;</span>
</button></div>";
}
?>