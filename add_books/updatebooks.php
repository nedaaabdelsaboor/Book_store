    <?php
    session_start();
    $idbook = $_SESSION['book_id'];

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

    $select = "SELECT * FROM books WHERE id = '$idbook'";
    $result = mysqli_query($conn, $select);
    $row = mysqli_fetch_assoc($result);
    ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8" />
        <meta name="desripion" content />
        <meta name="viewport" content="width=device-width ,initial-scale=1.0" />
        <meta name="keywords" content />
        <title>Update Book</title>
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
            <form action="updatebooks.php" method="post" enctype="multipart/form-data">
                <h2>Update</h2>
                <input type="text" value="<?php echo $row['name'] ?>" placeholder="Book Name" name="book-name">
                <input type="text" value="<?php echo $row['description'] ?>" placeholder="Description" name="description">
                <input type="text" value="<?php echo $row['price'] ?>" placeholder="Price" name="price">
                <input type="file" class="image" name="cover" id="cover" value="cover" placeholder="cover" accept=".jpg ,.png">
                <select name="category" title="category" id="category">
                    <option value="" hidden>category</option>
                    <option value="novals">Novals</option>
                    <option value="horror">Horror</option>
                    <option value="history">History</option>
                    <option value="education">Education</option>
                    <option value="cooking">Cooking</option>
                </select>
                <input type="submit" value="update" class="submit" name="submit">

            </form>
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
                $updateFields = array();

                // Check and add fields that are provided in the input
                if (isset($_POST['book-name'])) {
                    $updateFields[] = "name = '" . $_POST['book-name'] . "'";
                }

                if (isset($_POST['description'])) {
                    $updateFields[] = "description = '" . $_POST['description'] . "'";
                }

                if (isset($_FILES['cover']) && $_FILES['cover']['error'] === UPLOAD_ERR_OK) {
                    // Handle file upload and convert it to base64
                    $newCoverTmpName = $_FILES['cover']['tmp_name'];
                    $newCoverData = file_get_contents($newCoverTmpName);
                    $newCoverBase64 = base64_encode($newCoverData);
                    $updateFields[] = "cover = ?";
                }

                if (isset($_POST['price'])) {
                    $updateFields[] = "price = " . $_POST['price'];
                }

                if (isset($_POST['category'])) {
                    $updateFields[] = "category = '" . $_POST['category'] . "'";
                }

                // Construct the SQL query
                $sql = "UPDATE books SET " . implode(", ", $updateFields) . " WHERE id = $idbook";

                $stmt = $conn->prepare($sql);

                // Bind the base64 data for the cover if it's present in the update
                if (isset($_FILES['cover']) && $_FILES['cover']['error'] === UPLOAD_ERR_OK) {
                    $stmt->bind_param('s', $newCoverBase64);
                }

                // Execute the update
                if ($stmt->execute()) {
                    echo "Record updated successfully";
                } else {
                    echo "Error updating record: " . $stmt->error;
                }

                $stmt->close();
                $conn->close();
                header('location:../home/home-author.php');
                exit();
            }
            ?>
        </div>
    </body>

    </html>