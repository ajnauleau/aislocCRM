<?php
include 'include.php';

    //add contact  addcontact.php
    
if (!$_POST) {
    
	$display_block = <<<END_OF_TEXT
	<form method="post" action="$_SERVER[PHP_SELF]">
    
	
    <fieldset>
    <legend>First/Last Name:</legend><br/>
    <input type="text" name="f_name" size="60"
    maxlength="75" required="required" />
    <input type="text" name="l_name" size="60"
    maxlength="75" />
    </fieldset>
    
    
    <fieldset>
    <legend>Address:</legend><br/>
    <input type="text"  name="address"
    size="150" />
    </fieldset>
    
    <fieldset>
    <legend>Phone Number:</legend><br/>
    <input type="text" name="phone" size="25" maxlength="25" />
    </fieldset>
    
    <fieldset>
    <legend>Email:</legend><br/>
    <input type="text" name="email" size="30"
    maxlength="30" />
    </fieldset>
    
    
    <button type="submit" name="submit"
    value="send">Add Entry</button>
    </form>
    
END_OF_TEXT;

} else if ($_POST) {

	if ($_POST['f_name'] == "") {
		header("Location: addcontact.php");
		exit;
	}
	doDB();

	$safe_f_name = mysqli_real_escape_string($mysqli,
                $_POST['f_name']);
   	$safe_l_name = mysqli_real_escape_string($mysqli,
                $_POST['l_name']);
	$safe_address = mysqli_real_escape_string($mysqli,
                $_POST['address']);
	$safe_phone = mysqli_real_escape_string($mysqli,
                $_POST['phone']);
	$safe_email = mysqli_real_escape_string($mysqli,
                $_POST['email']);


	$add_con_sql = "INSERT INTO contacts (f_name, l_name, address, phone, email) VALUES
			('".$safe_f_name."', '".$safe_l_name."', '".$safe_address."', '".$safe_phone."', '".$safe_email."' )";
	$add_con_res = mysqli_query($mysqli, $add_con_sql)
			or die(mysqli_error($mysqli));

    
	mysqli_close($mysqli);
	$display_block = "<p>Your entry has been added. Would you like to <a href=\"addcontact.php\">add another</a>?"; 
}
?>
<!DOCTYPE html>
<head>
<title>Add Contact</title>
</head>
<body bgcolor="808080">
<h1>Add Contact</h1>
<?php echo $display_block; ?>
<a href="menu.php"><p>Return to Main Page</p></a>
</body>
</html>

