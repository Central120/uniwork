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
$id = mysqli_real_escape_string($conn, $_POST['id']);

if ($title == "" || $description == "")
{
    echo "Enter more information about the new category";
}
else
{
    if ($colour == "Green")
    {
        $real = "success";
    }
    else if ($colour == "Red")
    {
        $real = "danger";
    }
    else if ($colour == "Yellow")
    {
        $real = "warning";
    }
    else if ($colour == "Blue")
    {
        $real = "primary";
    }
    else if ($colour == "Light Blue")
    {
        $real = "info";
    }
    else if ($colour == "grey")
    {
        $real = "secondary";
    }
    else if ($colour == "Light Grey")
    {
        $real = "light";
    }
    else 
    {
        $real = "";
        echo "Colour not accepted";
    }


    $sqlfindcategory = "SELECT * FROM `forum_category` WHERE `id` = '$id'";
    $procfindcategory = mysqli_query($conn, $sqlfindcategory);
    $ctfindcategory = mysqli_num_rows($procfindcategory);

    if ($ctfindcategory != 0)
    {
        $sqlmodifycat = "UPDATE `forum_category` SET `category` = '$title', `category_desc` = '$description', `colour` = '$real' WHERE `id` = '$id'";
        $modifycat = mysqli_query($conn, $sqlmodifycat);
        if ($modifycat)
        {    
             echo "<script>window.location.replace('../../forum');</script>";
        }
        else
        {
            echo "Category not updated";
        }
    }
    else
    {
        echo "Category not found";
    }
}