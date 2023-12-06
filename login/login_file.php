<?php
session_start();
function safety_input($data)
{
    $data = stripslashes($data);
    $data = htmlentities($data);
    $data = htmlspecialchars($data);
    $data = strtolower($data);
    return $data;
}

// Check connection
$conn = mysqli_connect("localhost", "root", "", "book_store");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['submit'])) {
    $username =  safety_input($_POST['username']);
    $password =  safety_input($_POST['password']);
    $username = filter_input(INPUT_POST, 'username');

    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
}

if (empty($username) && !empty($password)) {
    $err_n = 1;
    header('location:login.php?error1=Please enter username');
} elseif (empty($password) && !empty($username)) {

    $err_n = 1;

    header('location:login.php?error2=Please enter password');
} elseif (empty($password) && empty($username)) {

    $err_n = 1;

    header('location:login.php?error=Please you have to enter your username and password');
}

if (!isset($err_n)) {
    $sql = "SELECT * FROM users WHERE email='$username' AND password ='$password'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
}


if ($row['email'] === $username && $row['password'] === $password) {
    // $_SESSION['email'] = $row['email'];
    $_SESSION['id'] = $row['id'];
    $_SESSION['type'] = $row['department'];
    if ($row['department'] == "author") {
        header('location:../home/home-author.php');
        exit();
    } else {
        header('location:../home/index.php');
        exit();
    }
} else {
    header('location:login.php?error3=Wrong username or password');
    exit();
}
