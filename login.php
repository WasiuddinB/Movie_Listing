<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body{
            align-content: center;
        }
    </style>
</head>
<body>
	<h1>Login Page</h1>
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
  header("location:movie.php");
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
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
 	Email :<input type="email" name="email" required placeholder="Enter Your Email">
 	<span><?php echo$err; ?></span><br><br>
    Password :<input type="password" name="password" required placeholder="Enter Your Password">
    <span><?php echo$pwd; ?></span><br><br>
    <input type="submit" name="login" value="Login"> <br><br>
</form>
<div>Don't Have an Account?<a href="signup.php"><b>Signup here</b></a></div>
</body>
</html>