<?php
    include 'include.php';
    doDB();
    
    if (!$_POST) {
        $display_block = "<h1> Delete an Entry</h1>";
        $get_list_sql ="SELECT con_id, CONCAT_WS(', ', l_name, f_name) AS display_name
        FROM contacts ORDER BY l_name, f_name";
        $get_list_res = mysqli_query($mysqli, $get_list_sql)
        or die(mysqli_error($mysqli));
        if (mysqli_num_rows($get_list_res) < 1) {
            $display_block .= "<p><em>Sorry, no records to select!</em></p>";
            
        } else {
            $display_block .= "
            <form method=\"post\" action=\"".$_SERVER['PHP_SELF']."\">
            <p><label for=\"sel_id\">Delete a Record:</label><br/>
                <select id=\"sel_id\" name=\"sel_id\" required=\"required\">
                <option value=\"\">-- Select One --</option>";
            
            while ($recs = mysqli_fetch_array($get_list_res)) {
                $id = $recs['con_id'];
                $display_name = stripslashes($recs['display_name']);
                $display_block .=
                "<option value=\"".$id."\">".$display_name."</option>";
            }
            
            $display_block .= "
            </select>
            <button type=\"submit\" name=\"submit\"
            value=\"view\">Delete Selected Entry</button>
            </form>";
        }
        mysqli_free_result($get_list_res);
        
    } else if ($_POST) {
        //check for required fields
        if ($_POST['sel_id'] == "") {
            header("Location: delcontact.php");
        }
        $safe_id = mysqli_real_escape_string($mysqli, $_POST['sel_id']);
        
        //issue queries
        $del_entry_sql = "DELETE FROM contacts WHERE con_id = '".$safe_id."'";
        $del_entry_res = mysqli_query($mysqli, $del_entry_sql)
        or die(mysqli_error($mysqli));
        
        
        mysqli_close($mysqli);
        
        $display_block = "<h1>Record(s) Deleted</h1>
        <p>Would you like to
        <a href=\"".$_SERVER['PHP_SELF']."\">delete another</a>?</p>";
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
