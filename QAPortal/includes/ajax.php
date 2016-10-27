<?php

$func= $_GET['func']?$_GET['func']:$_POST['func'];

include("mysqlConnect.php");

// using "+ INTERVAL 5 HOUR" with each now() function to overcome the timezone difference.

$slta="7LjxAZys50BM6Ve3";
// UPDATE employee SET Password = MD5(CONCAT(Password, "7LjxAZys50BM6Ve3"))

////////////////////////////////////////// login//////////////////////////////////

if($func=="login")
{
	
	$users = $_REQUEST['user'];//isset($_REQUEST['user']
	$pass = $_REQUEST['pass'];//isset($_REQUEST['pass'])
	$loggedin = $_REQUEST['loggedin'];
	$query=("SELECT * FROM employee where Email='$users' AND Password='".mysqli_real_escape_string($db,MD5($pass.$slta))."' and active='1'");
	$result = mysqli_query($db,$query);
	$rowCheck = mysqli_num_rows($result);	
	//echo $query;
	//echo mysqli_num_rows($result);
	if(mysqli_num_rows($result) > 0)
			{
			  while($row = mysqli_fetch_array($result,MYSQLI_BOTH))
			  {	
			    session_start();
			    //echo "checking rows"; 
				$_SESSION['email']=$row['Email'];			
				$_SESSION['username'] = $row['Name'];
				$_SESSION['designation'] = $row['Designation'];
				$_SESSION['team'] = $row['Team'];
				$_SESSION['company'] = $row['company'];
				$_SESSION['eid'] = $row['EID'];
				$_SESSION['admin'] = $row['admin'];
				$_SESSION['avatar'] = $row['AvatarPath'];

				if($loggedin=="true")
				{
					$_SESSION['loggedin']=$loggedin;
				}

				  echo "dashboard.php";
			   }
			   $query2=("SELECT * FROM company where CompanyID='".$_SESSION['company']."'");
	              $result2 = mysqli_query($db,$query2);

	              if(mysqli_num_rows($result2) > 0)
	              {
	                $row2 = mysqli_fetch_assoc($result2);
	              }
	              $_SESSION['companyname']=$row2['CompanyName'];

		  	}
			// that seems to be caused by internet connection, as i was unable to open any other webpage as well, we'll try to figure out by getting a better wifi connectivity there.
			if($rowCheck == 0)
			{
				
			  echo "Invalid Username/Password";
			 }
			 
	
}

////////////////////////////////////////// Direct login //////////////////////////////////

if($func=="directLogin")
{
	
	$pin = $_REQUEST['pin'];//isset($_REQUEST['user']
	$query=("SELECT * FROM employee where PIN='$pin' and active='1'");
	$result = mysqli_query($db,$query);
	$rowCheck = mysqli_num_rows($result);	
	//echo $query;
	//echo mysqli_num_rows($result);
	if(mysqli_num_rows($result) > 0)
			{
			  while($row = mysqli_fetch_array($result,MYSQLI_BOTH))
			  {	
			    session_start();
			    //echo "checking rows"; 
				$_SESSION['email']=$row['Email'];			
				$_SESSION['username'] = $row['Name'];
				$_SESSION['designation'] = $row['Designation'];
				$_SESSION['team'] = $row['Team'];
				$_SESSION['company'] = $row['company'];
				$_SESSION['eid'] = $row['EID'];
				$_SESSION['admin'] = $row['admin'];
				$_SESSION['avatar'] = $row['AvatarPath'];
				  //echo "dashboard.php";

				  $query23=("SELECT * FROM devicelist where checkerID='".$_SESSION['eid']."'");
         
				   	$result23 = mysqli_query($db,$query23);
					if(mysqli_num_rows($result23) > 0)
				     {
				       echo '<div id="numberofrows" style="display:none;">'.mysqli_num_rows($result23).'</div>';
				       while($row23 = mysqli_fetch_array($result23,MYSQLI_BOTH))
				       { 
				          $timestamp = strtotime($row23['LastUpdate']);
				           echo '<li id="device'.$row23['DeviceID'].'" class="" onclick="clearonedevice('.$row23['DeviceID'].')" ';
				           if ($row23['OSType']=='iOS')
				           {
				             echo 'style="background-color:#424F63;"';
				           }
				           echo '><span class="span-check" >
				     <label for="task-2" class="">'.$row23['name'].' - v'.$row23['OSVersion'].'</label>
				     </span>
				     
				     <div class="todo-date">
				       <div class="completed-date"> '.$row23['OSType'].'</div>
				       <div class="due-date">'.date('g:i a', $timestamp).' - '.date('l, F d, Y', $timestamp).'</div>
				     </div>
				     </li>';
				        }           
				       }
			   }
			   $query2=("SELECT * FROM company where CompanyID='".$_SESSION['company']."'");
	              $result2 = mysqli_query($db,$query2);

	              if(mysqli_num_rows($result2) > 0)
	              {
	                $row2 = mysqli_fetch_assoc($result2);
	              }
	              $_SESSION['companyname']=$row2['CompanyName'];

		  	}
			
			if($rowCheck == 0)
			{
				
			  echo "Invalid PIN";
			 }
			 
	
}

