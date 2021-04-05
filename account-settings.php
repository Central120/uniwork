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
    echo "<script>window.location.replace('index');</script>";
}


$findcurrentbookings = mysqli_query($conn, "SELECT * FROM `bookings` WHERE `username` = '$session_usern'");

?>
<!doctype html>
<html lang="en">
  <head>
  	<title>Kerry's K9's - Account Settings</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
   	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
     <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700' rel='stylesheet' type='text/css' />
     
     <style>
    .footer 
    {
        margin-top:10% !important;
    }

    .table-responsive .table {
    max-width: none;
    
}

     </style>
</head>
<body>
    <?php include "inc/header.php"; ?>
    
        <center>
    <h2 class="mb-42">Account Settings</h2>
    <div id="server-results"></div>
    <div class="container">
    <div class="d-flex justify-content-center">
        <h5 class="mb-42">Change Account Password</h5>
            <form class='change-password.php' method='post' id='Form1'>
            <label for='pw-change'>New Password</label>
            <input type="password" class="form-control" placeholder="Password" name="password">
            <br>
            <label for='conf-change'>Confirm new password</label>
            <input type="password" class="form-control" placeholder="Password" name="conf_pw">
            <input type='submit' value='Change password' class='btn btn-success'>
            </form>
            <br><br>
            <h5 class="mb-42">Change Security Details</h5>
            <form class='change-answers.php' method='post' id='Form2'>
            <label for='secq'>Security Question 1</label>
            <select class='form-control' name='SecQ1'>
            <?php
            $findsecq1 = mysqli_query($conn, "SELECT * FROM `accounts` WHERE `username` = '$session_usern'");
            while ($rowfindsecq1 = $findsecq1->fetch_assoc())
            {
            $secq1 = $rowfindsecq1['secq1'];
            $possible1 = "What was your mothers maiden name?";
            $possible2 = "What was the name of your first pet?";
            $possible3 = "What was your dream job as a child?";
            $possible4 = "Who was your childhood crush?";
            $possible5 = "What is your dream holiday destination?";
            
            if ($secq1 == $possible1)
            {
                echo "<option value='$secq1' selected>$secq1</option>";
            }
            else
            {
                echo "<option value='$possible1'>$possible1</option>";
            }
            if ($secq1 == $possible2)
            {
                echo "<option value='$secq1' selected>$secq1</option>";
            }
            else
            {
                echo "<option value='$possible2'>$possible2</option>";
            }
            if ($secq1 == $possible3)
            {
                echo "<option value='$secq1' selected>$secq1</option>";
            }
            else
            {
                echo "<option value='$possible3'>$possible3</option>";
            }
            if ($secq1 == $possible4)
            {
                echo "<option value='$secq1' selected>$secq1</option>";
            }
            else
            {
                echo "<option value='$possible4'>$possible4</option>";
            }
            if ($secq1 == $possible5)
            {
                echo "<option value='$secq1' selected>$secq1</option>";
            }
            else
            {
                echo "<option value='$possible5'>$possible5</option>";
            }
        }
            ?>

            </select>
            <label for='seca1'>Security Answer 1</label>
            <input type='password' name='password' class='form-control'>
            <br>
            <label for='secq2'>Security Question 2</label>
            <select class='form-control' name='SecQ1'>
            <?php
            $findsecq2 = mysqli_query($conn, "SELECT * FROM `accounts` WHERE `username` = '$session_usern'");
            while ($rowfindsecq2 = $findsecq2->fetch_assoc())
            {
            $secq2 = $rowfindsecq2['secq2'];
            $possibleq1 = "Where did you go on your first holiday?";
            $possibleq2 = "What is the name of your favourite uncle?";
            $possibleq3 = "What was the name of your primary school?";
            $possibleq4 = "What was the house number and street name you lived in as a child?";
            $possibleq5 = "What is the name of your favourite musician or band?";
            
            if ($secq1 == $possibleq1)
            {
                echo "<option value='$secq2' selected>$secq2</option>";
            }
            else
            {
                echo "<option value='$possibleq1'>$possibleq1</option>";
            }
            if ($secq1 == $possibleq2)
            {
                echo "<option value='$secq2' selected>$secq2</option>";
            }
            else
            {
                echo "<option value='$possibleq2'>$possibleq2</option>";
            }
            if ($secq1 == $possibleq3)
            {
                echo "<option value='$secq2' selected>$secq2</option>";
            }
            else
            {
                echo "<option value='$possibleq3'>$possibleq3</option>";
            }
            if ($secq1 == $possibleq4)
            {
                echo "<option value='$secq2' selected>$secq2</option>";
            }
            else
            {
                echo "<option value='$possibleq4'>$possibleq4</option>";
            }
            if ($secq1 == $possibleq5)
            {
                echo "<option value='$secq2' selected>$secq2</option>";
            }
            else
            {
                echo "<option value='$possibleq5'>$possibleq5</option>";
            }
        }
            ?>

            </select>
            <br>
            <label for='seca2'>Security Answer 2</label>
            <input type='password' name='seca2' class='form-control'>
            <input type='submit' value='Change Security Details' class='btn btn-success'>
            </form>
                        </div>
            </div>
                                  
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
<script type='text/javascript'>
    $('#Form2').submit(function(event) {
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