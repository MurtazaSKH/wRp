<?php
	include('sessionHeader.php');
	
	//global variables
	$adminDsg[0]=0;	//designations with admin rights
?>


<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="Keywords" content="Epsilon, mobile, framework, css3, html5, javascript, retina" />
<meta name="Description" content="Epsilon based mobile retina webpp template!" />
<!--Favicon shortcut link-->
<link type="image/x-icon" rel="shortcut icon" href="images/splash/favicon.ico" />
<link type="image/x-icon" rel="icon" href="images/splash/favicon.ico" />
<!--Declare page as mobile friendly --> 
<meta name="viewport" content="user-scalable=no, initial-scale=1.0, maximum-scale=1.0" />
<!-- Declare page as iDevice WebApp friendly -->
<meta name="apple-mobile-web-app-capable" content="yes" />
<!-- iDevice WebApp Splash Screen, Regular Icon, iPhone, iPad, iPod Retina Icons -->
<link rel="apple-touch-icon" sizes="114x114" href="images/splash/splash-icon.png" /> 
<link rel="apple-touch-startup-image" href="images/splash/splash-screen.png" media="screen and (max-device-width: 320px)" /> 
<link rel="apple-touch-startup-image" href="images/splash/splash-screen@2x.png" media="(max-device-width: 480px) and (-webkit-min-device-pixel-ratio: 2)" /> 
<link rel="apple-touch-startup-image" href="images/splash/splash-screen@3x.png" sizes="640x1096" />

<!-- Page Title -->
<title>weRplay App</title>

<!-- Stylesheet Load -->
<link href="styles/style.css" rel="stylesheet" type="text/css" />
<link href="styles/framework-style.css" rel="stylesheet" type="text/css" />
<link href="styles/framework.css" rel="stylesheet" type="text/css" />
<link href="styles/icons.css" rel="stylesheet" type="text/css" />
<link href="styles/retina.css" rel="stylesheet" type="text/css" media="only screen and (-webkit-min-device-pixel-ratio: 2)" />

<!--Page Scripts Load -->
<script src="scripts/jquery.min.js" type="text/javascript"></script>	
<script src="scripts/jquery-ui-min.js" type="text/javascript"></script>
<script src="scripts/colorbox.js" type="text/javascript"></script>
<script src="scripts/hammer.js" type="text/javascript"></script>	
<script src="scripts/subscribe.js" type="text/javascript"></script>
<script src="scripts/contact.js" type="text/javascript"></script>
<script src="scripts/swipe.js" type="text/javascript"></script>
<script src="scripts/klass.min.js" type="text/javascript"></script>
<script src="scripts/photoswipe.js" type="text/javascript"></script>
<script src="scripts/retina.js" type="text/javascript"></script>
<script src="scripts/custom.js" type="text/javascript"></script>
<script src="scripts/framework.js" type="text/javascript"></script>
</head>
 
<body>

<div id="preloader">
	<div id="status">
    	<p class="center-text">
			Loading the content...
            <em>Loading depends on your connection speed!</em>
        </p>
    </div>
</div>


  
<div class="header">
	<a href="#" class="deploy-left-sidebar"></a>
	
    <a href="#" class="top-logo"><img src="images/misc/logo.png" class="replace-2x" width="125" alt="img" /></a>
</div>
  
