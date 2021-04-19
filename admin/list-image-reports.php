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
                            <th scope="col">Reported</th>
                            <th scope="col">Reason Option</th>
                            <th scope="col">Reason Information</th>
                            <th scope="col">Other</th>
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
        $other = $reportrow['other'];
      
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


        if($imageid == 0)
        {
          $pLocation = "Image no longer exists";
        }
        else
        {
          $pLocation = "<a href='../$p_location target='_blank'>View Image</a>";
        }

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
        <td>$other</td>
        <td>$outcomeofreport</td>
        <td>$pLocation</td>
        <td>$statusofreport</td>
        
        
        <td><input type='button' data-toggle='modal' id='cancel_btn' data-target='#manage{$reportid}' class='btn btn-primary' value='Manage Report' /></td>
        
        </tr>
        ";

        echo "<div class='modal fade' id='manage{$reportid}' tabindex='-1' role='dialog' aria-labelledby='manage{$reportid}' aria-hidden='true'>
        <div class='modal-dialog' role='document'>
          <div class='modal-content'>
            <div class='modal-header'>
              <h5 class='modal-title'>What would you like to do with $reporter's report?</h5>
              <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
              </button>
            </div>
            <div class='modal-body'>
            <div id='report-results'></div>
            <form id='HandleReport' action='php/handle-report' method='post'>
            <div class='form-group'>
            <input type='hidden' name='reportid' value='$reportid'>
            <input type='hidden' name='imageid' value='$imageid'>
            <select name='handle-option' class='form-control'>
            <option value='close'>Close Report (No Rules Broken)</option>
            <option value='delete'>Delete Image & Close Report</option>
            </select><br>
            
            </div>
            


            </div>
            <div class='modal-footer'>
            ";
                   
           echo "
           <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
            <a href='../$p_location' target='_blank' class='btn btn-primary'>View Image</a>
               <button type='submit' class='btn btn-info'>Handle</button>
              </form>
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
    $('#HandleReport').submit(function(event) {
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
  </script>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
</html>