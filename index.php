<?php
include_once 'inc/dbconnect.php';
session_start();


?>

<!doctype html>
<html lang="en">
  <head>
  	<title>Kerry's K9's - Home</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
   	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
     <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700' rel='stylesheet' type='text/css' />

		<style>
  .footer 
  {
    margin-top: 20% !important; 
  }
    </style>
  </head>
  <body>
  <?php include "inc/header.php"; ?>
<center>
  <h2 class="mb-4">Welcome to Kerry's K9's!</h2><br>
  <p>Below are the most recent announcements.</p>
  <br>
  <p><?php
$sqlfinddiscounts = "SELECT * FROM `products` WHERE `discount` != '0'";
$finddiscount = mysqli_query($conn, $sqlfinddiscounts);
$countfinddiscount = mysqli_num_rows($finddiscount);

if ($countfinddiscount == '0')
{
$discount_message = "We currently have no discounts on offer. Try again later!";
$discount_style = "";
}
else
{
$discount_message = "The products we currently have discounted are:<br>";
echo $discount_message;
while ($rowfinddiscount = $finddiscount->fetch_assoc())
{
$image =$rowfinddiscount['image'];
$product_name = $rowfinddiscount['product_name'];
$price = $rowfinddiscount['price'];
$discount = $rowfinddiscount['discount'];

$discountcalc = $price / 100 * $discount; 
$new_price = $price - $discountcalc; 
$formatting = number_format((float)$new_price, 2, '.','');

$discount_style = "<h5 style='display:list-item;'>$product_name - FROM: £$price, NOW: £$formatting ($discount% off!)</h5>";

echo $discount_style; 
}
}
echo "<br>";
?>
</p>
</center>


<?php include "inc/footer.php"; ?>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
</html>
