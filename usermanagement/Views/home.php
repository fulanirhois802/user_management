<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User : Home</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
<nav>
        <div class="logo">
            Logo
        </div>
        <div class="menu">
<ul>
    <li><a href="#">Home</a></li>
    <li><a href="#">About Us</a></li>
    <li><a href="#">Contact Us</a></li>
</ul>
        </div>
    </nav>
    <div class="container">
  <div class="section1">
    <div class="user-menu">
<ul>
    <li>
        <a href="../Views/home.php">Home</a>
    </li>
    <li>
        <a href="../Views/photos.php">Photos</a>
    </li>
    <li>
        <a href="#">My Contacts</a>
    </li>
</ul>
    </div>
    <div class="user-details">
   <div class="card">
    <div class="card-image">
<img src="../images/user1.jpg" alt="">
    </div>
    <div class="card-body">
        <ul class="userInfo">
            <?php if($_SESSION['isLoggedIn']):?>
            <li><span style="font-weight:200">Full Name: </span><?php echo $_SESSION['userFirstName']." ".$_SESSION['userLastName'] ?> </li>
            <li><span>E-Mail: </span><?php echo $_SESSION['userEmail']?> </li>
            <?php endif;?>
        </ul>
    </div>
   </div>
    </div>
  </div>


</div>



</body>
</html>