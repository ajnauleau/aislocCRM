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
                
                $display_block .=
                "<option value=\"".$cnn_dis_id."\">".$inv_name." ".$cus_name." ".$con_name." ".$emp_name." </option>";
                
            }
            $display_block .= "
            </select>
            <button type=\"submit\" name=\"submit\"
			value=\"view\">Delete Entry</button>
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
        
        //issue queries
        $del_cnn_sql = "DELETE FROM connections WHERE cnn_id = '".$safe_cnn_id."'";
        $del_cnn_res = mysqli_query($mysqli, $del_cnn_sql)
        or die(mysqli_error($mysqli));
        
        
        mysqli_free_result($del_cnn_res);
        
        $display_block = "<h1>Connection(s) Deleted</h1>
        <p>Would you like to
        <a href=\"".$_SERVER['PHP_SELF']."\">delete another</a>?</p>";
     
        mysqli_close($mysqli);
    }
    
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
