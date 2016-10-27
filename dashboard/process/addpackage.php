<?php
	include("../requiredfiles/header.php");
		
	$name = $_POST['name'];
	$platform = $_POST['platform'];
	$devices = $_POST['devices'];
	$testing = $_POST['testing'];
	$hours = $_POST['hours'];
	$testplans = $_POST['testplans'];
    $verifications = $_POST['verifications'];
	$commu = $_POST['commu'];
	$reporting = $_POST['reporting'];
	$lead = $_POST['lead'];
	$extradevices = $_POST['extradevices'];
    $extraverify = $_POST['extraverify'];
    $monthly = $_POST['monthly'];
    $amount = $_POST['amount'];
	
foreach ($platform as $color){
    $stringplatform = $stringplatform.",".$color;
}

foreach ($testing as $color){
    $stringtesting = $stringtesting.",".$color;
}

foreach ($commu as $color){
    $stringcommu = $stringcommu.",".$color;
}

foreach ($reporting as $color){
    $stringreporting = $stringreporting.",".$color;
}


	include("../requiredfiles/mysqlConnect.php");
	
	if ($name == "" || $platform == "" || $devices == "" || $testing == "" || $hours == "")	//check for empty fields
	{
		echo '<script type="text/javascript">'
	   . 'window.location.href = "../createpackage.php?flag=1";'
	   . '</script>';
	}//end of if
	else
	{
		//check for duplicates
		$query = "SELECT * FROM packages";
		$result = mysql_query($query) or die('Query failed: ' . mysql_error());
		$num_results = mysql_num_rows($result);	
		$row = NULL;
		$bInsertCheck = 1;
		
		for($i = $num_results; $i > 0 ; $i--)
		{
			 $row = mysql_fetch_array($result);
			 
			 if($row['name'] == $name)
			 {
				 echo '<script type="text/javascript">'
			   . 'window.location.href = "../createpackage.php?flag=2";'
			   . '</script>';
			   
			   $bInsertCheck = 0;
			 }//end of if
		}//end of for
		
		if($bInsertCheck == 1)
		{
			$query = "INSERT INTO `packages`(`name`, `platform`, `noofdevices`, `hours`, `testplans`, `communication`, `reportingtool`, ` verificationcycle`, `addlead`, `extradevices`, `extraverification`, `monthly`, `testingtypes`, `amount`) VALUES ('$name','$stringplatform','$devices','$hours','$testplans','$stringcommu','$stringreporting','$verifications','$lead','$extradevices','$extraverify','$monthly','$stringtesting','$amount')";
			mysql_query($query) or die('Query failed: ' . mysql_error());
			
			echo '<script type="text/javascript">'
		   . 'window.location.href = "../createpackage.php?flag=3";'
		   . '</script>';
		}//end of if
	}//end of outer else
	
	mysql_close($db);
?>