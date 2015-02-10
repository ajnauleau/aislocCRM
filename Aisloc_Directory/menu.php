<?php
    
    //Select Menu menu.php
    
    if (!$_POST) {
            $display_block = "
            <form method=\"post\" action=\"".$_SERVER['PHP_SELF']."\">
            <p><label for=\"add_id\">Add an Entry</label><br/>
                <select id=\"add_id\" name=\"add_id\" required=\"required\">
                <option value=\"\">-- Select One --</option>
                <option value=\"addinvestor.php\">Investor</option>
                <option value=\"addcustomer.php\">Customer</option>
                <option value=\"addcontact.php\">Contact</option>
                <option value=\"addemployee.php\">Employee</option>
                </select></p>
                <button type=\"submit\" name=\"submit\"
                value=\"view\">Submit</button>
                </form>";
        
            $display_block .= "
            <form method=\"post\" action=\"".$_SERVER['PHP_SELF']."\">
                <p><label for=\"del_id\">Delete an Entry</label><br/>
                    <select id=\"del_id\" name=\"del_id\" required=\"required\">
                    <option value=\"\">-- Select One --</option>
                    <option value=\"delinvestor.php\">Investor</option>
                    <option value=\"delcustomer.php\">Customer</option>
                    <option value=\"delcontact.php\">Contact</option>
                    <option value=\"delemployee.php\">Employee</option>
                    </select></p>
                    <button type=\"submit\" name=\"submit\"
                    value=\"view\">Submit</button>
                    </form>";
        
            $display_block .= "
            <form method=\"post\" action=\"".$_SERVER['PHP_SELF']."\">
            <p><label for=\"sel_id\">View an Entry</label><br/>
                <select id=\"sel_id\" name=\"sel_id\" required=\"required\">
                <option value=\"\">-- Select One --</option>
                <option value=\"selinvestor.php\">Investor</option>
                <option value=\"selcustomer.php\">Customer</option>
                <option value=\"selcontact.php\">Contact</option>
                <option value=\"selemployee.php\">Employee</option>
                </select></p>
                <button type=\"submit\" name=\"submit\"
                value=\"view\">Submit</button>
                </form>";
        
        $display_block .= "
        <p style=\"text-align:center;font-size:150%;\"><strong>Connection Management</strong></p>
	<form method=\"post\" action=\"".$_SERVER['PHP_SELF']."\">
	<p><label for=\"cnn_id\">Select an Option</label><br/>
            <select id=\"cnn_id\" name=\"cnn_id\" required=\"required\">
            <option value=\"\">-- Select One --</option>
            <option value=\"addconnection.php\">Make Connection</option>
            <option value=\"delconnection.php\">Remove Connection</option>
            <option value=\"selconnection.php\">View Connection</option>
            </select></p>
            <button type=\"submit\" name=\"submit\"
            value=\"view\">Submit</button>
            </form>";

	 $display_block .= "
        <p style=\"text-align:center;font-size:150%;\"><strong>Network Monitoring</strong></p>
        <form method=\"post\" action=\"".$_SERVER['PHP_SELF']."\">
        <p><label for=\"net_id\">Select an Option</label><br/>
            <select id=\"net_id\" name=\"net_id\" required=\"required\">
            <option value=\"\">-- Select One --</option>
            <option value=\"/nagios\">Nagios Core</option>
	    <option value=\"/nagios/cgi-bin//status.cgi?host=all\">Service Monitor</option>  
            </select></p>
            <button type=\"submit\" name=\"submit\"
            value=\"view\">Submit</button>
            </form>";

	  $display_block .= "
        <p style=\"text-align:center;font-size:150%;\"><strong>Authorization Management</strong></p>
        <form method=\"post\" action=\"".$_SERVER['PHP_SELF']."\">
        <p><label for=\"auth_id\">Select an Option</label><br/>
            <select id=\"auth_id\" name=\"auth_id\" required=\"required\">
            <option value=\"\">-- Select One --</option>
            <option value=\"./Auth/Admin/adduser.php\">Add User</option>
            <option value=\"./Auth/changepass.php\">Change Password</option>
	     <option value=\"./Auth/logout.php\">Logout/Change Users</option> 
            </select></p>
            <button type=\"submit\" name=\"submit\"
            value=\"view\">Submit</button>
            </form>";
    
    } else if ($_POST) {
        if (($_POST['sel_id'] == "") && ($_POST['del_id'] == "") && 
	($_POST['add_id'] == "") && ($_POST['cnn_id'] == "") &&
	($_POST['net_id'] == "") && ($_POST['auth_id'] == "")) {
            header("Location: menu.php");
            exit;
        }
        
        if ($_POST['sel_id']) {
            header("Location: ".$_POST['sel_id']."");
            exit;
        }
        if ($_POST['del_id']) {
            header("Location: ".$_POST['del_id']."");
            exit;
        }
        if ($_POST['add_id']) {
            header("Location: ".$_POST['add_id']."");
            exit;
        }
        if ($_POST['cnn_id']) {
            header("Location: ".$_POST['cnn_id']."");
            exit;
        }
	if ($_POST['net_id']) {
            header("Location: ".$_POST['net_id']."");
            exit;
        }
	 if ($_POST['auth_id']) {
            header("Location: ".$_POST['auth_id']."");
            exit;
        }
        
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
<p style="text-align:center;font-size:150%;"><strong>Entry Management</strong></p>
<div style="text-align:center;">
<?php
    echo $display_block; 
?>
</div>
</body>
</html>

