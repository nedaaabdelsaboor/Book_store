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
$total = 0;
$Shipping = 18.32;
$rebate = 0.00;
$tax = 0;



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
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Cart</title>
  <link rel="stylesheet" href="css/cart.css" />
  <link rel="stylesheet" href="css/all.min.css" />
  <!-- Font -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=PT+Sans&display=swap" rel="stylesheet" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@300;500;900&family=Open+Sans:wght@400;500;600;700&family=PT+Sans&family=Work+Sans:wght@200;300;400;500;700;800;900&display=swap" rel="stylesheet" />
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
  <div class="cart-page">
    <div class="container">
      <table>
        <tr class="cart-head">
          <th>Book Cover</th>
          <th>Title</th>
          <th>Description</th>
          <th>Price</th>
          <th>Quantity</th>
          <th>-</th>
        </tr>
        <?php
        $id = $_SESSION['id'];
        $query = "SELECT * FROM cart WHERE id_customer = '$id'";
        $result = mysqli_query($conn, $query);
        while ($rowt = mysqli_fetch_assoc($result)) {
          $bookid = $rowt['id_book'];
          $queryt = "SELECT * FROM books WHERE id = '$bookid'";
          $resultt = mysqli_query($conn, $queryt);
          $row = mysqli_fetch_assoc($resultt);
          if ($rowt['status'] == 0) {
        ?>
            <tr class="cart">
              <th class="image"><?php
                                echo '<img src="data:image/jpeg;base64,' . $row['cover'] . '" alt="Image"><br>';
                                ?></th>
              <th><a href="../productsview/link.php?idbook=<?php echo $row['id'];  ?>"><?php echo $row['name']; ?></a></th>
              <th class="desc"><?php echo $row['description']; ?></th>
              <th class="price">$<span><?php echo $row['price']; ?>.00</span></th>
              <th class="quantity"><?php echo $rowt['q'] ?></th>
              <th><a href="del.php?idbook=<?php echo $row['id']; ?>"><i class="fa-solid fa-2x fa-trash"></i></a></th>
            </tr>
        <?php
            $querys = "SELECT * FROM users WHERE id = '$id'";
            $results = mysqli_query($conn, $querys);
            $rows = mysqli_fetch_assoc($results);
            $total = $total + $row['price'] * $rowt['q'];
            if ($total >= 200) {
              $rebate = ($total * 10 / 100);
              $rebate = intval($rebate * 100) / 100;
              $total = $total - ($rebate);
            }
            if ($rows['homeaddress'] == 'cairo' || $rows['homeaddress'] == 'giza' || $rows['homeaddress'] == 'Cairo' || $rows['homeaddress'] == 'Giza') {
              $Shipping = 0.00;
            }
            $tax = $total * 5 / 100;
            $tax = intval($tax * 100) / 100;
            $total = $total - $tax;
            $total = intval($total * 100) / 100;
          }
        }
        ?>
        <tr>
          <td class="image" rowspan="2">-</td>
        </tr>
      </table>
      <div class="payment-page">
        <div class="total">
          <div class="check-out">
            <div>
              <p>Total Books</p>
              <span>$<?php echo $total ?></span>
            </div>
            <div>
              <p>Total Shipping</p>
              <span>$<span><?php if ($total == 0) {
                              $Shipping = 0;
                              echo $Shipping;
                            } else {
                              echo $Shipping;
                            } ?></span></span>
            </div>
            <div>
              <p>Tax</p>
              <span>$<?php echo $tax ?></span>
            </div>
            <div>
              <p>rebate</p>
              <span>$<?php echo $rebate ?></span>
            </div>
            <div class="final">
              <p>Total Payment</p>
              <span>$<?php echo $total + $Shipping ?></span>
            </div>
          </div>

        </div>
        <section class="payment">
          <div class="check-out">
            <form action="cart.php" method="POST">
              <h3>Payment</h3>
              <div>
                <div>

                  <input type="radio" id="credit" name="payway">
                  <label for="credit"><i class="fa-regular fa-credit-card"></i>
                    Credit Card</label>
                </div>
                <div>
                  <input type="radio" id="paypal" name="payway">
                  <label for="paypal"><i class="fa-brands fa-paypal"></i>
                    PayPal</label>
                </div>
              </div>
              <div>
                <p>Name On Card</p>
                <input type="text" class="nCard" name="nCard" placeholder="Ahmed Mohamed">
              </div>
              <div>
                <p>Card Number</p>
                <input type="password" class="pCard" name="pCard" placeholder="**** **** **** 2153">
              </div>
              <div>
                <p>CVV</p>
                <input type="text" name="CVV" placeholder="123" class="cvv">
              </div>
              <input class="btn-submit" type="submit" value="Check Out" name="submit">
            </form>
            <div class="confirmation">

            </div>



          </div>
      </div>

      </section>
    </div>
  </div>

  <footer>
    <a class="logo" href="../home/index.php">
      <span class="first">Azba</span><span class="last">.keya</span>
    </a>

    <div class="footer-links">
      <h2>Contect Us</h2>
      <ul class="list-unstyled">
        <li><i class="fa-brands fa-facebook-f fa-2x"></i></li>
        <li><i class="fa-brands fa-twitter fa-2x"></i></li>
        <li><i class="fa-brands fa-youtube fa-2x"></i></li>
        <li><i class="fa-brands fa-google-plus fa-2x"></i></li>
        <li><i class="fa-brands fa-instagram fa-2x"></i></li>
      </ul>
    </div>
  </footer>

  <script src="js/jquery-3.7.1.min.js"></script>
  <script>
    // dropdown menu
    $("nav i.datalist").on("click", function() {
      $("ul.linked-list").toggleClass("block").toggleClass("links");
    });


    let result = $(".confirmation");

    let nameCard = $(".nCard");
    let numberCard = $(".pCard");
    let cvv = $(".cvv");

    let btn = $(".btn-submit");
    let btnOk = $(".btn-ok");


    btn.click(function() {
      event.preventDefault();

      if (nameCard.val() === "" || numberCard.val() === "" || cvv.val() === "") {
        result.append(`<div class="order-unsuccessed">
        <i class="fa-solid fa-xmark"></i>
        <p>your payment failed!</p>
        <button onclick="clear()" id="btn-ok" type=""><a href="cart.php">Ok</a></button>
        </div>`);
      } else {
        result.append(`<div class="order-successed">
        <i class="fa-solid fa-check"></i>
        <p>your order is confirmed!</p>
        <button onclick="clear()"  id="btn-ok" type=""><a href="../home/index.php">Ok</a></button>
        </div>`);

      }
      $("body").addClass("overlay");
    });
  </script>
</body>

</html>