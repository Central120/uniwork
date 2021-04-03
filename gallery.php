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


$findcurrentbookings = mysqli_query($conn, "SELECT * FROM `bookings` WHERE `username` = '$session_usern'");

?>
<!doctype html>
<html lang="en">
  <head>
  	<title>Kerry's K9's - Image Gallery</title>
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

    .center {
  margin: auto;
  width: 60%;
  border: 3px solid #73AD21;
  padding: 10px;
}
     </style>
</head>
<body>
    <?php include "inc/header.php"; ?>
    <br><br><br>
    <center>
    <div class="row">

      <?php

      $imageQuery = $mysqli_query($conn, "SELECT * FROM products WHERE approver != 'Pending'");
      
      while($row = mysqli_fetch_array($imageQuery))
      {
          $author = $row['username'];
          $productName = $row['product_name'];
          $caption = $row['caption'];
          $imageTimestamp = $row['timestamp'];
          $pLocation = $row['p_location'];
          ?>
      

      <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
        <div class="bg-dark rounded shadow-sm"><img src="<?php echo $pLocation; ?> alt="" class="img-fluid card-img-top">
          <div class="p-4">
            <h5> <a href="#" class="text-white"><?php echo $productName; ?></a></h5>
            <p class="small text-white mb-0"><?php echo $caption; ?></p>
            <div class="d-flex align-items-center justify-content-between rounded-pill bg-light px-3 py-2 mt-4">
              <p class="small mb-0"><i class="fa fa-user-o mr-2"></i><span class="font-weight-bold"><?php echo $author; ?></span></p>
              <div class="badge badge-danger px-3 rounded-pill font-weight-normal"><?php echo $imageTimestamp; ?></div>
            </div>
          </div>
        </div>
      </div>

      <?php
      }
      ?>
      

      

     </center>
  <?php include "inc/footer.php"; ?>
</body>
<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>

<script type="text/javascript">
const myCarousel = document.querySelector('#myCarousel')
const carousel = new mdb.Carousel(myCarousel)
</script>

  <script type='text/javascript'>
    $('#Form1').submit(function(event) {
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