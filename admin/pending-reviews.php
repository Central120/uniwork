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


$findpending = mysqli_query($conn, "SELECT * FROM `reviews` WHERE `status` = 'pending'");
$countfindreview = mysqli_num_rows($findpending);
?>
<!doctype html>
<html lang="en">
<head>
    <title>Kerry's K9's - Pending Reviews</title>
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
    <h2 class="mb-42">Pending Reviews</h2>
    <div id="server-results"></div>
    <div class="container" style='margin-bottom: 30%'>
        <div class="d-flex justify-content-center">
            <div class="table-responsive">
                <?php
                if ($countfindreview == 0)
                {
                    echo "<h5 class='mb-5'>There are no pending reviews</h5>";
                }
                else
                {
                    echo "<table class='table table-striped'>
            <thead>
                <tr>
                    <th scope='col'>Username</th>
                    <th scope='col'>Star Ratings</th>
                    <th scope='col'>Comments</th>
                    <th scope='col'>Submitted At</th>
                    <th>Manage</th>
                </tr>
            </thead>
            <tbody>";
                    while ($rowfindreview = $findpending->fetch_assoc())
                    {

                        $review_id = $rowfindreview['id'];
                        $username = $rowfindreview['username'];
                        $star_rating = $rowfindreview['star_rating'];
                        $submit_date = $rowfindreview['submit_date'];
                        $comments = $rowfindreview['comments'];

                        $strts1 = strtotime("$submit_date");

                        $ts1d = date("l jS \of F, g:i a", $strts1);

                        echo "<tr>
        <td>$username</td>
        <td>$star_rating</td>
        <td>$comments</td>
        <td>$ts1d</td>
        <td><input type='button' data-toggle='modal' id='continue_btn' data-target='#manage{$review_id}' class='btn btn-warning' value='Manage' /></td>
        </tr>
        ";

                        echo "<div class='modal fade' id='manage{$review_id}' tabindex='-1' role='dialog' aria-labelledby='manage{$review_id}' aria-hidden='true'>
        <div class='modal-dialog' role='document'>
          <div class='modal-content' style='width:150%;left:-10%;'>
            <div class='modal-header'>
              <h5 class='modal-title'>What would you like to do with $username's review?</h5>
              <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
              </button>
            </div>
            <div class='modal-footer'>
            ";


                        echo "<form action='php/approved-reviews.php' method='post' role='form'><input type='hidden' value='$review_id' name='approve' />
              <input type='hidden' value='$status = 1' name='id'>
              <button type='submit' class='btn btn-success'>Approve Timeslot 1</button>
            </form>";

                        echo "
            <form action='php/denied-reviews.php' method='post' role='form'>
            <input type='hidden' value='$status = 1' name='id' /><input type='hidden' value='none' name='deny'>
              <button type='submit' class='btn btn-danger'>Deny Review</button>
            </form>
              <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
            </div>
          </div>
        </div>
      </div>";

                    }
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