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

    .imageCenter {
  margin: auto;

  padding: 10px;
}
     </style>
</head>
<body>
    <?php include "inc/header.php"; ?>
    <br><br><br>
    <center>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">Upload yours!</button>
    </center>
    <div class="imageCenter">
    <div class="row">

      <?php

      $imageQuery = mysqli_query($conn, "SELECT * FROM photo_sharing WHERE approver != 'pending'");
      
      while($row = mysqli_fetch_array($imageQuery))
      {
        $imageid = $row['id'];
          $author = $row['username'];
          $productName = $row['product_name'];
          $caption = $row['caption'];
          $imageTimestamp = $row['timestamp'];
          $pLocation = $row['p_location'];
          ?>
      

      <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
        <div class="bg-dark rounded shadow-sm"><img src="/<?php echo $pLocation; ?>" alt="" class="img-fluid card-img-top" style="width: 100%; height: 250px; object-fit: cover;">
          <div class="p-4">
            <h5> <a href="#" class="text-white"><?php echo $productName; ?> </a></h5> <div style="float: right;"><input type='button' data-toggle='modal' id='cancel_btn' data-target='<?php echo "#manage{$imageid}";?>' class='btn btn-primary' value='Report Image' /> </div>
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
       

    </div>
    </div>

    <!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Upload your image!</h5>
        
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        
      </div>
      
      <div class="modal-body">
      <small>Your image will be put as pending whilst our team approves your submission.</small>
      <form action="php/upload-photo" method="post" enctype='multipart/form-data'>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Image Title</label>
            <input type="text" class="form-control" name="title" id="image-title" placeholder="E.g. Dog Biscuits">
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Image Description:</label>
            <input type="text" class="form-control" name="caption" id="image-description" placeholder="E.g. My little border collie enjoyed them!">
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Upload Photo:</label>
            <input type="file" class="form-control-file" name="image_upload" id="exampleFormControlFile1" accept="image/*">
          </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-success">Upload</button>
        </form>
      </div>
    </div>
  </div>
</div>

<div class='modal fade' id='<?php echo "manage{$imageid}"; ?>' tabindex='-1' role='dialog' aria-labelledby='<?php echo "manage{$imageid}"; ?>' aria-hidden='true'>
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Upload your image!</h5>
        
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        
      </div>
      
      <div class="modal-body">
      <small>Your image will be put as pending whilst our team approves your submission.</small>
      <form action="php/upload-photo" method="post" enctype='multipart/form-data'>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Image Title</label>
            <input type="text" class="form-control" name="title" id="image-title" placeholder="E.g. Dog Biscuits">
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Image Description:</label>
            <input type="text" class="form-control" name="caption" id="image-description" placeholder="E.g. My little border collie enjoyed them!">
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Upload Photo:</label>
            <input type="file" class="form-control-file" name="image_upload" id="exampleFormControlFile1" accept="image/*">
          </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-success">Upload</button>
        </form>
      </div>
    </div>
  </div>
</div>

  <?php include "inc/footer.php"; ?>
</body>
<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>

<script type="text/javascript">
const myCarousel = document.querySelector('#myCarousel')
const carousel = new mdb.Carousel(myCarousel)
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
</html>