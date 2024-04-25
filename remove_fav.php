<?php
session_start();
include_once 'db_conn.php';

if(isset($_POST['movie_id'])) {
    $movieId = $_POST['movie_id'];

    $deleteQuery = "DELETE FROM user_favorites WHERE movie_id = $movieId";
    $conn->query($deleteQuery);
    echo "Removed from favorites successfully";
} else {
    echo "Unauthorized access";
}
?>
