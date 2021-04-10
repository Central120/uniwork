<?php
$url = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
?>

<?php
if(isset($_SESSION['admin']))
{
  $accountUser = $_SESSION['admin'];
}
else if(isset($_SESSION['user']))
{
  $accountUser = $_SESSION['user'];
}
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
<a class="navbar-brand" href="index">
    <img src="../images/logo.png" width="64" height="64" alt="">
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item <?php if (strpos($url,'index') !== false) {
    echo 'active';
} ?>">
        <a class="nav-link" href="../index">Home</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Bookings
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item <?php if (strpos($url,'requestbooking') !== false) {
    echo 'active';
} ?>" href="../select-staff">Request a booking</a>
          <a class="dropdown-item <?php if (strpos($url,'currentbookings') !== false) {
    echo 'active';
} ?>" href="../current-bookings">View current bookings</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Shop
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item <?php if (strpos($url,'cart') !== false) {
    echo 'active';
} ?>" href="../cart">Cart</a>
<a class="dropdown-item <?php if (strpos($url,'shop') !== false) {
    echo 'active';
} ?>" href="../shop">View Store</a>
      </li>
      
      <li class="nav-item <?php if (strpos($url,'news') !== false) {
    echo 'active';
} ?>">
        <a class="nav-link" href="#">News</a>
      </li>
      <li class="nav-item <?php if (strpos($url,'images') !== false) {
    echo 'active';
} ?>">
        <a class="nav-link" href="../gallery">Gallery</a>
      </li>
      <li class="nav-item <?php if (strpos($url,'reviews') !== false) {
    echo 'active';
} ?>">
        <a class="nav-link" href="#">Reviews</a>
      </li>
      </ul>
      <ul class="navbar-nav">
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <?php 
          if (isset($_SESSION['user']) || isset($_SESSION['admin']))
          {
              echo $accountUser, "'s Account";
          }
          else
          {
            echo "Account";
          }
          ?>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
        <?php 
          if (isset($_SESSION['user']) || isset($_SESSION['admin']))
          {
            ?>
            
            <a class="dropdown-item <?php if (strpos($url,'settings') !== false) {
              echo 'active';
          } ?>" href="../account-settings">Account Settings</a>
                    <a class="dropdown-item" href="inc/logout">Logout</a>
<?php 
          }
          else
          {
            ?>
          <a class="dropdown-item <?php if (strpos($url,'login') !== false) {
    echo 'active';
} ?>" href="../login">Login</a>
          <a class="dropdown-item <?php if (strpos($url,'signup') !== false) {
    echo 'active';
} ?>" href="../signup">Sign up</a>
          <?php 
          }

          if (isset($_SESSION['admin']))
          {
            ?>
          <a class="dropdown-item <?php if (strpos($url,'adminlogin') !== false) {
    echo 'active';
} ?>" href="index">Admin</a>
          <?php 
          }
          ?>

      </li>
      
    </ul>
  </div>
</nav>