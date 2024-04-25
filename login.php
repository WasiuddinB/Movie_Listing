<?php
session_start();
?>


<?php
$err=$pwd="";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
include_once 'db_conn.php';
$email =$_POST["email"];
$password=$_POST["password"];
if (empty($_POST["email"])) {
    $err = "Email is required";
} else {
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $err = "Invalid email format";
    }
}
 $sql ="SELECT * FROM signup WHERE email='$email' and password='$password'";
 $notvalidmail ="SELECT * FROM signup WHERE email!='$email' and password='$password'";
 $notvalidpassword ="SELECT * FROM signup WHERE email='$email' and password!='$password'";
$getrows=$conn->query($sql);
$getrows1=$conn->query($notvalidmail);
$getrows2=$conn->query($notvalidpassword);
 if ($getrows->num_rows>0) {
  $_SESSION['email']=$email;
  header("location:home.php");
   }
  elseif($getrows1->num_rows>0 && $conn->query($notvalidmail)){
   $err =  "<br><br>Your Email is Wrong </br></br>";
}
 elseif($getrows2->num_rows>0 && $conn->query($notvalidpassword)){
        $pwd =  "<br><br>Your Password is Wrong </br></br>";
 }
else {
	echo "<b><p><center>Email Id doesn't Exists</center></p></b>";
	echo "<b><p><center>Please Wait it will redirect to Sign up Page</center></p></b>";
  header("Refresh:3; url=signup.php");
 }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            max-width: 400px;
            background-color: #fff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        form {
            margin-top: 20px;
        }

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

        .signup-link {
            text-align: center;
            margin-top: 10px;
        }

        .signup-link a {
            color: #333;
            text-decoration: none;
        }

        .signup-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Login Page</h1>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            Email <input type="email" name="email" required placeholder="Enter Your Email">
            <span><?php echo$err; ?></span><br>
            Password <input type="password" name="password" required placeholder="Enter Your Password">
            <span><?php echo$pwd; ?></span><br>
            <input type="submit" name="login" value="Login"><br>
        </form>
        <div class="signup-link">Don't Have an Account? <a href="signup.php"><b>Signup here</b></a></div>
    </div>
</body>
</html>
