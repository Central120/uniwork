<?php
include_once 'inc/dbconnect.php';
session_start();
$current_timestamp = date('Y-m-d H:i:s');

if(isset($_SESSION['admin']))
{
    $session_usern = $_SESSION['admin'];
}
else
{
    echo "<script>window.location.replace('../index');</script>";
}


$findpending = mysqli_query($conn, "SELECT * FROM `bookings` WHERE `approver` = ''");
$countfindbooking = mysqli_num_rows($findpending);
?>
<!doctype html>
<html lang="en">
  <head>
  	<title>Kerry's K9's - Pending Bookings</title>
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
    <div class="container" style='margin-bottom: 30%'>
    <div class="d-flex justify-content-center">
    <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Username</th>
                            <th scope="col">Pet Name</th>
                            <th scope="col">Timeslots</th>
                            <th scope="col">Emergency Contacts</th>
                            <th scope="col">Additional Info</th>
                            <th>Manage</th>
                        </tr>
                    </thead>
                    <tbody>
  <?php
    if ($countfindbooking == 0)
    {
      echo "<tr><td>There are no pending bookings</td></tr>";
    }
    else
    {
    while ($rowfindbooking = $findpending->fetch_assoc())
    {
        
        $booking_id = $rowfindbooking['id'];
        $username = $rowfindbooking['username'];
        $ts1 = $rowfindbooking['timeslot_1'];
        $ts2 = $rowfindbooking['timeslot_2'];
        $pet_name = $rowfindbooking['pet_name'];
        $ec1 = $rowfindbooking['ec1'];
        $ec2 = $rowfindbooking['ec2'];
        $info = $rowfindbooking['info'];

        $strts1 = strtotime("$ts1");
        $strts2 = strtotime("$ts2");

        $ts1d = date("l jS \of F, g:i a", $strts1);
        $ts2d = date("l jS \of F, g:i a", $strts2);

        
        echo "<tr>
        <td>$username</td>
        <td>$pet_name</td>
        <td>Timeslot 1: <p>$ts1d</p><br>Timeslot 2: <p>$ts2d</p></td>
        <td>Emergency 1: $ec1 <br> Emergency 2: $ec2</td>
        <td>$info</td>
        <td><input type='button' data-toggle='modal' id='continue_btn' data-target='#manage{$booking_id}' class='btn btn-warning' value='Manage' /></td>
        </tr>
        ";

        echo "<div class='modal fade' id='manage{$booking_id}' tabindex='-1' role='dialog' aria-labelledby='manage{$booking_id}' aria-hidden='true'>
        <div class='modal-dialog' role='document'>
          <div class='modal-content' style='width:150%;left:-10%;'>
            <div class='modal-header'>
              <h5 class='modal-title'>What would you like to do with $username's booking?</h5>
              <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
              </button>
            </div>
            <div class='modal-body'>
            <p>Reminder: <br>Timeslot 1: <b>$ts1d</b> <br>Timeslot 2: <b>$ts2d</b>
            </div>
            <div class='modal-footer'>
            ";
            

              echo "<form action='php/approve-booking.php' method='post' role='form'><input type='hidden' value='$booking_id' name='id' />
              <input type='hidden' value='$ts1' name='ts'>
              <button type='submit' class='btn btn-success'>Approve Timeslot 1</button>
            </form>";

            echo "<form action='php/approve-booking.php' method='post' role='form'><input type='hidden' value='$booking_id' name='id' />
            <input type='hidden' value='$ts2' name='ts'>
            <button type='submit' class='btn btn-outline-success'>Approve Timeslot 2</button>
          </form>";
            
           echo "
            <form action='php/approve-booking.php' method='post' role='form'>
            <input type='hidden' value='$booking_id' name='id' /><input type='hidden' value='none' name='ts'>
              <button type='submit' class='btn btn-danger'>Deny both timeslots</button>
            </form>
              <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
            </div>
          </div>
        </div>
      </div>";

    }
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