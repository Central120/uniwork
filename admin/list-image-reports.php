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


$findreports = mysqli_query($conn, "SELECT * FROM `image_report`");

?>
<!doctype html>
<html lang="en">
  <head>
  	<title>Kerry's K9's - Image Reports</title>
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
    <h2 class="mb-42">Image Reports</h2>
    <div id="server-results"></div>
    <div class="container" style='margin-bottom: 30%'>
    <div class="d-flex justify-content-center">
    <div class="table-responsive">
      <div id="approve-results"></div>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Reporter</th>
                            <th scope="col">Reported by</th>
                            <th scope="col">Reason Option</th>
                            <th scope="col">Reason Information</th>
                            <th scope="col">Outcome on Report</th>
                            <th scope="col">Report Status</th>
                            <th scope="col">View Image</th>
                            <th scope="col">Manage Report</th>
                        </tr>
                    </thead>
                    <tbody>
  <?php
    while ($reportrow = $findreports->fetch_assoc())
    {
      
        $reportid = $reportrow['id'];
        $reporter = $reportrow['reporter'];
        $reporting = $reportrow['reported'];
        $reportoption = $reportrow['reason_title'];
        $reportinformation = $reportrow['reason_description'];
        $reportoutcome = $reportrow['outcome'];
        $reportstatus = $reportrow['status'];
        $imageid = $reportrow['imageid'];
      
        // collecting image information
        $findimage = "SELECT * FROM photo_sharing WHERE id='$imageid'";
        $resultimage = mysqli_query($conn,$findimage);
        $resultimagerow = mysqli_fetch_array($resultimage);

        $p_location = $resultimagerow['p_location'];
        $author = $resultimagerow['username'];
        $imagetitle = $resultimagerow['product_name'];
        $imagecaption = $resultimagerow['caption'];
        $imagetimestamp = $resultimagerow['timestamp'];
        $imageapprover['approver'];

        if($reportstatus == 'open')
        {
          $statusofreport = "Open";
        }
        else
        {
          $statusofreport = "Closed";
        }

        if($reportoutcome == 'pending')
        {
          $outcomeofreport = "Pending Action";
        }
        else
        {
          $outcomeofreport = $reportrow['outcome'];
        }

        echo "<tr>
        <td>$reporter</td>
        <td>$reporting</b></td>
        <td>$reportoption</td>
        <td>$reportinformation</td>
        <td>$outcomeofreport</td>
        <td><a href='../$p_location' target='_blank'>View Image</a></td>
        <td>$statusofreport</td>
        
        
        <td><input type='button' data-toggle='modal' id='cancel_btn' data-target='#manage{$reportid}' class='btn btn-primary' value='Manage Report' /></td>
        
        </tr>
        ";

        echo "<div class='modal fade' id='manage{$reportid}' tabindex='-1' role='dialog' aria-labelledby='manage{$reportid}' aria-hidden='true'>
        <div class='modal-dialog' role='document'>
          <div class='modal-content' style='width:150%;left:-10%;'>
            <div class='modal-header'>
              <h5 class='modal-title'>What would you like to do with $reporter's report?</h5>
              <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
              </button>
            </div>
            <div class='modal-body'>
            <div id='manage-results'></div>
            <div id='mark-results'></div>
            <div id='delete-result'></div>
            <p>Please note: Deleting the image cannot be reversed.</p>
            </div>
            <div class='modal-footer'>
            ";
                   
           echo "
            <form id='DeleteImage1' action='php/close-report.php' method='post' role='form'>
            <input type='hidden' value='$reportid' name='imageid' />
              <button type='submit' class='btn btn-danger'>Close Report</button>
            </form>
            <form id='MarkImage' action='php/delete-image.php' method='post' role='form'>
            <input type='hidden' value='$imageid' name='imageid' />
              <button type='submit' class='btn btn-warning'>Delete Image</button>
            </form>
            <a href='../$p_location' target='_blank' class='btn btn-primary'>View Image</a>
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

<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
  <script type='text/javascript'>
    $('#ApproveImage').submit(function(event) {
      event.preventDefault(); //prevent default action
      var post_url = $(this).attr('action'); //get form action url
      var form_data = $(this).serialize(); //Encode form elements for submission

      $.ajax({
        url: post_url,
        type: 'post',
        data: form_data
      }).done(function(response) { //
        $('#approve-results').html(response);

      });
    });
  </script>

<script type='text/javascript'>
    $('#MarkImage').submit(function(event) {
      event.preventDefault(); //prevent default action
      var post_url = $(this).attr('action'); //get form action url
      var form_data = $(this).serialize(); //Encode form elements for submission

      $.ajax({
        url: post_url,
        type: 'post',
        data: form_data
      }).done(function(response) { //
        $('#mark-results').html(response);

      });
    });
  </script>

<script type='text/javascript'>
    $('#DeleteImage1').submit(function(event) {
      event.preventDefault(); //prevent default action
      var post_url = $(this).attr('action'); //get form action url
      var form_data = $(this).serialize(); //Encode form elements for submission

      $.ajax({
        url: post_url,
        type: 'post',
        data: form_data
      }).done(function(response) { //
        $('#delete-result').html(response);

      });
    });
  </script>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
</html>