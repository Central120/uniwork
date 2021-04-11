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

<div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="..." class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5>First slide label</h5>
        <p>Some representative placeholder content for the first slide.</p>
      </div>
    </div>
    <div class="carousel-item">
      <img src="..." class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5>Second slide label</h5>
        <p>Some representative placeholder content for the second slide.</p>
      </div>
    </div>
    <div class="carousel-item">
      <img src="..." class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5>Third slide label</h5>
        <p>Some representative placeholder content for the third slide.</p>
      </div>
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
<?php

}
?>
 
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
