<?php
include_once 'inc/dbconnect.php';
session_start();
$current_timestamp = date('Y-m-d H:i:s');
ini_set('display_errors', 1);

if(isset($_SESSION['admin']))
{
    $session_usern = $_SESSION['admin'];
}
else
{
    echo "<script>window.location.replace('../index');</script>";
}

$category = mysqli_real_escape_string($conn, $_POST['id']);
$sqlfindcategory = "SELECT * FROM `forum_category` WHERE `id` = '$category'";
$findcategory = mysqli_query($conn, $sqlfindcategory);
$rowfindcategory = mysqli_fetch_assoc($findcategory);
$title = $rowfindcategory['category'];
$description = $rowfindcategory['category_desc'];

?>

<!doctype html>
<html lang="en">
  <head>
  	<title>Kerry's K9's - Modify Category</title>
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
    <h2 class="mb-42">Modify Category</h2><br>
    <div class="container">
    <div class="d-flex justify-content-center">
    <form style='width:50%' action='php/add-category.php' method='post'>
    <div class="form-group">
    <label for="post_title">Title of New Category</label>
    <input type="text" class="form-control" value="<?php echo $title; ?>" name="title" placeholder="Enter title" />
    </div>
    <div class="form-group">
    <label for="post_content">Category Description</label>
    <textarea class='form-control' minlength='10' id='exampleFormControlTextarea1' rows='3' name='description'><?php echo $description; ?></textarea>
     </div>
     <div class="form-group">
    <label for="post_content">Colour</label>
    <select name="colour" class="form-control">
    <?php
    $sqlfindcolours = "SELECT * FROM `forum_category` WHERE `id` = '$category'";
    $findcolours = mysqli_query($conn, $sqlfindcolours);
    while ($colours = $findcolours->fetch_assoc())
    {
        $colour1 = "success";
        $real1 = "Green";
        $colour2 = "danger";
        $real2 = "Red";
        $colour3 = "warning";
        $real3 = "Yellow";
        $colour4 = "primary";
        $real4 = "Blue";
        $colour5 = "info";
        $real5 = "Light Blue";
        $colour6 = "light";
        $real6 = "Light Grey";
        $real7 = "Grey";
        $colour7 = "secondary";

      $colour = $colours['colour'];
    if ($colour == $colour1)
        { 
            echo "<option value='$real1' selected>$real1</option>";
        }
        else 
        {
            echo "<option value='$real1'>$real1</option>";
        }
     if ($colour == $colour2)
    {
        echo "<option value='$real2' selected>$real2</option>";
    }
    else 
        {
            echo "<option value='$real2'>$real2</option>";
        }
     if ($colour == $colour3)
    {
        echo "<option value='$real3' selected>$real3</option>";
    }
    else 
        {
            echo "<option value='$real3'>$real3</option>";
        }
     if ($colour == $colour4)
    {
        echo "<option value='$real4' selected>$real4</option>";
    }
    else 
        {
            echo "<option value='$real4'>$real4</option>";
        }
     if ($colour == $colour5)
    {
        echo "<option value='$real5' selected>$real5</option>";
    }
    else 
        {
            echo "<option value='$real5'>$real5</option>";
        }
     if ($colour == $colour6)
    {
        echo "<option value='$real6' selected>$real6</option>";
    }
    else 
        {
            echo "<option value='$real6'>$real6</option>";
        }
    if ($colour == $colour7)
    {
        echo "<option value='$real7' selected>$real7</option>";
    }
    else 
        {
            echo "<option value='$real7'>$real7</option>";
        }
        
       
    }
    
    ?>
    </select>
     </div>
     <button type='submit' class='btn btn-primary'>Modify Category</button>
     </form>
     </div>
     </div>
     <?php include "inc/footer.php"; ?>
</body>
<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
</html>
