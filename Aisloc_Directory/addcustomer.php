<?php
include 'include.php';

    //customers addcustomer.php
    
if (!$_POST) {
    
	$display_block = <<<END_OF_TEXT
	<form method="post" action="$_SERVER[PHP_SELF]">
    
	
    <fieldset>
    <legend>Name:</legend><br/>
    <input type="text" name="name" size="60"
    maxlength="75" required="required" />
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
    <legend>URL:</legend><br/>
    <input type="text" name="url" size="100"
    maxlength="100" />
    </fieldset>
    
    
    <button type="submit" name="submit"
    value="send">Add Entry</button>
    </form>
    
END_OF_TEXT;

} else if ($_POST) {

	if ($_POST['name'] == "") {
		header("Location: addcustomer.php");
		exit;
	}
	doDB();

	$safe_name = mysqli_real_escape_string($mysqli,
                $_POST['name']);
	$safe_address = mysqli_real_escape_string($mysqli,
                $_POST['address']);
	$safe_phone = mysqli_real_escape_string($mysqli,
                $_POST['phone']);
	$safe_url = mysqli_real_escape_string($mysqli,
                $_POST['url']);


		$add_cus_sql = "INSERT INTO customers (name, address, phone, URL) VALUES
			('".$safe_name."', '".$safe_address."', '".$safe_phone."', '".$safe_url."' )";
		$add_cus_res = mysqli_query($mysqli, $add_cus_sql)
			or die(mysqli_error($mysqli));
    
	mysqli_close($mysqli);
	$display_block = "<p>Your entry has been added. Would you like to 
	<a href=\"addcustomer.php\">add another</a>?";
}
?>
<!DOCTYPE html>
<head>
<title>Add Customer</title>
</head>
<body bgcolor="808080">
<h1>Add Customer</h1>
<?php echo $display_block; ?>
<a href="menu.php"><p>Return to Main Page</p></a>
</body>
</html>




