<?php
include_once 'inc/dbconnect.php';
session_start();
$current_timestamp = date('Y-m-d H:i:s');

$chosen_post = mysqli_real_escape_string($conn, $_POST['id']);
$sqlfindposts = "SELECT * FROM `forum_posts` WHERE `id` = '$chosen_post'";
$findposts = mysqli_query($conn, $sqlfindposts);
$ctposts = mysqli_num_rows($findposts);

if ($ctposts != 0)
{
  
$rowposts = mysqli_fetch_assoc($findposts);
$posts_name = $rowposts['forum_post'];
$status = $rowposts['status'];
$sqlfindcomments = "SELECT * FROM `forum_comments` WHERE `post_id` = '$chosen_post' ORDER BY `timestamp` DESC";
$findcomments = mysqli_query($conn, $sqlfindcomments);
$ctcomments = mysqli_num_rows($findcomments);
}
else
{
    echo "<h5>Post could not be found</h5>";
}

if (isset($_SESSION['user']))
{
    $session_usern = $_SESSION['user'];
}
else if(isset($_SESSION['admin']))
{
    $session_usern = $_SESSION['admin'];
    if ($status == "closed")
    {
      $modtools = "<div style='margin-bottom: 10px;' class='btn-group' role='group' aria-label='button'>
      <form action='php/unlock-post.php' method='post'>
      <input type='hidden' value='$chosen_post' name='post_id'>
      <button type='submit' title='Unlock Post' class='btn btn-warning'><i class='fa fa-unlock-alt' aria-hidden='true'></i></button>
       </form>
       <form action='php/delete-post.php' method='post'>
       <input type='hidden' value='$chosen_post' name='post_id'>
       <button type='submit' style='margin-left: 10px;' title='Delete Post' class='btn btn-danger'><i class='fa fa-trash' aria-hidden='true'></i></button>
        </form>
        </div>";
    }
    else
    {
      $modtools = "<div style='margin-bottom: 10px;' class='btn-group' role='group' aria-label='button'>
    <form action='php/lock-post.php' method='post'>
    <input type='hidden' value='$chosen_post' name='post_id'>
    <button type='submit' title='Lock Post' class='btn btn-warning'><i class='fa fa-lock' aria-hidden='true'></i></button>
     </form>
     <form action='php/delete-post.php' method='post'>
     <input type='hidden' value='$chosen_post' name='post_id'>
     <button type='submit' style='margin-left: 10px;' title='Delete Post' class='btn btn-danger'><i class='fa fa-trash' aria-hidden='true'></i></button>
      </form>
      </div>";
    }
    
     
}
else
{
    $session_usern = "Guest";
}



?>

<!doctype html>
<html lang="en">
  <head>
  	<title>Kerry's K9's - <?php echo $posts_name;?> Post </title>
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
<div class="container" style='min-height:40vh'><br>
  <h2 class="mb-4"><?php echo $posts_name;?> </h2><br>
  <?php echo $modtools; ?>
  <div <?php if ($ctcomments != 0) { echo ""; } else { echo "style='height:500px; overflow-y: scroll;'"; }?>>
  <?php 
  if ($ctcomments != 0)
  {
    while ($rowctcomments = $findcomments->fetch_assoc())
    {
      $comment_id = $rowctcomments['id'];
      $comment = $rowctcomments['comment'];
      $commenter = $rowctcomments['commenter'];
      $timestamp = $rowctcomments['timestamp'];
      $type = $rowctcomments['type'];

      if ($type == "main")
      {
        $title = "Announcement";
          $colour = "bg-secondary";
          $txt = "color:white!important;";
      }
      else
      {
        $title = "Comment";
          $colour = "";
          $txt = "";
      }
      if (isset($_SESSION['admin']) && $type != "main")
      {
        $tools = "<form action='php/delete-comment.php' method='post'><input type='hidden' value='$comment_id' name='comment'><button title='Delete comment' style='margin-left: 95%' type='submit' class='btn btn-danger'><i class='fa fa-trash' aria-hidden='true'></i></button></form>";
      }
      else if ($session_usern == $commenter && $type != "main")
      {
        $tools = "<form action='php/delete-comment.php' method='post'><input type='hidden' value='$comment_id' name='comment'><button title='Delete comment' style='margin-left: 95%' type='submit' class='btn btn-danger'><i class='fa fa-trash' aria-hidden='true'></i></button></form>";
      }
      else
      {
        $tools = "";
      }

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



      echo "
      
        <div class='card $colour text-center' style='$txt margin-bottom: 5px'>
    <div class='card-header'>
        $title from $commenter - $msg
        
    </div>
    <div class='card-body'>
        <p class='card-text'>$comment</p>
        
    </div>
    <div class='card-footer text-muted' style='$txt'>
        $tools
    </div>
    </div>
    ";
    }
  }
  else
  {
    echo "<h5>There are no comments for this post yet.</h5>";
  }
  ?>
   </div>
   <?php 
   if (isset($_SESSION['admin']) || isset($_SESSION['user']))
   {
   echo "<form action='php/new-comment.php' method='post'>
   <div class='form-group'>
   <label for='comment'>Post a new comment</label>
     <textarea class='form-control' style='width:50%' minlength='10' id='exampleFormControlTextarea1' rows='3' name='comment'></textarea>
   </div>
   <input type='hidden' value='<?php echo $chosen_post; ?>' name='id'>
   <button type='submit' class='btn btn-primary'>Post Comment</button>
 
 
 
   </form>";
   }
   else
   {
     echo "<h5>You must be signed in to post a new comment</h5>";
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

  
