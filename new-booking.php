<?php


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
    <div class="formCenter">
        <center>
    <h2 class="mb-42">Request a booking</h2>
    
<form>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputEmail4">Timeslot Preference One</label>
      <input type="email" class="form-control" id="inputEmail4" placeholder="Enter first timeslot preference">
    </div>
    <div class="form-group col-md-6">
      <label for="inputPassword4">Timeslot Preference Two</label>
      <input type="password" class="form-control" id="inputPassword4" placeholder="Enter second timeslot preference">
    </div>
  </div>
  <div class="form-group">
    <label for="inputAddress">Pet Name</label>
    <input type="text" class="form-control" id="inputAddress" placeholder="Enter Pet Name">
  </div>
  <div class="form-group">
    <label for="inputEmail3">Emergency Contact 1</label>
      <input type="email" class="form-control" id="inputEmail3" placeholder="Enter an emergency contact">
  </div>
  <div class="form-group">
    <label for="inputPassword3">Emergency Contact 2</label>
      <input type="password" class="form-control" id="inputPassword3" placeholder="Enter a 2nd emergency contact">
  </div>
  <div class="form-group">
    <label for="inputAddress">Additional Information</label>
    <input type="text" class="form-control" id="inputAddress" placeholder="Pet behaviours, lead/no lead etc...">
  </div>
  <div class="form-group row">
    <div class="col-sm-10">
      <button type="submit" class="btn btn-success">Request Booking</button>
    </div>
  </div>
        </center>
</div>
</form>

    <?php include "inc/footer.php"; ?>
</body>
<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
  <script type='text/javascript'>
    $('#LoginForm').submit(function(event) {
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