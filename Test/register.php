<?php
function doDB() {
        global $mysqli;

        // connect to server and select database
        $mysqli = mysqli_connect("localhost", "root", "Aisloc14", "aisloc_dir_UADB");

        // if connection fails, stop script execution
        if (mysqli_connect_errno()) {
                printf("Connect failed: %s\n", mysqli_connect_error());
                exit(); }
	}


if ($_POST['username']) {
  // Sanitize incoming username and password
  $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
  $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);

  doDB();	

  $add_con_sql = "INSERT INTO accounts (username, password)
        VALUES ('".$username."', MD5('".$password."'))";
 
  $add_con_res = mysqli_query($mysqli, $add_con_sql)
         or die(mysqli_error($mysqli));

        mysqli_close($mysqli);

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
<form action="register.php" enctype="application/x-www-form-urlencoded" method="post">

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
