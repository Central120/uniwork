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

  .card {display:inline-block; margin-bottom: 10px; }
    </style>
  </head>
  <body>
  <?php include "inc/header.php"; ?>
<center>
  <h2 class="mb-4">Welcome to Kerry's K9's!</h2><br>
  <p>

  <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
  </ol>
  
 

  
  <?php

$imageQuery = mysqli_query($conn, "SELECT * FROM photo_sharing WHERE approver != 'pending' LIMIT 5");

while($row = mysqli_fetch_array($imageQuery))
{
  $imageid = $row['id'];
    $author = $row['username'];
    $productName = $row['product_name'];
    $caption = $row['caption'];
    $imageTimestamp = $row['timestamp'];
    $pLocation = $row['p_location'];
    ?>


			
<div class="carousel-inner" role="listbox">
    <div class="carousel-item active">
			<p class="carouselTitle">Arashiyama</p>
      <img src="http://kclui.com/IVEST/ITP4208/images/BS4Carousel/carousel-1.jpg" alt="First slide">
    </div>
    <div class="carousel-item">
			<p class="carouselTitle">Uji</p>
      <img src="http://kclui.com/IVEST/ITP4208/images/BS4Carousel/carousel-2.jpg" alt="Second slide">
    </div>
    <div class="carousel-item">
			<p class="carouselTitle">Kiyomizu-dera</p>
      <img src="http://kclui.com/IVEST/ITP4208/images/BS4Carousel/carousel-3.jpg" alt="Third slide">
    </div>
  </div>
		
<?php

}
?>
	
  <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
    <span class="icon-prev" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
    <span class="icon-next" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
  </div>
    <?php
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
$image =$rowfinddiscount['Image'];
$product_name = $rowfinddiscount['product_name'];
$price = $rowfinddiscount['price'];
$discount = $rowfinddiscount['discount'];

$discountcalc = $price / 100 * $discount; 
$new_price = $price - $discountcalc; 
$formatting = number_format((float)$new_price, 2, '.','');

?>
<div class="card" style="width: 18rem;">
  <img class="card-img-top" src="<?php echo $image; ?>" alt="Card image cap">
  <div class="card-body">
    <h5 class="card-title"><?php echo $product_name; ?></h5>
    <p class="card-text"><s><?php echo "<font color='red'>£".$price."</font>"; ?></s> <?php echo "£" . $formatting; ?></p>
  </div>
</div>
<?php



#$discount_style = "<img src='$image' style='height: 100px; width: 100px;'/><h5 style='display:list-item;'>$product_name - FROM: £$price, NOW: £$formatting ($discount% off!)</h5>";

#echo $discount_style; 
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
