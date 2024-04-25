<?php
session_start();
if(!isset($_SESSION["email"])){
    header("location:login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout</title>
    <style>
        button{
           float:right;
        }
    </style>
</head>
<body>
    <h3>welcome</h3>
<p>hi
    <?php
    echo $_SESSION["email"] ;
    ?>
    </p>
    <form action="logout.php">
        <button>Logout</button>
    </form>
</body>
</html>
<?php
session_start();
if(session_destroy()){
    header("location:login.php");
}
?>