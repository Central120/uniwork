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
  <?php 
$sql = mysqli_query($conn, "SELECT * FROM products");

while($row = mysqli_fetch_assoc($sql))
{
    $productName = $row['product_name'];
    $category = $row['category'];
    $price = $row['price'];
    $discount = $row['discount'];
    $stock = $row['stock'];
    $image = $row['Image'];

    echo "<table>";
    echo "<tr>";
    echo "<td>$productName</td>";
    echo "<td>£$price</td>";
    echo "<td><img src='$image'></td>";
    echo "</tr>";
    echo "</table>";
}
?>

</div>

<?php include "inc/footer.php"; ?>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
</html>