////////////////////////////////////////// check if the company exists //////////////////////////////////

if($func=="company_check")
{
	
	$companyname = $_REQUEST['companyname'];//isset($_REQUEST['user']
	$pass = $_REQUEST['pass'];//isset($_REQUEST['pass'])
	$query=("SELECT * FROM company where CompanyName='$companyname'");
	$result = mysqli_query($db,$query);
	//echo $query;
	//echo mysqli_num_rows($result);
	if(mysqli_num_rows($result) > 0)
			{
			  while($row = mysqli_fetch_array($result,MYSQLI_BOTH))
			  {	
			    session_start();
			    //echo "checking rows"; 
				$_SESSION['companyname']=$row['CompanyName'];
				$_SESSION['company']=$row['CompanyID'];

				$query2=("SELECT * FROM employee where company='".$row['CompanyID']."' and admin='1'");
				  $result2 = mysqli_query($db,$query2);

				  if(mysqli_num_rows($result2) > 0)
				  {
				    $row2 = mysqli_fetch_assoc($result2);
				  }
				  
				if($row2['active']=='0')
				{

					echo "inactiveCom";
				}
				else
				{
					echo "gotosignup";	
				}
				  
			   }

		  	}
			else
			{
				session_start();
			    //echo "checking rows"; 
				$_SESSION['companyname']="newCompany";
				//$_SESSION['companyid']=$row['CompanyID'];		
				echo "nocompany";
			}
			
			 
	
}

////////////////////////////////////////////// destroy all sessions

if($func=="destroySess")
{
	session_start();
	if(isset($_SESSION['email']))
	{
    	$_SESSION['email']="";			
		$_SESSION['designation'] = "";
		$_SESSION['team'] = "";
		$_SESSION['company'] = "";
		session_destroy();   
    	session_unset();

	}
}

if($func=="destroySess2")
{
	session_start();
	if(isset($_SESSION['email']) and isset($_SESSION['loggedin']))
	{
		if ($_SESSION['loggedin']=="true")
		{
			echo "dashboard.php";
		}	
		else
		{
			$_SESSION['email']="";			
			$_SESSION['designation'] = "";
			$_SESSION['team'] = "";
			$_SESSION['company'] = "";
			$_SESSION['loggedin']=="";
			session_destroy();   
	    	session_unset();
	    	echo "index.php";
		}
	}
	else
	{
		echo "dont refresh";
	}
}

////////////////////////////////////////////// check session

if($func=="checkSession")
{
	session_start();
	$sessid = $_REQUEST['sessid'];

	// first of all check if user is logged in, if not logged in exit
	if(!isset($_SESSION['email']))
	{
    	echo "loggedOut";
    	exit;
	}	
	if($sessid=='1')
	{
		if($_SESSION['admin']!='1' and $_SESSION['admin']!='2')
		{
	    	echo "notAdmin";
		}
	}
	
	
}

////////////////////////////////////////// checkout

if($func=="checkout")
{
	session_start();
	$did = $_REQUEST['did'];
	$username = $_SESSION['username'];
	$eid = $_SESSION['eid'];
	
	$query=("UPDATE devicelist SET checkedBy='$username',checkerID='$eid',LastUpdate=now() + INTERVAL 5 HOUR where DeviceID='$did'");

	//$result = mysqli_query($db,$query);

	$query2 = "INSERT INTO checkoutLog (DeviceID,ownerId ,checkOut,checked) VALUES ('$did','$eid', now() + INTERVAL 5 HOUR, '1')";

	mysqli_query($db,$query2);

	// $query3 = "INSERT INTO recentActivity (activityName,time,activityDescription) VALUES ('Device Checkout', now() + INTERVAL 5 HOUR, '')";

	// mysqli_query($db,$query3);

	if(mysqli_query($db,$query))
 	{
	 	echo $_SESSION['username'];
	}
	else
	{
		 echo "Error";
	}
}

////////////////////////////////////////// Direct checkout

if($func=="directcheckout")
{
	$did = $_REQUEST['did'];
	session_start();
	$username = $_SESSION['username'];
	$eid = $_SESSION['eid'];
	$query=("SELECT * FROM devicelist where DeviceID='$did'");
	$result = mysqli_query($db,$query);

              // if(mysqli_num_rows($result) > 0)
              // {
              //   $row = mysqli_fetch_assoc($result);
              // }

    if(mysqli_num_rows($result) > 0)
    {
    	$row = mysqli_fetch_assoc($result);
    	// if device already checked out - send error
	    if($row['checkedBy']!=null )
	    {
	    	if($row['checkerID']!=$eid)
	    	{
	    		echo "Already";
	    	}
	    	else
	    	{
	    		echo "You";
	    	}

	    }
	    else
	    {
			
			$query3=("UPDATE devicelist SET checkedBy='$username',checkerID='$eid',LastUpdate=now() + INTERVAL 5 HOUR where DeviceID='$did'");

			//$result = mysqli_query($db,$query);

			$query33 = "INSERT INTO checkoutLog (DeviceID,ownerId ,checkOut,checked) VALUES ('$did','$eid', now() + INTERVAL 5 HOUR, '1')";

			mysqli_query($db,$query33);

			if(mysqli_query($db,$query3))
		 	{
			 	//echo "Checked Out-".$row['name'];
			 	// update the div instead of notifications for checked out
			          //$timestamp = strtotime($row2['LastUpdate']);
			           echo '<li id="device'.$row['DeviceID'].'" class="" onclick="clearonedevice('.$row['DeviceID'].')" ';
			           if ($row['OSType']=='iOS')
			           {
			             echo 'style="background-color:#424F63;"';
			           }
			           echo '><span class="span-check" >
			     <label for="task-2" class="">'.$row['name'].' - v'.$row['OSVersion'].'</label>
			     </span>
			     
			     
			     </li>';

			     // <div class="todo-date">
			     //   <div class="completed-date"> '.$row2['OSType'].'</div>
			     //   <div class="due-date">'.date('g:i a', $timestamp).' - '.date('l, F d, Y', $timestamp).'</div>
			     // </div>
			}
			else
			{
				 echo "Error";
			}
	    }
    }
    else
    {
    	echo "Device Does not Exist";
    }
}

