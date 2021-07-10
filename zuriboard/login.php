<?php
session_start();
include_once("connection.php");

if(isset($_POST["sub"])){
    if(isset($_POST['email'])&& isset($_POST["pass"])){
        $email = ($_POST['email']);
        $password = ($_POST['pass']);

        $sql = "SELECT * FROM register WHERE email_address = '$email' and password = '$password'";

        $res = mysqli_query($conn,$sql);
        if(mysqli_num_rows($res)>=1){
            $_SESSION['user_login'] = mysqli_fetch_assoc($res);
            header('location:dashboard.php');
        }else{
            echo 'Invalid email address or password! <a href="login.php">try again</a>';
        }
    }
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
  <form action="dashboard.php" method="POST">
  Email: <input type="email" name="email" placeholder="email address" required=""><br><br>
 Password: <input type="password" name="pass" placeholder="password" required=""><br><br>
  <input type="checkbox"><span>Remember me</span>
  <button type="submit" name="sub">Submit</button>
  <p>don't have an account</p> <a href="Register.php">Register here</a>
  </form>  
</body>
</html>