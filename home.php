<?php
session_start();
if(!isset($_SESSION["email"])){
    header("location:login.php");
}
include_once 'db_conn.php';
$select_movie="SELECT * FROM movie";
$result = $conn->query($select_movie);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movies</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
            margin-top: 20px;
            color: #333;
        }
        
        .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .welcome {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        .welcome-text {
            font-size: 24px;
            font-weight: bold;
        }

        .username {
            font-size: 18px;
            color: #666;
        }

        .logout-btn {
            background-color: #f44336;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .logout-btn:hover {
            background-color: #d32f2f;
        }

        .add-movie-btn {
            background-color: #4caf50;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .add-movie-btn:hover {
            background-color: #45a049;
        }

        .search-btn {
            background-color: #2196F3;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .search-btn:hover {
            background-color: #0b7dda;
        }


        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #333;
            color: #fff;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        img {
            max-width: 100px;
            max-height: 100px;
            display: block;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <h1>Movies Page</h1>

    <div class="container">

        <div class="welcome">
            <b class="welcome-text">WELCOME</b><br>
            <span class="username"><?php echo $_SESSION["email"]; ?></span>
        </div>

        <form action="add_movies.php">
            <button class="add-movie-btn">Add Movie</button>
        </form>

        <form method="get" action="search.php">
            <label for="search_query">Search:</label>
            <input type="text" id="search_query" name="query" required>
            <button type="submit" class="search-btn">Search</button>
        </form>


        <form action="logout.php">
            <button class="logout-btn">Logout</button>
        </form>

    </div>
    <table border="1" style="width:100%">
        <thead>
            <tr>
                <th>Movie Name</th>
                <th>Year</th>
                <th>Actor</th>
                <th>Actress</th>
                <th>Poster Image</th>
                <th>Budget</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['movie_name']; ?></td>
                <td><?php echo $row['movie_year']; ?></td>
                <td><?php echo $row['actor']; ?></td>
                <td><?php echo $row['actress']; ?></td>
                <td><img src="<?php echo $row['banner_image']; ?>" alt="Banner"></td>
                <td><?php echo $row['budget']; ?></td>
                
                <td>
                    <form method="post" action="add_fav.php">
                        <input type="hidden" name="movie_id" value="<?php echo $row['id']; ?>">
                        <button type="submit">Add to Favorites</button>
                    </form>
                </td>

                <td>
                    <form method="post" action="remove_fav.php">
                        <input type="hidden" name="movie_id" value="<?php echo $row['id']; ?>">
                        <button type="submit">Remove from Favorites</button>
                    </form>
                </td>
            </tr>
            

            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>
