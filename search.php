<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #333;
        }

        ul {
            list-style-type: none;
            padding: 0;
        }

        li {
            margin-bottom: 10px;
            border-bottom: 1px solid #ccc;
            padding: 10px;
            background-color: #f9f9f9;
            border-radius: 5px;
        }

        li:last-child {
            border-bottom: none;
            margin-bottom: 0;
        }

        .movie-name {
            font-weight: bold;
            color: #333;
        }

        .actor {
            color: #666;
        }
        
        .actress {
            color: #666;
        }

        .budget {
            color: #666;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php
        include("db_conn.php");

        if (isset($_GET['query'])) {
            $searchQuery = $_GET['query'];

            $searchSQL = "SELECT * FROM movie WHERE movie_name LIKE '%$searchQuery%' OR actor LIKE '%$searchQuery%' OR actress LIKE '%$searchQuery%' ";

            $result = $conn->query($searchSQL);

            if ($result->num_rows > 0) {
                echo "<h2>Search Results:</h2>";
                echo "<ul>";
                while ($row = $result->fetch_assoc()) {
                    echo "<li>";
                    echo "<span class='movie-name'>{$row['movie_name']}</span> - <span class='actor'>{$row['actor']}</span> - <span class='actress'>{$row['actress']}</span> - <span class='budget'>{$row['budget']}</span>";
                    echo "</li>";
                }
                echo "</ul>";
            } else {
                echo "<p>No results found.</p>";
            }

            $conn->close();
        }
        ?>
    </div>
</body>
</html>
