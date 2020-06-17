<?php
if(isset($_POST["email"]) && isset($_POST["password"])  ){
  require_once 'dbo.php';
session_start();
 
    $email= $_POST["email"];
    $password = $_POST["password"];
    $sql = "SELECT * FROM users WHERE email = '$email'"; 
    $stmt = $con->prepare($sql);
    $stmt->execute(["email" => $email]);
    $user = $stmt->fetch();
    $hash = $user['password'];

    if(md5($password) == $hash){
        session_start();
        $_SESSION["email"] =  $email;
        header("location:../step_1/index.php?login=success");
        exit();
    } else {
        header("location:../index.php?login=failed");
        exit();
    } 
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Log In</title>
</head>
<body>



<div class="container">
    <form action="login.php" method="post" class="container">
                <h4>Login</h4>
                <p>Enter your email and password to log in</p>
       

                   <label for="email">Email:</label><br>
    <input type="text" placeholder="Enter Email" name="email" required><br>    

             <label for="psw">Password:</label><br>
    <input type="password" placeholder="Enter Password" name="password" required>
        <div class="clearfix">

        
 <button type="submit" name="submit">Log In</button>
 <div class="signupbtn"></div>
 </div>
  </div>
    </form>
</body>
</html>
<link rel="stylesheet" type="text/css" href="style.css" />