////////////////////////////////////////// Direct Clear

if($func=="directclear")
{
	$did = $_REQUEST['did'];
	session_start();
	$username = $_SESSION['username'];
	$eid = $_SESSION['eid'];
	$query=("SELECT * FROM devicelist where DeviceID='$did'");
	$result = mysqli_query($db,$query);

    if(mysqli_num_rows($result) > 0)
    {
    	$row = mysqli_fetch_assoc($result);
    	// if device already checked out - send error
	    if($row['checkedBy']==null && $row['checkerID']=='0')
	    {
	    	echo "Already Cleared";
	    }
	    // if device checked out by the same user - clear device
	    else if($row['checkerID']==$eid)
	    {
	    	$query2=("UPDATE devicelist SET checkedBy='',checkerID='0',LastUpdate=now() + INTERVAL 5 HOUR where DeviceID='$did'");

			$query22 = ("UPDATE checkoutLog SET checkIn=now() + INTERVAL 5 HOUR,checked='0' where DeviceID='$did' and checked='1'");

			mysqli_query($db,$query2);

			if(mysqli_query($db,$query22))
		 	{
				 echo "Device Cleared-".$row['name'];
			}
			else
			{
				 echo "Error";
			}
	    }
	    else if($row['checkerID']!=$eid)
	    {
	    	echo "Another user";
	    }
	    // else check out the device
	    else
	    {
			
			$query3=("UPDATE devicelist SET checkedBy='$username',checkerID='$eid',LastUpdate=now() + INTERVAL 5 HOUR where DeviceID='$did'");

			//$result = mysqli_query($db,$query);

			$query33 = "INSERT INTO checkoutLog (DeviceID,ownerId ,checkOut,checked) VALUES ('$did','$eid', now() + INTERVAL 5 HOUR, '1')";

			mysqli_query($db,$query33);

			// $query3 = "INSERT INTO recentActivity (activityName,time,activityDescription) VALUES ('Device Checkout', now() + INTERVAL 5 HOUR, '')";

			// mysqli_query($db,$query3);

			if(mysqli_query($db,$query3))
		 	{
			 	//echo $_SESSION['username'];
			 	echo "Checked Out";
			}
			else
			{
				 echo "Error";
			}
	    }
    }
    else
    {
    	echo "Device Does not Exist";
    }
}

////////////////////////////////////////// Force checkout

if($func=="forcecheckout")
{
	$did = $_REQUEST['did'];
	session_start();
	$username = $_SESSION['username'];
	$eid = $_SESSION['eid'];
	$user = $_SESSION['username'];
	$query=("SELECT * FROM devicelist where DeviceID='$did'");
	$result = mysqli_query($db,$query);

    if(mysqli_num_rows($result) > 0)
    {
    	$row = mysqli_fetch_assoc($result);
    	$getmail=("SELECT * FROM employee where EID='".$row['checkerID']."'");
		$getmail_result = mysqli_query($db,$getmail);
		 
    	// If the device is checkedout by another user
    	if($row['checkerID']!=$eid)
    	{
    		// this will clear the existing user
    		$query2=("UPDATE devicelist SET checkedBy='',checkerID='0',LastUpdate=now() + INTERVAL 5 HOUR where DeviceID='$did'");

			$query22 = ("UPDATE checkoutLog SET checkIn=now() + INTERVAL 5 HOUR,checked='0' where DeviceID='$did' and checked='1'");

			mysqli_query($db,$query2);

			if(mysqli_query($db,$query22))
		 	{
		 		// this will checkout the device
		 		$query3=("UPDATE devicelist SET checkedBy='$username',checkerID='$eid',LastUpdate=now() + INTERVAL 5 HOUR where DeviceID='$did'");

				$query33 = "INSERT INTO checkoutLog (DeviceID,ownerId ,checkOut,checked) VALUES ('$did','$eid', now() + INTERVAL 5 HOUR, '1')";

				mysqli_query($db,$query33);

				if(mysqli_query($db,$query3))
			 	{
				 	echo "Checked Out-".$row['name'];

				 	// send email to previous owner about the change of #notification #mail to owner 

				 	if(mysqli_num_rows($getmail_result) > 0)
					 {
					 	$getmail_row = mysqli_fetch_assoc($getmail_result);
					 	$to = $getmail_row['Email'];// this is receiver's address
						$from = "murtaza+portal@werplay.com"; // this is the sender's addresss
						$name = "MSKH";
						
						$subject = "Notification from device portal";
						
						$message = "Hello, ".$row['checkedBy']."! <br>PENALTYY !!<br>You forgot to clear - ".$row['name'].", kindly let us know what happened? :) <br>Now, ".$user." has checked it out.<br>P.S. Please let us know if you still have the device or in case of concerns.<br><br> Portal Moderators: murtaza+portal@werplay.com - khaula+portal@werplay.com";

						$headers = "From:" . $from."\r\n";
						$headers .= "cc: murtaza+portal@werplay.com, khaula+portal@werplay.com\r\n";
						$headers .= "Return-Path: murtaza+portal@werplay.com\r\n";
						$headers .= "MIME-Version: 1.0\r\n";
						$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
						mail($to,$subject,$message,$headers);
					 }
					  // if email is not gotten by query, mail would not be sent. this prevents an error.
				 	
				}
				else
				{
					 echo "Error";
				}

			}
			else
			{
				 echo "Error";
			}
    	}
    	// if the checkerID matches
	    else
	    {
			// not decided yet, this case might never happen as the force checkout is only displayed if another user has checked out the device.
			
	    }
    }
    else
    {
    	echo "Device Does not Exist";
    }
}

