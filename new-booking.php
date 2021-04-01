<?php
include_once 'inc/dbconnect.php';
session_start();


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

$findavail = mysqli_query($conn, "SELECT * FROM `staff_availability` WHERE `staff_name` = '$staff_name'");
$countfindavail = mysqli_num_rows($findavail);
$rowfindavail = mysqli_fetch_assoc($findavail);
$first_day = $rowfindavail['first_date'];
$last_day = $rowfindavail['last_date'];
$first_time = $rowfindavail['start_time'];
$last_time = $rowfindavail['end_time'];

$findfdate = strtotime("this week $first_day");
$findldate = strtotime("this week $last_day");


$fdate = date('l jS \of F Y', $findfdate);
$ldate = date('l jS \of F Y', $findldate);



function list_days($findfdate,$findldate){
    $arr_days = array();
    $day_passed = ($findldate - $findfdate); //seconds
    $day_passed = ($day_passed/86400); //days

    $counter = 1;
    $day_to_display = $findfdate;
    while($counter < $day_passed){
        $day_to_display += 86400;
        //echo date("F j, Y \n", $day_to_display);
        $arr_days[] = date('l jS \of F Y',$day_to_display);
        $counter++;
    }

    return $arr_days;
}





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
      <select class="form-control" name="">
      <?php
        $today = strtotime('now');
        if ($findfdate < $today)
        {
          $date = $findfdate;
        }
        else
        {
          $date = $today;
        }

        
        
        while ($date <= $findldate) {
          $prdate = date('l (j-n-Y)',$date);
          
          echo "<option value=''>$prdate</option>";
          $date = strtotime('+1 day',$date);
        }
        
      ?>
      
      </select>
      </div>
    <div class="form-group col-md-6">
      <label for="inputPassword4">Preference One - Time</label>
      <input type="password" class="form-control" name="time1" id="timeslot2" placeholder="Enter preference one time">
    </div>
  </div>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputEmail4">Preference Two - Date</label>
     <select class="form-control" name="">
     <?php
     $today = strtotime('this sunday');
     if ($today > $findldate)
        {
          $findfdate = strtotime("next week $last_day");
          $findldate = strtotime("next week $last_day");
        }
      while ($date1 <= $findldate) {
        
        
        $prdate1 = date('l (j-n-Y)',$date1);
        
        
        echo "<option value=''>$prdate1</option>";
        $date1 = strtotime('+1 day',$date1);
      }
     ?>
     </select>
    </div>
    <div class="form-group col-md-6">
      <label for="inputPassword4">Preference Two - Time</label>
      <input type="password" class="form-control" name="time2" id="timeslot4" placeholder="Enter preference two time">
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