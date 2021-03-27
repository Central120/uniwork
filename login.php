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
.loginCenter {
  position: absolute;
  top: 35%;
  left: 50%;
  transform: translate(-50%, -50%);
}
</style>

  </head>
  <body>
  <?php include "inc/header.php"; ?>

<div class="loginCenter">
    <center>
        <h2 class="mb-42">Kerry's K9 - Account Login</h2>

   
        <div id='server-results'></div>
        <form id="LoginForm" action="inc/userlogin.php" method="POST">
            <div class="form-group">
                <label for="username">Account Username</label>
                <input type="text" class="form-control" placeholder="Username" name="username" style="width: 145px;">
            </div>

            <div class="form-group">
                <label for="password">Account Password</label>
                <input type="password" class="form-control" placeholder="Password" name="password" style="width: 145px;">
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Login</button>
            </div>
        </form>
    </center>
</div>

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