////////////////////////////////////////// device on charging

if($func=="charging")
{
	session_start();
	$did = $_REQUEST['did'];
	$username = $_SESSION['username'];
	
	$query=("UPDATE devicelist SET checkedBy='Charging',checkerID='0',LastUpdate=now()  + INTERVAL 5 HOUR where DeviceID='$did'");

	//$result = mysqli_query($db,$query);

	$query2 = ("UPDATE checkoutLog SET checkIn=now() + INTERVAL 5 HOUR,checked='0' where DeviceID='$did' and checked='1'");

	mysqli_query($db,$query2);


	if(mysqli_query($db,$query))
 	{
	 echo $_SESSION['username'];
	}
	else
	{
		 echo "Error";
	}
			 
	
}

////////////////////////////////////////// show all devices on directLogin

if($func=="directShowDevices")
{
	$query2=("SELECT * FROM devicelist where checkerID='".$_SESSION['eid']."'");
         
   	$result2 = mysqli_query($db,$query2);
	if(mysqli_num_rows($result2) > 0)
     {
       echo '<div id="numberofrows" style="display:none;">'.mysqli_num_rows($result2).'</div>';
       while($row2 = mysqli_fetch_array($result2,MYSQLI_BOTH))
       { 
          $timestamp = strtotime($row2['LastUpdate']);
           echo '<li id="device'.$row2['DeviceID'].'" class="" onclick="clearonedevice('.$row2['DeviceID'].')" ';
           if ($row2['OSType']=='iOS')
           {
             echo 'style="background-color:#424F63;"';
           }
           echo '><span class="span-check" >
     <label for="task-2" class="">'.$row2['name'].' - v'.$row2['OSVersion'].'</label>
     </span>
     
     <div class="todo-date">
       <div class="completed-date"> '.$row2['OSType'].'</div>
       <div class="due-date">'.date('g:i a', $timestamp).' - '.date('l, F d, Y', $timestamp).'</div>
     </div>
     </li>';
        }           
       }

}

////////////////////////////////////////// clear single device

if($func=="cleardevice")
{
	//session_start();
	$did = $_REQUEST['did'];
	//$username = $_SESSION['username'];
	
	$query=("UPDATE devicelist SET checkedBy='',checkerID='0',LastUpdate=now() + INTERVAL 5 HOUR where DeviceID='$did'");

	//$result = mysqli_query($db,$query);

	$query2 = ("UPDATE checkoutLog SET checkIn=now() + INTERVAL 5 HOUR,checked='0' where DeviceID='$did' and checked='1'");

	mysqli_query($db,$query2);

	if(mysqli_query($db,$query))
 	{
		 echo "";
	}
	else
	{
		 echo "Error";
	}
			 
	
}

////////////////////////////////////////// clear all devices checkedout by user

if($func=="clearall")
{
	session_start();
	$username = $_SESSION['username'];
	$eid = $_SESSION['eid'];
	//$username = $_SESSION['username'];
	
	$query=("UPDATE devicelist SET checkedBy='',checkerID='0' where checkerID='$eid'");
	//echo $query;

	//$result = mysqli_query($db,$query);

	$query2 = ("UPDATE checkoutLog SET checkIn=now()  + INTERVAL 5 HOUR,checked='0' where ownerId='$eid' and checked='1'");

	mysqli_query($db,$query2);

	if(mysqli_query($db,$query))
 	{
		 echo "";
	}
	else
	{
		 echo "Error";
	}
			 
	
}

////////////////////////////////////////// redirect to editDevice Page

if($func=="editDevice")
{
	session_start();
	$did = $_REQUEST['did'];
	$username = $_SESSION['username'];

	$query=("SELECT * FROM devicelist where company='".$_SESSION['company']."'");
              $result = mysqli_query($db,$query);

              if(mysqli_num_rows($result) > 0)
              {
                $row = mysqli_fetch_assoc($result);
              }

	if($_SESSION['admin']=='2' or ($_SESSION['admin']=='1' and $_SESSION['company']==$row['company']))
	{
		$_SESSION['editdeviceGo']=$did;
	}
	else
	{
		echo "unauthorized";
	}
			 
	
}

