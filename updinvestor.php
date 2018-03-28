<?php
    include 'include.php';
    
    //investors updinvestor.php
    doDB();
    
if ($_GET['sel_inv_id'] == "") {
		header("Location: selinvestor.php");
		exit;
        }
if (!$_POST) {
        $display_block = "<form method=\"post\" action=\"".$SERVER['PHP_SELF']."\">";
        if (isset($_GET['sel_inv_id'])) {
            $safe_id = mysqli_real_escape_string($mysqli, $_GET['sel_inv_id']);
            $get_name_sql = "SELECT name FROM investors WHERE inv_id = '".$safe_id."'";
            $get_name_res = mysqli_query($mysqli, $get_name_sql)
            or die(mysqli_error($mysqli));
            
            if (mysqli_num_rows($get_name_res) == 1) {
                while ($name_info = mysqli_fetch_array($get_name_res)) {
                    $display_name = stripslashes($name_info['name']);
                }
            }
        }
    
    $display_block .= "<p>Updating information for : <strong>$display_name</strong></p>";
    $display_block .= <<<END_OF_TEXT
    <fieldset>
    <legend>Address:</legend><br/>
    <input type="text"  name="address" size="150" />
    </fieldset>
    
    <fieldset>
    <legend>Phone Number:</legend><br/>
    <input type="text" name="phone" size="25" maxlength="25" />
    </fieldset>
    
    <fieldset>
    <legend>URL:</legend><br/>
    <input type="text" name="url" size="100" maxlength="100" />
    </fieldset>
    
    <button type="submit" name="submit" value="send">Update Entry</button>
    </form>
END_OF_TEXT;
} else if ($_POST) {
    doDB();
    $safe_address = mysqli_real_escape_string($mysqli, $_POST['address']);
    $safe_phone = mysqli_real_escape_string($mysqli, $_POST['phone']);
    $safe_url = mysqli_real_escape_string($mysqli, $_POST['url']);
    $safe_id = mysqli_real_escape_string($mysqli, $_GET['sel_inv_id']);
                if (($_POST['address']) && ($_POST['address'] != "")) {
                $add_add_sql = "UPDATE investors SET address = '".$safe_address."' WHERE inv_id = '".$safe_id."'";
                $add_add_res = mysqli_query($mysqli, $add_add_sql)
                or die(mysqli_error($mysqli)); }
                
                if (($_POST['phone']) && ($_POST['phone'] != "")) {
                $add_pho_sql = "UPDATE investors SET phone = '".$safe_phone."' WHERE inv_id = '".$safe_id."'";
                $add_pho_res = mysqli_query($mysqli, $add_pho_sql)
                or die(mysqli_error($mysqli)); }
                
                if (($_POST['url']) && ($_POST['url'] != "")){
                $add_url_sql = "UPDATE investors SET URL = '".$safe_url."' WHERE inv_id = '".$safe_id."'";
                $add_url_res = mysqli_query($mysqli, $add_url_sql)
                or die(mysqli_error($mysqli)); }
            
                $display_block = "<p>Your entry has been updated. Would you like to <a href=\"addinvestor.php\">add another Investor</a>? Or would you like view another <a href=\"selinvestor.php\">Investor</a>?</p>";
                mysqli_close($mysqli);
            }
?>
<!DOCTYPE html>
<head>
<title>Update Investor</title>
</head>
<body bgcolor="808080">
<h1>Update an Investor</h1>
<?php echo $display_block; ?>
<p><a href="menu.php">Return to Main Page</a></p>
</html>

