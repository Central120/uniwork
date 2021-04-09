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
  <div id = "server-results"></div>
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
$sqlfindcart = "SELECT cart.id, cart.product, cart.price, cart.quantity, products.Image, products.stock FROM `cart` LEFT JOIN `products` ON cart.product = products.product_name WHERE `username` = '$session_usern'";
$findcart = mysqli_query($conn,$sqlfindcart);
while($rowfindcart = $findcart->fetch_assoc())
{
    $id = $rowfindcart['id'];
    $image = $rowfindcart['Image'];
    $product = $rowfindcart['product'];
    $price = $rowfindcart['price'];
    $quantity = $rowfindcart['quantity'];
    $stock = $rowfindcart['stock'];
    $finalprice1 = $price * $quantity; 
    $finalprice = number_format((float)$finalprice1, 2, '.','');

    $total1 = $finalprice1 + $total;
    $total = number_format((float)$total1, 2, '.','');
    echo "
<tr>
<td><img src='$image' style = 'height:100px; width:100px;'></td>
<td>$product</td>
<td>£$finalprice</td>";
echo "<form action = 'php/modify-quantity.php' method = 'post' class = 'modify_form'><td><select name = 'quantity' class = 'form-control'>";
for($i=0;$i<=$quantity;$i++){
    if($i==$quantity){
        echo "<option value = '$i' selected> $i</option>";
    }
    else {
        echo "<option value = '$i'>$i</option>";
    }
}
echo"
</select></td>
<td><input type='button' data-toggle='modal' id='manage' data-target='#quantity{$id}' class='btn btn-success' value='Manage' /></td>
</tr>
"; 
echo "<div class='modal fade' id='quantity{$id}' tabindex='-1' role='dialog' aria-labelledby='quantity{$id}' aria-hidden='true'>
<div class='modal-dialog' role='document'>
<div class='modal-content'>
<div class='modal-header'>
<h5 class='modal-title'>How would you like to continue?</h5>
<button type='button' class='close' data-dismiss='modal' aria-label='Close'>
<span aria-hidden='true'>&times;</span>
</button>
</div>
<div class='modal-body'>
<p style='color: red'>Make sure that you update your quantity on the dropdown box before continuing.</p>
</div>
<div class='modal-footer'>
";
                        
                     
echo " <input type='hidden' value='$id' name='id' />
<button type='submit' class='btn btn-info'>Update Quantities</button>
</form>";
echo "
<form action='php/delete-item.php' class='modify_form' method='post' role='form'>
<input type='hidden' value='$id' name='id' />
  <button type='submit' class='btn btn-danger'>Remove from Cart</button>
</form>
  <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
</div>
</div>
</div>
</div>";

echo "<script type='text/javascript'>
$('.modify_form').submit(function(event) {
event.preventDefault(); //prevent default action
var post_url = $(this).attr('action'); //get form action url
var form_data = $(this).serialize(); //Encode form elements for submission

$.ajax({
url: post_url,
type: 'post',
data: form_data
}).done(function(response) { //
$('#server-results').html(response);
$('#quantity{$id}').modal('hide');
});
});
</script>";
}
?>
<tr>

<td></td>
<td></td>
<td></td>
<td><strong>Total</strong></td>
<td class="text-right" id='Fin_Tota'><strong>£<?php if ($total == '') {echo "0"; } else {echo $total; } ?></strong></td>
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
<script>
$('#continue').click(function(){
    window.location.replace('shop');
});
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
</html>
