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
  <p>
    
  <div class="block">

<div class="top">
  <ul>
    <li><a href="#"><i class="fa fa-star-o" aria-hidden="true"></i></a></li>
    <li><span class="converse">Converse</span></li>
    <li><a href="#"><i class="fa fa-shopping-basket" aria-hidden="true"></i>
</a></li>
  </ul>
</div>

<div class="middle">
  <img src="https://www.converse.com/on/demandware.static/-/Sites-ConverseMaster/default/dw33d36cdd/images/hi-res/654210C_standard.jpg?sw=580&sh=580&sm=fit" alt="pic" />
</div>

<div class="bottom">
  <div class="heading">Chuck Taylor All Star Neon Floral Yth/Jr</div>
  <div class="info">Neon converse edition</div>
  <div class="style">Color: Black/White/Aegean Aqua / Style: 654210C</div>
  <div class="price">$35.00 <span class="old-price">$45.00</span></div>
</div>

</div>
    
    
    
    <?php
#$sqlfinddiscounts = "SELECT * FROM `products` WHERE `discount` != '0'";
#$finddiscount = mysqli_query($conn, $sqlfinddiscounts);
#$countfinddiscount = mysqli_num_rows($finddiscount);

#if ($countfinddiscount == '0')
#{
#$discount_message = "We currently have no discounts on offer. Try again later!";
#$discount_style = "";
#}
#else
#{
#$discount_message = "The products we currently have discounted are:<br>";
#echo $discount_message;
#while ($rowfinddiscount = $finddiscount->fetch_assoc())
#{
#$image =$rowfinddiscount['Image'];
#$product_name = $rowfinddiscount['product_name'];
#$price = $rowfinddiscount['price'];
#$discount = $rowfinddiscount['discount'];

#$discountcalc = $price / 100 * $discount; 
#$new_price = $price - $discountcalc; 
#$formatting = number_format((float)$new_price, 2, '.','');

#$discount_style = "<img src='$image' style='height: 100px; width: 100px;'/><h5 style='display:list-item;'>$product_name - FROM: £$price, NOW: £$formatting ($discount% off!)</h5>";

#echo $discount_style; 
#}
#}
#echo "<br>";
?>
</p>
</center>


<?php include "inc/footer.php"; ?>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
</html>
