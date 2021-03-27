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
  	<title>Kerry's K9's - Admin Homepage</title>
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

  .card-counter.success{
    background-color: #66bb6a;
    color: #FFF;
  }  

  .card-counter.info{
    background-color: #26c6da;
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
</style>		
  </head>
]
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
