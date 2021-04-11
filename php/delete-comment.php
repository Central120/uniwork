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

$comment_id = mysqli_real_escape_string($conn, $_POST['comment']);

$sqlfindcomment = "SELECT * FROM `forum_comments` WHERE `id` = '$comment_id'";
$procfindcomment = mysqli_query($conn, $sqlfindcomment);

$ctfindcomment = mysqli_num_rows($procfindcomment);
if ($ctfindcomment != 0)
{
    $sqldeletecomment = "DELETE FROM `forum_comments` WHERE `id` = '$comment_id'";
    $procdel = mysqli_query($conn, $sqldeletecomment);
    if ($procdel)
    {
        echo "<script>window.location.replace('forum');</script>";
    }
    else
    {
        echo "There was an error deleting the comment.";
    }
}
else
{
    echo "There was an error finding the comment.";
}


?>