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
  	<title>Kerry's K9's - My Bookings</title>
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

    table {
  border-collapse: collapse;
  border-spacing: 0;
  width: 100%;
 
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
    <div style="overflow-x:auto;" class="table-responsive table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xl">
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
            $approved = "Booking will be handled by: <p style='color:green'>$approver</p>";
        }

        if ($approved_timestamp == $ts1)
        {
            $color1 = "green";
        }
        else
        {
            $color1 = "red";
        }

        if ($approved_timestamp == $ts2)
        {
            $color2 = "green";
        }
        else
        {
            $color2 = "red";
        }

        $strts1 = strtotime("$ts1");
        $strts2 = strtotime("$ts2");

        $ts1d = date("l jS \of F, g:i a", $strts1);
        $ts2d = date("l jS \of F, g:i a", $strts2);

        echo "<tr>
        <td>$pet_name</td>
        <td>Timeslot 1: <p style='color:$color1'>$ts1d</p><br>Timeslot 2: <p style='color:$color2'>$ts2d</p></td>
        <td>Emergency 1: $ec1 <br> Emergency 2: $ec2</td>
        <td>$info</td>
        <td>$approved</td>
        <td><form action='php/cancel-booking.php' id='Form1' method='post' role='form'><input type='hidden' value='$booking_id' name='id'><input type='submit' class='btn btn-danger' value='Cancel Booking'></form></td>
        </tr>
        ";

        

    }


?>
 </tbody>
                </table>
            </div>
            <br>
            <h2 class="mb-42">Cancelled / Denied Bookings</h2>
    <div style="overflow-x:auto;" class="table-responsive table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xl">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Timeslot</th>
                            <th scope="col">Handled by</th>
                            <th scope="col">Time</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
  <?php
  $sqlfindrejected = mysqli_query($conn, "SELECT * FROM `cancelled_bookings` WHERE `username` = '$session_usern'");
    while ($rowfindrejected = $sqlfindrejected->fetch_assoc())
    {
        $tsc = $rowfindrejected['timeslot_cancelled'];
        $handler = $rowfindrejected['booking_handler'];
        $tc = $rowfindrejected['time_cancelled'];
        $action = $rowfindrejected['action'];

        // find difference between next promotion and current timestamp
        $date1 = strtotime($current_timestamp);
        $date2 = strtotime($tc);
        $diff = abs($date2- $date1);

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

        $badge = "<span class='badge badge-danger'>$action</span>";

        
        
        if ($approver == "")
        {
            $approved = "Booking Pending";
        }
        else
        {
            $approved = "Booking will be handled by: <p style='color:green'>$approver</p>";
        }

        if ($approved_timestamp == $ts1)
        {
            $color1 = "green";
        }
        else
        {
            $color1 = "red";
        }

        if ($approved_timestamp == $ts2)
        {
            $color2 = "green";
        }
        else
        {
            $color2 = "red";
        }

        $strtsc = strtotime("$tsc");
       

        $tscd = date("l jS \of F, g:i a", $strtsc);
        

        echo "<tr>
        <td>$tscd</td>
        <td>$handler</td>
        <td>$msg</td>
        <td>$action</td>
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
</html>