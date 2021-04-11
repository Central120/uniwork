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
    $session_usern = "Guest";
}

$sqlfindcategories = "SELECT * FROM `forum_category` ORDER BY `category`";
$findcategories = mysqli_query($conn, $sqlfindcategories);
$ctcat = mysqli_num_rows($findcategories);

?>

<!doctype html>
<html lang="en">
  <head>
  	<title>Kerry's K9's - Forum</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
   	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
     <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700' rel='stylesheet' type='text/css' />

		<style>
  .footer 
  {
    margin-top: 20% !important; 
  }
    </style>
  </head>
  <body>
  <?php include "inc/header.php"; ?>
<center>
<div class="container-fluid" style='min-height:40vh'>
  <h2 class="mb-4">Welcome to Kerry's K9's Forum</h2><br>
  <p>Below are the forum categories</p>
  <br>
  <?php
  if ($ctcat != 0)
  {
    while ($rowctcat = $findcategories->fetch_assoc())
    {
      $cat_id = $rowctcat['id'];
      $category = $rowctcat['category'];
      $cat_desc = $rowctcat['category_desc'];
      $colour = $rowctcat['colour'];

      echo "
      <form action='forum-posts.php' method='post'>
      <div class='card bg-$colour'>
      <div class='card-body'>
        <h4 class='card-title'>$category</h4>
        <p class='card-text'>$cat_desc</p>
        <input type='hidden' value='$cat_id' name='id'>
        <input type='submit' value='View Posts' class='btn btn-primary'>
      </div>
    </div>
    </form>";
    }
  }
  else
  {
    echo "There are no categories";
  }
  ?>
</div>
<?php include "inc/footer.php"; ?>
</body>
<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
</html>

  
