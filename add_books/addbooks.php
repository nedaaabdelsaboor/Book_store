<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="desripion" content />
    <meta name="viewport" content="width=device-width ,initial-scale=1.0" />
    <meta name="keywords" content />
    <title>Add Book</title>
    <!-- Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=PT+Sans&display=swap" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;500;700;800;900;1000&family=Passion+One&family=Playfair+Display:ital,wght@1,800&family=Roboto:wght@100;300;400;500;900&display=swap" rel="stylesheet" />
    <!-- Css file -->
    <link rel="stylesheet" href="css/add-books.css" />
    <link rel="stylesheet" href="css/font-awesome.min.css" />
</head>

<body>
    <div class="form-add-books">
        <form action="addbooks.php" method="post" enctype="multipart/form-data">
            <h2>Add</h2>
            <input type="text" placeholder="Book Name" name="book-name">
            <input type="text" placeholder="Description" name="description">
            <input type="text" placeholder="Price" name="price">
            <input type="file" class="image" name="cover" id="cover" value="cover" placeholder="cover" accept=".jpg ,.png">
            <select name="category" title="category" id="category">
                <option value="" hidden>category</option>
                <option value="novals">Novals</option>
                <option value="horror">Horror</option>
                <option value="history">History</option>
                <option value="education">Education</option>
                <option value="cooking">Cooking</option>
            </select>
            <input type="submit" value="Add" class="submit" name="submit">

            <?php
            session_start();
            $id = $_SESSION['id'];

            $host = "localhost";
            $username = "root";
            $password = "";
            $database = "book_store";

            // Create a connection
            $conn = new mysqli($host, $username, $password, $database);

            // Check the connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
                $coverData = base64_encode(file_get_contents($_FILES["cover"]["tmp_name"]));
                $bookName = $_POST["book-name"];
                $description = $_POST["description"];
                $price = $_POST["price"];
                $category = $_POST["category"];

                $stmt = $conn->prepare("INSERT INTO books (name , description , cover , price ,id_author , category) VALUES (?,?,?,?,?,?)");
                $stmt->bind_param("ssssss", $bookName, $description, $coverData, $price, $id, $category);

                if ($stmt->execute()) {
                    echo "Image uploaded successfully.";
                } else {
                    echo "Error: " . $stmt->error;
                }

                // Close the prepared statement
                $stmt->close();
                header('location:../home/home-author.php');
                exit();
            }
            ?>
        </form>
    </div>
</body>

</html>