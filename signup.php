<!doctype html>
<html lang="en">
  <head>
  	<title>Kerry's K9's - Account Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
   	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
     <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700' rel='stylesheet' type='text/css' />

		<style>
        input[type=text], input[type=password], select
        {
            width:25%;
        }
        
.signupCenter {
  position: absolute;
  top: 45%;
  left: 50%;
  transform: translate(-50%, -50%);
}

        </style>
  </head>
  <body>
  <?php include "inc/header.php"; ?>
<div class="signupCenter">
    <center>
    
        <h2 class="mb-42">Kerry's K9's - Account Signup</h2>

        <div id='server-results'></div>

        <form id="SignupForm" action="inc/usersignup.php" method="POST">
            <div class="form-group">
                <label for="username">Account Username</label>
                <input type="text" class="form-control" placeholder="Username" name="username">
            </div>

            <div class="form-group">
                <label for="password">Account Password</label>
                <input type="password" class="form-control" placeholder="Password" name="password">
            </div>
            <div class="row">
				<div class="col-xs-12 col-sm-6 col-md-6">
					<div class="form-group">
						<label for="SecQ1">Security Question 1</label>
						<select class="form-control" name="SecQ1" id="SecQ1" tabindex="6">
      <option>What was your mothers maiden name?</option>
      <option>What was the name of your first pet?</option>
      <option>What was your dream job as a child?</option>
      <option>Who was your childhood crush?</option>
      <option>What is your dream holiday destination?</option>
    </select>					</div>
				</div>
				<div class="col-xs-12 col-sm-6 col-md-6">
					<div class="form-group">
						<label for="SecA1">Security Answer 1</label>
						<input type="text" name="SecA1" style='width:100% !important' id="SecA1" class="form-control " required placeholder="Security Answer 1" tabindex="6">
					</div>
				</div>
			</div>
<br>
	 	<div class="row">
				<div class="col-xs-12 col-sm-6 col-md-6">
					<div class="form-group">
						<label for="SecQ2">Security Question 2</label>
						<select class="form-control" name="SecQ2" id="SecQ2" tabindex="6">
      <option>Where did you go on your first holiday?</option>
      <option>What is the name of your favourite uncle?</option>
      <option>What was the name of your primary school?</option>
      <option>What was the house number and street name you lived in as a child?</option>
      <option>What is the name of your favourite musician or band?</option>
    </select>					</div>
				</div>
				<div class="col-xs-12 col-sm-6 col-md-6">
					<div class="form-group">
						<label for="SecA2">Security Answer 2</label>
						<input type="text" name="SecA2" style='width:100% !important' id="SecA2" class="form-control " required placeholder="Security Answer 2" tabindex="6">
					</div>
				</div>
			</div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Register</button>
            </div>
        </form>
    </center>
</div>



<?php include "inc/footer.php"; ?>
</body>
<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
  <script type='text/javascript'>
    $('#SignupForm').submit(function(event) {
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