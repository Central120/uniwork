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

  .card-counter.photos{
    background-color: #faa125;
    color: #FFF;
  }

  .card-counter.reviews{
    background-color: #b10fbd;
    color: #FFF;
  }

  .card-counter.news{
    background-color: #2bedcd;
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

  .footer 
  {
    margin-top:20% !important; 
  }
</style>		
  </head>
  <body>
  <?php include "inc/header.php"; ?> 
<div class="container container mt-4 mb-5">
        <h3 class="display-4 text-center">Admin Panel</h3>
        <hr class="bg-dark mb-4 w-25">
<?php
// sql for counting bookings
$sqlcountbookings = "select count(*) as totalbookings FROM `bookings`";
$resultcountbookings = mysqli_query($conn,$sqlcountbookings);
$rowcountbookings = mysqli_fetch_array($resultcountbookings);
  if ($rowcountbookings['totalbookings'] == '1')
  {
    $bookingtxt = "Booking";
  }
  else
  {
    $bookingtxt = "Bookings";
  }

  // sql for counting products
  $sqlcountproducts = "select count(*) as totalproducts FROM `products`";
  $resultcountproducts = mysqli_query($conn,$sqlcountproducts);
  $rowcountproducts = mysqli_fetch_array($resultcountproducts);
    if ($rowcountproducts['totalproducts'] == '1')
    {
      $producttxt = "Product";
    }
    else
    {
      $producttxt = "Products";
    }
    
  // sql for counting users
  $sqlcountusers = "SELECT count(*) as totalusers FROM `accounts`";
  $resultcountusers = mysqli_query($conn, $sqlcountusers);
  $rowcountusers = mysqli_fetch_array($resultcountusers);
  if($rowcountusers['totalusers'] == '1')
  {
    $userstxt = "User";
  }
  else
  {
    $userstxt = "Users";
  }

  // sql for counting photos
  $sqlcountphotos = "SELECT count(*) as totalphotos FROM `photo_sharing`";
  $resultcountphotos = mysqli_query($conn, $sqlcountphotos);
  $rowcountphotos = mysqli_fetch_array($resultcountphotos);
  if($rowcountphotos['totalphotos'] == '1')
  {
    $phototxt = "Photo";
  }
  else
  {
    $phototxt = "Photos";
  }

  // sql for counting reviews
  $sqlcountreviews = "SELECT count(*) as totalreviews FROM `reviews`";
  $resultcountreviews = mysqli_query($conn, $sqlcountreviews);
  $rowcountreviews = mysqli_fetch_array($resultcountreviews);
  if($rowcountreviews['totalreviews'] == '1')
  {
    $reviewtxt = "Review";
  }
  else
  {
    $reviewtxt = "Reviews";
  }

  // sql for counting News Posts
  $sqlcountnews = "SELECT count(*) as totalnews FROM `announcements`";
  $resultcountnews = mysqli_query($conn, $sqlcountnews);
  $rowcountnews = mysqli_fetch_array($resultcountnews);
  if($rowcountnews['totalnews'] == '1')
  {
    $newstxt = "News Post";
  }
  else
  {
    $newstxt = "News Posts";
  }

  // sql for counting Image Reports
  $sqlcountimagereports = "SELECT count(*) as totalimagereports FROM `image_report`";
  $resultimagereports = mysqli_query($conn, $sqlcountimagereports);
  $rowcountimagereports = mysqli_fetch_array($resultimagereports);
  if($rowcountimagereports['totalimagereports'] == '1')
  {
    $imgreporttxt = "Image Report";
  }
  else
  {
    $imgreporttxt = "Image Reports";
  }

        echo "
    <div class='container'>
    <div class='row'>
    <div class='col-md-3'>
    <a href='bookings' style='color: white' title='Click here to view Bookings'>
      <div class='card-counter primary'>
        <i class='fa fa-book'></i>
        <span class='count-numbers'>{$rowcountbookings['totalbookings']}</span>
        <span class='count-name'>$bookingtxt</span>
      </div>
    </a>
      </div>

    <div class='col-md-3'>
    <a href='products' style='color: white' title='Click here to view Product Options'>
      <div class='card-counter danger'>
        <i class='fa fa-tags'></i>
        <span class='count-numbers'>{$rowcountproducts['totalproducts']}</span>
        <span class='count-name'>$producttxt</span>
      </div>
      </a>
    </div>

    <div class='col-md-3'>
    <a href='users' style='color: white' title='Click here to view User Options'>
      <div class='card-counter info'>
        <i class='fa fa-users'></i>
        <span class='count-numbers'>{$rowcountusers['totalusers']}</span>
        <span class='count-name'>{$userstxt}</span>
    
      </div>
      </a>
    </div>

    <div class='col-md-3'>
    <a href='list-images' style='color: white' title='Click here to view Photo Options'>
      <div class='card-counter photos'>
        <i class='fa fa-picture-o'></i>
        <span class='count-numbers'>{$rowcountphotos['totalphotos']}</span>
        <span class='count-name'>{$phototxt}</span>
    
      </div>
      </a>
    </div>

    <div class='col-md-3'>
    <a href='users' style='color: white' title='Click here to view Reviews'>
      <div class='card-counter reviews'>
        <i class='fa fa-pencil-square-o'></i>
        <span class='count-numbers'>{$rowcountreviews['totalreviews']}</span>
        <span class='count-name'>{$reviewtxt}</span>
    
      </div>
      </a>
    </div>

    <div class='col-md-3'>
    <a href='users' style='color: white' title='Click here to view News and Announcements'>
      <div class='card-counter news'>
        <i class='fa fa-newspaper-o'></i>
        <span class='count-numbers'>{$rowcountnews['totalnews']}</span>
        <span class='count-name'>{$newstxt}</span>
    
      </div>
      </a>
    </div>

    <div class='col-md-3'>
    <a href='list-image-reports' style='color: white' title='Click here to view Image Reports'>
      <div class='card-counter news'>
        <i class='fa fa-newspaper-o'></i>
        <span class='count-numbers'>{$rowcountimagereports['totalimagereports']}</span>
        <span class='count-name'>{$imgreporttxt}</span>
    
      </div>
      </a>
    </div>

  </div>
</div>
    ";
    	?>
      
    </div>
    <?php include "inc/footer.php"; ?>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
</html>