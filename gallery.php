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
    <?php
    if($session_usern)
    {
      ?>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">Upload yours!</button>
    <?php
    }
    ?>
    </center>
    <div class="imageCenter">
    <div class="row">

      <?php

      $imageQuery = mysqli_query($conn, "SELECT * FROM photo_sharing WHERE approver != 'pending' ORDER BY timestamp");
      
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
            <h5> <a href="#" class="text-white"><?php echo $productName; ?> </a></h5> <div style="float: right; margin-right: 3px;">
            <?php
            if($author == $session_usern)
            {
              ?>
              <form action="php/user-delete-photo" method="post">
              <input type="hidden" name="imageid" value="<?php echo $imageid; ?>">
              <button class="btn btn-danger" type="submit"><i class="fa fa-trash"></i></button>
            </form>
              <?php
            }
            ?>
            </div>
            <div style="float: right; display: inline-block; margin-left: 5px;">
           <?php if($session_usern){?> <a href='#' type='button' data-toggle='modal' id='cancel_btn' data-target='<?php echo "#manage{$imageid}";?>' class='btn btn-primary'/ title='Report <?php echo $author, 's image';?>'><i class="fa fa-gavel"></i></a> <?php } ?>
            </div>
            <p class="small text-white mb-0"><?php echo $caption; ?></p>
            <div class="d-flex align-items-center justify-content-between rounded-pill bg-light px-3 py-2 mt-4">
              <p class="small mb-0"><i class="fa fa-user-o mr-2"></i><span class="font-weight-bold"><?php echo $author; ?></span></p>
              <div class="badge badge-danger px-3 rounded-pill font-weight-normal"><?php echo $imageTimestamp; ?></div>
            </div>
          </div>
        </div>
      </div>
      <div class='modal fade' id='<?php echo "manage{$imageid}"; ?>' tabindex='-1' role='dialog' aria-labelledby='<?php echo "manage{$imageid}"; ?>' aria-hidden='true'>
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Report Tools</h5>
        
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        
      </div>
      <form id="FormReport(<?php echo $imageid; ?>)" class="gallery" action="php/report-image" method="post">
      <div class="modal-body">
      <small>You're reporting: <?php echo $author; ?>.<br>Their image: <a href='/<?php echo $pLocation; ?>' target='_blank'>Click to view</a><br>The page will refresh and your report will be sent.</small>
      <div id="report-results"></div>
      
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Reason Option</label>
            <input type="hidden" name="reporter" value="<?php echo $session_usern; ?>">
            <input type="hidden" name="reporting" value="<?php echo $author; ?>">
            <input type="hidden" name="imageid" value="<?php echo $imageid; ?>">
            <select id="selectoption" name="reportoption" class="form-control" required>
              <option selected disabled>Please select...</option>
              <option value="Harassment">Harassment</option>
              <option value="Unpermitted use of image">Unpermitted use of Image</option>
              <option value="Spam">Spam</spam>
              <option value="Threat to Site">Threat to Site</option>
              <option value="Identity Theft">Identity Theft</option>
              <option value="Contains inappropriate language">Contains inappropriate language</option>
              <option id="other" value="other">Other</option>
            </select>
          </div>
          <div id="othergroup" class="form-group" style="display: none;">
            <label for="message-text" class="col-form-label">Other Reason Option</label>
            <input type="text" name="otheroption" id="otheroption" class="form-control">
          </div>

          <div class="form-group">
            <label for="message-text" class="col-form-label">Report Information</label>
            <textarea type="text" class="form-control" name="reportinformation" id="image-description" placeholder="E.g. More information..." required></textarea>
          </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-danger">Report</button>
        
      </div>
      </form>
    </div>
  </div>
</div>
<script type='text/javascript'>
    $('#FormReport<?php echo "(" . $imageid . ")"; ?>').submit(function(event) {
      event.preventDefault(); //prevent default action
      var post_url = $(this).attr('action'); //get form action url
      var form_data = $(this).serialize(); //Encode form elements for submission

      $.ajax({
        url: post_url,
        type: 'post',
        data: form_data
      }).done(function(response) { //
        $('#report-results').html(response);

      });
    });

    $(document).ready(function() {
    $('#selectoption other').change(function() {
      if ($(this).val() == 'other') {
            $('#othergroup').css('display', '');
            $('#otheroption').val('');
            $('#otheroption').prop('disabled', false);
        }
        else
        {
            $('#othergroup').css('display', 'none');
            $('#otheroption').val('');
            $('#otheroption').prop('disabled', true);
        }
    });
});

  </script>


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
      <small>Your image will be put as pending whilst our team approves your submission.<br><br><i>Don't be alarmed if you don't see your photo uploaded straight away; our site team are on it and will look at your request as soon as possible.</i> <br><br><b>Why does my photo need approved?</b><br><i>To avoid any sort of breach against our Terms of Use / Code of Conduct, we feel as if it's best that all photo uploads should be reviewed and dealt with individually to avoid any future issues.</i></small>
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