<div class="content-box">
  <a href="index.html" >hi3 </a>
    <div class="content">
      <a href="index.html" >hi2 </a>
     <?php
			if(isset($_GET['flag']))
			{
				if($_GET['flag'] == 1)//user checked out a device
				{
					echo "
            <div class=\"notification-box blue-box\">
                    <h4>You now own the device</h4>
                    <a href=\"#\" class=\"close-notification\">x</a>
                <div class=\"clear\"></div>
                <p>
                   To clear ownership you can now tap on the button below.  
                </p>  
            </div>  ";
				}//end of inner if
				elseif($_GET['flag'] == 2)// user cleared of all possessions
				{
					echo "
            <div class=\"notification-box green-box\">
                    <h4>You have been cleared of all possession</h4>
                    <a href=\"#\" class=\"close-notification\">x</a>
                <div class=\"clear\"></div>
                <p>
                   To check out device place device with QR Code reader on the QR at the back of the device.
                </p>  
            </div> ";
				}//end of if
				elseif($_GET['flag'] == 3)//Admin: Cleared all ownerships
				{
					echo "<div class='success grid_12'><h3>All Device Ownerships Cleared</h3><a class='hide_btn'>&nbsp;</a></div>";
				}//end of elseif
				elseif($_GET['flag'] == 4)//Admin: A single device cleared
				{
					echo "<div class='success grid_12'><h3>Success! Ownership Cleared</h3><a class='hide_btn'>&nbsp;</a></div>";
				}
				elseif($_GET['flag'] == 5)//Device info updated
				{
					echo "<div class='success grid_12'><h3>Device Info Updated Successfully</h3><a class='hide_btn'>&nbsp;</a></div>";
				}
				elseif($_GET['flag'] == 6)//Device added
				{
					echo "<div class='success grid_12'><h3>New Device Added Successfully</h3><a class='hide_btn'>&nbsp;</a></div>";
				}
			}//end of outer if
		?>
    
    	<div class="container no-bottom">
        
         <a href="index.html" >hi </a>
        <?php
						include("mysqlConnect.php");
						
						//echo "hi";
						//$userName = "Hammad Ahmed";
			
						$query = "SELECT * FROM devicelist where OwnedBy = \"$userName\" ORDER BY OSType, DeviceName";
						$result = mysql_query($query) or die('Query failed: ' . mysql_error());
						$num_results = mysql_num_rows($result);	
						$row = NULL;
						
						
												
						for($i = $num_results; $i > 0 ; $i--)
						{
							 $row = mysql_fetch_array($result);
							 
							
							 echo"    <a href=\"processCheckOut.php?flag=disownid&did=". $row['DeviceID'] ."\" 
							 class=\"no-bottom demo-button button-minimal yellow fullscreen-button no-bottom\"><strong class=\"uppercase\">". $row['DeviceName'] ."</strong><br />
                    " . $row['OSType'] . " " . $row['OSVersion'] . " and Last updated on " . $row['LastUpdate'] . "</a>   ";
							 
							/*
							 
							 echo "<tr>";
							 echo "<td>" . $row['DeviceName'] . "</td>";
							 echo "<td>" . $row['OSType'] . " " . $row['OSVersion'] . "</td>";
							 echo "<td>" . $row['OwnedBy'] . "</td>";
							 echo "<td>" . $row['LastUpdate'] . "</td>";
							 
							 for($j=0; $j< count($adminDsg) ; $j++)
							 {
								 if($dsgID == $adminDsg[$j])
								 {
									  echo "<td><div style='height: 3px;'>&nbsp;</div><div class='actionbar'>
										 <a href='processCheckOut.php?flag=disownid&did=". $row['DeviceID'] .
										 "' class='action delete'><span>Clear</span></a></div></td>";
										 break;
								 }//end of if
							 }//end of for
							 
							 
							 echo "</tr>";*/
						}//end of for
						
						
						mysql_close();
						?>
        <a href="index.html" >hi </a>
        
        <a href="index.php?flag=kill" class="no-bottom demo-button button-minimal red fullscreen-button no-bottom">Log Out </a>
        
        	<!--<h5 class="uppercase">Swipe notifications!</h5>
            <p> The bellow notifications are triggered by swipe events, either to the left or to the right! Swipe to the left or right to deploy the hide button!</p>
        </div>

        <div class="white-box container">
            <div class="swipe-notification swipe-left-notification container no-bottom">
                <a href="#">
                    <strong class="uppercase">SWIPE ME TO THE LEFT!</strong><br />
                    And the delete button will appear!
                </a>
                <span class="swipe-button">HIDE</span>
            </div>        
        </div>

        <div class="white-box container">
            <div class="swipe-notification swipe-right-notification container no-bottom">
                <a href="#">
                    <strong class="uppercase">SWIPE ME TO THE RIGHT!</strong><br />
                    And the delete button will appear!
                </a>
                <span class="swipe-button">HIDE</span>
            </div>        
        </div>
        
        <div class="decoration"></div>
        
        <div class="container no-bottom">
        	<h5 class="uppercase">Swipe tick, cross boxes!</h5>
            <p>Swipe one way, it turns green, swipe the other, it goes red, tap it and it goes back to normal!</p>
        </div>
        
        <div class="white-box container">
        	<div class="swipe-tick-cross swipe-tick-cross-left">
				<a href="#" class="swipe-null-box">Swipe left!</a>
                <a href="#" class="swipe-check-box">Swipe right!</a>
                <a href="#" class="swipe-tick-box">Now tap me!</a>
            </div>        
        </div>
       
        <div class="white-box container">
        	<div class="swipe-tick-cross swipe-tick-cross-right">
				<a href="#" class="swipe-null-box">Swipe right!</a>
                <a href="#" class="swipe-check-box">Swipe left!</a>
                <a href="#" class="swipe-tick-box">Now tap me!</a>
            </div>        
        </div>
        
        <div class="decoration"></div>


        <div class="container no-bottom">
        	<h5 class="uppercase">Tap once, tap twice!</h5>
            <p>Tap to dismiss a box, tap it once or twice to dismiss it!</p>
        </div>
         
        
        <div class="tap-dismiss white-box container">
            <div class="white-notification container">
                <a href="#" class="white-information uppercase">
                    <strong>Tap me once!</strong><br />
                    Tapping once will make it dissapear! 
                    <em>x</em>
                </a>
            </div>
        </div>
        
        <div class="double-tap-dismiss white-box container">
            <div class="white-notification container">
                <a href="#" class="white-information uppercase">
                    <strong>Tap me twice!</strong><br />
                    Tapping twice will make it dissapear!
                    <em>x</em>
                </a>
            </div>
        </div>
