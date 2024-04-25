<?php
include_once 'db_conn.php';

if(isset($_POST['movie_id'])) {
    $movieId = $_POST['movie_id'];

    $checkQuery = "SELECT * FROM user_favorites WHERE movie_id = $movieId";
    $checkResult = $conn->query($checkQuery);

    if($checkResult->num_rows == 0) {
        
        $insertQuery = "INSERT INTO user_favorites (movie_id) VALUES ($movieId)";
        $conn->query($insertQuery);
        echo "Added to favorites successfully";
    } else {
        echo "Movie already in favorites";
    }
} else {
    echo "Unauthorized access";
}
?>


<?php
$selectQuery = "SELECT m.* FROM movie m INNER JOIN user_favorites uf ON m.id = uf.movie_id";
$result = $conn->query($selectQuery);

if ($result->num_rows > 0) {
    echo "<h2 style='text-align: center; margin-bottom: 20px;'>Movies Added to Favorites</h2>";
    echo "<table style='width: 100%; border-collapse: collapse; border: 1px solid #ddd;'>";
    echo "<thead style='background-color: #f2f2f2;'>";
    echo "<tr>";
    echo "<th style='padding: 10px; text-align: left;'>Movie Name</th>";
    echo "<th style='padding: 10px; text-align: left;'>Year</th>";
    echo "<th style='padding: 10px; text-align: left;'>Actor</th>";
    echo "<th style='padding: 10px; text-align: left;'>Actress</th>";
    echo "<th style='padding: 10px; text-align: left;'>Budget</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td style='padding: 10px;'>" . $row['movie_name'] . "</td>";
        echo "<td style='padding: 10px;'>" . $row['movie_year'] . "</td>";
        echo "<td style='padding: 10px;'>" . $row['actor'] . "</td>";
        echo "<td style='padding: 10px;'>" . $row['actress'] . "</td>";
        echo "<td style='padding: 10px;'>" . $row['budget'] . "</td>";
        echo "</tr>";
    }

    echo "</tbody>";
    echo "</table>";
} else {
    echo "<p style='text-align: center; margin-top: 20px;'>No movies added to favorites yet.</p>";
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Favorite Movies</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            margin: 50px auto;
            text-align: center;
        }
        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="home.php" class="btn">Go Back to Home Page</a>
    </div>
</body>
</html>