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



$id = mysqli_real_escape_string($conn, $_POST['id']);
$sqlfindcategory = "SELECT * FROM `forum_category` WHERE `id` = '$id'";
$procfindcategory = mysqli_query($conn, $sqlfindcategory);
$ctfindcategory = mysqli_num_rows($procfindcategory);

if ($ctfindcategory != 0)
{
    $sqlfindposts = "SELECT * FROM `forum_posts` WHERE `category_id` = '$id'";
    $findposts = mysqli_query($conn, $sqlfindposts);
    $ctfindposts = mysqli_num_rows($findposts);
    if ($ctfindposts != 0)
    {
         
        while ($posts = $findposts->fetch_assoc())
        {
            $post_id = $posts['id'];
            $sqldelcom = "DELETE FROM `forum_comments` WHERE `post_id` = '$post_id'";
            $delcom = mysqli_query($conn, $sqldelcom);
            $sqldelpost = "DELETE FROM `forum_posts` WHERE `id` = '$post_id'";
            $delpost = mysqli_query($conn, $sqldelpost);

            if ($delpost && $delcom)
            {
                echo "Posts and Comments deleted from category";
            }
            else
            {
                echo "Posts / Comments not deleted.";
            }
        }
        $sqldelcat = "DELETE FROM `forum_category` WHERE `id` = '$id'";
        $delcat = mysqli_query($conn, $sqldelcat);
        if ($delcat)
        {
            echo "<script>window.location.replace('../manage-category');</script>";
        }
        else
        {
            echo "Category not deleted";
        }
    }
    else
    {
        echo "Error finding the posts to delete";
    }
    
}
else
{
    echo "Category not found";
}