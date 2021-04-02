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
    echo "<script>window.location.replace('../index');</script>";
}

$staff_name = mysqli_real_escape_string($conn, $_POST['staff']);
$dateentry = mysqli_real_escape_string($conn, $_POST['date']);

if ($dateentry == 'week')
{
  $timer = "this week";
}
else if ($dateentry == 'next')
{
  $timer = "next week";
}
else
{
  echo "This date entry is not available: $dateentry. ";
}

$findavail = mysqli_query($conn, "SELECT * FROM `staff_availability` WHERE `staff_name` = '$staff_name'");
$countfindavail = mysqli_num_rows($findavail);
$rowfindavail = mysqli_fetch_assoc($findavail);
$first_day = $rowfindavail['first_date'];
$last_day = $rowfindavail['last_date'];
$first_time = $rowfindavail['start_time'];
$last_time = $rowfindavail['end_time'];



$findfdate = strtotime("$timer $first_day");
$findldate = strtotime("$timer $last_day");
$findftime = strtotime("$first_time");
$findltime = strtotime("$last_time");



if ($countfindavail == 0)
{
  $msg = "<br><br><h2 style='margin-left:25%'>$staff_name is currently unavailable - Please try again later.</h2>"; 
}
?>
<!doctype html>
<html lang="en">
  <head>
  	<title>Kerry's K9's - New Booking</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
   	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
     <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700' rel='stylesheet' type='text/css' />
     <?php 
     if ($countfindavail == 0)
     {
       echo "<style>
       .container-fluid
       {
        display: none; 
       }
       .footer
       {
        margin-top: 20% !important;
       }
       html
       {
         height: 100%;
       }
       </style>
       "; 
     }
     
     ?>
</head>
<body>
    <?php include "inc/header.php"; ?>
    <?php echo $msg; ?>
    <div class="container-fluid">
    <div class="d-flex justify-content-center">
        <center>
    <h2 class="mb-42">Request a booking with <?php echo $staff_name; ?></h2>
    <div id="server-results"></div>
<form action='php/request-booking.php' method='post' role='form' id="Form1">
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputEmail4">Preference One - Date</label>
      <select class="form-control" name="day1">
      <?php
        $today = strtotime('today');
        if ($findfdate >= $today)
        {
          $date = $findfdate;
        }
        else
        {
          $date = $today;
        }
    
        while ($date <= $findldate) {
          
          $prdate = date('l jS \of F',$date);
          
          echo "<option value=''>$prdate</option>";
          $date = strtotime('+1 day',$date);
        }
        
      ?>
      
      </select>
      </div>
    <div class="form-group col-md-6">
      <label for="inputPassword4">Preference One - Time</label>
      <select class="form-control" name="time1">
      <?php
         
         $time = strtotime('now');

         

        while ($timey <= $findltime) {
          if ($time > $timey)
          {
           $prtime = "No times available.";
          }
          else
          {
          $prtime = date('g:i a',$timey);
          }

          
          
          echo "<option value=''>$prtime</option>";
          $timey = strtotime('+1 hour',$timey);
        }
        
      ?>
      
      </select>
    </div>
  </div>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputEmail4">Preference Two - Date</label>
     <select class="form-control" name="day2">
     <?php
     if ($findfdate >= $today)
     {
       $date1 = $findfdate;
     }
     else
     {
       $date1 = $today;
     }
    
      while ($date1 <= $findldate) {
        $prdate1 = date('l jS \of F',$date1);
        echo "<option value=''>$prdate1</option>";
        $date1 = strtotime('+1 day',$date1);
      }
     ?>
     </select>
    </div>
    <div class="form-group col-md-6">
      <label for="inputPassword4">Preference Two - Time</label>
      <select class="form-control" name="time1">
      <?php
         
         $time2 = strtotime('now');

         

           if ($time2 > $findftime)
           {
             $timey2 = strtotime('+1 hour',$findftime);
           }
           else
           {
           $timey2 = $findftime;
           }
         
        while ($timey2 <= $findltime) {
          
          $prtime2 = date('g:i a',$timey2);
          
          echo "<option value=''>$prtime2</option>";
          $timey2 = strtotime('+1 hour',$timey2);
        }
        
      ?>
      
      </select>
    </div>
  </div>
  <div class="form-group">
    <label for="inputAddress">Pet Name</label>
    <input type="text" class="form-control" name="petname" id="petname" placeholder="Enter Pet Name">
  </div>
  <div class="form-group">
    <label for="inputEmail3">Emergency Contact 1</label>
      <input type="email" class="form-control" name="emergency1" id="emergency1" placeholder="Enter an emergency contact">
  </div>
  <div class="form-group">
    <label for="inputPassword3">Emergency Contact 2</label>
      <input type="password" class="form-control" name="emergency2" id="emergency2" placeholder="Enter a 2nd emergency contact">
  </div>
  <div class="form-group">
    <label for="inputAddress">Additional Information</label>
    <input type="text" class="form-control" name="additional" id="additional" placeholder="Pet behaviours, lead/no lead etc...">
  </div>
  <div class="form-group row">
    <div class="col-sm-10">
      <button type="submit" class="btn btn-success">Request Booking</button>
    </div>
  </div>
        </center>
</div>
        </div>
</form>

    <?php include "inc/footer.php"; ?>
</body>
<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
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