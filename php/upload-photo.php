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

$target_dir = "../images/uploads/";
$file = "images/uploads/" . $_FILES["image_upload"]["name"];
$target_file = $target_dir . basename($file);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["image_upload"]["tmp_name"]);
  if($check !== false) {
    $uploadOk = 1;
  } else {
    $msg1 = "<div class='alert alert-danger alert-dismissable fade show' role='alert'><strong>An error occured.</strong> The image you uploaded is not a real image. <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
        <span aria-hidden='true'>&times;</span>
        </button></div>";
    $uploadOk = 0;
  }
}


// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
    $msg1 = "<div class='alert alert-danger alert-dismissable fade show' role='alert'><strong>An error occured.</strong> Only JPG, JPEG or PNG images are allowed. <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
        <span aria-hidden='true'>&times;</span>
        </button></div>";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    $msg = "<div class='alert alert-danger alert-dismissable fade show' role='alert'><strong>An error occured.</strong> The image was not uploaded. <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span>
    </button></div>";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["image_upload"]["tmp_name"], $target_file)) {
    if (file_exists($target_file)) {
    $msg1 = "The image ". htmlspecialchars( basename( $_FILES["image_upload"]["name"])). " has been uploaded.";
    $sqlinsertimage = "INSERT INTO photo_sharing VALUES(DEFAULT, '$file', '$imageTitle', '$imageCaption', '$current_timestamp', 'pending'";
    $insertimage = mysqli_query($conn, $sqlinsertimage);
    if ($insertimage)
    {
        $msg1 = "<script>window.location.replace('../gallery');</script>";
    }
    else
    {
        $msg1 = "<div class='alert alert-danger alert-dismissable fade show' role='alert'><strong>An error occured.</strong> Your image hasn't been uploaded. <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
        <span aria-hidden='true'>&times;</span>
        </button></div>";
    }
  } else {
    $msg1 = "<div class='alert alert-danger alert-dismissable fade show' role='alert'><strong>An error occured.</strong> There was an error uploading your image. <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span>
    </button></div>";
  }
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
    <?php echo $msg1; ?><br>
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
window.location.replace('../add-product');
});
</script>
</html>