<?php
include_once 'database.php';

$username = mysqli_real_escape_string($con, $_POST['username']);
$password = mysqli_real_escape_string($con, $_POST['password']);
$passencrypt = md5($password);

$sql = "SELECT * FROM accounts WHERE username='$username' AND password='$passencrypt'";

$results = mysqli_query($con,$sql);
$userCount = mysqli_num_rows($results);
$row = mysqli_fetch_array($results);

if(empty($_POST['username']) || empty($_POST['password']))
{
    ?>
        <div class="alert alert-danger" role="alert">The fields can't be empty.</div>
    <?php
}
else
{
    if($userCount != 0)
    {
        session_start();
        $_SESSION['valid'] = $username;
        $_SESSION['username'] = $row['username'];
        $_SESSION['userid'] = $row['id'];

        echo "<meta http-equiv='refresh' content='2; url=index.php'>";
        echo "<div class='alert alert-success' role='alert'>Logged in successfully.</div>";
    }
    else
    {
        echo "<div class='alert alert-danger' role='alert'>The username or password you have entered is incorrect.</div>";
    }
}
?>