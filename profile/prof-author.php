<?php
session_start();
$id = $_SESSION['id'];

$host = "localhost";
$username = "root";
$password = "";
$database = "book_store";

// Create a connection
$conn = new mysqli($host, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$select = "SELECT * FROM users WHERE id = '$id'";
$result = mysqli_query($conn, $select);
$row = mysqli_fetch_assoc($result); ?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="css/prof.css" />
  <link rel="stylesheet" href="css/font-awesome.min.css" />
  <!-- Font -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=PT+Sans&display=swap" rel="stylesheet" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;500;700;800;900;1000&family=Passion+One&family=Playfair+Display:ital,wght@1,800&family=Roboto:wght@100;300;400;500;900&display=swap" rel="stylesheet" />

  <title>Profile</title>
</head>

<body>
  <header>
    <div class="container">
      <a class="logo" href="../home/home-author.php">
        <span class="first">Azba</span><span class="last">.keya</span>
      </a>
      <nav>
        <i class="datalist fa fa-2x fa-bars"></i>
        <ul class="linked-list links">
          <li class="link Home active">
            <a href="../home/home-author.php">Home</a>
          </li>
          <li class="link Services"><a href="#services">Services</a></li>
          <li class="link About"><a href="../profile/prof-author.php">About</a></li>
          <li class="link Contact"><a href="#contact">Contact</a></li>
        </ul>
        <span></span>
        <ul class="header-icons">
          <li class="account">
            <a href="../profile/prof-author.php">
              <i class="fa fa-user fa-2x"></i>
            </a>
          </li>
          <li class="user">
            <a title="sign" href="../login/login.php">
              <i class="fa fa-2x fa-sign-out"></i>
            </a>
          </li>
        </ul>
      </nav>
    </div>
  </header>
  <div class="container-form">
    <div class="form_cont">
      <div class="form">
        <div class="content">
          <h2>My Profile</h2>
          <img src="images/th.jpg" height="120px" width="120px" alt="" />
          <div>
            <p>Name:</p>
            <span> <?php echo $row['username'] ?> </span>
          </div>
          <div>
            <p>Email:</p>
            <span> <?php echo $row['email'] ?> </span>
          </div>
          <div>
            <p>Adress:</p>
            <span> <?php echo $row['homeaddress'] ?> </span>
          </div>
          <div>
            <p>Phone number:</p>
            <span> <?php echo $row['phonenumber'] ?> </span>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>