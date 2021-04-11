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

$chosen_cat = mysqli_real_escape_string($conn, $_POST['id']);
$sqlfindcategories = "SELECT * FROM `forum_category` WHERE `id` = '$chosen_cat'";
$findcategories = mysqli_query($conn, $sqlfindcategories);
$ctcat = mysqli_num_rows($findcategories);

if ($ctcat != 0)
{
    $rowcat = mysqli_fetch_assoc($findcategories);
    $category_name = $rowcat['category'];

$sqlfindposts = "SELECT * FROM `forum_posts` WHERE `category_id` = '$chosen_cat' ORDER BY `timestamp` DESC";
$findposts = mysqli_query($conn, $sqlfindposts);
$ctposts = mysqli_num_rows($findposts);
}
else
{
    echo "<h5>Category could not be found</h5>";
}
?>

<!doctype html>
<html lang="en">
  <head>
  	<title>Kerry's K9's - Forum Posts</title>
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
<div class="container" style='min-height:40vh'>
  <h2 class="mb-4"><?php echo $category_name;?> posts:</h2><br>
  <?php 
  if ($ctposts != 0)
  {
      echo "
  <table class='table table-hover'>
    <thead class='thead-dark'>
      <tr>
        <th>Post</th>
        <th>Author</th>
        <th>Time Posted</th>
        <th>Status</th>
        <th>View Post</th>
      </tr>
    </thead>
    <tbody>
  <br>";
  
    while ($rowctposts = $findposts->fetch_assoc())
    {
      $post_id = $rowctposts['id'];
      $post_name = $rowctposts['forum_post'];
      $poster = $rowctposts['poster'];
      $timestamp = $rowctposts['timestamp'];
      $status = $rowctposts['status'];

      $date1 = strtotime($current_timestamp);
      $date2 = strtotime($timestamp);
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

      if ($status == "closed" || isset($_SESSION['admin']))
      {
        $msgstatus = "Closed";
        if (isset($_SESSION['admin']))
        {
          $input = "<input type='hidden' value='$post_id' name='id'><input type='submit' value='View Post' class='btn btn-success'>";
        }
        else
        {
          $input = "";
        }
      }
      else
      {
        $msgstatus = "Open";
        $input = "<input type='hidden' value='$post_id' name='id'><input type='submit' value='View Post' class='btn btn-success'>";
      }

      echo "
      <form action='forum-comments.php' method='post'>
      <tr>
      <td>$post_name</td>
      <td>$poster</td>
      <td title='$timestamp'>$msg</td>
      <td>$msgstatus</td>
      <td>$input</td></tr>
    </form>";
    }
  }
  else
  {
    echo "<h5>There are no posts for this category</h5>";
  }
  ?>
   </tbody>
</table>
</div>
<?php include "inc/footer.php"; ?>
</body>
<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
</html>

  
