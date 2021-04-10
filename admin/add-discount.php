<?php
include_once 'inc/dbconnect.php';
session_start();
$current_timestamp = date('Y-m-d H:i:s');

if(isset($_SESSION['admin']))
{
    $session_usern = $_SESSION['admin'];
}
else
{
    echo "<script>window.location.replace('../index');</script>";
}

$sqlfindproducts = "SELECT * FROM `products` ORDER BY `category`";
$findproducts = mysqli_query($conn, $sqlfindproducts);

?>
<!doctype html>
<html lang="en">
  <head>
  	<title>Kerry's K9's - Add a discount</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
   	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
     <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700' rel='stylesheet' type='text/css' />
     
     <style>
    .footer 
    {
        margin-top:10% !important;
    }
     </style>
</head>
<body>
    <?php include "inc/header.php"; ?>
  
        <center>
    <h2 class="mb-42">Add a discount</h2>
    <div id="server-results"></div>
    <div class="container" style='margin-bottom: 30%'>
    <div class="d-flex justify-content-center">
    <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Image</th>
                            <th scope="col">Product</th>
                            <th scope="col">Category</th>
                            <th scope="col">Price</th>
                            <th scope="col">Current discount</th>
                            <th>Manage</th>
                        </tr>
                    </thead>
                    <tbody>
  <?php
    while ($rowfindproducts = $findproducts->fetch_assoc())
    {
        $image = $rowfindproducts['Image'];
        $productid = $rowfindproducts['id'];
        $product = $rowfindproducts['product_name'];
        $category = $rowfindproducts['category'];
        $price = $rowfindproducts['price'];
        $discount = $rowfindproducts['discount'];
        
        if($discount == "0"){
            $discountmsg = "$product currently has no discount applied";
        }
        else{
            $discountmsg = "$product currently has a $discount% discount applied";
        }
        
        echo "<tr>
        <td><img src='../$image' style='height: 100px; width: 100px;'/></td>
        <td>$product</td>
        <td>$category</td>
        <td>$price</td>
        <td>$discountmsg</td>
        <td><input type='button' data-toggle='modal' id='cancel_btn' data-target='#discount{$productid}' class='btn btn-warning' value='Manage discount' /></td>
        </tr>
        ";

        echo "<div class='modal fade' id='discount{$productid}' tabindex='-1' role='dialog' aria-labelledby='discount{$productid}' aria-hidden='true'>
        <div class='modal-dialog' role='document'>
          <div class='modal-content' style='width:150%;left:-10%;'>
            <div class='modal-header'>
              <h5 class='modal-title'>What would you like to do with $product?</h5>
              <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
              </button>
            </div>
            <div class='modal-footer'>
            ";
                   
           echo "
            <form action='new-discount.php' method='post' role='form'>
            <input type='hidden' value='$productid' name='id' />
              <button type='submit' class='btn btn-success'>Add a discount</button>
            </form>
            <form action='modify-discount.php' method='post' role='form'>
            <input type='hidden' value='$productid' name='id' />
              <button type='submit' class='btn btn-warning'>Modify discount</button>
            </form>
              <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
            </div>
          </div>
        </div>
      </div>";

    }


?>
 </tbody>
                </table>
            </div>
        </div>
        </div>
  <?php include "inc/footer.php"; ?>
</body>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
</html>