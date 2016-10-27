<?php
	session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php 
	
	if($_GET['ID'] != 555)
	{
		
		echo '<script type="text/javascript">'
		   . 'window.location.href = "http://newapps.werplay.com/index.php"'
		   . '</script>';
	}//end of if
	
	
			if(isset($_GET['flag']))
			{
				if($_GET['flag'] == 1)
				{
					echo "<div id='main' class='container_12'>";
					echo "<div class='error grid_12'><h3>Invalid email or password. 
					<a href='passwordRetrieval.php'>Click here</a> if you forgot your password.</h3><a class='hide_btn'>&nbsp;</a></div>";
					echo "</div>";
				}//end of inner if
				if($_GET['flag'] == 2)
				{
					session_destroy();
					echo "<div id='main' class='container_12'>";
					echo "<div class='error grid_12'><h3>Session Expired. Please Login again</h3><a class='hide_btn'>&nbsp;</a></div>";
					echo "</div>";
				}//end of if
				if($_GET['flag'] == 'kill')
				{
					session_destroy();
				}
				if ($_GET['flag'] == 3)
				{	
					$to = $_GET['email'];
					$toEID = $_GET['eid'];
					
					echo "<div id='main' class='container_12'>";
					echo "<div class='error grid_12'><h3>Account not activated. <a href='sendRegisterationEmail.php?eid=".$toEID."&to=".$to."'>Click here </a>to send the link again</h3></div>";
					echo "</div>";
				}//end of if
				if ($_GET['flag'] == 4)
				{
					echo "<div id='main' class='container_12'>";
					echo "<div class='error grid_12'><h3>Email address not registered</h3><a class='hide_btn'>&nbsp;</a></div>";
					echo "</div>";
				}//end of if
			}//end of if
		?>
<title>weRplay Apps</title>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="data/js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="data/js/jquery.corner.js"></script>
<script type="text/javascript" src="data/js/jquery.validate.js"></script>
<script type="text/javascript" src="data/js/css_browser_selector.js"></script>
<script type="text/javascript" src="data/js/js.js"></script>
<link rel="stylesheet" href="data/css/reset.css" type="text/css" />
<link rel="stylesheet" href="data/css/grid.css" type="text/css" />
<link rel="stylesheet" href="data/css/style.css" type="text/css" />
<link rel="shortcut icon" href="img/favicon.ico" />
<style>
/* html, body { margin: 0; padding: 0; }
  .hide { display: none;}
  .show { display: block;}*/
</style>
  <script type="text/javascript">
  /**
   * Global variables to hold the profile and email data.
   */
  /* var profile, email;*/

  /*
   * Triggered when the user accepts the sign in, cancels, or closes the
   * authorization dialog.
   */
 /* function loginFinishedCallback(authResult) {
    if (authResult) {
      if (authResult['error'] == undefined){
        toggleElement('signin-button'); // Hide the sign-in button after successfully signing in the user.
        gapi.client.load('plus','v1', loadProfile);  // Trigger request to get the email address.
      } else {
        console.log('An error occurred');
      }
    } else {
      console.log('Empty authResult');  // Something went wrong
    }
  }*/

  /**
   * Uses the JavaScript API to request the user's profile, which includes
   * their basic information. When the plus.profile.emails.read scope is
   * requested, the response will also include the user's primary email address
   * and any other email addresses that the user made public.
   */
  /*function loadProfile(){
    var request = gapi.client.plus.people.get( {'userId' : 'me'} );
    request.execute(loadProfileCallback);
  }*/

  /**
   * Callback for the asynchronous request to the people.get method. The profile
   * and email are set to global variables. Triggers the user's basic profile
   * to display when called.
   */
 /* function loadProfileCallback(obj) {
    profile = obj;*/

    // Filter the emails object to find the user's primary account, which might
    // not always be the first in the array. The filter() method supports IE9+.
    /*email = obj['emails'].filter(function(v) {
        return v.type === 'account'; // Filter out the primary email
    })[0].value; // get the email from the filtered results, should always be defined.
    displayProfile(profile);
  }*/

  /**
   * Display the user's basic profile information from the profile object.
   */
 /* function displayProfile(profile){
    document.getElementById('name').innerHTML = profile['displayName'];
    document.getElementById('pic').innerHTML = '<img src="' + profile['image']['url'] + '" />';
    document.getElementById('email').innerHTML = email;
    //toggleElement('profile');
	myFunction()
  }*/

  /**
   * Utility function to show or hide elements by their IDs.
   */
  /*function toggleElement(id) {
    var el = document.getElementById(id);
    if (el.getAttribute('class') == 'hide') {
      el.setAttribute('class', 'show');
    } else {
      el.setAttribute('class', 'hide');
    }
  }
  
  function myFunction()
{
	document.getElementById('email1').value = email;
	document.loginForm.arg.value = 'gplus';
    document.forms["loginForm"].submit();*/
	
	
			   //window.location.href = "home.php";
			   
/*}*/
  </script>
  <script src="https://apis.google.com/js/client:plusone.js" type="text/javascript"></script>
</head>
<body>
	<div id="loginbox">
		<a href="index.php" id="logo">weRplay Apps</a>
		<div id="loginform">
			<form id="loginForm" name="loginForm" action="processLogin.php" method="post">
				<input  type="text" name="email" id="email1" placeholder="Username" class="required" value="" />
                <input type="hidden" name="arg" id="arg" value="">
				<input  type="password" name="password" placeholder="Password" class="required" value="" />
		  <div id="buttonline">	
         
 <!--<div id="signin-button" class="show" style="width:183px; margin:0 auto;">
     <div class="g-signin"
      data-callback="loginFinishedCallback"
      data-approvalprompt="force"
      data-clientid="951425032555.apps.googleusercontent.com"
      data-scope="https://www.googleapis.com/auth/plus.login  https://www.googleapis.com/auth/userinfo.email"
      data-height="standard"
      data-theme="light"
      data-width="wide"
      data-cookiepolicy="single_host_origin"
      >
    </div>-->
    <!-- In most cases, you don't want to use approvalprompt=force. Specified
    here to facilitate the demo.-->
<!--  </div>-->

 <!-- <div id="profile" class="hide">
    <div>
      <span id="pic"></span>
      <span id="name"></span>
    </div>

    <div id="email"></div>
  </div>-->
					<input class="loginbutton" type="submit" id="loginbutton"  value="Login" />
					<a href="registerationForm.php" class="passforgot float_center">Register</a>
				</div> 
			</form>
		</div>
	</div>
</body>
</html>