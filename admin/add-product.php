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
    <h2 class="mb-42">Add a new product</h2><br>
    <div id="server-results"></div>
    <div class="container">
    <div class="d-flex justify-content-center">
    <form action='php/add-product.php' method='post' enctype="multipart/form-data">
    <div class="custom-file" style='margin-bottom: 10px'>
    <input type="file" class="file-input" name="image_upload" id="image">
    <label class="custom-file-label" for="image" style='word-break:break-word'>Choose Image</label>
    </div>
    <p>
  <div class="form-group">
    <label for="product_name">Product Name</label>
    <input type="text" name="product_name" class="form-control" id="product_name" placeholder="Product Name">
  </div><br>
  <div class="custom-control custom-radio custom-control-inline" style='margin-bottom:5px'>
  <input type="radio" id="existing_category" name="category" value='existing' class="custom-control-input">
  <label class="custom-control-label" for="existing_category">Use an existing category</label>
</div>
<div class="custom-control custom-radio custom-control-inline" style='margin-bottom:5px'>
  <input type="radio" id="new_category" name="category" value='new' class="custom-control-input">
  <label class="custom-control-label" for="new_category">Create a new category</label>
</div><br>
<div style='display:none;' class="form-group" id="existing_input">
<label for='existing_select'>Choose a category</label>
<select class="form-control" id='existing_select' name="existing">
<?php 
$sqlfindexisting = "SELECT DISTINCT `category` FROM `products`";
$findexisting = mysqli_query($conn, $sqlfindexisting);
$countfindexisting = mysqli_num_rows($findexisting);

if ($countfindexisting != 0)
{
    while ($rowfindexisting = $findexisting->fetch_assoc())
    {
        $category = $rowfindexisting['category'];
        echo "<option value='$category'>$category</option>";
    }
}
else
{
    echo "<option disabled>Could not find any categories - Please create a new one</option>";
}
?>
</select>
</div><br>
<div style='display:none;' class="form-group" id="new_category_input">
    <label for="new_cat">New Category Name</label>
    <input type="text" class="form-control" id="new_cat" name="new" placeholder="Enter new category name">
  </div><br>
<div class="form-group">
<label for="price">Price</label>
<input type="number" pattern="^\d+(\.|\,)\d{2}$" step="0.01" name="price" value="0.00" min='0' class="form-control">
</div><br>
<div class="form-group">
    <label for="discount">Discount</label>
    <input type="number" class="form-control" min='0' max='100' name="discount" value='0' id="discount">
  </div><br>
  <div class="form-group">
    <label for="stock">Stock</label>
    <input type="number" min='0' pattern="[0-9]" name="stock" class="form-control" id="stock">
  </div><br>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>
</div>
<?php include "inc/footer.php"; ?>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script>
$(".file-input").on("change", function() {
  var fileName = $(this).val().split("\\").pop();
  $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});

$(document).ready(function() {
    $('input:radio[name=category]').change(function() {
        if (this.value == 'existing') {
            $('#new_category_input').css('display', 'none');
            $('#existing_input').css('display', '');
            $('#new_cat').val('');
            $('#new_cat').attr('disabled', 'disabled');
            $('#existing_select').removeAttr('disabled');
            console.log('existing');
        }
        else if (this.value == 'new') {
            $('#existing_input').css('display', 'none');
            $('#new_category_input').css('display', '');
            console.log('new');
            $('#existing_select').attr('disabled', 'disabled');
            $('#new_cat').removeAttr('disabled');
        }
        else
        {
            $('#new_category_input').css('display', 'none');
            $('#existing_input').css('display', 'none');
            $('#new_cat').val('');
            console.log('none');
        }
    });
});
</script>
</html>