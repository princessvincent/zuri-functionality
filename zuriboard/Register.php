<?php
session_start();

include_once("connection.php");

if(isset($_POST["sub"])){
    if(isset($_POST["full"])&& isset($_POST["user"])&& isset($_POST["email"])&& isset($_POST["phone"])&& isset($_POST["pass"])){

        $fullname = ($_POST["full"]);
        $username = ($_POST["user"]);
        $email =($_POST["email"]);
        $phone = ($_POST["phone"]);
        $pass = ($_POST["pass"]);

        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
            $email_error = "Invalid email address";
        }

        if(filter_var($phone,FILTER_VALIDATE_INT)){
            $number_error = "please your number should be only numbers!";
        }
        $sql = "SELECT * FROM register WHERE email_address = '$email'";

        $res = mysqli_query($conn,$sql);
        if ((mysqli_num_rows($res) == 1)){
            $email_error = "Sorry ..... Email alredy exist";
        }else{
            $insert = "INSERT INTO register(fullname,username,email_address,phone_number,password) VALUES('$fullname','$username','$email','$phone', md5('$pass'))";

            $result = (mysqli_query($conn, $insert));
            echo "Registration successful!";

           header("location:login.php");
    exit();
        }
    }
}





?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
   <form action="<?php  echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
   Fullname:<input type="text" name="full" placeholder="fullname" required=""><br><br>
   Username:<input type="text" name="user" placeholder="username" required=""><br><br>
   Email Address:<input type="email" name="email" placeholder="email" required=""><br><br>
   Phone Number: <input type="number" name="phone" placeholder="phone" required=""><br><br>
   Password: <input type="text" name="pass" placeholder="password" required=""><br><br>
   <button type="submit" name="sub">Submit</button>
   </form>
</body>
</html>