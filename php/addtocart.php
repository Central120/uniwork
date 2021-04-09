<?php
include_once '../inc/dbconnect.php';
session_start();
$current_timestamp = date('Y-m-d H:i:s');
ini_set('display_errors', 1);

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

$itemid = mysqli_real_escape_string($conn, $_POST['id']);
$quantity = mysqli_real_escape_string($conn, $_POST['quantity']);
if ($quantity < "1"){
    echo "Your Quantity Cannot Be 0";
}
else {

$fitem = "SELECT * FROM `products` WHERE `id` = '$itemid'";
$finditem = mysqli_query($conn,$fitem);
$countitem = mysqli_num_rows($finditem);
if($countitem != 0){
    $rowfinditem = mysqli_fetch_assoc($finditem);
    $product = $rowfinditem['product_name'];
    $ogprice = $rowfinditem['price'];
    $discount = $rowfinditem['discount'];
    $ogstock = $rowfinditem['stock'];
    if ($discount == '0')
    {
    $finalprice = $ogprice;
    }
    else
    {
    $calcy = $ogprice / 100 * $discount; 
    $finalprice = $ogprice - $calcy;
    }
    if($quantity > $ogstock) {
        echo "an error has occured, there is insuffient stock for your requested quantity";
    }
    else {
        $chkitem = "SELECT * FROM `cart` WHERE `product` = '$product' AND `username` = '$session_usern'";
        $checkitem = mysqli_query($conn, $chkitem);
        $countcheckitem = mysqli_num_rows($checkitem);
        if ($countcheckitem != 0)
        {
            $rowcheckitem = mysqli_fetch_assoc($checkitem);
            $cartid = $rowcheckitem['id'];
            $currentq = $rowcheckitem['quantity'];
            $tempq = $currentq + $quantity;
            
            if ($tempq <= $ogstock)
            {
                $tempstock = $ogstock - $quantity;
            }

            $updateamountssql = "UPDATE `cart` SET `quantity` = '$tempq' WHERE `id` = '$cartid'";
            $updatestocksql = "UPDATE `products` SET `stock` = '$tempstock' WHERE `id` = '$itemid'";
            $updateamounts = mysqli_query($conn, $updateamountssql);
            $updatestock = mysqli_query($conn, $updatestocksql);

            if($updateamounts && $updatestock)
            {
                echo "<script>window.location.replace('../cart');</script>";
            }
            else
            {
                echo "There was an error updating your quantity.";
            }
        }
        else
        {
            $newstock = $ogstock - $quantity;
            $insertitemsql = "INSERT INTO `cart` VALUES (DEFAULT, '$session_usern', '$product', '$finalprice', '$quantity','no')";
            $updatestocksql = "UPDATE `products` SET `stock` = '$newstock' WHERE `id` = '$itemid'";
            $insertitemtocart = mysqli_query($conn, $insertitemsql);
            $updatestock = mysqli_query($conn, $updatestocksql);
              
            if ($insertitemtocart && $updatestock)
            {
                echo "<script>window.location.replace('../cart');</script>";
            }
            else
            {
                echo "There was an error adding your item to the cart.";
               
            }
        }
    }
}
else
{
    echo "Item not found, please try again.";
}
}
?>