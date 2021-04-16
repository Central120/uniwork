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


$listaccounts = mysqli_query($conn, "SELECT * FROM `accounts`");

?>
<!doctype html>
<html lang="en">
  <head>
  	<title>Kerry's K9's - Accounts</title>
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
    <h2 class="mb-42">Account List</h2>
    <div id="server-results"></div>
    <div class="container" style='margin-bottom: 30%'>
    <div class="d-flex justify-content-center">
    <div class="table-responsive">
      <div id="approve-results"></div>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Account ID</th>
                            <th scope="col">Username</th>
                            <th scope="col">Security Question 1</th>
                            <th scope="col">Security Question 2</th>
                            <th scope="col">User/Admin</th>
                            <th scope="col">Manage</th>
                        </tr>
                    </thead>
                    <tbody>
  <?php
    while ($rowaccounts = $listaccounts->fetch_assoc())
    {
     

        
        $accountid = $rowaccounts['id'];
        $accountusername = $rowaccounts['username'];
        $secq1 = $rowaccounts['secq1'];
        $secq2 = $rowaccounts['secq2'];
        if($rowaccounts['admin_id'] == 0)
        {
          $admin_status = "Suspended";
        }
        else if($rowaccounts['admin_id'] == 1)
        {
          $admin_status = "User";
        }
        else if($rowaccounts['admin_id'] == 2)
        {
            $admin_status = "Admin";
        }




        echo "<tr>
        <td>$accountid</td>
        <td>$accountusername</td>
        <td>$secq1</b></td>
        <td>$secq2</td>
        <td>$admin_status</td>
        <td><input type='button' data-toggle='modal' id='continue_btn' data-target='#manage{$accountid}' class='btn btn-warning' value='Manage' /></td>
        </tr>
        ";
        echo "<div class='modal fade' id='manage{$accountid}' tabindex='-1' role='dialog' aria-labelledby='manage{$accountid}' aria-hidden='true'>
        <div class='modal-dialog' role='document'>
          <div class='modal-content' style='width:150%;left:-10%;'>
            <div class='modal-header'>
              <h5 class='modal-title'>What would you like to do with $accountusername?</h5>
              <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
              </button>
            </div>
            <div class='modal-footer'>
            ";
        if ($admin_status == "Suspended"){
            echo "<form action='php/unsuspend-user.php' method='post' role='form'>
            <input type='hidden' value= '$accountid' name='id' />
              <button type='submit' class='btn btn-danger'>Unsuspend</button>
            </form>
            <form action='php/make-admin.php' method='post' role='form'>
            <input type='hidden' value= '$accountid' name='id' />
              <button type='submit' class='btn btn-danger'>Unsuspend and set as admin</button>
            </form>";
        }
        else if ($admin_status == "User"){
            echo "<form action='php/suspend.php' method='post' role='form'>
            <input type='hidden' value= '$accountid' name='id' />
              <button type='submit' class='btn btn-danger'>Suspend user</button>
            </form>
            <form action='php/make-admin.php' method='post' role='form'>
            <input type='hidden' value= '$accountid' name='id' />
              <button type='submit' class='btn btn-danger'>Make admin</button>
            </form>";
        }
        else if ($admin_status == "Admin"){
            echo "<form action='php/suspend.php' method='post' role='form'>
            <input type='hidden' value= '$accountid' name='id' />
              <button type='submit' class='btn btn-danger'>Suspend user</button>
            </form>
            <form action='php/make-user.php' method='post' role='form'>
            <input type='hidden' value= '$accountid' name='id' />
              <button type='submit' class='btn btn-danger'>Make user</button>
            </form>";
        }
        else {
            echo "";
        }
        echo "
            
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

<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
 



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
</html>