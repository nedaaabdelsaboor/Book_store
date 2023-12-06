<?php

session_start();

$_SESSION['book_id'] = $_GET['idbook'];

header('location:updatebooks.php');
exit();
