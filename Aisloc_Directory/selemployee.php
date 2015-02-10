<?php
include 'include.php';
doDB();

if (!$_POST) {
	$display_block = "<h1> Select an Entry</h1>";
	$get_list_sql ="SELECT emp_id, CONCAT_WS(', ', l_name, f_name) AS display_name
			FROM employees ORDER BY l_name, f_name";
	$get_list_res = mysqli_query($mysqli, $get_list_sql)
			or die(mysqli_error($mysqli));
	if (mysqli_num_rows($get_list_res) < 1) {
		$display_block .= "<p><em>Sorry, no records to select!</em></p>";

	} else {
		$display_block .= "
		<form method=\"post\" action=\"".$_SERVER['PHP_SELF']."\">
		<p><label for=\"sel_id\">Select a Record:</label><br/>
		<select id=\"sel_id\" name=\"sel_id\" required=\"required\">
		<option value=\"\">-- Select One --</option>";

		while ($recs = mysqli_fetch_array($get_list_res)) {
			$id = $recs['emp_id'];
			$display_name = stripslashes($recs['display_name']);
			$display_block .=
			"<option value=\"".$id."\">".$display_name."</option>";
		}

		$display_block .= "
		</select>
		<button type=\"submit\" name=\"submit\"
			value=\"view\">View Selected Entry</button>
		</form>";
	}
	mysqli_free_result($get_list_res);

} else if ($_POST) {
	if ($_POST['sel_id'] == "") {
		header("Location: selemployee.php");
		exit;
	}

	$safe_id = mysqli_real_escape_string($mysqli, $_POST['sel_id']);
	$get_name_sql = "SELECT CONCAT_WS(' ', f_name, l_name) as display_name
			FROM employees WHERE emp_id = '".$safe_id."'";
	$get_name_res = mysqli_query($mysqli, $get_name_sql)
			or die(mysqli_error($mysqli));

	while ($name_info = mysqli_fetch_array($get_name_res)) {
		$display_name = stripslashes($name_info['display_name']);
	}

	$display_block = "<h1>Showing Record for ".$display_name."</h1>";

	mysqli_free_result($get_name_res);

	$get_address_sql = "SELECT address FROM employees WHERE emp_id = '".$safe_id."'";
	$get_address_res = mysqli_query($mysqli, $get_address_sql)
				or die(mysqli_error($mysqli));

if (mysqli_num_rows($get_address_res) > 0) {
	$display_block .= "<p><strong>Addresses:</strong><br/>
	<ul>";

	while ($add_info = mysqli_fetch_array($get_address_res)) {
		$address = stripslashes($add_info['address']);

		$display_block .= "<li>$address</li>";
	}
	$display_block .= "</ul>";

	}
	mysqli_free_result($get_address_res);
    
    $get_pos_sql = "SELECT position FROM employees WHERE emp_id = '".$safe_id."'";
	$get_pos_res = mysqli_query($mysqli, $get_pos_sql)
    or die(mysqli_error($mysqli));
    
	if (mysqli_num_rows($get_pos_res) > 0) {
		$display_block .= "<p><strong>Position:</strong><br/>
        <ul>";
        
        while ($pos_info = mysqli_fetch_array($get_pos_res)) {
            $position = stripslashes($pos_info['position']);
            
            $display_block .= "<li>$position</li>";
        }
        $display_block .= "</ul>";
    }
	mysqli_free_result($get_pho_res);

	$get_pho_sql = "SELECT phone FROM employees WHERE emp_id = '".$safe_id."'";
	$get_pho_res = mysqli_query($mysqli, $get_pho_sql)
			or die(mysqli_error($mysqli));

	if (mysqli_num_rows($get_pho_res) > 0) {
		$display_block .= "<p><strong>Telephone:</strong><br/>
	<ul>";

	while ($pho_info = mysqli_fetch_array($get_pho_res)) {
		$pho_number = stripslashes($pho_info['phone']);

		$display_block .= "<li>$pho_number</li>";
	}
	$display_block .= "</ul>";
}
	mysqli_free_result($get_pho_res);

	$get_email_sql = "SELECT email FROM employees WHERE emp_id = '".$safe_id."'";
	$get_email_res = mysqli_query($mysqli, $get_email_sql)
			or die(mysqli_error($mysqli));
	if (mysqli_num_rows($get_email_res) > 0) {
		$display_block .= "<p><strong>Email:</strong><br/>
		<ul>";

	while ($email_info = mysqli_fetch_array($get_email_res)) {
		$email = stripslashes($email_info['email']);

		$display_block .= "<li>$email</li>";
		}
		$display_block .= "</ul>";
	}
	mysqli_free_result($get_email_res);

$display_block .= "<p style=\"text-align:center\">
    <a href=\"updemployee.php?sel_emp_id=".$_POST['sel_id']."\">Update Info</a> ...
    <a href=\"".$_SERVER['PHP_SELF']."\">Select Another</a></p>";
}
mysqli_close($mysqli);
    
?>
<!DOCTYPE html>
<html>
<head>
<title>My Records</title>
</head>
<body bgcolor="808080">
<?php
echo $display_block; 
?>
<br/>
<a href="menu.php"><p>Return to Main Page</p></a>
</html>

