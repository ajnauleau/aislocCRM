<?php
include 'include.php';
doDB();

//View Investors selinvestor.php
    
if (!$_POST) {
	$display_block = "<h1> Select an Entry</h1>";
	$get_list_sql ="SELECT cus_id, name FROM customers ORDER BY name";
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
			$id = $recs['cus_id'];
			$display_name = stripslashes($recs['name']);
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
		header("Location: selcustomer.php");
		exit;
	}

	$safe_id = mysqli_real_escape_string($mysqli, $_POST['sel_id']);
	$get_cus_sql = "SELECT name FROM customers WHERE cus_id = '".$safe_id."'";
	$get_cus_res = mysqli_query($mysqli, $get_cus_sql)
			or die(mysqli_error($mysqli));

	while ($name_info = mysqli_fetch_array($get_cus_res)) {
		$name = stripslashes($name_info['name']);
	}

	$display_block = "<h1>Showing Record for ".$name."</h1>";

	mysqli_free_result($get_cus_res);

	$get_addresses_sql = "SELECT address FROM customers WHERE cus_id = '".$safe_id."'";
	$get_addresses_res = mysqli_query($mysqli, $get_addresses_sql)
				or die(mysqli_error($mysqli));

if (mysqli_num_rows($get_addresses_res) > 0) {
	$display_block .= "<p><strong>Addresses:</strong><br/>
	<ul>";

	while ($add_info = mysqli_fetch_array($get_addresses_res)) {
		$address = stripslashes($add_info['address']);

		$display_block .= "<li>$address </li>";
	}
	$display_block .= "</ul>";

	}
	mysqli_free_result($get_addresses_res);

	$get_pho_sql = "SELECT phone FROM customers WHERE cus_id = '".$safe_id."'";
	$get_pho_res = mysqli_query($mysqli, $get_pho_sql)
			or die(mysqli_error($mysqli));

	if (mysqli_num_rows($get_pho_res) > 0) {
		$display_block .= "<p><strong>Telephone:</strong><br/>
	<ul>";

	while ($pho_info = mysqli_fetch_array($get_pho_res)) {
		$phone = stripslashes($pho_info['phone']);

		$display_block .= "<li>$phone</li>";
	}
	$display_block .= "</ul>";
}
	mysqli_free_result($get_phone_res);

	$get_url_sql = "SELECT URL FROM customers WHERE cus_id = '".$safe_id."'";
	$get_url_res = mysqli_query($mysqli, $get_url_sql)
			or die(mysqli_error($mysqli));

	if (mysqli_num_rows($get_url_res) > 0) {
		$display_block .= "<p><strong>URL:</strong><br/>
		<ul>";

		while ($url_info = mysqli_fetch_array($get_url_res)) {
			$url = stripslashes($url_info['URL']);

		$display_block .= "<li>$url</li>";
		}
		$display_block .= "</ul>";
	}
	mysqli_free_result($get_url_res);

$display_block .= "<p style=\"text-align:center\">
    <a href=\"updcustomer.php?sel_cus_id=".$_POST['sel_id']."\">Update Info</a> ...
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
</br>
<br/>
<a href="menu.php"><p>Return to Main Page</p></a>
</html>
