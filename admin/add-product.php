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
    <h2 class="mb-42">Add a new product</h2>
    <div id="server-results"></div>
    <div class="container">
    <form action='php/add-product.php' method='post'>
    <div class="custom-file">
    <input type="file" class="file-input" id="image">
    <label class="custom-file-label" for="image">Choose Image</label>
    </div>
  <div class="form-group">
    <label for="product_name">Product Name</label>
    <input type="text" class="form-control" id="product_name" placeholder="Product Name">
  </div>
  <div class="custom-control custom-radio custom-control-inline">
  <input type="radio" id="existing_category" name="category" class="custom-control-input">
  <label class="custom-control-label" for="existing_category">Use an existing category</label>
</div>
<div class="custom-control custom-radio custom-control-inline">
  <input type="radio" id="new_category" name="category" class="custom-control-input">
  <label class="custom-control-label" for="new_category">Create a new category</label>
</div>
<div style='display:none;' class="form-group" id="existing">
<select class="form-control" name="existing">
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
</div>
<div style='display:none;' class="form-group" id="new_category">
    <label for="new_cat">New Category Name</label>
    <input type="text" class="form-control" id="new_cat" placeholder="Enter new category name">
  </div>
<div class="form-group">
<label for="price">Price</label>
<input type="number" pattern="^\d+(\.|\,)\d{2}$" class="form-control">
</div>
<div class="form-group">
    <label for="discount">Discount</label>
    <input type="number" class="form-control" min='0' max='100' id="discount">
  </div>
  <div class="form-group">
    <label for="stock">Stock</label>
    <input type="number" class="form-control" id="stock">
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
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
$('#existing_category').click(function() {
   if($('#existing_category').is(':checked')) { 
       $('#new_category').css('display', 'none');
       $('#existing_category').css('display', '');
       $('#new_cat').html('');
}
});
$('#new_category').click(function() {
   if($('#new_category').is(':checked')) { 
       $('#existing_category').css('display', 'none');
       $('#new_category').css('display', '');
}
});

</script>
</html>