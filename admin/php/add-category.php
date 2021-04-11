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


$title = mysqli_real_escape_string($conn, $_POST['title']);
$description = mysqli_real_escape_string($conn, $_POST['description']);
$colour = mysqli_real_escape_string($conn, $_POST['colour']);

if ($title == "" || $description == "")
{
    echo "Enter more information about the new category";
}
else
{
    if ($colour == "green")
    {
        $real = "success";
    }
    else if ($colour == "red")
    {
        $real = "danger";
    }
    else if ($colour == "yellow")
    {
        $real = "warning";
    }
    else if ($colour == "blue")
    {
        $real = "primary";
    }
    else if ($colour == "lightblue")
    {
        $real = "info";
    }
    else if ($colour == "grey")
    {
        $real = "secondary";
    }
    else if ($colour == "light")
    {
        $real = "light";
    }
    else 
    {
        $real = "";
        echo "Colour not accepted";
    }


    $sqlfindcategory = "SELECT * FROM `forum_category` WHERE `category` = '$title'";
    $procfindcategory = mysqli_query($conn, $sqlfindcategory);
    $ctfindcategory = mysqli_num_rows($procfindcategory);

    if ($ctfindcategory == 0)
    {
        $sqladdnewcat = "INSERT INTO `forum_category` VALUES (DEFAULT, '$title','$description','$real')";
        $addnewcat = mysqli_query($conn, $sqladdnewcat);
        if ($addnewcat)
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
        echo "Category already exists";
    }
}