////////////////////////////////////////// redirect to editUser Page

if($func=="editUser")
{
	session_start();
	$eid = $_REQUEST['eid'];
	$username = $_SESSION['username'];

	$query=("SELECT * FROM employee where company='".$_SESSION['company']."'");
              $result = mysqli_query($db,$query);

              if(mysqli_num_rows($result) > 0)
              {
                $row = mysqli_fetch_assoc($result);
              }

	if($_SESSION['admin']=='2' or ($_SESSION['admin']=='1' and $_SESSION['company']==$row['company']))
	{
		$_SESSION['edituserGo']=$eid;
		//echo $_SESSION['edituserGo'];
	}
	else
	{
		echo "unauthorized";
	}
			 
	
}

////////////////////////////////////////// check if the mail already exists//////////////////////////////////

if($func=="existingMail")
{
	
	$email = $_REQUEST['email'];//isset($_REQUEST['user']
	
	$query=("SELECT * FROM employee where Email='$email'");
	$result = mysqli_query($db,$query);
	$rowCheck = mysqli_num_rows($result);	
	//echo $query;
	//echo mysqli_num_rows($result);
	if(mysqli_num_rows($result) > 0)
			{
				echo "fail";
		  	}
		  	else
		  	{
		  		echo "success";
		  	}
			 
	
}

////////////////////////////////////////// check if the company name already exists//////////////////////////////////

if($func=="existingCompany")
{
	
	$company = $_REQUEST['company'];//isset($_REQUEST['user']
	
	$query=("SELECT * FROM company where CompanyName='$company'");
	$result = mysqli_query($db,$query);
	$rowCheck = mysqli_num_rows($result);	
	//echo $query;
	//echo mysqli_num_rows($result);
	if(mysqli_num_rows($result) > 0)
			{
				echo "fail";
		  	}
		  	else
		  	{
		  		echo "success";
		  	}
			 
	
}

