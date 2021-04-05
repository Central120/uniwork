<?php
include_once 'inc/dbconnect.php';
session_start();


?>

<!doctype html>
<html lang="en">
  <head>
  	<title>Kerry's K9's - Shop</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
   	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
     <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700' rel='stylesheet' type='text/css' />

		
  </head>
  <body>
  <?php include "inc/header.php"; ?>
  <div class="container-fluid" style='min-height:40vh'>
  <h2 class="mb-4">Welcome to Kerry's K9's shop!</h2>
  <p>Store Page</p>
  <br>
  <div class="container-fluid">
  <div class="row">
  <?php 
$sql = mysqli_query($conn, "SELECT * FROM products");

while($row = mysqli_fetch_assoc($sql))
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
?>

</div>
</div>
</div>

<?php include "inc/footer.php"; ?>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
</html>
