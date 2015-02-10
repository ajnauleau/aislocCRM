<?php

    //logout  Auth/logout.php

    if (!$_POST) {

        $display_block = <<<END_OF_TEXT
        <form method="post" action="$_SERVER[PHP_SELF]"> 
 	<input type="hidden" name="logout" value="logout" />
	<button name="logout" type="submit" value="send">Logout</button>
        </form>
END_OF_TEXT;

    } else if ($_POST) {
 
 if ($_POST['logout']) {
	header('Location: http://log:out@d1toine.aisloc.com');
	exit;

	unset($_SERVER['PHP_AUTH_USER']);
	
	if (!isset($_SERVER['PHP_AUTH_USER'])) {
		echo 'Logged Out, Being Redirected';
		header("Location: /Aisloc_Directory/menu.php");  
 		exit; }
     
	if (isset($_SERVER['PHP_AUTH_USER'])) {
		echo 'Log Out Failed, Please Try Again';
		header("Location: logout.php");
                exit; }
	} 
}
    ?>
<!DOCTYPE html>
<head>
<title>Click to Logout/Change Users:</title>
</head>
<body bgcolor="808080">
<h1>Logout/Change Users <br> PLEASE USE SAFARI</h1>
<?php echo "$display_block \n <br />"; 

$user = $_SERVER['REMOTE_USER'];
echo "Logged in as: $user";
?>
<a href="/Aisloc_Directory/menu.php"><p>Return to Main Page</p></a>
</body>
</html>

