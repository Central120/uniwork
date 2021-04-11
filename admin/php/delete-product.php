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
    $rowfindproduct = mysqli_fetch_assoc($findproduct);
    $product_name = $rowfindproduct['product_name'];
    $image = $rowfindproduct['Image'];
    $file = "../../$image";
    if(file_exists($file)){
        unlink($file);
        $sqldeleteproduct = "DELETE FROM `products` WHERE `id` = '$product_id'";
        $sqldeletefromcart = "DELETE FROM `cart` WHERE `product` = '$product_name'";
        $deletefromcart = mysqli_query($conn, $sqldeletefromcart);
        $deleteproduct = mysqli_query($conn, $sqldeleteproduct);
        if ($deleteproduct && $deletefromcart){
            echo "<script>window.location.replace('../modify-products');</script>";
        }
        else{
            echo "<div class='alert alert-danger alert-dismissable fade show' role='alert'><strong>An error occured.</strong> We could not delete the product. <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
          </button></div>";
        }
    }
    else{
        echo "<div class='alert alert-danger alert-dismissable fade show' role='alert'><strong>An error occured.</strong> The image could not be found. <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span>
  </button></div>";
    }
}
else{
    echo "<div class='alert alert-danger alert-dismissable fade show' role='alert'><strong>An error occured.</strong> We could not find the product. <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span>
  </button></div>";
}