////////////////////////////////////////// sign up for the main user / manager/admin of their company
if($func=="signupmain")
{
	

	$fullname=$_GET['fullname'];   
	$employee=$_GET['employee'];     
	$email=$_GET['email'];  
	$persoemail=$_GET['persoemail']; 
	$birthdate=$_GET['birthdate'];
	$desig=$_GET['desig'];     
	$company=$_GET['company'];  

	$password=$_GET['password'];
 	
 	$query1 = "INSERT INTO company (CompanyName) VALUES ('$company')";
 	mysqli_query($db,$query1);

	$query2=("SELECT * FROM company where CompanyName='$company'");
	  $result2 = mysqli_query($db,$query2);

	  if(mysqli_num_rows($result2) > 0)
	  {
	    $row = mysqli_fetch_assoc($result2);
	  }


	 $query = "INSERT INTO employee (EmployeeID ,Name ,Email ,Password,DateofBirth, PersonalEmail, Designation , company, admin,active,AvatarPath) VALUES ('$employee','$fullname', '$email', '".md5($password.$slta)."','$birthdate', '$persoemail','$desig','".$row['CompanyID']."','1','0','guy01.png')";
	 
	 //$result = mysqli_query($db,$query);

	if(mysqli_query($db,$query))
 	{
		 echo "AdminSucccess";
		 $query3=("SELECT * FROM employee where company='".$row['CompanyID']."' and admin='1'  " );
		  $result3 = mysqli_query($db,$query3);

		  if(mysqli_num_rows($result3) > 0)
		  {
		    $row3 = mysqli_fetch_assoc($result3);
		  }

		  $query4 = "UPDATE company SET AdminID='".$row3['EID']."' where CompanyID='".$row['CompanyID']."'";
		  mysqli_query($db,$query4);
		 // sending email to site admin to verify account
		 if(isset($email)){
		 	// sending registration mail
			$to = "murtaza@werplay.com"; // this is receiver's address
			$from = "test@test.com"; // this is the sender's address
			$name = "tester";
			
			$subject = "Please activate the account for the following user";
			
			$message = "Please verify and activate:" . "\n\n Fullname:" . $fullname. "\n\n employee:" . $employee. "\n\n Company Email:" . $email. "\n\n Personal Email:" . $persoemail. "\n\n birthdate:" . $birthdate. "\n\n desig:" . $desig. "\n\n company:" . $company. "\n\n password:" . $password;

			$messagemain = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> <html xmlns="http://www.w3.org/1999/xhtml"> <head> <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> <style type="text/css"> #outlook a{ padding:0; } body{ width:100% !important; } body{ margin:0; padding:0; } img{ border:none; outline:none; text-decoration:none; } body{ background-position:left top; background-repeat:repeat; background-color:#404040; } #container{ background-position:left top; background-repeat:repeat; background-color:#404040; height:100%; margin:0; padding:0; width:100%; } .title{ color:#FFFFFF; font-family:Arial; font-size:24px; font-weight:bold; line-height:100%; } .subTitle{ color:#DDDDDD; font-family:Arial; font-size:18px; font-weight:bold; line-height:100%; } .registerButton,.registerButton a:link,.registerButton a:visited{ color:#FFFFFF; font-family:Arial; font-size:14px; line-height:100%; text-align:center; text-decoration:none; } .registerButton.header{ background-color:#94332C; width:25%; } .registerButton.content{ background-color:#252525; width:38%; } #emailHeading{ color:#FFFFFF; font-family:Arial; font-size:60px; font-weight:bold; letter-spacing:-3px; line-height:75%; } #emailHeading a:link,#emailHeading a:visited{ color:#FFFFFF; font-weight:bold; text-decoration:underline; } #location{ color:#DDDDDD; font-family:Arial; font-size:43px; line-height:100%; } #headerImage{ border:5px solid #332A27; max-width:590px; }

		 #emailContent{ color:#DDDDDD; font-family:Arial; font-size:18px; line-height:150%; }

		 #emailContent a:link,#emailContent a:visited{ color:#DDDDDD; font-weight:normal; text-decoration:underline; } #utility{ color:#DDDDDD; font-family:Arial; font-size:12px; line-height:150%; } #utility a:link,#utility a:visited{ color:#DDDDDD; font-weight:bold; text-decoration:none; } #utilityLeft,#utilityCenter,#utilityRight{ border-top:2px solid #8A8683; } #templateFooter{ color:#B1B1B1; font-family:Arial; font-size:10px; font-weight:bold; line-height:150%; } #templateFooter a:link,#templateFooter a:visited{ color:#8C8C8C; font-weight:bold; text-decoration:underline; } </style></head> <body> <center> <table bgcolor="#404040" border="0" cellpadding="0" cellspacing="0" style="color:white;" height="100%" width="100%" id="container"> <tr> <td align="center" valign="top"> <table border="0" cellpadding="0" cellspacing="0" width="600" id="templateBody"> <tr> <td align="left" valign="top" id="location"> <br> <div>Account has been created with the following credentials</div> </td> </tr>

		 <tr> <td align="center" valign="top"> <table border="0" cellpadding="0" cellspacing="0" width="600"> <tr> <td width="100"> <br> </td> <td align="left" valign="top" width="400"> <br> <div id="emailContent" mc:edit="main"> '.$message.' </div> <br> <div style="width:38%" class="registerButton content"> <br> <div mc:edit="register_button2"><a href="#">Goto Dashboard</a></div> <br> </div> <br> <br> </td> <td width="100"> <br> </td> </tr> </table> </td> </tr> </table> <table border="0" cellpadding="0" cellspacing="0" width="600" id="templateFooter"> <tr> <td align="left" valign="top"> <img src="http://www.werplay.com/newPortal/assets/images/logo/logo-white.png" alt="logo"></a> </td> <td> <a href="http://www.werplay.com/" >we.R.play</a> </td> </tr> </table> </td> </tr> </table> </center> </body> </html>';

			$headers = "From:" . $from."\r\n";
			$headers .= "Return-Path: murtaza@werplay.com\r\n";
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
			mail($to,$subject,$messagemain,$headers);
			
			}
    
		}
	else
	{
		 echo "AdminFail";
	}
		
	
	
}

////////////////////////////////////////// sign up for the user of their company
if($func=="signupuser")
{
	
	session_start();
	$fullname=$_GET['fullname'];   
	$employee=$_GET['employee'];     
	$email=$_GET['email'];  
	$persoemail=$_GET['persoemail']; 
	$birthdate=$_GET['birthdate'];
	$team=$_GET['team'];
	$desig=$_GET['desig'];     

	$password=$_GET['password'];
 
	 $query = "INSERT INTO employee (EmployeeID ,Name ,Email ,Password,DateofBirth, PersonalEmail, Designation , company, admin,active) VALUES ('$employee','$fullname', '$email', '".md5($password.$slta)."','$birthdate', '$persoemail','$desig','".$_SESSION['company']."','0','1')";
	 
	 //echo $query;
	 //$result = mysqli_query($db,$query);

	if(mysqli_query($db,$query))
 	{
		 echo "UserSucccess";
	}
	else
	{
		 echo "UserFail";
	}

	// echo $_SESSION['company'];
		
	
	
}

////////////////////////////////////////// update profile of any user
if($func=="updateuser")
{
	
	session_start();
	$eid = $_SESSION['eid'];
	$fullname=$_GET['fullname'];   
	$employee=$_GET['employee'];     
	$persoemail=$_GET['persoemail']; 
	$birthdate=$_GET['birthdate'];
	$desig=$_GET['desig'];     
	$team=$_GET['team'];     
	$password=$_GET['password'];
	$paschng=$_GET['paschng'];
	$pin=$_GET['pin'];
	$pinchng=$_GET['pinchng'];

	 $query = "UPDATE employee SET Name='$fullname', EmployeeID='$employee', PersonalEmail='$persoemail', DateofBirth='$birthdate', Designation='$desig', Team='$team' where EID='$eid'";
	 
	 //echo $query;
	 //echo $query;
	 //$result = mysqli_query($db,$query);

	if(mysqli_query($db,$query))
 	{
		 echo "UserSucccess";
	}
	else
	{
		 echo "UserFail";
	}

	if($paschng=="1")
	 {
	 	$query2 = "UPDATE employee SET Password='".md5($password.$slta)."' where EID='$eid'";
	 	mysqli_query($db,$query2);
	 	// echo $query2;
	 	// echo "password changed";
	 	// echo("Error description: " . mysqli_error($db));
	 }

	 if ($pinchng=="1")
	 {
	 	//$query2 = "UPDATE employee SET Password='".md5($password.$slta)."' where EID='$eid'";
	 	//mysqli_query($db,$query2);
	 	$query3 = "UPDATE employee SET PIN='$pin' where EID='$eid'";
	 	mysqli_query($db,$query3);
	 }
		
	
	
}

