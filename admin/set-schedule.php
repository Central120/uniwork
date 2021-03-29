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
?>

<!doctype html>
<html lang="en">
  <head>
  	<title>Kerry's K9's - Set Schedule</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
   	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
     <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700' rel='stylesheet' type='text/css' />
     <style>
         .formCenter 
         {
            position: absolute;
            top: 35%;
            left: 50%;
            transform: translate(-50%, -50%);
            margin-top:5%;
         }
     </style>
</head>
<body>
    <?php include "inc/header.php"; ?>
    <div class="container-fluid">
    <div class="d-flex justify-content-center">
        <center>
        <br><div id="server-results"></div>
    <h2 class="mb-42">Update your schedule</h2>
    
  <div class="form-row">
    <div class="form-group col-md-6">
    <form action='schedule-update.php' method='post' role='form' id='Form1'>
      <label for="inputEmail4">Start Day</label>
      <select class="form-control" name='start'>
         <option value='monday'>Monday</option>
         <option value='tuesday'>Tuesday</option>
         <option value='wednesday'>Wednesday</option>
         <option value='thursday'>Thursday</option>
         <option value='friday'>Friday</option>
         <option value='saturday'>Saturday</option>
         <option value='sunday'>Sunday</option>
      </select>
    </div>
    <div class="form-group col-md-6">
      <label for="inputEmail4">End Day</label>
      <select class="form-control" name='end'>
         <option value='monday'>Monday</option>
         <option value='tuesday'>Tuesday</option>
         <option value='wednesday'>Wednesday</option>
         <option value='thursday'>Thursday</option>
         <option value='friday'>Friday</option>
         <option value='saturday'>Saturday</option>
         <option value='sunday'>Sunday</option>
      </select>
    </div>
    <div class="form-group col-md-6">
      <label for="inputPassword4">Start Time</label>
      <select class="form-control" name="start_time">
      <?php
       for($s=0;$s<24;$s++)
        {
            if ($s < '10')
            {
                $t = "0$s";
            }
            else
            {
                $t = "$s";
            }
        echo "<option value='$s'>$t:00 </option>";
        }
    ?>
    </select>
    </div>
    <div class="form-group col-md-6">
    <label for="inputAddress">End Time</label>
    <select class="form-control" name='end_time'>
    <?php
       for($s=0;$s<24;$s++)
        {
            if ($s < '10')
            {
                $t = "0$s";
            }
            else
            {
                $t = "$s";
            }
        echo "<option value='$s'>$t:00 </option>";
        }
    ?>
    </select>
  </div>
  </div>
  <div class="form-group row">
    <div class="col-sm-10">
      <button type="submit" class="btn btn-success">Set Schedule</button>
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