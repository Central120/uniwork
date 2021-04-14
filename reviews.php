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
    $session_usern = "Guest";
}

$findreview = "SELECT * from reviews order by submit_date asc";
$searchreview = mysqli_query($conn, $findreview);
$numberreview = mysqli_num_rows($searchreview);

?>

<!doctype html>
<html lang="en">
<head>
    <title>Kerry's K9's - Reviews</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700' rel='stylesheet' type='text/css' />

</head>
<body>
<?php include "inc/header.php"; ?>
<div class="container-fluid" style='min-height:40vh'>
    <h2 class="mb-4">Welcome to Kerry's K9's reviews!</h2>

    <?php

    if ($numberreview != 0) {
        while ($reviewrow = $searchreview->fetch_assoc()) {
            $username = $reviewrow['username'];
            $star_rating = $reviewrow['star_rating'];
            $comments = $reviewrow['comments'];
            $status = $reviewrow['status'];
            $submit_date = $reviewrow['submit_date'];

            if ($status == 'approved') {
                $status_message = "<span class = 'badge badge-success'> (Verified User)</span>";
            }
            else {
                $status_message = "";
            }
            // find difference between next booking and current timestamp
            $date1 = strtotime($current_timestamp);
            $date2 = strtotime($submit_date);
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
            echo "<div class='card' style='width: 18rem;'>
  <div class='card-body'>
    <h5 class='card-title'>$username $status_message</h5>
    <h6 class='card-subtitle mb-2 text-muted'>$msg</h6>
    <p class='card-text'>$comments</p>
  </div>
</div>";
        }
    }
    else {
        echo "There are currently no reviews to see.";
    }

    ?>

</div>
</div>
</div>

<?php include "inc/footer.php"; ?>
</body>
<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script type='text/javascript'>
    $('#Form1').submit(function(event) {
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



































//// Below function will convert datetime to time elapsed string.
//function time_elapsed_string($datetime, $full = false) {
//    $now = new DateTime;
//    $ago = new DateTime($datetime);
//    $diff = $now->diff($ago);
//    $diff->w = floor($diff->d / 7);
//    $diff->d -= $diff->w * 7;
//    $string = array('y' => 'year', 'm' => 'month', 'w' => 'week', 'd' => 'day', 'h' => 'hour', 'i' => 'minute', 's' => 'second');
//    foreach ($string as $k => &$v) {
//        if ($diff->$k) {
//            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
//        } else {
//            unset($string[$k]);
//        }
//    }
//    if (!$full) $string = array_slice($string, 0, 1);
//    return $string ? implode(', ', $string) . ' ago' : 'just now';
//}
//// Page ID needs to exist, this is used to determine which reviews are for which page.
//if (isset($_GET['page_id'])) {
//    if (isset($_POST['username'], $_POST['star_rating'], $_POST['comments'])) {
//        // Insert a new review (user submitted form)
//        $stmt = $conn->prepare('INSERT INTO reviews (page_id, username, comments, star_rating, submit_date) VALUES (?,?,?,?,NOW())');
//        $stmt->execute([$_GET['page_id'], $_POST['username'], $_POST['comments'], $_POST['star_rating']]);
//        exit('Your review has been submitted!');
//    }
//    // Get all reviews by the Page ID ordered by the submit date
//    $stmt = $conn->prepare('SELECT * FROM reviews WHERE page_id = ? ORDER BY submit_date DESC');
//    $stmt->execute([$_GET['page_id']]);
//    $reviews = $stmt->fetchAll(PDO::FETCH_ASSOC);
//    // Get the overall rating and total amount of reviews
//    $stmt = $conn->prepare('SELECT AVG(star_rating) AS overall_rating, COUNT(*) AS total_reviews FROM reviews WHERE page_id = ?');
//    $stmt->execute([$_GET['page_id']]);
//    $reviews_info = $stmt->fetch(PDO::FETCH_ASSOC);
//} else {
//    exit('Please provide the page ID.');
//}
//
//if (isset($_GET['page_id'])) {
//    if (isset($_POST['username'], $_POST['star_rating'], $_POST['comments'])) {
//// Insert a new review (user submitted form)
//        $stmt = $conn->prepare('INSERT INTO reviews (page_id, username, comments, star_rating, submit_date) VALUES (?,?,?,?,NOW())');
//        $stmt->execute([$_GET['page_id'], $_POST['username'], $_POST['comments'], $_POST['star_rating']]);
//        exit('Your review has been submitted!');
//    }
//}
//?>
