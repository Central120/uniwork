<!doctype html>
<html lang="en">
  <head>
  	<title>Kerry's K9's - Account Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
   	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
     <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700' rel='stylesheet' type='text/css' />

		
  </head>
  <body>
  <?php include "inc/header.php"; ?>
<div class="container">
    <center>
        <h2 class="mb-42">Kerry's K9 - Account Login</h2>

        <form id="LoginForm" action="inc/userlogin.php" method="POST">
            <div class="form-group">
                <label for="username">Account Username</label>
                <input type="text" class="form-control" placeholder="Username" name="username" style="width: 85px;">
            </div>

            <div class="form-group">
                <label for="password">Account Password</label>
                <input type="password" class="form-control" placeholder="Password" name="password" style="width: 85px">
            </div>
        </form>
    </center>
</div>



<?php include "inc/footer.php"; ?>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
</html>