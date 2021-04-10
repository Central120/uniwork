<?php
include_once '../inc/dbconnect.php';
session_start();

if(isset($_SESSION['admin']))
{
    $session_usern = $_SESSION['admin'];
}
else
{
    echo "<script>window.location.replace('../index');</script>";
}

$product_id = mysqli_real_escape_string($conn, $_POST['id']);
$sqlfindproduct = "SELECT * FROM `products` WHERE `id` = '$product_id'";
$findproduct = mysqli_query($conn, $sqlfindproduct);
$countfindproduct = mysqli_num_rows($findproduct);

if ($countfindproduct != 0)
{
    $rowfindproduct = mysqli_fetch_assoc($findproduct);
    $product = $rowfindproduct['product_name'];
    $price = $rowfindproduct['price'];
    $error_message = "";
}
else
{
    $error_message = "<div class='alert alert-danger alert-dismissable fade show' role='alert'><strong>An error occured.</strong> The product could not be found. <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span>
  </button></div>";
}

?>

<!doctype html>
<html lang="en">
  <head>
  	<title>Kerry's K9's - Add a discount to <?php echo $product; ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
   	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
     <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700' rel='stylesheet' type='text/css' />
     <style>
         .formCenter 
         {
             <?php 
            if ($countfindproduct == "")
            {
                echo ".container-fluid
                {
                 display:none;    
                }";
            }
        
             ?>
            position: absolute;
            top: 35%;
            left: 50%;
            transform: translate(-50%, -50%);
            margin-top:5%;
         }

         .footer
         {
           margin-top:20% !important;
         }
     </style>
    
</head>
<body>
<div><?php echo $error_message; ?></div>
    <?php include "inc/header.php"; ?>
    <div class="container-fluid">
    <div class="d-flex justify-content-center">
        <center>
        <br><div id="server-results"></div>
    <h2 class="mb-42">Add a discount to <?php echo $product; ?></h2>
    <form action='php/add-discount.php' method='post' id='discount'>
 <div class="form-group">
 <label for="price">Current Price</label>
         <p><?php echo "£$price"; ?></p>
         </div>
         <div class="form-group">
         <label for="discount">Discount</label>
         <select name='discount' id='discount_sel' class='form-control'>
        <?php 
        for ($i=1;$i<=100;$i++)
        {
            echo "<option value='$i'>$i</option>";
        }
        ?>
         </select>
         </div>
         <div class="form-group">
         <p><button id='calculate'>Calculate Final Amount</button></p>
         <br>
         <p>Final Amount: £<span id='final'></span></p>
         </div>
  <div class="form-group row">
    <div class="col-sm-10">
      <button type="submit" class="btn btn-success">Add Discount</button>
    </div>
  </div>
        </center>
</form>
</div>
        </div>
    <?php include "inc/footer.php"; ?>
</body>

<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script>
 $(document).ready(function(){
        $('#calculate').click(function()
        {
          var price = "<?php echo $price; ?>";
          var discount = $('#discount_sel option:selected').val();
          var calculation = price / 100 * discount;
          var amount = price - calculation; 
          var result = amount.toFixed(2);
          $('#final').html(result);
          
        });
      });

 
</script>

  <script type='text/javascript'>
    $('#discount').submit(function(event) {
      event.preventDefault(); //prevent default action
      var post_url = $(this).attr('action'); //get form action url
      var form_data = $(this).serialize(); //Encode form elements for submission

      $.ajax({
        url: post_url,
        type: 'post',
        data: form_data
      }).done(function(response) { //
        $('#server-results').html(response);

      });
    });
  </script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
</html>