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
  	<title>YMCA Caf&eacute; - Home</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
		
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="custom-css/style1.css">
		
		
  </head>
  <body>
  <?php include "inc/header.php"; ?> 
<div class="container container mt-4 mb-5">
        <h3 class="display-4 text-center">Admin Panel</h3>
        <hr class="bg-dark mb-4 w-25">
<?php
        echo "
    <div class='container'>
    <div class='row'>
    <div class='col-md-3'>
    <a href='bookings' style='color: white' title='Click here to view Bookings'>
      <div class='card-counter primary'>
        <i class='fa fa-book'></i>
        <span class='count-numbers'>Amount</span>
        <span class='count-name'>Bookings</span>
      </div>
    </a>
      </div>

    <div class='col-md-3'>
    <a href='products' style='color: white' title='Click here to view Product Options'>
      <div class='card-counter danger'>
        <i class='fa fa-tags'></i>
        <span class='count-numbers'>Amount</span>
        <span class='count-name'>Products</span>
      </div>
      </a>
    </div>

    <div class='col-md-3'>
    <a href='cart' style='color: white' title='Click here to view Cart Options'>
      <div class='card-counter success'>
        <i class='fa fa-shopping-basket'></i>
        <span class='count-numbers'>Amount</span>
        <span class='count-name'>Cart Items</span>
      </div>
      </a>
    </div>

    <div class='col-md-3'>
    <a href='users' style='color: white' title='Click here to view User Options'>
      <div class='card-counter info'>
        <i class='fa fa-users'></i>
        <span class='count-numbers'>Amount</span>
        <span class='count-name'>Users</span>
    
      </div>
      </a>
    </div>

    <div class='col-md-3'>
    <a href='users' style='color: white' title='Click here to view Photo Options'>
      <div class='card-counter info'>
        <i class='fa fa-picture-o'></i>
        <span class='count-numbers'>Amount</span>
        <span class='count-name'>Photos</span>
    
      </div>
      </a>
    </div>

    <div class='col-md-3'>
    <a href='users' style='color: white' title='Click here to view Reviews'>
      <div class='card-counter info'>
        <i class='fa fa-pencil-square-o'></i>
        <span class='count-numbers'>Amount</span>
        <span class='count-name'>Reviews</span>
    
      </div>
      </a>
    </div>

    <div class='col-md-3'>
    <a href='users' style='color: white' title='Click here to view News and Announcements'>
      <div class='card-counter info'>
        <i class='fa fa-newspaper-o'></i>
        <span class='count-numbers'>Amount</span>
        <span class='count-name'>News Posts</span>
    
      </div>
      </a>
    </div>

  </div>
</div>
    ";
    	?>
      
    </div>
