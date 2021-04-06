<?php
include_once 'inc/dbconnect.php';

$username = mysqli_real_escape_string($conn, $_POST['username']);

$finduser = mysqli_query($conn, "SELECT * FROM `accounts` WHERE `username` = '$username'");
$countfinduser = mysqli_num_rows($finduser);

if ($countfinduser != 0)
{
    $msg = "<div class='alert alert-sucess alert-dismissable fade show' role='alert'><strong>Account found!</strong> Please enter your security answers. <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span>
  </button></div>";

  $rowfinduser = mysqli_fetch_Assoc($finduser);
  $username2 = $rowfinduser['username'];
  $secq1 = $rowfinduser['secq1'];
  $secq2 = $rowfinduser['secq2'];
}
else
{
    $msg = "<div class='alert alert-danger alert-dismissable fade show' role='alert'><strong>An error occured.</strong> Your account could not be found. <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span>
  </button></div>";
}

?>


<!doctype html>
<html lang="en">
  <head>
  	<title>Kerry's K9's - Reset Password Stage 2</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
   	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
     <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700' rel='stylesheet' type='text/css' />
  </head>
  <body>
  <?php include "inc/header.php"; ?>
 
    <div class="container-fluid">
  <div class="d-flex justify-content-center">
    <center>
    <?php echo $msg; ?>
        <h2 class="mb-42">Kerry's K9's - Reset Password Stage 2</h2>
        <form action="reset-password.php" method="POST">
            <div class="form-group">
                <label for="username">Account Username</label>
                <input type="text" disabled class="form-control" value="<?php echo $username2; ?>" name="username" style="width: 145px;">
            </div>
            <div class="row">
				<div class="col-xs-12 col-sm-6 col-md-6">
					<div class="form-group">
						<label for="SecQ1">Security Question 1</label>
						<select disabled class="form-control">
                        <option><?php echo $secq1; ?></option>     
    </select>
					</div>
				</div>
				<div class="col-xs-12 col-sm-6 col-md-6">
					<div class="form-group">
						<label for="SecA1">Security Answer 1</label>
						<input type="text" name="SecA1" style='width:100% !important' id="SecA1" class="form-control" required placeholder="Security Answer 1" tabindex="1">
					</div>
				</div>
                <br>
                <div class="row">
				<div class="col-xs-12 col-sm-6 col-md-6">
					<div class="form-group">
						<label for="SecQ1">Security Question 2</label>
						<select disabled class="form-control">
                        <option><?php echo $secq2; ?></option>     
    </select>
					</div>
				</div>
				<div class="col-xs-12 col-sm-6 col-md-6">
					<div class="form-group">
						<label for="SecA1">Security Answer 2</label>
						<input type="text" name="SecA2" style='width:100% !important' id="SecA2" class="form-control" required placeholder="Security Answer 2" tabindex="2">
					</div>
				</div>
            <div class="form-group">
                <button type='submit' class="btn btn-primary">Next Stage</button>
                <button id='login' type="button" class="btn btn-info">Login</button>
            </div>
        </form>
    </center>
</div>
</div>

<?php include "inc/footer.php"; ?>
</body>
<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script>
$('#login').click(function(){
window.location.replace('login');
});

  </script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
</html>