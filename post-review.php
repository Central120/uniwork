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
    echo "<script>window.location.replace('login');</script>";
}

$findreview = "SELECT * from reviews where status = 'approved' order by submit_date asc";
$searchreview = mysqli_query($conn, $findreview);
$numberreview = mysqli_num_rows($searchreview);

?>

<!doctype html>
<html lang="en">
<head>
    <title>Kerry's K9's - Reviews</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="post-review.css" rel="stylesheet" type="text/css">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700' rel='stylesheet' type='text/css' />
    <style>
        .footer{
            margin-top:15%!important;
        }
    </style>
</head>
<body>
<?php include "inc/header.php"; ?>
<div class="container-fluid" >
    <div class="d-flex justify-content-center">
        <div id="server-results"> </div>
        <center>
            <h2 class="mb-4">Welcome to Kerry's K9's reviews!</h2>
                <form id="ratingsystem" action="php/confirmreview.php" method="post">
                    <label> Rate us out of 5: </label>
                    <div class="rating" style="margin-bottom: 10px;">
                        <input id="star5" name="star" type="radio" value="5" class="radio-btn hide" />
                        <label for="star5" >☆</label>
                        <input id="star4" name="star" type="radio" value="4" class="radio-btn hide" />
                        <label for="star4" >☆</label>
                        <input id="star3" name="star" type="radio" value="3" class="radio-btn hide" />
                        <label for="star3" >☆</label>
                        <input id="star2" name="star" type="radio" value="2" class="radio-btn hide" />
                        <label for="star2" >☆</label>
                        <input id="star1" name="star" type="radio" value="1" class="radio-btn hide" />
                        <label for="star1" >☆</label>
                        <div class="clear"></div>
                    </div>
                <div class="mb-3 row">
                    <label for="inputComment" class="col-sm-2 col-form-label">Review:</label>
                    <div class="col-sm-10">
                        <input type="comments" class="form-control" id="comments" name="comments">
                    </div>
                </div>
            <div>
                <input class= "btn btn-success" type="submit" value="Submit" accesskey="u">
            </div>
                </form>
    </div>
</div>







<?php include "inc/footer.php"; ?>
</body>
<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script type='text/javascript'>
    $('#ratingsystem').submit(function(event) {
        event.preventDefault(); //prevent default action
        var post_url = $(this).attr('action'); //get form action url
        var form_data = $(this).serialize(); //Encode form elements for submission

        $.ajax({
            url: post_url,
            type: 'post',
            data: form_data
        }).done(function(response) { //
            $('#server-results').html(response);

        });
    });
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
</html>