////////////////////////////////////////// Check if the pin already exists

if($func=="pincheck")
{
	
	$pin = $_REQUEST['pin'];//isset($_REQUEST['user']
	$query=("SELECT * FROM employee where PIN='$pin' and active='1'");
	$result = mysqli_query($db,$query);
	$rowCheck = mysqli_num_rows($result);	
	//echo $query;
	//echo mysqli_num_rows($result);
	if(mysqli_num_rows($result) > 0)
			{
			 	echo "Alraedy Exists";
		  	}
			 
	
}

////////////////////////////////////////// update profile of any user through admin page
if($func=="adminupdateUser")
{
	
	//session_start();
	//$eid = $_SESSION['eid'];
	$eid = $_GET['eid'];
	$fullname=$_GET['fullname'];   
	$employee=$_GET['employee'];     
	$persoemail=$_GET['persoemail']; 
	$birthdate=$_GET['birthdate'];
	$desig=$_GET['desig'];     
	$team=$_GET['team'];     
	$password=$_GET['password'];
	$paschng=$_GET['paschng'];

	 $query = "UPDATE employee SET Name='$fullname', EmployeeID='$employee', PersonalEmail='$persoemail', DateofBirth='$birthdate', Designation='$desig', Team='$team' where EID='$eid'";
	 
	 //echo $query;
	 //echo $query;
	 //$result = mysqli_query($db,$query);

	if(mysqli_query($db,$query))
 	{
		 echo "UserSucccess";
	}
	else
	{
		 echo "UserFail";
	}

	if($paschng=="1")
	 {
	 	$query2 = "UPDATE employee SET Password='".md5($password.$slta)."' where EID='$eid'";
	 	mysqli_query($db,$query2);
	 }
		
	
	
}

////////////////////////////////////////// deactive user

if($func=="deactivateUser")
{
	//session_start();
	$eid = $_REQUEST['eid'];
	//$username = $_SESSION['username'];
	
	$query=("UPDATE employee SET active='0'where EmployeeID='$eid'");

	if(mysqli_query($db,$query))
 	{
		 echo "";
	}
	else
	{
		 echo "Error";
	}
			 
	
}



////////////////////////////////////////// updateDevice data

if($func=="updateDevice")
{
	session_start();
	$did = $_REQUEST['did'];
	$devicename = $_REQUEST['devicename'];
	$deviceos = $_REQUEST['deviceos'];
	$osversion = $_REQUEST['osversion'];
	$resolution = $_REQUEST['resolution'];
	$vendor = $_REQUEST['vendor'];
	$priority = $_REQUEST['priority'];
	$imei = $_REQUEST['imei'];
	$udid = $_REQUEST['udid'];
	$deviceactive = $_REQUEST['deviceactive'];

	//$eid = $_SESSION['eid'];
	//echo "about to write:";
	$query=("UPDATE devicelist SET name='$devicename',OSType='$deviceos',OSVersion='$osversion',Resolution='$resolution',Vendor='$vendor',Priority='$priority',IMEI='$imei',DIDs='$udid',device_active='$deviceactive' where DeviceID='$did' ");

	//echo $query;
	//$result = mysqli_query($db,$query);

	if(mysqli_query($db,$query))
 	{
	 	echo "success";
	}
	else
	{
		 echo "Error";
		 //echo("Error description: " . mysqli_error($db));
	}
			 
	
}

////////////////////////////////////////// insert new device data

if($func=="addDevice")
{
	session_start();
	//$did = $_REQUEST['did'];
	//echo $_POST['devicename'];
	$devicename = $_REQUEST['devicename'];
	$deviceos = $_REQUEST['deviceos'];
	$osversion = $_REQUEST['osversion'];
	$resolution = $_REQUEST['resolution'];
	$vendor = $_REQUEST['vendor'];
	$priority = $_REQUEST['priority'];
	$imei = $_REQUEST['imei'];
	$udid = $_REQUEST['udid'];



	//$eid = $_SESSION['eid'];
	$query = "INSERT INTO devicelist (OSType ,OSVersion ,Resolution ,Vendor,Priority , name, DIDs, IMEI, company) VALUES ('$deviceos','$osversion', '$resolution', '$vendor','$priority', '$devicename','$udid','$imei','".$_SESSION['company']."')";
	//echo $query;
	

	//$result = mysqli_query($db,$query);

	if(mysqli_query($db,$query))
 	{
	 	echo "success";
	}
	else
	{
		 echo "Error";
		 //echo("Error description: " . mysqli_error($db));
	}
			 
	
}

