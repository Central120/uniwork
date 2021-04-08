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


?>

<!doctype html>
<html lang="en">
  <head>
  	<title>Kerry's K9's - Cart</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
   	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
     <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700' rel='stylesheet' type='text/css' />

		
  </head>
  <body>
  <?php include "inc/header.php"; ?>
  <div class="container" style='min-height:40vh'>
  <center>
  <h2 class="mb-4">Cart</h2>
  <p>
  <h2 class="mb-4">This is your shopping bag</h2>
  </p>
  <div class="row">
 <div class="col-12">
 <div class="table-responsive">
 <table class="table table-striped">
 <thead>
<tr>
 <th scope="col">Image</th>
 <th scope="col">Product</th>
 <th scope="col">Price</th>
 <th scope="col">Quantity</th>
 <th>Manage</th>
</tr>
</thead>
<tbody>
<?php
$sqlfindcart = "SELECT cart.product, cart.price, cart.quantity, products.Image FROM `cart` LEFT JOIN `products` ON cart.product = products.product_name WHERE `username` = '$session_usern'";
$findcart = mysqli_query($conn,$sqlfindcart);
while($rowfindcart = $findcart->fetch_assoc())
{
    $image = $rowfindcart['Image'];
    $product = $rowfindcart['product'];
    $price = $rowfindcart['price'];
    $quantity = $rowfindcart['quantity'];
    $finalprice1 = $price * $quantity; 
    $finalprice = number_format((float)$finalprice1, 2, '.','');

    $total = $finalprice + $total;
    $total1 = number_format((float)$total1, 2, '.','');
    echo "
<tr>
<td><img src='$image' style = 'height:100px; width:100px;'></td>
<td>$product</td>
<td>$finalprice</td>
<td>$quantity</td>
<td></td>
</tr>
"; 
}
?>
<tr>
<td></td>
<td></td>
<td></td>
<td></td>
<td><strong>Total</strong></td>
<td class="text-right" id='Fin_Tota'><strong>£<?php if ($total == '') {echo "0"; } else {echo $total1; } ?></strong></td>
</tr>

</tbody>
</table>
</div>
</div>
<div class="col mb-2">
<div class="row">
<div class="col-sm-12  col-md-6">
<button id='continue' class="btn btn-lg btn-block btn-info">Continue Shopping</button>
</div>
<div class="col-sm-12 col-md-6 text-right">
<button class="btn btn-lg btn-block btn-success text-uppercase">Checkout</button>
</div>
</div>
</div>
</div>
</div>
?>
</center>
  </div>
<?php include "inc/footer.php"; ?>
</body>
<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
</html>
