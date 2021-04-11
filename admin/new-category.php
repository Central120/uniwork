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

?>

<!doctype html>
<html lang="en">
  <head>
  	<title>Kerry's K9's - Add a new category</title>
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
    <h2 class="mb-42">Add a new category</h2><br>
    <h5 style='color:red'>Note: if you would like to post to a new category, create the category first.</h5>
    <div id="server-results"></div>
    <div class="container">
    <div class="d-flex justify-content-center">
    <form style='width:50%' action='php/add-category.php' method='post'>
    <div class="form-group">
    <label for="post_title">Title of New Category</label>
    <input type="text" class="form-control" name="title" placeholder="Enter title" />
    </div>
    <div class="form-group">
    <label for="post_content">Category Description</label>
    <textarea class='form-control' minlength='10' id='exampleFormControlTextarea1' rows='3' name='description'></textarea>
     </div>
     <div class="form-group">
    <label for="post_content">Colour</label>
    <select name="colour" class="form-control">
    <option value="green">Green</option>
    <option value="red">Red</option>
    <option value="yellow">Yellow</option>
    <option value="blue">Blue</option>
    <option value="lightblue">Light Blue</option>
    <option value="grey">Grey</option>
    <option value="light">Light Grey</option>
    </select>
     </div>
     <button type='submit' class='btn btn-primary'>Submit new category</button>
     </div>
     </div>
     <?php include "inc/footer.php"; ?>
</body>
<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
</html>