////////////////////////////////////////// deactivate user

if($func=="deactivateUser")
{
	session_start();
	$eid = $_REQUEST['eid'];
	$state = $_REQUEST['state'];
	// $adminid = $_SESSION['eid']; // to save in activity table
	
	$query=("UPDATE employee SET active='$state' where EID='$eid'");


	// $query2 = "INSERT INTO checkoutLog (DeviceID,ownerId ,checkOut,checked) VALUES ('$did','$eid', now() + INTERVAL 5 HOUR, '1')";

	// mysqli_query($db,$query2);

	if(mysqli_query($db,$query))
 	{
	 	// echo $_SESSION['username'];
	 	echo "success";
	}
	else
	{
		 echo "Error";
	}
			 
	
}

////////////////////////////////////////// set session to view company table

if($func=="setCompanysession")
{
	session_start();
	$comId = $_REQUEST['comId'];

	$_SESSION['companyview']=$comId;

	echo "success";
}

////// send sample mail

if($func=="sendmail")
{
	$to = "murtaza@werplay.com"; // this is receiver's address
	$from = "test@test.com"; // this is the sender's address
	$name = "tester";
	
	$subject = "Please activate the account for the following user";
	
	$message = "Account has been created with the following credentials, please verify and activate:" . "\n\n Fullname:" . $fullname. "\n\n employee:" . $employee. "\n\n Company Email:" . $email. "\n\n Personal Email:" . $persoemail. "\n\n birthdate:" . $birthdate. "\n\n desig:" . $desig. "\n\n company:" . $company. "\n\n password:" . $password;

	$messagemain = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> <html xmlns="http://www.w3.org/1999/xhtml"> <head> <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> <style type="text/css"> #outlook a{ padding:0; } body{ width:100% !important; } body{ margin:0; padding:0; } img{ border:none; outline:none; text-decoration:none; } body{ background-position:left top; background-repeat:repeat; background-color:#404040; } #container{ background-position:left top; background-repeat:repeat; background-color:#404040; height:100%; margin:0; padding:0; width:100%; } .title{ color:#FFFFFF; font-family:Arial; font-size:24px; font-weight:bold; line-height:100%; } .subTitle{ color:#DDDDDD; font-family:Arial; font-size:18px; font-weight:bold; line-height:100%; } .registerButton,.registerButton a:link,.registerButton a:visited{ color:#FFFFFF; font-family:Arial; font-size:14px; line-height:100%; text-align:center; text-decoration:none; } .registerButton.header{ background-color:#94332C; width:25%; } .registerButton.content{ background-color:#252525; width:38%; } #emailHeading{ color:#FFFFFF; font-family:Arial; font-size:60px; font-weight:bold; letter-spacing:-3px; line-height:75%; } #emailHeading a:link,#emailHeading a:visited{ color:#FFFFFF; font-weight:bold; text-decoration:underline; } #location{ color:#DDDDDD; font-family:Arial; font-size:43px; line-height:100%; } #headerImage{ border:5px solid #332A27; max-width:590px; }

 #emailContent{ color:#DDDDDD; font-family:Arial; font-size:18px; line-height:150%; }

 #emailContent a:link,#emailContent a:visited{ color:#DDDDDD; font-weight:normal; text-decoration:underline; } #utility{ color:#DDDDDD; font-family:Arial; font-size:12px; line-height:150%; } #utility a:link,#utility a:visited{ color:#DDDDDD; font-weight:bold; text-decoration:none; } #utilityLeft,#utilityCenter,#utilityRight{ border-top:2px solid #8A8683; } #templateFooter{ color:#B1B1B1; font-family:Arial; font-size:10px; font-weight:bold; line-height:150%; } #templateFooter a:link,#templateFooter a:visited{ color:#8C8C8C; font-weight:bold; text-decoration:underline; } </style></head> <body> <center> <table bgcolor="#404040" border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" id="container"> <tr> <td align="center" valign="top"> <table border="0" cellpadding="0" cellspacing="0" width="600" id="templateBody"> <tr> <td align="left" valign="top" id="location"> <br> <div>Title</div> </td> </tr>

 <tr> <td align="center" valign="top"> <table border="0" cellpadding="0" cellspacing="0" width="600"> <tr> <td width="100"> <br> </td> <td align="left" valign="top" width="400"> <br> <div id="emailContent" mc:edit="main"> '.$message.' </div> <br> <div style="width:38%" class="registerButton content"> <br> <div mc:edit="register_button2"><a href="#">Goto Dashboard</a></div> <br> </div> <br> <br> </td> <td width="100"> <br> </td> </tr> </table> </td> </tr> </table> <table border="0" cellpadding="0" cellspacing="0" width="600" id="templateFooter"> <tr> <td align="left" valign="top"> <img src="http://www.werplay.com/newPortal/assets/images/logo/logo-white.png" alt="logo"></a> </td> <td> <a href="http://www.werplay.com/" >we.R.play</a> </td> </tr> </table> </td> </tr> </table> </center> </body> </html>';

	$headers = "From:" . $from."\r\n";
	$headers .= "Return-Path: murtaza@werplay.com\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
	mail($to,$subject,$messagemain,$headers);
}
 
  ?>