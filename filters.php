<?php
include "inc/dbconnect.php";
$category1 = mysqli_real_escape_string($conn, $_POST['category']);
if ($category1 == "all")
{
    $cat = "SELECT * FROM `products`";
} 
else {
    $cat = "SELECT * FROM `products` WHERE `category1` = '$category1'";
}
// find the items in the category.

$findcat = mysqli_query($conn, $cat);
echo "<div class='container-fluid'>
<div class='row'>";
while ($rowcat = $findcat->fetch_assoc())
{
    $itemID = $row['id'];
    $productName = $row['product_name'];
    $category = $row['category'];
    $price = $row['price'];
    $discount = $row['discount'];
    $stock = $row['stock'];
    $image = $row['Image'];

    echo "<div class='col-md-11 col-lg-2 col-sm-5' style='margin-right:10px;margin-bottom: 10px;'>
    <div class='card'>
    <img src='$image' class='card-img-top' alt='$productName' style='margin-top:10px'>
    <div class='card-body'>
    <h5 class='card-title'>$productName</h5>
    ";
    echo "<form action='php/addtocart.php' method='post' role='form'>
    <input type='hidden' name='id' value='$itemid'>
  <p class='card-text'>£$price</p>
<p><input type='submit' class='btn btn-success' value='Add to cart'></p></form>
</div></div></div>";

}
echo "</div></div>";
?>