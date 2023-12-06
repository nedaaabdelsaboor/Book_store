<?php
session_start();
$host = "localhost";
$username = "root";
$password = "";
$dbname = "book_store";
$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$countInCart = 0;
$query = "SELECT * FROM cart";
$result = mysqli_query($conn, $query);
while ($row = mysqli_fetch_assoc($result)) {
  if ($row['id_customer'] == $_SESSION['id']) {
    $countInCart++;
  }
}
?>


<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <meta name="desripion" content="" />
  <meta name="viewport" content="width=device-width ,initial-scale=1.0" />
  <meta name="keywords" content="" />
  <title>Home</title>
  <!-- Font -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=PT+Sans&display=swap" rel="stylesheet" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;500;700;800;900;1000&family=Passion+One&family=Playfair+Display:ital,wght@1,800&family=Roboto:wght@100;300;400;500;900&display=swap" rel="stylesheet" />
  <!-- Css file -->
  <link rel="stylesheet" href="css/style.css" />
  <link rel="stylesheet" href="css/font-awesome.min.css" />
</head>

<body>
  <header>
    <div class="container">
      <a class="logo" href="../home/index.php">
        <span class="first">Azba</span><span class="last">.keya</span>
      </a>
      <nav>
        <i class="datalist fa fa-2x fa-bars"></i>
        <ul class="linked-list links">
          <li class="link Home active"><a href="../home/index.php">Home</a></li>
          <li class="link Services"><a href="#services">Services</a></li>
          <li class="link About"><a href="../profile/prof.php">About</a></li>
          <li class="link Contact"><a href="#contact">Contact</a></li>
        </ul>
        <span></span>
        <ul class="header-icons">
          <li class="account">
            <a href="../profile/prof.php">
              <i class="fa fa-user fa-2x"></i>
            </a>
          </li>
          <li class="cart-icon">
            <a href="../cart/cart.php">
              <i count="<?php echo $countInCart ?>" class="fa fa-cart-plus fa-2x"></i>
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


  <!-- slider -->
  <section class="landing">
    <div class="container">
      <h2 class="landing-text">
        Discover & Read <span>1 Million</span> Books
      </h2>
      <div class="home-search">
        <input type="text" name="searchTitle" id="searchTitle" placeholder="Type to search..." />
      </div>

    </div>
  </section>
  <!-- category section -->
  <section class="category">
    <div class="container">
      <div class="products-info p-xy hover-title">
        <ul class="products-link list-unstyled">
          <li><a class="novals" >Novals</a></li>
          <li><a class="horror">Horror</a></li>
          <li><a class="cooking">Cooking </a></li>
          <li><a class="history">History </a></li>
          <li><a class="education">Education</a></li>
        </ul>
      </div>
      <div class="category-items">
        <?php
        $query = "SELECT * FROM books";
        $result = mysqli_query($conn, $query);
        while ($row = mysqli_fetch_assoc($result)) { ?>
          <div class="category-item">
            <div class="image">
              <?php
              echo '<img src="data:image/jpeg;base64,' . $row['cover'] . '" alt="Image"><br>';
              ?>
            </div>
            <div class="prod-stars">
              <i class="active prodicon fa fa-star fa-s"></i>
              <i class="active prodicon fa fa-star fa-s"></i>
              <i class="active prodicon fa fa-star fa-s"></i>
              <i class="prodicon fa fa-star-o fa-s"></i>
              <i class="prodicon fa fa-star-o fa-s"></i>
            </div>
            <a class="desc" href="../productsview/link.php?idbook=<?php echo $row['id'];  ?>"><?php echo $row['name']; ?></a>
            <p class="item-price">$<?php echo $row['price']; ?></p>
            <i class=" icon-cate  fa-2x  fa fa-heart"></i>
            <form id="dataForm" action="ty.php" method="post">
              <!-- Your other form elements here -->
              <i class="icon-cate fa fa-2x fa-cart-arrow-down" onclick="submitForm(<?php echo $row['id']; ?>)"></i>
              <input type="hidden" name="id" id="idInput" value="">
            </form>
            <span class="item-cate" style="display: none;"><?php echo $row['category']; ?></span>
          </div>
        <?php } ?>
      </div>
    </div>
  </section>

  <footer>
    <a class="logo" href="../home/index.php">
      <span class="first">Azba</span><span class="last">.keya</span>
    </a>

    <div class="footer-links">
      <h2>Contect Us</h2>
      <ul class="list-unstyled">
        <li><i class="fa fa-facebook-f fa-2x"></i></li>
        <li><i class="fa fa-twitter fa-2x"></i></li>
        <li><i class="fa fa-youtube fa-2x"></i></li>
        <li><i class="fa fa-google-plus fa-2x"></i></li>
        <li><i class="fa fa-instagram fa-2x"></i></li>
      </ul>
    </div>
  </footer>

  <script src="js/jquery-3.7.1.min.js"></script>
  <script>
    $("nav i.datalist").on("click", function() {
      $("ul.linked-list").toggleClass("block").toggleClass("links");
    });




    // search Function
    var AllBooks = $(".category-item a.desc");

    let searchTitle = document.querySelector("#searchTitle");
    searchTitle.addEventListener('keyup', function(e) {
      console.log("keyup", e.target.value);
      for (let index = 0; index < AllBooks.length; index++) {
        let element = AllBooks[index];
        if (element.textContent.toLowerCase().indexOf(e.target.value.toLowerCase()) == -1)
          element.parentElement.classList.add("remove-item");
      }
      if (e.target.value == "") {
        $(".category-item").removeClass("remove-item");
      }
    });

    // Category Function
    AllBooksCategory = $(".category-item .item-cate");
    
    let novals = $(".products-link li a.novals");
    let horror = $(".products-link li a.horror");
    let cooking = $(".products-link li a.cooking");
    let history = $(".products-link li a.history");
    let education = $(".products-link li a.education");

    novals.on("click" , function(){
      for (let index = 0; index < AllBooksCategory.length; index++) {
          if (AllBooksCategory[index].textContent.toLowerCase().indexOf(novals.text().toLowerCase()) == -1)
            AllBooksCategory[index].parentElement.classList.toggle("remove-item");

        }
        novals.toggleClass("change-color");

    })
    horror.on("click" , function(){
      for (let index = 0; index < AllBooksCategory.length; index++) {
          if (AllBooksCategory[index].textContent.toLowerCase().indexOf(horror.text().toLowerCase()) == -1)
            AllBooksCategory[index].parentElement.classList.toggle("remove-item");

        }
        horror.toggleClass("change-color");

    })
    cooking.on("click" , function(){
      for (let index = 0; index < AllBooksCategory.length; index++) {
          if (AllBooksCategory[index].textContent.toLowerCase().indexOf(cooking.text().toLowerCase()) == -1)
            AllBooksCategory[index].parentElement.classList.toggle("remove-item");

        }
        cooking.toggleClass("change-color");

    })
    history.on("click" , function(){
      for (let index = 0; index < AllBooksCategory.length; index++) {
          if (AllBooksCategory[index].textContent.toLowerCase().indexOf("history") == -1)
            AllBooksCategory[index].parentElement.classList.toggle("remove-item");

        }
        history.toggleClass("change-color");

    })
    education.on("click" , function(){
      for (let index = 0; index < AllBooksCategory.length; index++) {
          if (AllBooksCategory[index].textContent.toLowerCase().indexOf(education.text().toLowerCase()) == -1)
            AllBooksCategory[index].parentElement.classList.toggle("remove-item");

        }
        education.toggleClass("change-color");

    })
    



    function submitForm(id) {
      var formData = new FormData(document.getElementById("dataForm"));
      formData.append('id', id);
      formData.append('id_c', <?php echo $_SESSION['id']; ?>);
      var xhr = new XMLHttpRequest();
      xhr.open("POST", "ty.php", true);
      xhr.onload = function() {
        console.log(xhr.responseText);
      };

      xhr.onerror = function() {
        console.error("Error submitting form");
      };
      xhr.send(formData);
    }
  </script>
</body>

</html>