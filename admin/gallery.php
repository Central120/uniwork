<?php
include_once '../inc/dbconnect.php';
session_start();

if(isset($_SESSION['admin']))
{
    $session_usern = $_SESSION['admin'];
}
else
{
    echo "<script>window.location.replace('../index');</script>";
}
?>

<!doctype html>
<html lang="en">
    <head>
  	<title>Kerry's K9's - Bookings Panel</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
   	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
     <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700' rel='stylesheet' type='text/css' />
<style>
.card-counter{
    box-shadow: 2px 2px 10px #DADADA;
    margin: 5px;
    padding: 10px 10px;
    background-color: #fff;
    height: 100px;
    border-radius: 5px;
    transition: .3s linear all;
  }

  .card-counter:hover{
    box-shadow: 4px 4px 20px #DADADA;
    transition: .3s linear all;
  }

  .card-counter.primary{
    background-color: #007bff;
    color: #FFF;
  }

  .card-counter.danger{
    background-color: #ef5350;
    color: #FFF;
  }  

  .card-counter.info{
    background-color: #26c6da;
    color: #FFF;
  }  

  .card-counter.success{
    background-color: #66bb6a;
    color: #FFF;
  }  

  .card-counter i{
    font-size: 5em;
    opacity: 0.2;
    
  }

  .card-counter .count-numbers{
    position: absolute;
    right: 35px;
    top: 20px;
    font-size: 32px;
    display: block;
  }

  .card-counter .count-name{
    position: absolute;
    right: 35px;
    top: 65px;
    font-style: italic;
    text-transform: capitalize;
    opacity: 0.5;
    display: block;
    font-size: 18px;
  }

  .footer 
  {
    margin-top:20% !important; 
  }
</style>		
  </head>
  <body>
  <?php include "inc/header.php"; ?> 
<div class="container container mt-4 mb-5">
        <h3 class="display-4 text-center">Gallery Panel</h3>
        <hr class="bg-dark mb-4 w-25">
<?php
        echo "
        <a href='index' class='btn btn-primary'>Back</a>
    <div class='container'>
    <div class='row'>
    
    <div class='col-md-3'>
    <a href='list-images' style='color: white' title='Click here to set your schedule'>
      <div class='card-counter primary'>
        <i class='fa fa-picture-o'></i>
      
        <span class='count-name'>Image Submissions</span>
      </div>
    </a>
      </div>

    <div class='col-md-3'>
    <a href='list-image-reports' style='color: white' title='Click here to view pending bookings'>
      <div class='card-counter info'>
        <i class='fa fa-gavel'></i>
        <span class='count-name'>Image Reports</span>
      </div>
      </a>
    </div>
  </div>
</div>
    ";
    	?>
      
    </div>
    <?php include "inc/footer.php"; ?>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
</html>