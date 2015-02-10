<?php

  // Sanitize incoming username and password
  $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
  $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);

  // Connect to the MySQL server
  $db = new mysqli("localhost", "root", "Aisloc14", "aisloc_dir_UADB");

  // Determine whether an account exists matching this username and password
  $stmt = $db->prepare("SELECT id FROM accounts WHERE username = ? and password = md5(?)");

  // Bind the input parameters to the prepared statement
  $stmt->bind_param('ss', $username, $password); 

  // Execute the query
  $stmt->execute();

  // Store the result so we can determine how many rows have been returned
  $stmt->store_result();

  if ($stmt->num_rows == 1) {

    // Bind the returned user ID to the $id variable
    $stmt->bind_result($id); 
    $stmt->fetch();

    // Update the account's last_login column
    $stmt = $db->prepare("UPDATE accounts SET last_login = NOW() WHERE id = ?");
    $stmt->bind_param('d', $id); 
    $stmt->execute();

    session_start();

    $_SESSION['username'] = $username;

    // Redirect the user to the home page
    header('Location: http://d1toine.aisloc.com/Aisloc_Directory/Test/menu.php');
  }
?>
<!DOCTYPE html>
<html>
<head>
<title>Aisloc Directory</title>
</head>
<body bgcolor="808080">
<?php
$user = $_SERVER['REMOTE_USER'];
echo "Logged in as: $user";
?>
<h1>
<div style="text-align:center;">Aisloc Directoine</br><IMG SRC="/Aisloc_Directory/images/branding.png" ALT="image"></div>
</h1>
<form action="login.php" enctype="application/x-www-form-urlencoded" method="post">

<div class="articlePara">
<label for="username">Your username:</label><br />
<input name="username" size="25" type="text" />
</div>

<div class="articlePara">
<label for="password">Your password:</label><br />
<input name="password" size="25" type="password" />
</div>

<div class="articlePara">
<input name="submit" type="submit" value="Login" />
</div>
</form>

</div>
</body>
</html>