-->
        <div class="decoration"></div>      
        <p class="center-text uppercase footer-text">
            Copyright 2013. All rights reserved!
        </p>

    </div>
</div>



<div class="sidebar-left">
	<div class="sidebar-scroll-left">
    	<div class="sidebar-header-left">
			<img src="images/misc/logo-sidebar.png" class="sidebar-left-logo replace-2x" width="125" alt="img" />
        	<a href="#" class="close-sidebar-left"></a>
    	</div>
    
        <p class="sidebar-divider-text">NAVIGATION</p>
        
        <a href="touch.php" class="nav-item home-nav">HOMEPAGE<em class="icon-page"></em></a>
        <a href="index.php?flag=kill" class="nav-item folio-nav">LOG OUT<em class="icon-page"></em></a>   
        
   
        
      
    </div>
</div>

<!--<div class="sidebar-right">
	<div class="sidebar-scroll-right">
    	<div class="sidebar-header-right">
        	<a href="#" class="close-sidebar-right"></a>
			<img src="images/misc/logo-sidebar.png" class="sidebar-right-logo replace-2x" width="125" alt="img" />
    	</div>
        
        <p class="sidebar-divider-text">CONTACT</p>
        
        <a href="#" class="nav-item newsletter-nav deploy-subscribe-form">NEWSLETTER<em class="icon-drop"></em></a>
        <div class="modalForm sidebar-form2" id="modalForm">      
            <div id="emailError" class="small-notification red-notification no-bottom subscribe-notification">
                <p>Mail address required!</p>
            </div>
          
            <div id="emailError2" class="small-notification red-notification no-bottom subscribe-notification">
                <p>Mail address must be valid!</p>
            </div>
        
            <div class="success-subscribe">
                <div class="notification-box yellow-box">
                    <h4>YOU'RE SUBSCRIBED!</h4>
                    <!--<a href="#" class="close-notification">x</a>-->
                    <!--<div class="clear"></div>
                    <p>
                       Your request for a subscription has been sent! Thank you!
                    </p>  
                </div> 
            </div>
            <form id="contact" />                   
                <fieldset>
                    <label for="contactName" id="name_label">NAME:</label>
                    <p id="left_label_name">required</p>
                    <input type="text" name="contactName" id="contactName" size="30" value="[Page Subscriber]" class="text-input" />
                    
                    <label for="contactEmail" id="email_label">EMAIL:</label>
                    <p id="left_label_mail">required</p>
                    <input type="text" name="contactEmail" id="contactEmail" size="30" value="" class="text-input" />
                    
                    <textarea name="contactMessage" id="contactMessage" class="text-input">Message Sent From Modal Pop-Up</textarea>
                    
                    <p class="contact-button-house">
                      <input type="submit" name="submitMessage" class="contactButton" id="contactSubmitBtn" value="SUBSCRIBE" />
                    </p>            
            
                </fieldset>
            </form>
        </div>-->

        <!--
        <a href="#" class="nav-item mail-nav deploy-contact-form">SEND EMAIL<em class="icon-drop"></em></a>
        <div class="sidebar-form contact-form"> 
            <div class="formSuccessMessageWrap" id="formSuccessMessageWrap">
                <div class="notification-box blue-box">
                    <h4>EMAIL MESSAGE SENT!</h4>-->
                    <!--<a href="#" class="close-notification">x</a>-->
                   <!-- <div class="clear"></div>
                    <p>
                        You're message has been successfully sent. Please allow up to 48 hours for us to reply!  
                    </p>  
                </div> 
            </div>
            <form action="php/contact.php" method="post" class="contactForm" id="contactForm" />
                <div class="formSubmitButtonErrorsWrap">                       
                    <div class="formValidationError" id="contactNameFieldError">
                        <div class="small-notification red-notification no-bottom">
                            <p>NAME IS REQUIRED</p>
                        </div>
                    </div>             
                    <div class="formValidationError" id="contactEmailFieldError">
                        <div class="small-notification red-notification no-bottom">
                            <p>EMAIL IS REQUIRED</p>
                        </div>
                    </div> 
                    <div class="formValidationError" id="contactEmailFieldError2">
                        <div class="small-notification red-notification no-bottom">
                            <p>ADDRESS MUST BE VALID</p>
                        </div>
                    </div> 
                    <div class="formValidationError" id="contactMessageTextareaError">
                        <div class="small-notification red-notification no-bottom">
                            <p>MESSAGE FIELD IS EMPTY</p>
                        </div>
                    </div>   
                </div>
                <fieldset>
                    <div class="formFieldWrap">
                        <label class="contactNameField" for="contactNameField">Name:<span>required</span></label>
                        <input type="text" name="contactNameField" value="" class="contactField requiredField" id="contactNameField" />
                    </div>
                    <div class="formFieldWrap">
                        <label class="contactEmailField" for="contactEmailField">Email: <span>required</span></label>
                        <input type="text" name="contactEmailField" value="" class="contactField requiredField requiredEmailField" id="contactEmailField" />
                    </div>
                    <div class="formTextareaWrap">
                        <label class="contactMessageTextarea" for="contactMessageTextarea">Message: <span>required</span></label>
                        <textarea name="contactMessageTextarea" class="contactTextarea requiredField" id="contactMessageTextarea"></textarea>
                    </div>
                        <div class="formSubmitButtonErrorsWrap">                       
                            <input type="submit" class="buttonWrap sidebar-send-button contactSubmitButton" id="contactSubmitButton" value="Submit" data-formid="contactForm" />
                        </div>
                </fieldset>
            </form>       
        </div>        
        <a href="tel:+1 234 456 7890" class="nav-item call-nav">CALL US<em class="icon-page"></em></a>
        <a href="sms:+1 234 456 7890" class="nav-item text-nav">SMS US<em class="icon-page"></em></a>
        
        <p class="sidebar-divider-text">SOCIAL NETWORKS</p>
        
        <a href="#" class="nav-item facebook-nav">FACEBOOK<em class="icon-page"></em></a>
        <a href="#" class="nav-item twitter-nav">TWITTER<em class="icon-page"></em></a>
        
        <p class="copyright-sidebar right-sidebar-copyright">Copyright 2013. All rights reserved!</p>
        
        <div class="sidebar-bottom-controls">
            <a href="#">
                <em class="twitter-bottom"></em>
                <p>Twitter</p>
            </a>
            <a href="#">
                <em class="facebook-bottom"></em>
                <p>Facebook</p>
            </a>
            <a href="#">
                <em class="close-bottom-right"></em>
                <p>Collapse</p>
            </a>
            <div class="clear"></div>
        </div>
    </div>-->
<!--</div>-->




</body>