<?php
$conn = mysqli_connect('localhost', 'root', '', 'book_store');
if (!$conn) {
    die('Error' . mysqli_connect_error());
}

$error = 0;


function safety_input($data)
{
    $data = htmlentities($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if (isset($_POST['submit'])) {
    $username = safety_input(strtolower($_POST['username']));
    $email = safety_input($_POST['email']);
    $password = safety_input($_POST['password']);
    $cpassword = safety_input($_POST['cpassword']);
    $phonenumber = safety_input($_POST['phonenumber']);
    $homeaddress = safety_input($_POST['homeaddress']);
}
//user info

$username =   mysqli_real_escape_string($conn, $_POST['username']);
$email =      mysqli_real_escape_string($conn, $_POST['email']);
$password =   mysqli_real_escape_string($conn, $_POST['password']);
$cpassword =  mysqli_real_escape_string($conn, $_POST['cpassword']);
$phonenumber = mysqli_real_escape_string($conn, $_POST['phonenumber']);
$homeaddress = mysqli_real_escape_string($conn, $_POST['homeaddress']);


//user type
if (isset($_POST['type'])) {
    $type = ($_POST['type']);
    $type = htmlentities(mysqli_real_escape_string($conn, $_POST['type']));
    if (!in_array($type, ['customer', 'author'])) {
        header('location:register.php?errortype=please choose if you are customer or auther');
        $error = 1;
    }
}



//user already exists
$existance = "SELECT * FROM `users` WHERE username='$username'";
$users = mysqli_query($conn, $existance);
$rows = mysqli_num_rows($users);
if ($rows > 0) {
    header('location:register.php?errorusermatching=Username already exists!');
    $error = 2;
}


//email already exists
$exist = "SELECT * FROM `users` WHERE email='$email'";
$em = mysqli_query($conn, $exist);
$rows = mysqli_num_rows($em);
if ($rows > 0) {
    header('location:register.php?erroremailmatching=Email already exists!');
    $error = 3;
}


//username check
if (empty($username)) {
    header('location:register.php?erroruserempty=Please enter your username!');
    $error = 4;
} elseif (strlen($username) < 6) {
    header('location:register.php?errorusersmall=Username must contain at least 6 letters!');
    $error = 5;
} elseif (filter_var($username, FILTER_VALIDATE_INT)) {
    header('location:register.php?errorusernotvalidation=Enter letters not numbers only!');
    $error = 6;
}


//email check
if (empty($email)) {
    header('location:register.php?erroremailempty=Please enter your email!');
    $error = 7;
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header('location:register.php?erroremailnotvalidation=Please enter VALID email format!');
    $error = 8;
}


//user
if (empty($type)) {
    header('location:register.php?errortypeempty=Please choose type .. ');
    $error = 9;
}



//password
if (empty($password)) {
    header('location:register.php?errorpassempty=Please enter your password!');
    $error = 10;
} elseif (strlen($password) < 6) {
    header('location:register.php?errorpasssmail=Password must contain at least 6 characters!');
    $error = 11;
} elseif ($password !== $cpassword) {
    header('location:register.php?errorpassmatching=Your entered password doesnot match!');
    $error = 12;
}

if (($error == 0) && ($rows == 0)) {
    $insert = "INSERT INTO users (username,email,password,phonenumber,homeaddress,department) 
    VALUES ('$username','$email','$password','$phonenumber','$homeaddress','$type')";
    mysqli_query($conn, $insert);
    header('location:../login/login.php');
}
exit();
