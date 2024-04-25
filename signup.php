<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
</head>
<body>
  <h1>Sign Up</h1>  



<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (isset($_POST["signup"])) {
    include("db_conn.php");
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $city = $_POST["city"];
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      die( '<script>
        alert("invalid email ");
        window.location.href="signup.php";
        </script>');
    }
    $selectuseremail = "SELECT * FROM signup WHERE email = '$email'";
    $insertuserdata ="INSERT INTO signup (name, email, password, city) VALUES ('$name','$email','$password','$city')";
    $getrows1=$conn->query($selectuseremail);
    if ($getrows1->num_rows>0 ){
      echo '<script>
      alert("you already have an account try to log in");
      window.location.href="login.php";
      </script>';
    }
    elseif($conn->query($insertuserdata)){
      echo '<script>
      alert("account created succesfully");
      window.location.href="login.php";
      </script>';
    }
    else{
      echo ".";
    }
  }
}
?>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
  Name :<input type="text" name="name" required placeholder="Enter Your Name"><br><br>
  Email :<input type="email" name="email" required placeholder="Enter Your Email"><br><br>
  <!-- <span><?php echo $err; ?></span><br><br> -->
  Password :<input type="password" name="password" minlength="6" required placeholder="Enter Your Password"><br><br>
  City :<input type="text" name="city"required placeholder="Enter Your City"><br><br>
  <input type="submit" name="signup" value="Signup"> <br><br>
  <div>Already a user?<a href="login.php"><b>Login Here</b></a></div>
</form>
</body>
</html>