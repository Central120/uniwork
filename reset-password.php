<?php
include_once 'inc/dbconnect.php';

$username = mysqli_real_escape_string($conn, $_POST['usern']);
$seca1 = mysqli_real_escape_string($conn, $_POST['SecA1']);
$seca2 = mysqli_real_escape_string($conn, $_POST['SecA2']);
$salt = "£$%";
$sa1 = md5($salt . $seca1);
$sa2 = md5($salt . $seca2);

$finduser = mysqli_query($conn, "SELECT * FROM `accounts` WHERE `username` = '$username' AND `seca1` = '$sa1' AND `seca2` = '$sa2'");
$countfinduser = mysqli_num_rows($finduser);

if ($countfinduser != 0)
{
    
  $msg = "<div class='alert alert-success alert-dismissable fade show' role='alert'><strong>Security Answers Correct.</strong> Please enter your new password. <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
  <span aria-hidden='true'>&times;</span>
</button></div>";
$content = "<div class='form-group'>
<label for='newpw'>New Password</label>
<input type='password' class='form-control' placeholder='Enter new password' name='newpw' style='width: 145px;'>
</div><br>
<div class='form-group'>
<label for='newpw'>Repeat Password</label>
<input type='password' class='form-control' placeholder='Repeat new password' name='r_newpw' style='width: 145px;''>
</div>";

$input = "<input type='hidden' name='usern' value='$username2'>
              <button type='submit' class='btn btn-primary'>Reset Password</button>
";
}
else
{
    $msg = "<div class='alert alert-danger alert-dismissable fade show' role='alert'><strong>Security Answers Incorrect</strong> Please retry. <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span>
  </button></div>";
  $content = "";
  $input = "";
}

?>


<!doctype html>
<html lang="en">
  <head>
  	<title>Kerry's K9's - Reset Password Stage 3</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
   	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
     <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700' rel='stylesheet' type='text/css' />
  </head>
  <body>
  <?php include "inc/header.php"; ?>
 
    <div class="container">
  
    <center><br>
    <?php echo $msg; ?>
        <h2 class="mb-42">Kerry's K9's - Reset Password Stage 2</h2>
        <form action="php/reset-password.php" method="POST">
            <div class="form-group">
                <label for="username">Account Username</label>
                <input type="text" disabled class="form-control" value="<?php echo $username2; ?>" name="username" style="width: 145px;">
            </div>

<?php echo $content; ?>

<div class='form-group'>
<?php echo $input; ?>
                <button id='login' type="button" class="btn btn-info">Login</button>
            </div>
        </form>
    </center>
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