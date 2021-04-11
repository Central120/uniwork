<?php
include_once '../inc/dbconnect.php';
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

$product_name = mysqli_real_escape_string($conn, $_POST['product_name']);
$existing_category = mysqli_real_escape_string($conn, $_POST['existing']);
$new_category = mysqli_real_escape_string($conn, $_POST['new']);
$price = mysqli_real_escape_string($conn, $_POST['price']);
$discount = mysqli_real_escape_string($conn, $_POST['discount']);
$stock = mysqli_real_escape_string($conn, $_POST['stock']);
$product_id = mysqli_real_escape_string($conn, $_POST['id']);

if ($existing_category == "")
{
    $chosen_cat = $new_category;
}

if ($new_category == "")
{
    $chosen_cat = $existing_category;
}

$final_price = number_format((float)$price, 2, '.','');
$final_discount = ceil($discount); // ensures the value is rounded to the nearest whole number (incase of decimal value being sent)
$final_stock = ceil($stock); // ensures the value is rounded to the nearest whole number (incase of decimal value being sent)


$sqlfindproduct = "SELECT * FROM `products` WHERE `id` = '$product_id'";
$findproduct = mysqli_query($conn, $sqlfindproduct);
$countfindproduct = mysqli_num_rows($findproduct);

// current image details
if ($countfindproduct != 0)
{
    $rowfindproduct = mysqli_fetch_assoc($findproduct);
    $image = $rowfindproduct['Image'];
    $target_dir2 = "../../images/";
    $target_file1 = $target_dir2 . basename($image);
    $error_message = "";
}
else
{
    $error_message = "<div class='alert alert-danger alert-dismissable fade show' role='alert'><strong>An error occured.</strong> The item could not be found. <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span>
  </button></div>";
}

$target_dir = "../../images/";
$file = "images/" . $_FILES["image_upload"]["name"];
$target_file = $target_dir . basename($file);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

if($_FILES["image_upload"]["name"]) {
     

if ($target_file==$target_file1)
{
    $msg1 = "<div class='alert alert-danger alert-dismissable fade show' role='alert'><strong>An error occured.</strong> The image you uploaded is the same as your current. <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
        <span aria-hidden='true'>&times;</span>
        </button></div>";
$uploadOk = 0;
}
else
{
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
    $sqlupdateproduct = "UPDATE `products` SET `product_name` = '$product_name', `category` = '$chosen_cat', `price` = '$final_price', `discount` = '$final_discount', `stock` = '$final_stock', `Image` = '$file' WHERE `id` = '$product_id'";
    $updateproduct = mysqli_query($conn, $sqlupdateproduct);
    if ($updateproduct)
    {
        $msg1 = "testyup";
      //  $msg1 = "<script>window.location.replace('../modify-products');</script>";
    }
    else
    {
        $msg1 = "<div class='alert alert-danger alert-dismissable fade show' role='alert'><strong>An error occured.</strong> Your product was not added. <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
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
}
}
else {
    $sqlupdateproduct = "UPDATE `products` SET `product_name` = '$product_name', `category` = '$chosen_cat', `price` = '$final_price', `discount` = '$final_discount', `stock` = '$final_stock' WHERE `id` = '$product_id'";
    $updateproduct = mysqli_query($conn, $sqlupdateproduct);
    if ($updateproduct)
    {
        $msg1 = "testy";
      //  $msg1 = "<script>window.location.replace('../modify-products');</script>";
    }
    else
    {
        $msg1 = "<div class='alert alert-danger alert-dismissable fade show' role='alert'><strong>An error occured.</strong> Your product was not added. <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
        <span aria-hidden='true'>&times;</span>
        </button></div>";
    }
}
echo $msg;
echo $msg1; 
?>


