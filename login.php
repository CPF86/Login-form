<?php
$hostname = "localhost";
$username = "root";
$password = "";
$database = "loginform";
$table    = "user";

// Create connection
$conn = new mysqli($hostname, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
echo "Connected successfully";

//Checks login attempts and adds a time block 

function confirmIPAddress($value) { 

  $q = "SELECT attempts, (CASE when lastlogin is not NULL and DATE_ADD(LastLogin, INTERVAL ".TIME_PERIOD.
  " MINUTE)>NOW() then 1 else 0 end) as Denied FROM ".TBL_ATTEMPTS." WHERE ip = '$value'"; 

  $result = mysql_query($q, $this->connection); 
  $data = mysql_fetch_array($result); 

  //Check attempt to login 

  if (!$data) { 
    return 0; 
  } 
  if ($data["attempts"] >= ATTEMPTS_NUMBER) 
  { 
    if($data["Denied"] == 1) 
    { 
      return 1; 
    } 
    else 
    { 
      $this->clearLoginAttempts($value); 
      return 0; 
    } 
  } 
  return 0; 
} 


?>


<html>
<script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
<body>
<!-- simple user form -->

<form name="login" action="index_submit" method="get" accept-charset="utf-8">
    <ul>

<!-- users email request -->

        <li><label for="usermail">Email</label>
        <input type="email" name="usermail" placeholder="yourname@email.com" required></li>

<!-- users password request -->

        <li><label for="password">Password</label>

<!-- requests the users password but it must contain 1 uppercase, lowercase, number and must be at least 8 characters long in order for the form to validate -->

        <input type="password" name="password" placeholder="Password" pattern="(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" required></li>

Password must be at least 8 characters long, contain 1 uppercase, lowercase and number

        <li>
        <input type="submit" value="Login"></li>
    </ul>
</form>
</body>
</html>