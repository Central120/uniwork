<?php
include_once 'inc/dbconnect.php';
session_start();
$current_timestamp = date('Y-m-d H:i:s');
ini_set('display_errors', 1);

if(isset($_SESSION['admin']))
{
    $session_usern = $_SESSION['admin'];
}
else
{
    echo "<script>window.location.replace('../index');</script>";
}


$findoncoming = mysqli_query($conn, "SELECT * FROM `bookings` WHERE `approver` != ''");

?>
<!doctype html>
<html lang="en">
  <head>
  	<title>Kerry's K9's - Oncoming Bookings</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
   	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
     <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700' rel='stylesheet' type='text/css' />
     
     <style>
    .footer 
    {
        margin-top:10% !important;
    }
     </style>
</head>
<body>
    <?php include "inc/header.php"; ?>
  
        <center>
    <h2 class="mb-42">My Bookings</h2>
    <div id="server-results"></div>
    <div class="container-fluid" style='margin-bottom: 30%'>
    <div class="d-flex justify-content-center">
    <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Username</th>
                            <th scope="col">Pet Name</th>
                            <th scope="col">Timeslot</th>
                            <th scope="col">Emergency Contacts</th>
                            <th scope="col">Additional Info</th>
                            <th scope="col">Handled by:</th>
                            <th>Manage</th>
                        </tr>
                    </thead>
                    <tbody>
  <?php
    while ($rowfindoncoming = $findoncoming->fetch_assoc())
    {
        $booking_id = $rowfindoncoming['id'];
        $username = $rowfindoncoming['username'];
        $approver = $rowfindoncoming['approver'];
        $app_ts = $rowfindoncoming['approved_timestamp'];
        $pet_name = $rowfindoncoming['pet_name'];
        $ec1 = $rowfindoncoming['ec1'];
        $ec2 = $rowfindoncoming['ec2'];
        $info = $rowfindoncoming['info'];

        
        
        // find difference between next booking and current timestamp
        $date1 = strtotime($current_timestamp);
        $date2 = strtotime($app_ts);
        $diff = abs($date2 - $date1);
        $appstr = date("l jS \of F, g:i a", $date2);

        $years = floor($diff / (365*60*60*24));
        $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
        $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
        $hours = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24) / (60*60));
        $minutes = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24 - $hours*60*60)/ 60);

        if ($years == 0 && $months == 0 && $days == 0 && $hours == 0)
        {
        // prints minutes
        $msg = "$minutes minutes ago";
        }
        else if ($years == 0 && $months == 0 && $days == 0)
        {
        // prints hours
        $msg = "$hours hours and $minutes minutes ago";
        }
        else if ($years == 0 && $months == 0 && $hours)
        {
        // prints days
        $msg = "$days days, $hours hours and $minutes minutes ago";
        }
        else if ($years == 0)
        {
        // prints months
        $msg = "$months months, $days days, $hours hours and $minutes minutes ago";
        }
        else
        {
        // prints years
        $msg = "$years years, $months months, $days days, $hours hours and $minutes minutes ago";
        }

        
        echo "<tr>
        <td>$username</td>
        <td>$pet_name</td>
        <td>$appstr<br>Time until this booking: $msg</td>
        <td>Emergency 1: $ec1 <br> Emergency 2: $ec2</td>
        <td>$info</td>
        <td>$approver</td>
        <td><input type='button' data-toggle='modal' id='cancel_btn' data-target='#manage{$booking_id}' class='btn btn-warning' value='Cancel Booking' /></td>
        </tr>
        ";

        echo "<div class='modal fade' id='manage{$booking_id}' tabindex='-1' role='dialog' aria-labelledby='manage{$booking_id}' aria-hidden='true'>
        <div class='modal-dialog' role='document'>
          <div class='modal-content' style='width:150%;left:-10%;'>
            <div class='modal-header'>
              <h5 class='modal-title'>Are you sure you want to cancel $username's booking?</h5>
              <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
              </button>
            </div>
            <div class='modal-body'>
            <p>Please note: Cancelling the booking cannot be reversed.</p>
            </div>
            <div class='modal-footer'>
            ";
                   
           echo "
            <form action='php/cancel-booking.php' method='post' role='form'>
            <input type='hidden' value='$booking_id' name='id' />
              <button type='submit' class='btn btn-danger'>Confirm Cancellation</button>
            </form>
              <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
            </div>
          </div>
        </div>
      </div>";

    }


?>
 </tbody>
                </table>
            </div>
        </div>
        </div>
  <?php include "inc/footer.php"; ?>
</body>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
</html>