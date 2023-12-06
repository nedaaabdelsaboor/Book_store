<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
    <link rel="stylesheet" href="css/all.min.css" />
    <!-- Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=PT+Sans&display=swap"
      rel="stylesheet"
    />
    <!-- Css file -->
    <link rel="stylesheet" href="css/Login.css" />
    <link rel="stylesheet" href="css/font-awesome.min.css" />
  </head>
  <body>
    <div class="login">
      <div class="photo">
        <i class="fa-solid fa-user"></i>
      </div>
      <div class="container">
        <form method="POST" enctype="multipart/form-data" action="login_file.php">


          <div class="icon">
            <i class="fa-solid fa-user"></i>
            <input type="text" placeholder="Email" name="username" class="user" />
          </div>
          <?php 
                if(isset($_GET['error1'])){
                  echo '<p class="error" >'.$_GET['error1'].'</p>';}

          ?>


          <div class="icon">
            <i class="fa-solid fa-lock"></i>
            <input type="password" placeholder="Password" name="password" class="pass" />
          </div>
          <?php 
                if(isset($_GET['error2'])){
                  echo '<p class="error" >'.$_GET['error2'].'</p>';}

           ?>


          <div class="submit">
            <input type="submit" name="submit" value="LOGIN" class="log" />
          </div>
          <?php 
                if(isset($_GET['error'])){
                  echo '<p class="error" >'.$_GET['error'].'</p>';}
                if(isset($_GET['error3'])){
                  echo '<p class="error" >'.$_GET['error3'].'</p>';}
          ?>

          
          <div class="info">
            <p class="register-link">
                Don't have an account?
              <a href="../register/register.php">Sign Up</a>
            </p>
            <div class="for-pass">
              <div class="check">
                <input type="checkbox" id="me" class="not" />
                <label for="me">Remember me</label>
              </div>

              <p id="me"><i>Forget your password?</i></p>
            </div>
          </div>
        </form>
      </div>
    </div>
    <script>
       
       var eduname = document.getElementById('username')
       var edupass = document.getElementById('password')
       eduname.value=''
       edupass.value=''

    </script> 
  </body>
</html>
