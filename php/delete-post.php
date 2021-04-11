<?php
include_once '../inc/dbconnect.php';
session_start();
$current_timestamp = date('Y-m-d H:i:s');

if(isset($_SESSION['admin']))
{
    $session_usern = $_SESSION['admin'];
}
else
{
    echo "<script>window.location.replace('index');</script>";
}

$post_id = mysqli_real_escape_string($conn, $_POST['post_id']);

$sqlfindpost = "SELECT * FROM `forum_posts` WHERE `id` = '$post_id'";
$procfindpost = mysqli_query($conn, $sqlfindpost);

$ctfindpost = mysqli_num_rows($procfindpost);
if ($ctfindpost != 0)
{
    $sqllockpost = "DELETE FROM `forum_posts` WHERE `id` = '$post_id'";
    $sqldeletecomments = "DELETE FROM `forum_comments` WHERE `post_id` = '$post_id'";
    $proclock = mysqli_query($conn, $sqllockpost);
    $proccommdelete = mysqli_query($conn, $sqldeletecomments);
    if ($proclock && $proccommdelete)
    {
        echo "<script>window.location.replace('../forum');</script>";
    }
    else
    {
        echo "There was an error deleting the post.";
    }
}
else
{
    echo "There was an error finding the post.";
}


?>