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


$findimages = mysqli_query($conn, "SELECT * FROM `photo_sharing` WHERE `approver` != ''");

?>
<!doctype html>
<html lang="en">
  <head>
  	<title>Kerry's K9's - Submitted Photos</title>
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
    <h2 class="mb-42">Submitted Photos</h2>
    <div id="server-results"></div>
    <div class="container" style='margin-bottom: 30%'>
    <div class="d-flex justify-content-center">
    <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Username</th>
                            <th scope="col">Image<br><small>Click to view image</small></th>
                            <th scope="col">Image Title</th>
                            <th scope="col">Image Caption</th>
                            <th scope="col">Submitted on</th>
                            <th scope="col">Approved By</th>
                            <th>Manage</th>
                        </tr>
                    </thead>
                    <tbody>
  <?php
    while ($rowimages = $findimages->fetch_assoc())
    {
        $imageid = $rowimages['id'];
        $imageUsername = $rowimages['username'];
        $p_location = $rowimages['p_location'];
        $title = $rowimages['product_name'];
        $caption = $rowimages['caption'];
        $imageTimestamp = $rowimages['timestamp'];
        $approver = $rowimages['approver'];
      
        if($approver == "pending")
        {
          $approve1 = "Pending Approval";
        }
        else
        {
          $approve1 = $rowimages['approver'];
        }

        echo "<tr>
        <td>$imageUsername</td>
        <td><a href='../$p_location' target='_blank'>View Image</a></td>
        <td>$title</b></td>
        <td>$caption</td>
        <td>$imageTimestamp</td>
        <td>$approve1</td>
        
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


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
</html>