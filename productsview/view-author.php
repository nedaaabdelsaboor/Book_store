<?php
session_start();
$idbook = $_SESSION['book_id'];

$host = "localhost";
$username = "root";
$password = "";
$dbname = "book_store";
$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$select = "SELECT * FROM books WHERE id = '$idbook'";
$result = mysqli_query($conn, $select);
$row = mysqli_fetch_assoc($result);
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="css/font-awesome.min.css" />
  <link rel="stylesheet" href="css/all.min.css" />
  <link rel="stylesheet" href="css/view.css" />
  <title>View products</title>
  <!-- Font -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=PT+Sans&display=swap" rel="stylesheet" />
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
          <li class="link Home active"><a href="../home/home-author.php">Home</a></li>
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


  <div class="product-details">
    <div class="container">
      <div class="product">
        <div class="image">
          <?php
          echo '<img src="data:image/jpeg;base64,' . $row['cover'] . '" alt="Image"><br>';
          ?>
        </div>
        <div class="product_info">
          <h1><?php echo $row['name'] ?></h1>
          <div class="rate">
            <i class="fa fa-star active"></i>
            <i class="fa fa-star active"></i>
            <i class="fa fa-star active"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
          </div>
          <p class="category"><span>Category: </span><?php echo $row['category'] ?></p>
          <p class="desc">
            <?php echo $row['description'] ?>
          </p>
          <h2><span>$</span><?php echo $row['price'] ?></h2>
          <!-- <button class="cart-arrow-down"  onclick="addToCart(<?php echo $row['id']; ?>)" >Add To Cart</button> -->
        </div>
      </div>
    </div>
  </div>

  <script src="js/jquery-3.7.1.min.js"></script>
  <script>
    $("nav i.datalist").on("click", function() {
      $("ul.linked-list").toggleClass("block").toggleClass("links");
    });



    // count
    var countInCart = localStorage.getItem("count") ? JSON.parse(localStorage.getItem("count")) : 0;

    $(".cart-arrow-down").click(function() {
      countInCart++;
      $("header .container ul li i.fa-cart-plus").attr('count', countInCart);
      localStorage.setItem("count", JSON.stringify(countInCart));
    });

    $("header .container ul li i.fa-cart-plus").attr('count', countInCart);

    // add to cart
    let allBooksInCart = localStorage.getItem("allBooksInCart") ?
      JSON.parse(localStorage.getItem("allBooksInCart")) : [];


    function addToCart(id) {
      let item = [id, 1];
      let check = false;

      for (let index = 0; index < allBooksInCart.length; index++) {
        if (allBooksInCart[index][0] == id) {
          allBooksInCart[index][1]++;
          check = true;
          break;
        }
      }

      if (allBooksInCart.length == 0) {
        allBooksInCart = [...allBooksInCart, item];
        check = true;
      }
      if (!check) {
        allBooksInCart = [...allBooksInCart, item];
      }

      localStorage.setItem("allBooksInCart", JSON.stringify(allBooksInCart));
    }
  </script>
</body>

</html>