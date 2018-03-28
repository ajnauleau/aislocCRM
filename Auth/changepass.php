<?php
   
    //Change Password  Auth/changepass.php
   
    if (!$_POST) {
	$user = $_SERVER['REMOTE_USER'];
        $display_block = "<p style=\"text-align:center;font-size:150%;\"><strong>Username: $user</strong></p>";
	$display_block .=<<<END_OF_TEXT

        <form method="post" action="$_SERVER[PHP_SELF]">
        <fieldset>
        <legend>Password:</legend><br/>
        <input type="text"  name="pass" size="60" required="required"  />
        </fieldset>

        <button type="submit" name="submit" value="send">Update</button>
        </form>
END_OF_TEXT;
    } else if ($_POST) {
        if (($_POST['user'] == "") && ($_POST['pass'] == "")) {
            header("Location: adduser.php");
            exit;
        }

        $u = $_SERVER['REMOTE_USER'];
        $p = $_POST['pass'];
        $add = shell_exec('/var/www/html/Aisloc_Directory/Auth/.bashlogin "'.$u.'" "'.$p.'" 2>&1');
        $display_block = "<p>$add</p>";
    }

    ?>
<!DOCTYPE html>
<head>
<title>Change Password</title>
</head>
<body bgcolor="808080">
<h1>Change Password</h1>
<?php echo $display_block;
?>
<a href="/Aisloc_Directory/menu.php"><p>Return to Main Page</p></a>
</body>
</html>

