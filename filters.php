<?php
include "inc/dbconnect.php";
$category1 = mysqli_real_escape_string($conn, $_POST['category']);
if ($category1 == "all")
{
    $cat = "SELECT * FROM `products`";
} 
else {
    $cat = "SELECT * FROM `products` WHERE `category` = '$category1'";
}
// find the items in the category.

$findcat = mysqli_query($conn, $cat);
echo "<div class='container-fluid'>
<div class='row'>";
while ($rowcat = $findcat->fetch_assoc())
{
    $itemID = $rowcat['id'];
    $productName = $rowcat['product_name'];
    $category = $rowcat['category'];
    $price = $rowcat['price'];
    $discount = $rowcat['discount'];
    $stock = $rowcat['stock'];
    $image = $rowcat['Image'];
    if ($discount == '0')
{
$finalprice = $price;
$discountmsg ="";
$fp = number_format((float)$finalprice, 2, '.', '');
}
else
{
$calcy = $price / 100 * $discount; 
$finalprice = $price - $calcy;
$discountmsg ="($discount% off!)";
$fp = number_format((float)$finalprice, 2, '.', '');
}

    echo "<div class='col-md-11 col-lg-2 col-sm-5' style='margin-right:10px;margin-bottom: 10px;'>
    <div class='card'>
    <img src='$image' class='card-img-top' alt='$productName' style='margin-top:10px'>
    <div class='card-body'>
    <h5 class='card-title'>$productName</h5>
    ";
    echo "<form action='php/addtocart.php' method='post' role='form'>
    <input type='hidden' name='id' value='$itemid'>
  <p class='card-text'>£$fp $discountmsg</p>
<p><input type='submit' class='btn btn-success' value='Add to cart'></p></form>
</div></div></div>";

}
echo "</div></div>";
?>