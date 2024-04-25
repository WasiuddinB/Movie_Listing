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
