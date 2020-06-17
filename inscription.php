<?php

$pdo = new PDO('mysql:host=127.0.0.1;port=3306;dbname=gecko', 'hurma', 'pass');

$date = date('Y-m-d');

$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$nameErr = $emailErr =$passErr="";
$name = $email = $password= $password_confirmation =$date="";
$date = date('Y-m-d');
function my_password_hash($password){
  $salt = umiqid();
  $hashed = md5($password.$salt);
  return array("hash"=>$hashed, "salt"=> $salt);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["name"])) {
    $nameErr = "Name is required";
  } 
  else {
    $name = test_input($_POST["name"]);
    $namelength= strlen($name);

    if ($namelength <3 || $namelength >10)
    {
      $nameErr = "Invalid name";

    }
  }

  if (empty($_POST["email"])) {
    $emailErr = "Email is required";
  } 
  else {
    $email = test_input($_POST["email"]);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format";
    }
  }
  if (empty($_POST["password"])) {
    $passErr = "Password is required";
  } else {
    $password = test_input($_POST["password"]);
    $password_confirmation = test_input($_POST['password_confirmation']);
    $passlength= strlen($password);
    $hashedPasswd = md5($password);


    if ($passlength <3 || $passlength >10 || $password !== $password_confirmation)
    {
      $passErr = "Invalid password";
    }
    if ( isset($name) && isset($email) && isset($password)) 
    {
      
     $sql = "INSERT INTO users (name, email, password, created_at,is_admin) 
              VALUES ('$name', '$email', '$hashedPasswd', '$date', 0)";
 

      $stmt = $pdo->prepare($sql);
      $stmt->execute([$_POST['name'], $_POST['email'],$hashedPasswd]);
      
    }     
  }
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>
<?php
if (isset($_POST['submit']) &&  isset($name) && isset($email) && isset($password)){
  echo "User created";
  header("location: ../step_1/login.php");
  exit();
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Sign Up</title>
  <body>

     <div class="contanier">

<p>Fill the form to sign up</p>

<span class="error"><?php echo $nameErr;?></span>
<span class="error"><?php echo $emailErr;?></span>
<span class="error"><?php echo $passErr;?></span>



<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  

  <label for="name">Name: </label><br>
    <input type="text" name="name" placeholder="Enter your name" >
  <br><br>
  <label for="email">Email: </label><br>
  <input type="text" name="email" placeholder="Enter your email">
  <br><br>
  <label for="password">Password: </label> <br>
  <input type="password" name="password" placeholder="Enter your password">
  <br><br>
  <label for="password_confirmation">Password confirmation: </label><br>
    <input type="password" name="password_confirmation" placeholder="Confirm your password">
  <span class="error"></span>
  <br><br>
  <div class="clearfix">

  <button type="submit" name="submit" value="Submit">Sign Up</button>
  <div class="signupbtn"></div>

</div>
</div>
</form>
</head>

</body>
</html>
<link rel="stylesheet" type="text/css" href="style.css">
