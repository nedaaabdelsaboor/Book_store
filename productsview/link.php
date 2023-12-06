<?php

session_start();

$_SESSION['book_id'] = $_GET['idbook'];

if ($_SESSION['type'] == "author") {
    header('location:view-author.php');
}else{
    header('location:view.php');
}

exit();
