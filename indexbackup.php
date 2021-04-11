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
    
    <!-- Card -->
<div class="card">

<div class="view zoom overlay">
  <img class="img-fluid w-100" src="https://mdbootstrap.com/img/Photos/Horizontal/E-commerce/Vertical/13a.jpg" alt="Sample">
  <h4 class="mb-0"><span class="badge badge-primary badge-pill badge-news">Sale</span></h4>
  <a href="#!">
    <div class="mask">
      <img class="img-fluid w-100"
        src="https://mdbootstrap.com/img/Photos/Horizontal/E-commerce/Vertical/13.jpg">
      <div class="mask rgba-black-slight"></div>
    </div>
  </a>
</div>

<div class="card-body text-center">

  <h5>Fantasy T-shirt</h5>
  <p class="small text-muted text-uppercase mb-2">Shirts</p>
  <ul class="rating">
    <li>
      <i class="fas fa-star fa-sm text-primary"></i>
    </li>
    <li>
      <i class="fas fa-star fa-sm text-primary"></i>
    </li>
    <li>
      <i class="fas fa-star fa-sm text-primary"></i>
    </li>
    <li>
      <i class="fas fa-star fa-sm text-primary"></i>
    </li>
    <li>
      <i class="far fa-star fa-sm text-primary"></i>
    </li>
  </ul>
  <hr>
  <h6 class="mb-3">
    <span class="text-danger mr-1">$12.99</span>
    <span class="text-grey"><s>$36.99</s></span>
  </h6>

  <button type="button" class="btn btn-primary btn-sm mr-1 mb-2">
    <i class="fas fa-shopping-cart pr-2"></i>Add to cart
  </button>
  <button type="button" class="btn btn-light btn-sm mr-1 mb-2">
    <i class="fas fa-info-circle pr-2"></i>Details
  </button>
  <button type="button" class="btn btn-danger btn-sm px-3 mb-2 material-tooltip-main" data-toggle="tooltip" data-placement="top" title="Add to wishlist">
    <i class="far fa-heart"></i>
  </button>

</div>

</div>
<!-- Card -->
    
    
    
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
