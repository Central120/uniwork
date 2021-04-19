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
    echo "<script>window.location.replace('index');</script>";
}



?>
<!doctype html>
<html lang="en">
  <head>
  	<title>Kerry's K9's - Past Bookings</title>
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
        <a href='bookings' class='btn btn-primary'>Back</a><br>
       <h2 class="mb-42">Past Bookings</h2>
            <div class="container">
            <div class="d-flex justify-content-center">
    <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Timeslot</th>
                            <th scope="col">Handled by</th>
                            <th scope="col">Time since action taken</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
  <?php
  $sqlfindrejected = mysqli_query($conn, "SELECT * FROM `cancelled_bookings`");
    while ($rowfindrejected = $sqlfindrejected->fetch_assoc())
    {
        $tsc = $rowfindrejected['timeslot_cancelled'];
        $handler = $rowfindrejected['booking_handler'];
        $tc = $rowfindrejected['time_cancelled'];
        $action = $rowfindrejected['action'];

        // find difference between next booking and current timestamp
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

        if ($action == 'Completed')
        {
            $badge = "<span class='badge badge-success'>$action</span>";
        }
        else
        {
            $badge = "<span class='badge badge-danger'>$action</span>";
        }

        if ($tsc == "None allocated" || $tsc == "None accepted")
        {
            $tscd = $tsc;
        }
        else
        {
            $strtsc = strtotime("$tsc");
            $tscd = date("l jS \of F, g:i a", $strtsc);
        }
        

        echo "<tr>
        <td>$tscd</td>
        <td>$handler</td>
        <td>$msg</td>
        <td>$badge</td>
        </tr>
        ";

        

    }


?>
 </tbody>
                </table>
            </div>
        </div>
        </div>
                       
  <?php include "inc/footer.php"; ?>
</body>
<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
</html>