<?php
    
    //add user  Auth/adduser.php
    
    if (!$_POST) {
        
        $display_block = <<<END_OF_TEXT
       	<form method="post" action="$_SERVER[PHP_SELF]">
        
        <fieldset>
        <legend>Username:</legend><br/>
        <input type="text" name="user" size="60" maxlength="75" required="required" />
        </fieldset>
        
        <fieldset>
        <legend>Password:</legend><br/>
        <input type="text"  name="pass" size="60" required="required"  />
        </fieldset>
        
        <button type="submit" name="submit" value="send">Add Entry</button>
        </form>
END_OF_TEXT;
    } else if ($_POST) {
        if (($_POST['user'] == "") && ($_POST['pass'] == "")) {
            header("Location: adduser.php");
            exit;
        }
      
        $u = $_POST['user'];
        $p = $_POST['pass'];
        $add = shell_exec('/var/www/html/Aisloc_Directory/Auth/.bashlogin "'.$u.'" "'.$p.'" 2>&1');
        $display_block = "<p>$add. Would you like to perform <a href=\"adduser.php\">another command</a>?";   
    }

    ?>
<!DOCTYPE html>
<head>
<title>Add/Update Authorized User</title>
</head>
<body bgcolor="808080">
<h1>Add/Update Authorized User</h1>
<?php echo $display_block;
$user = $_SERVER['REMOTE_USER'];
echo "<br />Logged in as: $user";
?>
<a href="/Aisloc_Directory/menu.php"><p>Return to Main Page</p></a>
</body>
</html>
