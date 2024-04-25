<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include("db_conn.php");
    $movieName = $_POST["movie_name"];
    $movieYear = $_POST["movie_year"];
    $actor = $_POST["actor"];
    $actress = $_POST["actress"];
    $budget = $_POST["budget"];

    
    $targetDirectory = "posters/";
    $targetFile = $targetDirectory . basename($_FILES["banner_image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    
    if (move_uploaded_file($_FILES["banner_image"]["tmp_name"], $targetFile)) {
        echo "The file ". basename( $_FILES["banner_image"]["name"]). " has been uploaded.";

        $insertQuery = "INSERT INTO movie (movie_name, movie_year, actor, actress, banner_image, budget) VALUES ('$movieName', '$movieYear', '$actor', '$actress', '$targetFile', '$budget')";

        if ($conn->query($insertQuery) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $insertQuery . "<br>" . $conn->error;
        }
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
    

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Movie</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        form {
            max-width: 500px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 10px;
            color: #333;
        }

        input[type="text"], input[type="file"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            width: 100%;
            background-color: #4caf50;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h1>Add Movie</h1>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
        <label for="movie_name">Movie Name:</label>
        <input type="text" id="movie_name" name="movie_name" required>

        <label for="movie_year">Year:</label>
        <input type="text" id="movie_year" name="movie_year" required>

        <label for="actor">Actor:</label>
        <input type="text" id="actor" name="actor" required>

        <label for="actress">Actress:</label>
        <input type="text" id="actress" name="actress" required>

        <label for="banner_image">Poster Image:</label>
        <input type="file" id="banner_image" name="banner_image" required>

        <label for="budget">Budget:</label>
        <input type="text" id="budget" name="budget" required>

        <input type="submit" value="Add Movie">
    </form>
</body>
</html>

