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

$id = $_POST['id'];
$id_c = $_POST['id_c'];
$checkQuery = "SELECT * FROM cart WHERE id_customer = '$id_c' AND id_book = '$id'";
$result = mysqli_query($conn, $checkQuery);

if (mysqli_num_rows($result) > 0) {
    $updateQuery = "UPDATE cart SET q = q + 1 WHERE id_customer = '$id_c' AND id_book = '$id'";
    mysqli_query($conn, $updateQuery);
} else {
    $insertQuery = "INSERT INTO cart (id_customer, id_book, q) VALUES ('$id_c', '$id', 1)";
    mysqli_query($conn, $insertQuery);
}

$conn->close();
