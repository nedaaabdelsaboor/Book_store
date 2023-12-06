<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Register</title>
  <link rel="stylesheet" href="css/all.min.css" />
  <!-- Font -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=PT+Sans&display=swap" rel="stylesheet" />
  <!-- Css file -->
  <link rel="stylesheet" href="css/Register.css" />
  <link rel="stylesheet" href="css/font-awesome.min.css" />
</head>

<body>
  <div class="register">
    <div class="photo">
      <i class="fa-solid fa-user"></i>
    </div>
    <div class="container">
      <form action="register_file.php" enctype="multipart/form-data" method="post">

        <div class="icon">
          <i class="fa-solid fa-user"></i>
          <input type="text" placeholder="Username" name="username" id="username" class="user" />
        </div>
        <?php
        if (isset($_GET['errorusermatching'])) {
          echo '<p class="error" >' . $_GET['errorusermatching'] . '</p>';
        }

        if (isset($_GET['erroruserempty'])) {
          echo '<p class="error" >' . $_GET['erroruserempty'] . '</p>';
        }

        if (isset($_GET['errorusersmall'])) {
          echo '<p class="error" >' . $_GET['errorusersmall'] . '</p>';
        }

        if (isset($_GET['errorusernotvalidation'])) {
          echo '<p class="error" >' . $_GET['errorusernotvalidation'] . '</p>';
        }

        ?>

        <div class="icon">
          <i class="fa-solid fa-user"></i>
          <input type="email" placeholder="Email" name="email" id="email" class="user" />
        </div>
        <?php
        if (isset($_GET['erroremailmatching'])) {
          echo '<p class="error" >' . $_GET['erroremailmatching'] . '</p>';
        }
        if (isset($_GET['erroremailempty'])) {
          echo '<p class="error" >' . $_GET['erroremailempty'] . '</p>';
        }
        if (isset($_GET['erroremailnotvalidation'])) {
          echo '<p class="error" >' . $_GET['erroremailnotvalidation'] . '</p>';
        }

        ?>


        <div class="icon">
          <i class="fa-solid fa-lock"></i>
          <input type="password" placeholder="Password.." name="password" id="password" class="pass" />
        </div>
        <?php
        if (isset($_GET['errorpassempty'])) {
          echo '<p class="error" >' . $_GET['errorpassempty'] . '</p>';
        }
        if (isset($_GET['errorpasssmail'])) {
          echo '<p class="error" >' . $_GET['errorpass'] . '</p>';
        }

        ?>


        <div class="icon">
          <i class="fa-solid fa-lock"></i>
          <input type="password" placeholder="Confirm Password.." name="cpassword" id="cpassword" class="pass" />
        </div>
        
        <?php
        if (isset($_GET['errorpassmatching'])) {
          echo '<p class="error" >' . $_GET['errorpassmatching'] . '</p>';
        }

        ?>

        <div class="icon">
          <i class="fa-solid fa-lock"></i>
          <input type="text" placeholder="Home Address..." name="homeaddress" id="homeaddress" class="home-address" />
        </div>
        <div class="icon">
          <i class="fa-solid fa-lock"></i>
          <input type="number" placeholder="Your Number..." name="phonenumber" id="phonenumber" class="phone-number" />
        </div>

        <select name="type" title="type" id="type">
          <option value="" hidden>Type</option>
          <option value="customer">Customer</option>
          <option value="author">Author</option>
        </select>
        <?php
        if (isset($_GET['errortypeempty'])) {
          echo '<p class="error" >' . $_GET['errortypeempty'] . '</p>';
        }

        if (isset($_GET['errortype'])) {
          echo '<p class="error" >' . $_GET['errortype'] . '</p>';
        }

        ?>

        <div class="submit">
          <input type="submit" value="Register" name="submit" class="log" />
        </div>

        <?php
        if (isset($_GET['errorgeneral'])) {
          echo '<p class="error" >' . $_GET['errorgeneral'] . '</p>';
        }
        ?>
        <div class="info">
          <div class="check">
            <p>
              If you already have an account click
              <a href="../login/Login.php">Sign In</a>
            </p>
          </div>
        </div>
      </form>
    </div>
  </div>

  <script>
    var name = document.getElementById("username");
    var pass = document.getElementById("password");
    var cpass = document.getElementById("cpassword");
    var email = document.getElementById("email");
    var home_address = document.getElementById("homeaddress");
    var phone_number = document.getElementById("phonenumber");
    name.value = "";
    pass.value = "";
    cpass.value = "";
    email.value = "";
    home_address.value = "";
    phone_number.value = "";
  </script>
</body>

</html>