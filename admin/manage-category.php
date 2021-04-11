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

$sqlfindcategory = "SELECT * FROM `forum_category` ORDER BY `id`";
$findcategory = mysqli_query($conn, $sqlfindcategory);

?>
<!doctype html>
<html lang="en">
  <head>
  	<title>Kerry's K9's - Manage Category</title>
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
    <h2 class="mb-42">Manage Category</h2>
    <div id="server-results"></div>
    <div class="container" style='margin-bottom: 30%'>
    <div class="d-flex justify-content-center">
    <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Category Name</th>
                            <th scope="col">Category Description</th>
                            <th scope="col">Colour</th>
                            <th scope="col">Manage</th>
                        </tr>
                    </thead>
                    <tbody>
  <?php
    while ($rowfindcategory = $findcategory->fetch_assoc())
    {
        $id = $rowfindcategory['id'];
        $title = $rowfindcategory['title'];
        $description = $rowfindcategory['description'];
        $colour = $rowfindcategory['colour'];

        if ($colour == "success")
        {
            $real = "Green";
        }
        else if ($colour == "danger")
        {
            $real = "Red";
        }
        else if ($colour == "warning")
        {
            $real = "Yellow";
        }
        else if ($colour == "primary")
        {
            $real = "Blue";
        }
        else if ($colour == "info")
        {
            $real = "Light Blue";
        }
        else if ($colour == "secondary")
        {
            $real = "Grey";
        }
        else if ($colour == "light")
        {
            $real = "Light Grey";
        }
        else 
        {
            $real = "";
            echo "Colour not accepted";
        }
        echo "<tr>
        <td>$id</td>
        <td>$title</td>
        <td style='word-break:break-word'>$description</td>
        <td>$real</td>
        <td><input type='button' data-toggle='modal' id='cancel_btn' data-target='#category{$id}' class='btn btn-warning' value='Manage Category' /></td>
        </tr>
        ";

        echo "<div class='modal fade' id='category{$id}' tabindex='-1' role='dialog' aria-labelledby='category{$id}' aria-hidden='true'>
        <div class='modal-dialog' role='document'>
          <div class='modal-content' style='width:150%;left:-10%;'>
            <div class='modal-header'>
              <h5 class='modal-title'>What would you like to do with $title?</h5>
              <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
              </button>
            </div>
            <div class='modal-body'>
            <p>Deleting the category cannot be undone.</p>
            </div>
            <div class='modal-footer'>
            ";
                   
           echo "
            <form action='change-category.php' method='post' role='form'>
            <input type='hidden' value='$id' name='id' />
              <button type='submit' class='btn btn-success'>Modify category</button>
            </form>

            <form action='php/delete-category.php' method='post' role='form'>
            <input type='hidden' value='$id' name='id' />
              <button type='submit' class='btn btn-danger'>Delete category</button>
            </form>
            
              <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
            </div>
          </div>
        </div>
      </div>";

    }


?>
 </tbody>
                </table>
            </div>
        </div>
        </div>
  <?php include "inc/footer.php"; ?>
</body>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
</html>