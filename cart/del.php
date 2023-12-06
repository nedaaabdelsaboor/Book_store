<?php


$idbook = $_GET['idbook'];

$host = "localhost";
$username = "root";
$password = "";
$dbname = "book_store";
$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "DELETE FROM cart WHERE cart.id_book = '$idbook'";

mysqli_query($conn, $sql);
header('location:cart.php');
exit();
