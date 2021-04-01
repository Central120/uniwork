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


$findstaff = mysqli_query($conn, "SELECT * FROM `accounts` WHERE `admin_id` = '2'");


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
     
     <style>
    .footer 
    {
        margin-top:20% !important;
    }
     </style>
</head>
<body>
    <?php include "inc/header.php"; ?>
    <div class="container-fluid">
    <div class="d-flex justify-content-center">
        <center>
    <h2 class="mb-42">Request a booking</h2>
    <div id="server-results"></div>
<form action='new-booking.php' method='post' role='form' id="Form1">
  <div class="form-row">
  <label for='staff'>Choose a staff member:</label>
  <select class="form-control" name='staff'>
  <?php
    while ($rowfindstaff = mysqli_fetch_assoc($findstaff))
    {
        $usern = $rowfindstaff['username'];
        echo "<option value='$usern'>$usern</option>";
    }
  ?>
  
  </select>
  </div>
  <div class="form-row">
  <label for='date'>When would you like your booking for?</label>
  <select class="form-control" name='date'>
  <option value='week'>This week</option>
  <option value='next'>Next week</option>
  </select>
  </div>s
  <div class="form-group row">
    <div class="col-sm-10"><br>
      <button type="submit" class="btn btn-success">Request Booking</button>
    </div>
  </div></form>
  </div>
  </div>
  
  <?php include "inc/footer.php"; ?>
</body>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
</html>