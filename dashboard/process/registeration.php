<?php
	//include('checkSession.php');

    if(isset($_POST['g-recaptcha-response'])){
          $captcha=$_POST['g-recaptcha-response'];
        }

    if(!$captcha){
		// What happens when the CAPTCHA was entered incorrectly
		echo '<script type="text/javascript">'
	   . 'window.location.href = "../register.php?flag=2";'
	   . '</script>';
        }

     $response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6Le4nggTAAAAAOsovoMzySXUKD7tZc99SW4e_e54&response=".$captcha."&remoteip=".$_SERVER['REMOTE_ADDR']);

	if ($response.success==false) 
	{
		// What happens when the CAPTCHA was entered incorrectly
		echo '<script type="text/javascript">'
	   . 'window.location.href = "../register.php?flag=2";'
	   . '</script>';
	}
	else
	{	
		$number = $_POST['number'];
		$name = $_POST['name'];
		$company = $_POST['company'];
		$email = $_POST['email'];
		$password = $_POST['password'];
        $password2 = $_POST['password2'];
        $address = $_POST['address'];
        
        $textToStore = nl2br(htmlentities($address, ENT_QUOTES, 'UTF-8'));
        
        $avatar = "/assets/images/avatars/avatar11_big.png";
        
        if($password != $password2)//check password recheck
		{		
			echo '<script type="text/javascript">'
				   . 'window.location.href = "../register.php?flag=3";'
				   . '</script>';
		}//end of if
		
		include("../requiredfiles/mysqlConnect.php");
		
		$query = "SELECT email FROM client";
		$result = mysql_query($query) or die('Query failed: ' . mysql_error());
		$num_results = mysql_num_rows($result);
	
		$flag = false;
		
        
		for($i=0; $i<$num_results; $i++)//check if the email is already in use
		{
			$row = mysql_fetch_array($result);
			if(strcmp($row['email'], $email) == 0)
			 {
				$flag = true;
				break;
			 }//end of if
		}//end of while
		
		if($flag == true)//if the email is indeed in use
		{		
			echo '<script type="text/javascript">'
				   . 'window.location.href = "../register.php?flag=1";'
				   . '</script>';
		}//end of if
		if($flag == false)//if the info is unique
		{
            
            $escapedPW = mysql_real_escape_string($password);

            # generate a random salt to use for this account
            $salt = bin2hex(mcrypt_create_iv(32, MCRYPT_DEV_URANDOM));

            $saltedPW =  $escapedPW . $salt;

            $hashedPW = hash('sha256', $saltedPW);
            
			//insert the employee data in DB
			$query = "INSERT INTO `client`(`name`, `company`, `email`, `password`, `joindate`, `contactno`, `address`, `img_loc`, `activated`, `salt`) VALUES ('$name','$company','$email','$hashedPW',NOW(),'$number','$textToStore','$avatar','0','$salt')";
            
			mysql_query($query) or die('Query failed: ' . mysql_error());
            
            $query = "SELECT joindate FROM client where email = '$email'";
		    $result = mysql_query($query) or die('Query failed: ' . mysql_error());
            $row = mysql_fetch_row($result);
            
            echo $row[0];
            
            $code = hash('sha256', $row[0]);
?>

<script>

var xmlhttp;
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.open("POST","../requiredfiles/sendRegisterationEmail.php?id=<?php echo $code; ?>&to=<?php echo $email; ?>",true);
xmlhttp.send();

</script>

<?php
            echo '<script type="text/javascript">'
				   . 'window.location.href = "../register.php?flag=4";'
				   . '</script>';
            
            
		}//end of if
		
		mysql_close($db);
		
	}//end of CAPTCHA check else
?>