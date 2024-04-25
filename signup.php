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


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
        }

        .container {
            max-width: 400px;
            margin: 50px auto;
            background-color: #fff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #333;
        }

        form {
            margin-top: 20px;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
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

        .login-link {
            text-align: center;
            margin-top: 10px;
        }

        .login-link a {
            color: #333;
            text-decoration: none;
        }

        .login-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Sign Up</h1>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <input type="text" name="name" required placeholder="Enter Your Name"><br>
            <input type="email" name="email" required placeholder="Enter Your Email"><br>
            <input type="password" name="password" minlength="6" required placeholder="Enter Your Password"><br>
            <input type="text" name="city" required placeholder="Enter Your City"><br>
            <input type="submit" name="signup" value="Signup"><br>
            <div class="login-link">Already a user? <a href="login.php"><b>Login Here</b></a></div>
        </form>
    </div>
</body>
</html>
