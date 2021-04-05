<?php
include_once 'inc/dbconnect.php';
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

$itemid = mysqli_real_escape_string($conn, $_POST['id']);
$quantity = mysqli_real_escape_string($conn, $_POST['quantity']);
$fitem = "SELECT * FROM `products` WHERE `id` = '$itemid'";
$finditem = mysqli_query($conn,$fitem);
$countitem = mysqli_num_rows($finditem);
if($countitem != 0){
    $rowfinditem = mysqli_fetch_assoc($finditem);
    $product = $rowfinditem['product_name'];
    $ogprice = $rowfinditem['price'];
    $discount = $rowfinditem['discount'];
    $ogstock - $rowfinditem['stock'];
    if ($discount == '0')
    {
    $finalprice = $price;
    }
    else
    {
    $calcy = $price / 100 * $discount; 
    $finalprice = $price - $calcy;
    }
    if($quantity > $ogstock) {
        echo "an error has occured, there is insuffient stock for your requested quantity";
    }
    else {
        $chkitem = "SELECT * FROM `cart` WHERE `product` = '$product'";
        $checkitem = mysqli_query($conn, $chkitem);
        $countcheckitem = mysqli_num_rows($checkitem);
        if ($countcheckitem != 0)
        {
            $rowcheckitem = mysqli_fetch_assoc($checkitem);
            $cartid = $rowcheckitem['id'];
            $currentq = $rowcheckitem['quantity'];
            $tempq = $currentq + $quantity;
        
        }
    }
}
?>