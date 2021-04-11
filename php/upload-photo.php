<?php
include_once '../inc/dbconnect.php';
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
    echo "<script>window.location.replace('index');</script>";
}

$imageTitle = mysqli_real_escape_string($conn, $_POST['title']);
$imageCaption = mysqli_real_escape_string($conn, $_POST['caption']);


$target_dir = "../../images/uploads/";
$file1 = "images/uploads/" . $_FILES["image_upload"]["name"];
$file = $_FILES["image_upload"]["name"];
$target_file = $target_dir . basename($file);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["image_upload"]["tmp_name"]);
  if($check !== false) {
    echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    $msq1 = "<div class='alert alert-danger alert-dismissable fade show' role='alert'><strong>Uhh ohh!</strong> The file you're uploading isn't an image file. <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span>
    </button></div>";
    $uploadOk = 0;
  }
}

// Check if file already exists
if (file_exists($target_file)) {
  $msq1 = "<div class='alert alert-danger alert-dismissable fade show' role='alert'><strong>Uhh ohh!</strong> This file name already exists. <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span>
    </button></div>";
  $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") 
{
  $msg = "<div class='alert alert-danger alert-dismissable fade show' role='alert'><strong>Uhh ohh!</strong> Only JPG, PNG & JPEG files are allowed.$imageFileType <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span>
    </button></div>";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  $msq1 = "<div class='alert alert-danger alert-dismissable fade show' role='alert'><strong>Uhh ohh!</strong> Your file hasn't been uploaded. <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span>
    </button></div>";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["image_upload"]["tmp_name"], $target_file)) {
    $uploadimagesql = "INSERT INTO photo_sharing VALUES(DEFAULT, '$session_usern', '$file1', '$imageTitle', '$imageCaption', '$current_timestamp', 'pending')";
    $imagerunsql = mysqli_query($conn, $uploadimagesql);

    if($imagerunsql)
    {
      echo "<script>window.location.replace('../gallery');</script>";
    }
    else
    {
      $msq1 = "<div class='alert alert-danger alert-dismissable fade show' role='alert'><strong>Uhh ohh!</strong> We failed to upload your image to the gallery. Please try again. <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span>
    </button></div>";
    }

  } else {
    echo "Sorry, there was an error uploading your file.";
  }
}

  ?>
  <!doctype html>
<html lang="en">
  <head>
  	<title>Kerry's K9's - Insert Image</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
   	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
     <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700' rel='stylesheet' type='text/css' />
     
     <style>
    .footer 
    {
        margin-top:20% !important;
    }
     </style>
</head>
<body>
    <?php include "../inc/header.php"; ?>
    <div class="container">
    <div class="d-flex justify-content-center">
    <?php echo $msg; ?><br>
    <?php echo $msq1; ?><br>
    <button id='retry' class='btn btn-warning'>Try again</button>
    </div>
    </div>
    <?php include "../inc/footer.php"; ?>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script>
$('#retry').click(function()
{
window.location.replace('../gallery');
});
</script>
</html>