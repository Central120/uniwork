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

$category = mysqli_real_escape_string($conn, $_POST['category']);
$title = mysqli_real_escape_string($conn, $_POST['title']);
$content = mysqli_real_escape_string($conn, $_POST['content']);

$sqlfindcategory = "SELECT * FROM `forum_category` WHERE `id` = '$category'";
$procfindcategory = mysqli_query($conn, $sqlfindcategory);
$ctfindcategory = mysqli_num_rows($procfindcategory);

if ($title == "")
{
    echo "";
}
else
{
    if ($ctfindcategory != 0)
    {
        $sqladdnewpost = "INSERT INTO `forum_posts` VALUES (DEFAULT, '$category','$title','$session_usern', '$current_timestamp', 'open')";
        $addnewpost = mysqli_query($conn, $sqladdnewpost);
        if ($addnewpost)
        {
            $sqlsearchpost = "SELECT * FROM `forum_posts` WHERE `category_id` = '$category' AND `forum_post` = '$title' AND `poster` = '$session_usern'";
            $searchpost = mysqli_query($conn, $sqlsearchpost);
            $ctsearchpost = mysqli_num_rows($searchpost);
            if ($ctsearchpost != 0)
            {
                $rowsearchpost = mysqli_fetch_assoc($searchpost);
                $post_id = $rowsearchpost['id'];
                $sqladdcontent = "INSERT INTO `forum_comments` VALUES (DEFAULT, '$post_id', '$content', '$session_usern', '$current_timestamp', 'main')";
                $addcontent = mysqli_query($conn, $sqladdcontent);
                if ($addcontent)
                {
                   echo "<script>window.location.replace('../add-post');</script>";
                }
                else
                {
                    echo "Content was not added";
                }
            }
            else
            {
                echo "Unable to find the new post";
            }
        }
        else
        {
            echo "Post was not added";
        }
    }
    else
    {
        echo "Category could not be found";
    }
}