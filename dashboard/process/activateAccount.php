<?php


	$code = $_GET['activationcode'];
    $id = $_GET['id'];

	include("../requiredfiles/mysqlConnect.php");
            
    $query = "SELECT joindate FROM client where email = '$id'";
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());
    $row = mysql_fetch_row($result);
            
    $code2 = hash('sha256', $row[0]);
	
    echo $code2."<br />".$code;

    if($code == $code2)
    {
	   //activate account via eid
        $query = "UPDATE client SET activated = '1' WHERE email = '$id'";
        mysql_query($query) or die('Query failed: ' . mysql_error());
        
        echo '<script type="text/javascript">'
				. 'window.location.href = "../index.php?flag=1";'
				. '</script>';
    }
	
	mysql_close($db);
?>
