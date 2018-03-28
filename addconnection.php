<?php
    include 'include.php';
    doDB();
    
    //View connections addconnection.php
    
    if (!$_POST) {
        doDB();
        $display_block = "<h1> Make A Connection</h1>";
        
        //Display Investor Selection
        $get_inv_list_sql ="SELECT inv_id, name FROM investors";
        $get_inv_list_res = mysqli_query($mysqli, $get_inv_list_sql)
        or die(mysqli_error($mysqli));
        
        $display_block .= "<form method=\"post\" action=\"".$_SERVER['PHP_SELF']."\">
            <p><label for=\"sel_inv_id\">Select an Investor:</label></p><br/>
            <select id=\"sel_inv_id\" name=\"sel_inv_id\">
            <option value=\"\">-- Select Investor --</option>";
        
            while ($inv_recs = mysqli_fetch_array($get_inv_list_res)){
                $inv_id = $inv_recs['inv_id'];
                $inv_name = stripslashes($inv_recs['name']);
                $display_block .= "<option value=\"".$inv_id."\">".$inv_name."</option>";}
        
        $display_block .= "</select>";

        
        //Display Customer Selection
        $get_cus_list_sql ="SELECT cus_id, name FROM customers";
        $get_cus_list_res = mysqli_query($mysqli, $get_cus_list_sql)
        or die(mysqli_error($mysqli));
        
        $display_block .= "<p><label for=\"sel_cus_id\">Select a Customer:</label></p><br/>
            <select id=\"sel_cus_id\" name=\"sel_cus_id\">
            <option value=\"\">-- Select Customer --</option>";
        
            while ($cus_recs = mysqli_fetch_array($get_cus_list_res)){
                $cus_id = $cus_recs['cus_id'];
                $cus_name = stripslashes($cus_recs['name']);
                $display_block .= "<option value=\"".$cus_id."\">".$cus_name."</option>";}
        
        $display_block .= "</select>";
        

        //Display Contact Selection
        $get_con_list_sql ="SELECT con_id, CONCAT_WS(', ', l_name, f_name) AS display_name
            FROM contacts ORDER BY l_name, f_name";
        $get_con_list_res = mysqli_query($mysqli, $get_con_list_sql)
        or die(mysqli_error($mysqli));
        
        $display_block .= "<p></br><label for=\"sel_con_id\">Select a Contact:</label></p><br/>
            <select id=\"sel_con_id\" name=\"sel_con_id\">
            <option value=\"\">-- Select Contact --</option>";
        
            while ($con_recs = mysqli_fetch_array($get_con_list_res)){
                $con_id = $con_recs['con_id'];
                $con_name = stripslashes($con_recs['display_name']);
                $display_block .= "<option value=\"".$con_id."\">".$con_name."</option>";}
        
        $display_block .= "</select>";
       
        //Display Employee Selection
        $get_emp_list_sql ="SELECT emp_id, CONCAT_WS(', ', l_name, f_name) AS display_name
            FROM employees ORDER BY l_name, f_name";
        $get_emp_list_res = mysqli_query($mysqli, $get_emp_list_sql)
        or die(mysqli_error($mysqli));
            
        $display_block .= "<p></br><label for=\"sel_emp_id\">Select an Employee:</label></p><br/>
            <select id=\"sel_emp_id\" name=\"sel_emp_id\">
            <option value=\"\">-- Select Employee --</option>";
        
            while ($emp_recs = mysqli_fetch_array($get_emp_list_res)){
                $emp_id = $emp_recs['emp_id'];
                $emp_name = stripslashes($emp_recs['display_name']);
                $display_block .= "<option value=\"".$emp_id."\">".$emp_name."</option>"; }
        
        $display_block .= "</select>";
        
        
        if ((mysqli_num_rows($get_inv_list_res) < 1) && (mysqli_num_rows($get_cus_list_res) < 1) && (mysqli_num_rows($get_con_list_res) < 1) && (mysqli_num_rows($get_emp_list_res) < 1)) {
            $display_block .= "<p><em>Sorry, no records to select!</em></p>";
        } else {
            $display_block .= "<button type=\"submit\" name=\"submit\" value=\"send\">Add Selected Connections</button></form>";
        }
        //Free Results for Loop
        mysqli_free_result($get_inv_list_res);
        mysqli_free_result($get_cus_list_res);
        mysqli_free_result($get_con_list_res);
        mysqli_free_result($get_emp_list_res);
    
} else if ($_POST) {
        if (($_POST['sel_inv_id'] == "") && ($_POST['sel_cus_id'] == "") && ($_POST['sel_con_id'] == "") && ($_POST['sel_emp_id'] == "")) {
            header("Location: addconnection.php");
            exit;
        }
    doDB();
        $safe_inv_id = mysqli_real_escape_string($mysqli, $_POST['sel_inv_id']);
        $safe_cus_id = mysqli_real_escape_string($mysqli, $_POST['sel_cus_id']);
        $safe_con_id = mysqli_real_escape_string($mysqli, $_POST['sel_con_id']);
        $safe_emp_id = mysqli_real_escape_string($mysqli, $_POST['sel_emp_id']);
    
    if ($_POST['sel_cus_id'] == "") {
        $add_inv_sql = "INSERT INTO connections (inv_id, con_id, emp_id) VALUES ('".$safe_inv_id."', '".$safe_con_id."', '".$safe_emp_id."')";
        $add_inv_res = mysqli_query($mysqli, $add_inv_sql)
        or die(mysqli_error($mysqli));

    } else if ($_POST['sel_inv_id'] == "") {
        $add_cus_sql = "INSERT INTO connections (cus_id, con_id, emp_id) VALUES ('".$safe_cus_id."', '".$safe_con_id."', '".$safe_emp_id."')";
        $add_cus_res = mysqli_query($mysqli, $add_cus_sql)
        or die(mysqli_error($mysqli));
    } else {
	$add_all_sql = "INSERT INTO connections (inv_id, cus_id, con_id, emp_id) VALUES ('".$safe_inv_id."', '".$safe_cus_id."', '".$safe_con_id."', '".$safe_emp_id."')";
        $add_all_res = mysqli_query($mysqli, $add_all_sql)
        or die(mysqli_error($mysqli)); }
	
	mysqli_free_result($add_inv_res);
        mysqli_free_result($add_cus_res);
        mysqli_free_result($add_all_res);	

        mysqli_close($mysqli);
        $display_block = "<p>The connection you made has been added.<br />
	 Would you like to <a href=\"addconnection.php\">add another connection</a>?
	 Or would you like to <a href=\"selconnection.php\"> view connections</a>?</p>";
}
?>
<!DOCTYPE html>
<head>
<title>Add Connection</title>
</head>
<body bgcolor="808080">
<h1>Add Connection
</h1>
<?php echo $display_block; ?>
<a href="menu.php"><p>Return to Main Page</p></a>
</body>
</html>

