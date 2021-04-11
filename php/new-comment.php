<?php
include_once '../inc/dbconnect.php';
session_start();
$current_timestamp = date('Y-m-d H:i:s');

if(isset($_SESSION['user']))
{
    $session_usern = $_SESSION['user'];
}
else if (isset($_SESSION['admin']))
{
    $session_usern = $_SESSION['admin'];
}
else
{
    echo "<script>window.location.replace('index');</script>";
}

$comment = mysqli_real_escape_string($conn, $_POST['comment']);
$post_id = mysqli_real_escape_string($conn, $_POST['id']);

if ($comment = "")
{
    echo "The comment must have text in it.";
}
else
{
    $sqlfindpost = "SELECT * FROM `forum_posts` WHERE `id` = '$post_id'";
    $procfindpost = mysqli_query($conn, $sqlfindpost);
    $ctfindpost = mysqli_num_rows($procfindpost);

    if ($ctfindpost != 0)
    {
        $sqladdcomment = "INSERT INTO `forum_comments` VALUES (DEFAULT, '$post_id', '$comment', '$session_usern', '$current_timestamp', 'comment')";
        $procaddcomment = mysqli_query($conn, $sqladdcomment);
        if ($procaddcomment)
        {
            echo "<script>window.location.replace('../forum');</script>";
        }
        else
        {
            echo "There was an error adding your comment";
        }
    }
    else
    {
        echo "There was an error finding the post you are trying to comment on";
    }
}
