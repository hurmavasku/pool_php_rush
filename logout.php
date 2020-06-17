<?php
session_start();
session_destroy();
?>
<head></head>
<form action="login.php">
 <button type="submit" id="logout" value="logout" name="logout">Log Out</button>
 <div class="signupbtn"></div>
</form>
<link rel="stylesheet" type="text/css" href="style.css">