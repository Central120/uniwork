<?php
include_once 'inc/dbconnect.php';
session_start();
$current_timestamp = date('Y-m-d H:i:s');
ini_set('display_errors', 1);

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
    echo "<script>window.location.replace('index');</script>";
}

$sqlfindcart = "SELECT * FROM `cart` WHERE `username` = '$session_usern'";
$findcart = mysqli_query($conn, $sqlfindcart);
$countfindcart = mysqli_num_rows($findcart);
if($countfindcart !=0){
    while($rowfindcart = $findcart->fetch_assoc()){
        $id = $rowfindcart['id'];
        $sqlupdatecart = "UPDATE `cart` SET `checkout` = 'yes' WHERE `id` = '$id'";
        $updatecart = mysqli_query($conn, $sqlupdatecart);
        if ($updatecart)
        {
            echo "<script>window.location.replace('../cart');</script>";
        }
        else
        {
            echo "There was an error updating your cart to checked-out";
        }
    }
}
else
{
    echo "There was an error finding your cart.";
}