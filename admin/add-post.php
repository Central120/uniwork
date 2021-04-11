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
  	<title>Kerry's K9's - Add a product</title>
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
    <h2 class="mb-42">Add a new post</h2><br>
    <h5 style='color:red'>Note: if you would like to post to a new category, create the category first.</h5>
    <div id="server-results"></div>
    <div class="container">
    <div class="d-flex justify-content-center">
    <form action='php/add-product.php' method='post'>
    <label for='category'>Choose a category to post to</label>
    <select name='category' id='category' class="form-control">
    <?php
    $sqlfindcategories = "SELECT * FROM `forum_category`";
    $procfindcategories = mysqli_query($conn, $sqlfindcategories);
    $ctfindcat = mysqli_num_rows($procfindcategories);
    if ($ctfindcat != 0)
    {
      while ($rowfindcat = $procfindcategories->fetch_assoc())
      {
          $cat_id = $rowfindcat['id'];
          $category_name = $rowfindcat['category'];
          echo "<option value='$cat_id'>$category_name</option>";
      }  
    }
    ?>
    </select>
    <div class="form-group">
    <label for="post_title">Title of Post</label>
    <input type="text" class="form-control" name="title" placeholder="Enter title" />
    </div>
    <div class="form-group">
    <label for="post_content">Content of Post</label>
    <textarea class='form-control' style='width:50%' minlength='10' id='exampleFormControlTextarea1' rows='3' name='comment'></textarea>
     </div>
     <button type='submit' class='btn btn-primary'>Submit new post</button>
     </div>
     </div>
     <?php include "inc/footer.php"; ?>
</body>
<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
</html>
