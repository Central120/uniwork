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
  <h5>Filters</h5>
  <br>
  <div class = 'btn-group' role = 'group'>
  <form action='filters.php' method='post' class='filterfrm'>
    <input type='hidden' value='all' name='category'>
    <input type='submit' value='all' class='btn btn-success'>
    </form>
    <form action='filters.php' method='post' class='filterfrm'>
    <input type='hidden' value='discount' name='category'>
    <input type='submit' value='discount' class='btn btn-success'>
    </form>
  <?php
  // find categories
  $categories = "SELECT DISTINCT `category` FROM `products`";
  $findcategories = mysqli_query($conn, $categories);
  while ($rowcategories = $findcategories->fetch_assoc())
  {
    $cat = $rowcategories['category'];
    echo "<form action='filters.php' method='post' class='filterfrm'>
    <input type='hidden' value='$cat' name='category'>
    <input type='submit' value='$cat' class='btn btn-success'>
    </form>";
  }
  ?>
  </div>
  <div id = "filtershow">
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
    if ($discount == '0')
{
$finalprice = $price;
$discountmsg="";
$fp = number_format((float)$finalprice, 2, '.', '');
}
else
{
$calcy = $price / 100 * $discount; 
$finalprice = $price - $calcy;
$discountmsg ="($discount% off!)";
$fp = number_format((float)$finalprice, 2, '.', '');
}
if ($stock <= '5' && $stock != '0')
{
$stockmsg = "<p style ='color:red'> Hurry, there is only $stock of this item left.</p>";
$disabled = "";
}
else if ($stock == '0')
{
$stockmsg = "<p style ='color:red'> Sorry, this item is out of stock </p>";
$disabled = "disabled";
}
else
{
$stockmsg = "<p style ='color:red'> There are $stock of this item left.</p>";
$disabled = "";
}

    echo "<div class='col-md-11 col-lg-2 col-sm-5' style='margin-right:10px;margin-bottom: 10px;'>
    <div class='card'>
    <img src='$image' class='card-img-top' alt='$productName' style='margin-top:10px'>
    <div class='card-body'>
    <h5 class='card-title'>$productName</h5>
    ";
    echo "<form action='php/addtocart.php' method='post' role='form'>
    <input type='hidden' name='id' value='$itemID'>
  <p class='card-text'>£$fp $discountmsg</p>
  <select name ='quantity' class = 'form-control'>
  ";
  for($i=0;$i<=$stock;$i++)
  {
    if($i==0){
      echo "<option disabled selected> Out Of Stock </option>";
    }
    else if ($i==1) {
    echo "<option value = '$i' selected>$i</option>";  
    }
    else {
    echo "<option value = '$i'>$i</option>";
  }
}




echo "</select><p><input type='submit' $disabled class='btn btn-success' value='Add to cart'></p>$stockmsg</form>
</div></div></div>";

  }
?>

</div>
</div>
</div>
</div>
<?php include "inc/footer.php"; ?>
</body>
<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
  <script type='text/javascript'>
    $('.filterfrm').submit(function(event) {
      event.preventDefault(); //prevent default action
      var post_url = $(this).attr('action'); //get form action url
      var form_data = $(this).serialize(); //Encode form elements for submission

      $.ajax({
        url: post_url,
        type: 'post',
        data: form_data
      }).done(function(response) { //
        $('#filtershow').html(response);

      });
    });
  </script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
</html>
