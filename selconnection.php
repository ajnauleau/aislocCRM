<?php
    include 'include.php';
    doDB();
    
    //View Connections selconnection.php
    
    if (!$_POST) {
        doDB();
        $display_block = "<h1> Select an Entry</h1>";
        $get_cnn_sql = "SELECT cnn_id, inv_id, cus_id, con_id, emp_id FROM connections";
        $get_cnn_res = mysqli_query($mysqli, $get_cnn_sql)
        or die(mysqli_error($mysqli));

        if (mysqli_num_rows($get_cnn_res) < 1) {
            $display_block .= "<p><em>Sorry, no records to select!</em></p>";
            
        } else {
            $display_block .= "
            <form method=\"post\" action=\"".$_SERVER['PHP_SELF']."\">
            <p><label for=\"sel_id\">Select a Record:</label><br/>
                <select id=\"sel_id\" name=\"sel_id\" required=\"required\">
                <option value=\"\">-- Select One --</option>";
            
            while ($recs = mysqli_fetch_array($get_cnn_res)) {
                $cnn_dis_id = $recs['cnn_id'];
                //Get Investor Name
                $inv_nam_id = $recs['inv_id'];
                $get_inv_nam_sql = "SELECT name FROM investors WHERE inv_id = '".$inv_nam_id."'";
                $get_inv_nam_res = mysqli_query($mysqli, $get_inv_nam_sql)
                or die(mysqli_error($mysqli));
                $inv_nam_recs = mysqli_fetch_array($get_inv_nam_res);
                $inv_name = stripslashes($inv_nam_recs['name'])." /";
                
                //Get Customer Name
                $cus_nam_id = $recs['cus_id'];
                $get_cus_nam_sql = "SELECT name FROM customers WHERE cus_id = '".$cus_nam_id."'";
                $get_cus_nam_res = mysqli_query($mysqli, $get_cus_nam_sql)
                or die(mysqli_error($mysqli));
                $cus_nam_recs = mysqli_fetch_array($get_cus_nam_res);
                $cus_name = stripslashes($cus_nam_recs['name'])." /";
                
                //Get Contact Name
                $con_nam_id = $recs['con_id'];
                $get_con_nam_sql = "SELECT CONCAT_WS(', ', f_name, l_name) AS name
                    FROM contacts WHERE con_id = '".$con_nam_id."'";
                $get_con_nam_res = mysqli_query($mysqli, $get_con_nam_sql)
                or die(mysqli_error($mysqli));
                $con_nam_recs = mysqli_fetch_array($get_con_nam_res);
                $con_name = stripslashes($con_nam_recs['name'])." /";
                
                //Get Employee Name
                $emp_nam_id = $recs['emp_id'];
                $get_emp_nam_sql = "SELECT CONCAT_WS(', ', f_name, l_name) AS name
                    FROM employees WHERE emp_id = '".$emp_nam_id."'";
                $get_emp_nam_res = mysqli_query($mysqli, $get_emp_nam_sql)
                or die(mysqli_error($mysqli));
                $emp_nam_recs = mysqli_fetch_array($get_emp_nam_res);
                $emp_name = stripslashes($emp_nam_recs['name']);

		//ADD RESULTS TOGETHER
		$results = $inv_name."  ".$cus_name."  ".$con_name."  ".$emp_name;

                $display_block .=
		 "<option value=\"".$cnn_dis_id."\">".$results." </option>";                
            }
            $display_block .= "
            </select>
            <button type=\"submit\" name=\"submit\"
			value=\"view\">View Selected Entry</button>
            </form>";
        }
        mysqli_free_result($get_cnn_res);
        mysqli_free_result($get_inv_nam_res);
        mysqli_free_result($get_cus_nam_res);
        mysqli_free_result($get_con_nam_res);
        mysqli_free_result($get_emp_nam_res);
        
    } else if ($_POST) {
        if ($_POST['sel_id'] == "") {
            header("Location: selconnection.php");
            exit;
        }
        
        $safe_cnn_id = mysqli_real_escape_string($mysqli, $_POST['sel_id']);
        $get_post_cnn_sql = "SELECT inv_id, cus_id, con_id, emp_id FROM connections where cnn_id = '".$safe_cnn_id."'";
        $get_post_cnn_res = mysqli_query($mysqli, $get_post_cnn_sql)
        or die(mysqli_error($mysqli));
        
        //Get Post ID's
        $post_recs_id = mysqli_fetch_array($get_post_cnn_res);
            
        $inv_post_id = $post_recs_id['inv_id'];
        $get_inv_sql = "SELECT name, address, phone, URL FROM investors WHERE inv_id = '".$inv_post_id."'";
        $get_inv_res = mysqli_query($mysqli, $get_inv_sql)
        or die(mysqli_error($mysqli));
        
        if (mysqli_num_rows($get_inv_res) > 0) {
            $inv_info = mysqli_fetch_array($get_inv_res);
            $inv_name = stripslashes($inv_info['name']);
            $inv_address = stripslashes($inv_info['address']);
            $inv_phone = stripslashes($inv_info['phone']);
            $inv_url = stripslashes($inv_info['URL']);
        $display_block = "<h1>Investor: ".$inv_name."</h1>";
        $display_block .= "<p><strong>Address:</strong><br/>
            <ul><li>$inv_address </li></ul>";
        $display_block .= "<p><strong>Phone:</strong><br/>
            <ul><li>$inv_phone </li></ul>";
        $display_block .= "<p><strong>URL:</strong><br/>
            <ul><li>$inv_url </li></ul>"; 
        }
        
        mysqli_free_result($get_inv_res);
        
        //Show Customer
        $cus_post_id = $post_recs_id['cus_id'];
        $get_cus_sql = "SELECT name, address, phone, URL FROM customers WHERE cus_id = '".$cus_post_id."'";
        $get_cus_res = mysqli_query($mysqli, $get_cus_sql)
        or die(mysqli_error($mysqli));
        
        if (mysqli_num_rows($get_cus_res) > 0) {
                $cus_info = mysqli_fetch_array($get_cus_res);
                $cus_name = stripslashes($cus_info['name']);
                $cus_address = stripslashes($cus_info['address']);
                $cus_phone = stripslashes($cus_info['phone']);
                $cus_url = stripslashes($cus_info['URL']);
            $display_block .= "<h1>Customer: ".$cus_name."</h1>";
            $display_block .= "<p><strong>Address:</strong><br/>
            <ul><li>$cus_address </li></ul></p>";
            $display_block .= "<p><strong>Phone:</strong><br/>
            <ul><li>$cus_phone </li></ul></p>";
            $display_block .= "<p><strong>URL:</strong><br/>
            <ul><li>$cus_url </li></ul></p>";
        }
        
        mysqli_free_result($get_cus_res);
        
        //Show Contact
        $con_post_id = $post_recs_id['con_id'];
        $get_con_sql = "SELECT CONCAT_WS(' ', f_name, l_name) as name, address, phone, email
            FROM contacts WHERE con_id = '".$con_post_id."'";
        $get_con_res = mysqli_query($mysqli, $get_con_sql)
        or die(mysqli_error($mysqli));
        
        if (mysqli_num_rows($get_con_res) > 0) {
                $con_info = mysqli_fetch_array($get_con_res);
                $con_name = stripslashes($con_info['name']);
                $con_address = stripslashes($con_info['address']);
                $con_phone = stripslashes($con_info['phone']);
                $con_email = stripslashes($con_info['email']);
            $display_block .= "<h1>Contact: ".$con_name."</h1>";
            $display_block .= "<p><strong>Address:</strong><br/>
            <ul><li>$con_address </li></ul>";
            $display_block .= "<p><strong>Phone:</strong><br/>
            <ul><li>$con_phone </li></ul>";
            $display_block .= "<p><strong>Email:</strong><br/>
            <ul><li>$con_email </li></ul>";
        }
            
        mysqli_free_result($get_con_res);
        
        //Show Employee
        $emp_post_id = $post_recs_id['emp_id'];
        $get_emp_sql = "SELECT CONCAT_WS(' ', f_name, l_name) as name, position, address, phone, email FROM employees
            WHERE emp_id = '".$emp_post_id."'";
        $get_emp_res = mysqli_query($mysqli, $get_emp_sql)
        or die(mysqli_error($mysqli));

        if (mysqli_num_rows($get_emp_res) > 0) {
                $emp_info = mysqli_fetch_array($get_emp_res);
                $emp_name = stripslashes($emp_info['name']);
                $emp_position = stripslashes($emp_info['position']);
                $emp_address = stripslashes($emp_info['address']);
                $emp_phone = stripslashes($emp_info['phone']);
                $emp_email = stripslashes($emp_info['email']);
            $display_block .= "<h1>Employee: ".$emp_name."</h1>";
            $display_block .= "<p><strong>Position:</strong><br/>
            <ul><li>$emp_position </li></ul>";
            $display_block .= "<p><strong>Address:</strong><br/>
            <ul><li>$emp_address </li></ul>";
            $display_block .= "<p><strong>Phone:</strong><br/>
            <ul><li>$emp_phone </li></ul>";
            $display_block .= "<p><strong>Email:</strong><br/>
            <ul><li>$emp_email </li></ul>";
        }
    
        mysqli_free_result($get_emp_res);
            
        mysqli_free_result($get_post_cnn_res);
        
        $display_block .= "<p style=\"text-align:center\">
        <a href=\"".$_SERVER['PHP_SELF']."\">View Another Connection</a></p>";
    
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
</body>
</html>

