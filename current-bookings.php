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
    echo "<script>window.location.replace('../index');</script>";
}


$findcurrentbookings = mysqli_query($conn, "SELECT * FROM `bookings` WHERE `username` = '$session_usern'");

?>
<!doctype html>
<html lang="en">
  <head>
  	<title>Kerry's K9's - My Bookings</title>
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
    <h2 class="mb-42">My Bookings</h2>
    <div id="server-results"></div>
    <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Pet Name</th>
                            <th scope="col">Timeslots</th>
                            <th scope="col">Emergency Contacts</th>
                            <th scope="col">Additional Info</th>
                            <th scope="col">Status</th>
                            <th>Manage</th>
                        </tr>
                    </thead>
                    <tbody>
  <?php
    while ($rowfindbooking = $findcurrentbookings->fetch_assoc())
    {
        $booking_id = $rowfindbooking['id'];
        $approver = $rowfindbooking['approver'];
        $approved_timestamp = $rowfindbooking['approved_timestamp'];
        $ts1 = $rowfindbooking['timeslot_1'];
        $ts2 = $rowfindbooking['timeslot_2'];
        $pet_name = $rowfindbooking['pet_name'];
        $ec1 = $rowfindbooking['ec1'];
        $ec2 = $rowfindbooking['ec2'];
        $info = $rowfindbooking['info'];
        
        if ($approver == "")
        {
            $approved = "Booking Pending";
        }
        else
        {
            $approved = "Approved by $approver";
        }

        if ($approved_timestamp == $ts1 || $approved_timestamp == $ts2)
        {
            $color = "green";
        }
        else
        {
            $color = "red";
        }

        echo "<tr>
        <td>$pet_name</td>
        <td>Timeslot 1: <p style='color:$color'>$ts1<p><br>Timeslot 2: <p style='color:$color'>$ts2</p></td>
        <td>Emergency 1: $ec1 <br> Emergency 2: $ec2</td>
        <td>$info</td>
        <td>$approved</td>
        <td><form action='cancel-booking.php' method='post' role='form'><input type='hidden' value='$booking_id' name='id'><input type='submit' class='btn btn-danger' value='Cancel Booking' /></form></td>
        </tr>
        ";

        

    }


?>
 </tbody>
                </table>
            </div>
        </div>
        </div>
            </div>
        </div>
    </div>
</div>
  <?php include "inc/footer.php"; ?>
</body>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
</html>