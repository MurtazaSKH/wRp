var xmlhttp;
// Exchange device ID between functions, e.g. checkout and clear etc.
var did;
// variable to exchange cookie variables
var usercook;
var passcook;
 ///////////////////////////////////////////////////// Ajax web service
function GetXmlHttpObject()
{
if (window.XMLHttpRequest)
  {
  // code for IE7+, Firefox, Chrome, Opera, Safari
  return new XMLHttpRequest();
  }
if (window.ActiveXObject)
  {
  // code for IE6, IE5
  return new ActiveXObject("Microsoft.XMLHTTP");
  }
return null;
}
 ///////////////////////////////////////////////////// Simple login for web portal
function login()
{
	xmlhttp=GetXmlHttpObject();
	if (xmlhttp==null)
	{
	alert ("Browser does not support HTTP Request");
	return;
	}
	var user=document.getElementById("username").value;
	var pass=document.getElementById("password").value;
	var loggedin=document.getElementById("loggedin").checked;


	if(loggedin==true)
	{
		// global variable so the cookies can be saved
		usercook=user;
		passcook=pass;
	}

	// attempt to check for user/pass in database
	if(user != "" && pass !="")
	{
		var url = "./includes/ajax.php";
		url = url + "?func=login&user="+user+"&pass="+pass+"&loggedin="+loggedin;
		url=url+"&sid="+Math.random();
		xmlhttp.onreadystatechange=login_callback;
		xmlhttp.open("GET",url,true);
		xmlhttp.send(null);
		//alert(url);		
	}
	else
	{
		notifContent = '<div class="alert alert-dark media fade in bd-0" style="background:#920000;" id="message-alert"><div class="media-body width-100p"><h4 class="alert-title f-14">Could not log you in!</h4><p class="f-12 alert-message pull-left">Please do not leave field(s) empty</p><p class="pull-right"></p></div></div>';
		    setTimeout(function() {
		        if (!$('#quickview-sidebar').hasClass('open') && !$('.page-content').hasClass('page-builder') && !$('.morphsearch').hasClass('open')) generateError(notifContent);
		    }, 100);
	}
}
	
function login_callback()
{
if (xmlhttp.readyState==4)
{
	var response= xmlhttp.responseText;
	if(response.length<14)
	{
		window.location.href=response;
		document.cookie = "username="+usercook+"; expires=Sun, 1 Jan 2017 12:00:00 UTC; path=/";
		document.cookie = "password="+passcook+"; expires=Sun, 1 Jan 2017 12:00:00 UTC; path=/";
	}
	else
	{
		notifContent = '<div class="alert alert-dark media fade in bd-0" style="background:#920000;" id="message-alert"><div class="media-body width-100p"><h4 class="alert-title f-14">Could not log you in!</h4><p class="f-12 alert-message pull-left">'+response+'</p><p class="pull-right"></p></div></div>';
    setTimeout(function() {
        if (!$('#quickview-sidebar').hasClass('open') && !$('.page-content').hasClass('page-builder') && !$('.morphsearch').hasClass('open')) generateError(notifContent);
    }, 100);
	}
}
}

///////////////////////////////////////////////////// Direct login - for PIN checkout from dock

function Directlogin()
{
	document.getElementById("loading").style.display="inline";

	xmlhttp=GetXmlHttpObject();
	if (xmlhttp==null)
	{
	alert ("Browser does not support HTTP Request");
	return;
	}
	var pin=document.getElementById("text-basic").value;

	//alert(pin);
	if(pin != "" && pin!='0')
	{
		var url = "./includes/ajax.php";
		url = url + "?func=directLogin&pin="+pin;
		url=url+"&sid="+Math.random();
		xmlhttp.onreadystatechange=Directlogin_callback;
		xmlhttp.open("GET",url,true);
		xmlhttp.send(null);
		//alert(url)
		
	}
	else
		{
			notifContent = '<div class="alert alert-dark media fade in bd-0" style="background:#920000;" id="message-alert"><div class="media-body width-100p"><h4 class="alert-title f-14">Who are you kidding?</h4><p class="f-12 alert-message pull-left">Please enter a valid PIN</p><p class="pull-right"></p></div></div>';
			    setTimeout(function() {
			        if (!$('#quickview-sidebar').hasClass('open') && !$('.page-content').hasClass('page-builder') && !$('.morphsearch').hasClass('open')) generateErrorMobile(notifContent);
			    }, 10);
		}
	
	
	setTimeout(function() {
		document.getElementById("loading").style.display="none";
	}, 400);
}
	
function Directlogin_callback()
{
if (xmlhttp.readyState==4)
{
	var response= xmlhttp.responseText;
	//alert(response);
	if(response!="Invalid PIN")
	{
		//window.location.href=response;
		document.getElementById("select_device").style.display="inline";
		document.getElementById("select_device").style+="-webkit-animation:fadeIn ease-in 1;  /* call our keyframe named fadeIn, use animattion ease-in and repeat it only 1 time */    -moz-animation:fadeIn ease-in 1;  animation:fadeIn ease-in 1; -webkit-animation-fill-mode:forwards;  /* this makes sure that after animation is done we remain at the last keyframe value (opacity: 1)*/    -moz-animation-fill-mode:forwards;    animation-fill-mode:forwards;    -webkit-animation-duration:1s;    -moz-animation-duration:1s;    animation-duration:1s;";
		document.getElementById("enter_pin").style.display="none";
		//directShowDevices();
		//alert(response);
		document.getElementById("devicesdiv").style.display="inline";
		document.getElementById("showdevices").innerHTML=response;
		$("#text2-basic").focus(); // auto focus on device id field when user logs in
	}
	else
	{
		notifContent = '<div class="alert alert-dark media fade in bd-0" style="background:#920000;" id="message-alert"><div class="media-body width-100p"><h4 class="alert-title f-14">Could not log you in!</h4><p class="f-12 alert-message pull-left">'+response+'</p><p class="pull-right"></p></div></div>';
    setTimeout(function() {
        if (!$('#quickview-sidebar').hasClass('open') && !$('.page-content').hasClass('page-builder') && !$('.morphsearch').hasClass('open')) generateErrorMobile(notifContent);
    }, 10);
	}
}
}


///////////////////////////////////////////////////// ForceCheckout - device will auto-clear and new user will checkout

function ForceCheckout()
{
	document.getElementById("loading").style.display="inline";

	xmlhttp=GetXmlHttpObject();
	if (xmlhttp==null)
	{
	alert ("Browser does not support HTTP Request");
	return;
	}
	var did=document.getElementById("text2-basic").value;
	//alert(pin);
	if(did != "" && did!='0')
	{
		var url = "./includes/ajax.php";
		url = url + "?func=forcecheckout&did="+did;
		url=url+"&sid="+Math.random();
		xmlhttp.onreadystatechange=ForceCheckout_callback;
		xmlhttp.open("GET",url,true);
		xmlhttp.send(null);			
	}
	else
		{
			notifContent = '<div class="alert alert-dark media fade in bd-0" style="background:#920000;" id="message-alert"><div class="media-body width-100p"><h4 class="alert-title f-14">Who are you kidding?</h4><p class="f-12 alert-message pull-left">Please enter a valid PIN</p><p class="pull-right"></p></div></div>';
			    setTimeout(function() {
			        if (!$('#quickview-sidebar').hasClass('open') && !$('.page-content').hasClass('page-builder') && !$('.morphsearch').hasClass('open')) generateErrorMobile(notifContent);
			    }, 10);
		}
	
	
	setTimeout(function() {
		document.getElementById("loading").style.display="none";
	}, 400);
}
	
function ForceCheckout_callback()
{
	if (xmlhttp.readyState==4)
	{
		var response= xmlhttp.responseText;

		// Successfully cleared and checked out device.
		if(response.includes("Checked Out"))
		{
			var response2=response.split("-");
			//alert(response2[1]);
			notifContent = '<div class="alert alert-dark media fade in bd-0" style="background:#00921C;" id="message-alert"><div class="media-body width-100p"><h4 class="alert-title f-14">You have this device now: '+response2[1]+', previous owner is notified.</h4><p class="f-12 alert-message pull-left"></p><p class="pull-right"></p></div></div>';
	    setTimeout(function() {
	        if (!$('#quickview-sidebar').hasClass('open') && !$('.page-content').hasClass('page-builder') && !$('.morphsearch').hasClass('open')) generateErrorMobile(notifContent);
	    }, 100);

	    	document.getElementById("text2-basic").value="";
	    	document.getElementById("hidden1").style.display="none";
	    	document.getElementById("hidden2").style.display="none";
			 
		}
		else
		{
			notifContent = '<div class="alert alert-dark media fade in bd-0" style="background:#920000;" id="message-alert"><div class="media-body width-100p"><h4 class="alert-title f-14">We faced an error please try again!</h4><p class="f-12 alert-message pull-left"></p><p class="pull-right"></p></div></div>';
	    setTimeout(function() {
	        if (!$('#quickview-sidebar').hasClass('open') && !$('.page-content').hasClass('page-builder') && !$('.morphsearch').hasClass('open')) generateErrorMobile(notifContent);
	    }, 100);

	    	document.getElementById("text2-basic").value="";
	    	document.getElementById("hidden1").style.display="none";
	    	document.getElementById("hidden2").style.display="none";
			
		}
	}
}

///////////////////////////////////////////////////// check if the company exists
function company_check()
{
	xmlhttp=GetXmlHttpObject();
	if (xmlhttp==null)
	{
	alert ("Browser does not support HTTP Request");
	return;
	}
	var companyname=document.getElementById("companyname").value;

	if(companyname != "")
	{
		var url = "./includes/ajax.php";
		url = url + "?func=company_check&companyname="+companyname;
		url=url+"&sid="+Math.random();
		xmlhttp.onreadystatechange=company_check_callback;
		xmlhttp.open("GET",url,true);
		xmlhttp.send(null);
		//alert(url)
		
	}
	else
		{
			notifContent = '<div class="alert alert-dark media fade in bd-0" style="background:#920000;" id="message-alert"><div class="media-body width-100p"><h4 class="alert-title f-14">Please Try again!</h4><p class="f-12 alert-message pull-left">Do not leave field empty.</p><p class="pull-right"></p></div></div>';
			    setTimeout(function() {
			        if (!$('#quickview-sidebar').hasClass('open') && !$('.page-content').hasClass('page-builder') && !$('.morphsearch').hasClass('open')) generateError(notifContent);
			    }, 100);
		}
}
	
function company_check_callback()
{
if (xmlhttp.readyState==4)
{
	var response= xmlhttp.responseText;
	if(response=="gotosignup")
	{
		window.location.href="signup.php";
		 
	}
	else if(response=="nocompany")
	{
		document.getElementById("checkContent").innerHTML="<h2 style='color:white;'> Not found. Please use <a href='register.php' style='color:#FFAFAF; font-size:22px;'>this form</a> to register your company,  or <a href='' style='color:#FFAFAF; font-size:22px;' onclick='location.reload();'>go back</a> to try again.</h2>";
	}
	else if(response=="inactiveCom")
	{
		document.getElementById("checkContent").innerHTML="<h2 style='color:white;'>Your mentioned company is present but not active. Please <a href='http://www.werplay.com/contactus.php' style='color:#FFAFAF; font-size:22px;'>contact</a> administrator.</h2>";
	}
	else
	{
		//alert(response);
		notifContent = '<div class="alert alert-dark media fade in bd-0" style="background:#920000;" id="message-alert"><div class="media-body width-100p"><h4 class="alert-title f-14">Encountered an error!</h4><p class="f-12 alert-message pull-left">Please try again later.</p><p class="pull-right"></p></div></div>';
    setTimeout(function() {
        if (!$('#quickview-sidebar').hasClass('open') && !$('.page-content').hasClass('page-builder') && !$('.morphsearch').hasClass('open')) generateError(notifContent);
    }, 100);
	}
}
}

/////////////////////////////////// display noty function

function generateError(content) {
    var position = 'topRight';
    if ($('body').hasClass('rtl')) position = 'topLeft';
    var n = noty({
        text: content,
        type: 'failure',
        layout: position,
        theme: 'made',
        animation: {
            open: 'animated bounceIn',
            close: 'animated bounceOut'
        },
        timeout: 7500,
        callback: {
            onShow: function() {
                $('#noty_topRight_layout_container, .noty_container_type_success').css('width', 350).css('bottom', 10);
            },
            onCloseClick: function() {
                setTimeout(function() {
                    $('#quickview-sidebar').addClass('open');
                }, 500)
            }
        }
    });
}

/////////////////////////////////// display noty function - generate error on mobile

function generateErrorMobile(content) {
    var position = 'bottomCenter';
    //if ($('body').hasClass('rtl')) position = 'topLeft';
    var n = noty({
        text: content,
        type: 'failure',
        layout: position,
        theme: 'made',
        animation: {
            open: 'animated bounceIn',
            close: 'animated bounceOut'
        },
        timeout: 7500,
        callback: {
            onShow: function() {
                $('#noty_bottom_layout_container, .noty_container_type_success').css('width', 350).css('bottom', 10);
            },
            onCloseClick: function() {
                setTimeout(function() {
                    $('#quickview-sidebar').addClass('open');
                }, 500)
            }
        }
    });
}

/////////////////////////////////// display noty function for checkout

function generateErrorCheck(content) {
    var position = 'topCenter';
    if ($('body').hasClass('rtl')) position = 'topLeft';
    var n = noty({
        text: content,
        type: 'failure',
        layout: position,
        theme: 'made',
        animation: {
            open: 'animated bounceIn',
            close: 'animated bounceOut'
        },
        timeout: 7500,
        callback: {
            onShow: function() {
                $('#noty_topRight_layout_container, .noty_container_type_success').css('width', 350).css('bottom', 10);
            },
            onCloseClick: function() {
                setTimeout(function() {
                    $('#quickview-sidebar').addClass('open');
                }, 500)
            }
        }
    });
}

/////////////////////////////////// display noty function for checkout

function generateDoneMobile(content) {
    var position = 'bottomCenter';
    if ($('body').hasClass('rtl')) position = 'topLeft';
    var n = noty({
        text: content,
        type: 'failure',
        layout: position,
        theme: 'made',
        animation: {
            open: 'animated bounceIn',
            close: 'animated bounceOut'
        },
        timeout: 1500,
        callback: {
            onShow: function() {
                $('#noty_topRight_layout_container, .noty_container_type_success').css('width', 350).css('bottom', 10);
            },
            onCloseClick: function() {
                setTimeout(function() {
                    $('#quickview-sidebar').addClass('open');
                }, 500)
            }
        }
    });
}




/////////////////////////////////////////////// Logout
function destroySessions()
{

	xmlhttp=GetXmlHttpObject();
	if (xmlhttp==null)
	{
	alert ("Browser does not support HTTP Request");
	return;
	}
	//alert("destroying Sessions");
	//alert ("running fine")
	var url = "./includes/ajax.php";
	url = url + "?func=destroySess";
	url=url+"&sid="+Math.random();
	xmlhttp.onreadystatechange=destroySessions_callback;
	xmlhttp.open("GET",url,true);
	xmlhttp.send(null);
}

function destroySessions_callback()
{
if (xmlhttp.readyState==4)
{
	window.location ="index.php";
}
}

function destroySessionsforDirect() // directLogout or direct logout
{
	document.getElementById("loading").style.display="inline";

	xmlhttp=GetXmlHttpObject();
	if (xmlhttp==null)
	{
	alert ("Browser does not support HTTP Request");
	return;
	}
	//alert("destroying Sessions");
	//alert ("running fine")
	var url = "./includes/ajax.php";
	url = url + "?func=destroySess";
	url=url+"&sid="+Math.random();
	xmlhttp.onreadystatechange=destroySessionsforDirect_callback;
	xmlhttp.open("GET",url,true);
	xmlhttp.send(null);

	setTimeout(function() {
		document.getElementById("loading").style.display="none";
	}, 400);
}

function destroySessionsforDirect_callback()
{
if (xmlhttp.readyState==4)
{
	//window.location ="index.php";
	document.getElementById("select_device").style.display="none";
	document.getElementById("enter_pin").style+="-webkit-animation:fadeIn ease-in 1;  /* call our keyframe named fadeIn, use animattion ease-in and repeat it only 1 time */    -moz-animation:fadeIn ease-in 1;  animation:fadeIn ease-in 1; -webkit-animation-fill-mode:forwards;  /* this makes sure that after animation is done we remain at the last keyframe value (opacity: 1)*/    -moz-animation-fill-mode:forwards;    animation-fill-mode:forwards;    -webkit-animation-duration:1s;    -moz-animation-duration:1s;    animation-duration:1s;";
	document.getElementById("enter_pin").style.display="inline";
	document.getElementById("text-basic").value="";
	document.getElementById("text2-basic").value="";
	document.getElementById("devicesdiv").style.display="none";
	document.getElementById("hidden1").style.display="none";
	document.getElementById("hidden2").style.display="none";
	$("#text-basic").focus();
	//document.getElementById("testiFrame").style="-webkit-animation:fadeIn ease-in 1;  /* call our keyframe named fadeIn, use animattion ease-in and repeat it only 1 time */    -moz-animation:fadeIn ease-in 1;  animation:fadeIn ease-in 1; -webkit-animation-fill-mode:forwards;  /* this makes sure that after animation is done we remain at the last keyframe value (opacity: 1)*/    -moz-animation-fill-mode:forwards;    animation-fill-mode:forwards;    -webkit-animation-duration:1s;    -moz-animation-duration:1s;    animation-duration:1s;";
}
}

// Getting cookies from string

function getCookie(name) {
  var value = "; " + document.cookie;
  var parts = value.split("; " + name + "=");
  if (parts.length == 2) return parts.pop().split(";").shift();
}

// check if user is already logged in don't log him out
function destroySessions2()
{

	xmlhttp=GetXmlHttpObject();
	if (xmlhttp==null)
	{
	alert ("Browser does not support HTTP Request");
	return;
	}
	
	var url = "./includes/ajax.php";
	url = url + "?func=destroySess2";
	url=url+"&sid="+Math.random();
	xmlhttp.onreadystatechange=destroySessions2_callback;
	xmlhttp.open("GET",url,true);
	xmlhttp.send(null);
	//alert("destroying Sessions");
	//alert ("running fine")
	
}

function destroySessions2_callback()
{
if (xmlhttp.readyState==4)
{
	var response= xmlhttp.responseText;
	//alert(response);
	if(response=="dont refresh")
	{
		// if cookies are set update fields
		usercook=getCookie("username");
		passcook=getCookie("password");
		if(usercook!=null && usercook!="undefined" && passcook!=null)
		{
			document.getElementById("username").value=usercook;
			document.getElementById("password").value=passcook;
		}
		// if cookies are not do nothing
	}
	else
	{
		window.location = response;
	}
	// if(response=="loggedOut")
	// {
	// 	window.location = "index.php";
	// }
	// else if(response=="notAdmin")
	// {
	// 	window.location = "dashboard.php";
	// }
}
}

/////////////////////////////////////////////// check user session
function checkSession()
{
	xmlhttp=GetXmlHttpObject();
	if (xmlhttp==null)
	{
	alert ("Browser does not support HTTP Request");
	return;
	}
	//alert(~window.location.href.indexOf("signup.php"));
	// checking admin access
	if(~window.location.href.indexOf("editDevice.php") || ~window.location.href.indexOf("addDevice.php") || ~window.location.href.indexOf("addUser.php") || ~window.location.href.indexOf("editUser.php") )
	{
		var url = "./includes/ajax.php";
		url = url + "?func=checkSession&sessid="+'1';
		url=url+"&sid="+Math.random();
		xmlhttp.onreadystatechange=checkSession_callback;
		xmlhttp.open("GET",url,true);
		xmlhttp.send(null);
	}
	// checking session on sign up pages
	// else if (~window.location.href.indexOf("signup.php"))
	// {
	// 	var url = "./includes/ajax.php";
	// 	url = url + "?func=checkSession&sessid="+'2';
	// 	url=url+"&sid="+Math.random();
	// 	xmlhttp.onreadystatechange=checkSession_callback;
	// 	xmlhttp.open("GET",url,true);
	// 	xmlhttp.send(null);	
	// 	alert(url);
	// }	
	// general check
	else
	{
		var url = "./includes/ajax.php";
		url = url + "?func=checkSession&sessid="+'0';
		url=url+"&sid="+Math.random();
		xmlhttp.onreadystatechange=checkSession_callback;
		xmlhttp.open("GET",url,true);
		xmlhttp.send(null);	
	}	
}

function checkSession_callback()
{
if (xmlhttp.readyState==4)
{
	var response= xmlhttp.responseText;
	//alert(response);
	if(response=="loggedOut")
	{
		window.location = "index.php";
	}
	else if(response=="notAdmin")
	{
		window.location = "dashboard.php";
	}
}
}

 ///////////////////////////////////////////////////// Checkout device
function checkout(deviceid)
{
	//alert (deviceid);
	did=deviceid;
	xmlhttp=GetXmlHttpObject();
	if (xmlhttp==null)
	{
	alert ("Browser does not support HTTP Request");
	return;
	}

	if(deviceid!=null)
	{
		var url = "./includes/ajax.php";
		url = url + "?func=checkout&did="+deviceid;
		url=url+"&sid="+Math.random();
		xmlhttp.onreadystatechange=checkout_callback;
		xmlhttp.open("GET",url,true);
		xmlhttp.send(null);
		//alert(url)
		
	}
	else 
	{
		alert ("Please try again!");
	}
	
}
	
function checkout_callback()
{
if (xmlhttp.readyState==4)
{
	var response= xmlhttp.responseText;
	//alert (response+"checkout callback");
	if(response!="Error")
	{
		notifContent = '<div class="alert alert-dark media fade in bd-0" style="background:#00921C;" id="message-alert"><div class="media-body width-100p"><h4 class="alert-title f-14">Device State: Checked Out.</h4><p class="f-12 alert-message pull-left"></p><p class="pull-right"></p></div></div>';
    setTimeout(function() {
        if (!$('#quickview-sidebar').hasClass('open') && !$('.page-content').hasClass('page-builder') && !$('.morphsearch').hasClass('open')) generateErrorCheck(notifContent);
    }, 100);
		 
		 document.getElementById("device"+did+"").innerHTML=response;
		 document.getElementById("cbttn"+did+"").style.display="none";
		 document.getElementById("clearbttn"+did+"").style.display="inline-block";
		 document.getElementById("charge"+did+"").style.display="inline-block";
	}
	else
	{
		alert("Please try again later!");	
		
	}
}
}

///////////////////////////////////////////////////// Direct Checkout device
function directcheckout()
{
	//alert (deviceid);
	// did=deviceid;
	document.getElementById("loading").style.display="inline";

	var did=document.getElementById("text2-basic").value;
	// alert(did);
	xmlhttp=GetXmlHttpObject();
	if (xmlhttp==null)
	{
		alert ("Browser does not support HTTP Request");
		return;
	}

	if(did!=null)
	{
		var url = "./includes/ajax.php";
		url = url + "?func=directcheckout&did="+did;
		url=url+"&sid="+Math.random();
		xmlhttp.onreadystatechange=directcheckout_callback;
		xmlhttp.open("GET",url,true);
		xmlhttp.send(null);
		//alert(url);
		
	}
	else 
	{
		alert ("Please try again!");
	}
	//document.getElementById("loading").style.display="none";

	setTimeout(function() {
		document.getElementById("loading").style.display="none";
	}, 400);
	
}
	
function directcheckout_callback()
{
if (xmlhttp.readyState==4)
{
	var response= xmlhttp.responseText;
	
	// using IFs in case of an error - and else will display success scenario
	if(response=="Already")
	{
		notifContent = '<div class="alert alert-dark media fade in bd-0" style="background:#920000;" id="message-alert"><div class="media-body width-100p"><h4 class="alert-title f-14">Device State: Already Checked Out by another user!</h4><p class="f-12 alert-message pull-left"></p><p class="pull-right"></p></div></div>';
    setTimeout(function() {
        if (!$('#quickview-sidebar').hasClass('open') && !$('.page-content').hasClass('page-builder') && !$('.morphsearch').hasClass('open')) generateErrorMobile(notifContent);
    }, 100);

    	document.getElementById("hidden2").style.display="inline";
	}
	else if(response=="You")
	{
		notifContent = '<div class="alert alert-dark media fade in bd-0" style="background:#920000;" id="message-alert"><div class="media-body width-100p"><h4 class="alert-title f-14">Device State: You have checked out this device!</h4><p class="f-12 alert-message pull-left"></p><p class="pull-right"></p></div></div>';
    setTimeout(function() {
        if (!$('#quickview-sidebar').hasClass('open') && !$('.page-content').hasClass('page-builder') && !$('.morphsearch').hasClass('open')) generateErrorMobile(notifContent);
    }, 100);

    	document.getElementById("text2-basic").value="";
    	document.getElementById("hidden1").style.display="none";
	}
	else if(response=="Device Does not Exist")
	{
		notifContent = '<div class="alert alert-dark media fade in bd-0" style="background:#920000;" id="message-alert"><div class="media-body width-100p"><h4 class="alert-title f-14">Device does not exist.</h4><p class="f-12 alert-message pull-left"></p><p class="pull-right"></p></div></div>';
    setTimeout(function() {
        if (!$('#quickview-sidebar').hasClass('open') && !$('.page-content').hasClass('page-builder') && !$('.morphsearch').hasClass('open')) generateErrorMobile(notifContent);
    }, 100);
		
	}
	else
	{
		//var response2=response.split("-");
		//alert(response2[1]);
		// notifContent = '<div class="alert alert-dark media fade in bd-0" style="background:#00921C;" id="message-alert"><div class="media-body width-100p"><h4 class="alert-title f-14">You just checked out: '+response2[1]+'.</h4><p class="f-12 alert-message pull-left"></p><p class="pull-right"></p></div></div>';
  //   setTimeout(function() {
  //       if (!$('#quickview-sidebar').hasClass('open') && !$('.page-content').hasClass('page-builder') && !$('.morphsearch').hasClass('open')) generateErrorMobile(notifContent);
  //   }, 100);
  		document.getElementById("showdevices").innerHTML+=response;
    	document.getElementById("text2-basic").value="";
    	document.getElementById("hidden1").style.display="none";
	}
}
}

///////////////////////////////////////////////////// Direct clear device
function directclear()
{
	//alert (deviceid);
	// did=deviceid;
	document.getElementById("loading").style.display="inline";
	var did=document.getElementById("text2-basic").value;
	// alert(did);
	xmlhttp=GetXmlHttpObject();
	if (xmlhttp==null)
	{
		alert ("Browser does not support HTTP Request");
		return;
	}

	if(did!=null)
	{
		var url = "./includes/ajax.php";
		url = url + "?func=directclear&did="+did;
		url=url+"&sid="+Math.random();
		xmlhttp.onreadystatechange=directclear_callback;
		xmlhttp.open("GET",url,true);
		xmlhttp.send(null);
		//alert(url);
		
	}
	else 
	{
		alert ("Please try again!");
	}

	setTimeout(function() {
		document.getElementById("loading").style.display="none";
	}, 400);
	
}
	
function directclear_callback()
{
if (xmlhttp.readyState==4)
{
	var response= xmlhttp.responseText;
	if(response.includes("Device Cleared"))
	{
		var response2=response.split("-");
		notifContent = '<div class="alert alert-dark media fade in bd-0" style="background:#00921C;" id="message-alert"><div class="media-body width-100p"><h4 class="alert-title f-14">You have cleared: '+response2[1]+'.</h4><p class="f-12 alert-message pull-left"></p><p class="pull-right"></p></div></div>';
    setTimeout(function() {
        if (!$('#quickview-sidebar').hasClass('open') && !$('.page-content').hasClass('page-builder') && !$('.morphsearch').hasClass('open')) generateErrorMobile(notifContent);
    }, 100);

    	document.getElementById("text2-basic").value="";
    	document.getElementById("hidden1").style.display="none";
	}
	if(response=="Another user")
	{
		notifContent = '<div class="alert alert-dark media fade in bd-0" style="background:#920000;" id="message-alert"><div class="media-body width-100p"><h4 class="alert-title f-14">Device State: Checked Out by another user!</h4><p class="f-12 alert-message pull-left"></p><p class="pull-right"></p></div></div>';
    setTimeout(function() {
        if (!$('#quickview-sidebar').hasClass('open') && !$('.page-content').hasClass('page-builder') && !$('.morphsearch').hasClass('open')) generateErrorMobile(notifContent);
    }, 100);
	}
	else if(response=="Already Cleared")
	{
		notifContent = '<div class="alert alert-dark media fade in bd-0" style="background:#920000;" id="message-alert"><div class="media-body width-100p"><h4 class="alert-title f-14">Device State: Device has already been cleared!</h4><p class="f-12 alert-message pull-left"></p><p class="pull-right"></p></div></div>';
    setTimeout(function() {
        if (!$('#quickview-sidebar').hasClass('open') && !$('.page-content').hasClass('page-builder') && !$('.morphsearch').hasClass('open')) generateErrorMobile(notifContent);
    }, 100);
	}
	else if(response=="Device Does not Exist")
	{
		notifContent = '<div class="alert alert-dark media fade in bd-0" style="background:#920000;" id="message-alert"><div class="media-body width-100p"><h4 class="alert-title f-14">Device does not exist.</h4><p class="f-12 alert-message pull-left"></p><p class="pull-right"></p></div></div>';
    setTimeout(function() {
        if (!$('#quickview-sidebar').hasClass('open') && !$('.page-content').hasClass('page-builder') && !$('.morphsearch').hasClass('open')) generateErrorMobile(notifContent);
    }, 100);
		
	}
}
}


///////////////////////////////////////////////////// Charge device
function chargeDev(deviceid)
{
	//alert (deviceid);
	did=deviceid;
	xmlhttp=GetXmlHttpObject();
	if (xmlhttp==null)
	{
	alert ("Browser does not support HTTP Request");
	return;
	}

	if(deviceid!=null)
	{
		var url = "./includes/ajax.php";
		url = url + "?func=charging&did="+deviceid;
		url=url+"&sid="+Math.random();
		xmlhttp.onreadystatechange=chargeDev_callback;
		xmlhttp.open("GET",url,true);
		xmlhttp.send(null);
	}
	else 
	{
		alert ("Please try again!");
	}
	
}
	
function chargeDev_callback()
{
if (xmlhttp.readyState==4)
{
	var response= xmlhttp.responseText;
	//alert (response+"checkout callback");
	if(response!="Error")
	{
		notifContent = '<div class="alert alert-dark media fade in bd-0" style="background:#00921C;" id="message-alert"><div class="media-body width-100p"><h4 class="alert-title f-14">Device State: Charging.</h4><p class="f-12 alert-message pull-left"></p><p class="pull-right"></p></div></div>';
    setTimeout(function() {
        if (!$('#quickview-sidebar').hasClass('open') && !$('.page-content').hasClass('page-builder') && !$('.morphsearch').hasClass('open')) generateErrorCheck(notifContent);
    }, 100);
		 
		 document.getElementById("device"+did+"").innerHTML="Charging";
		 document.getElementById("cbttn"+did+"").style.display="inline-block";
		 document.getElementById("clearbttn"+did+"").style.display="none";
		 document.getElementById("charge"+did+"").style.display="none";
	}
	else
	{
		alert("Please try again!");	
		
	}
}
}

///////////////////////////////////////////////////// clear device
function cleardevice(deviceid)
{
	did=deviceid;
	xmlhttp=GetXmlHttpObject();
	if (xmlhttp==null)
	{
	alert ("Browser does not support HTTP Request");
	return;
	}

	if(deviceid!=null)
	{
		var url = "./includes/ajax.php";
		url = url + "?func=cleardevice&did="+deviceid;
		url=url+"&sid="+Math.random();
		xmlhttp.onreadystatechange=cleardevice_callback;
		xmlhttp.open("GET",url,true);
		xmlhttp.send(null);
		//alert(url)
		
	}
	else 
	{
		alert ("Please try again!");
	}
	
}
	
function cleardevice_callback()
{
if (xmlhttp.readyState==4)
{
	var response= xmlhttp.responseText;
	//alert (response+"checkout callback");
	if(response!="Error")
	{
		notifContent = '<div class="alert alert-dark media fade in bd-0" style="background:#00921C;" id="message-alert"><div class="media-body width-100p"><h4 class="alert-title f-14">Device State: Cleared.</h4><p class="f-12 alert-message pull-left"></p><p class="pull-right"></p></div></div>';
    setTimeout(function() {
        	generateErrorCheck(notifContent);
    }, 100);
		 
		 document.getElementById("device"+did+"").innerHTML=response;
		 document.getElementById("clearbttn"+did+"").style.display="none";
		 document.getElementById("charge"+did+"").style.display="none";
		 document.getElementById("cbttn"+did+"").style.display="inline-block";

	}
	else
	{
		notifContent = '<div class="alert alert-dark media fade in bd-0" style="background:#920000;" id="message-alert"><div class="media-body width-100p"><h4 class="alert-title f-14">There was an error please try again later!</h4><p class="f-12 alert-message pull-left"></p><p class="pull-right"></p></div></div>';
    setTimeout(function() {
        	generateError(notifContent);
    }, 100);
		
	}
}
}

///////////////////////////////////////////////////// clearing device(s) from dashboard

// Since this function is being used for both web and mobile, so we need to check for current page location to displayed loading animation and displaying notification

function clearonedevice(deviceid)
{
	//alert (deviceid);
	if(~window.location.href.indexOf("directLogin2.php"))
	{
		document.getElementById("loading").style.display="inline";
	}
	did=deviceid;
	xmlhttp=GetXmlHttpObject();
	if (xmlhttp==null)
	{
	alert ("Browser does not support HTTP Request");
	return;
	}

	if(deviceid!=null)
	{
		var url = "./includes/ajax.php";
		url = url + "?func=cleardevice&did="+deviceid;
		url=url+"&sid="+Math.random();
		xmlhttp.onreadystatechange=clearonedevice_callback;
		xmlhttp.open("GET",url,true);
		xmlhttp.send(null);
		//alert(url)
		
	}
	else 
	{
		alert ("Please try again!");
	}
	
	if(~window.location.href.indexOf("directLogin2.php"))
	{
		setTimeout(function() {
		document.getElementById("loading").style.display="none";
	}, 400);
	}
}
	
function clearonedevice_callback()
{
if (xmlhttp.readyState==4)
{
	var response= xmlhttp.responseText;
	if(response!="Error")
	{
		// show noti for mobile
    	if(~window.location.href.indexOf("directLogin2.php"))
    	{
    		notifContent = '<div class="alert alert-dark media fade in bd-0" style="background:#00921C;" id="message-alert"><div class="media-body width-100p"><h4 class="alert-title f-14">Device State: Cleared.</h4><p class="f-12 alert-message pull-left"></p><p class="pull-right"></p></div></div>';
		    setTimeout(function() {
		        	generateDoneMobile(notifContent);
		    }, 100);
    	}
    	// show noti for web
    	else
    	{
    		notifContent = '<div class="alert alert-dark media fade in bd-0" style="background:#00921C;" id="message-alert"><div class="media-body width-100p"><h4 class="alert-title f-14">Device State: Cleared.</h4><p class="f-12 alert-message pull-left"></p><p class="pull-right"></p></div></div>';
		    setTimeout(function() {
		        	generateError(notifContent);
		    }, 100);
    	}
		 // document.getElementById("device"+did+"").style.opacity=0;
		 document.getElementById("device"+did+"").style.display='none';
		 document.getElementById("numberofrows").innerHTML=document.getElementById("numberofrows").innerHTML-1;
		 if(document.getElementById("numberofrows").innerHTML=="0")
		 {
		 	document.getElementById("checkoutButtons").innerHTML="<a href='deviceList.php'  style='width:100%;' class='btn btn-success'>Checkout!</a>";
		 }
	}
	else
	{
		alert("Please try again later!");	
		
	}
}
}

function clearAll()
{
	//alert (deviceid);
	xmlhttp=GetXmlHttpObject();
	if (xmlhttp==null)
	{
	alert ("Browser does not support HTTP Request");
	return;
	}

	if(document.getElementById("devicelist").innerHTML!="")
	{
		var url = "./includes/ajax.php";
		url = url + "?func=clearall";
		url=url+"&sid="+Math.random();
		xmlhttp.onreadystatechange=clearAll_callback;
		xmlhttp.open("GET",url,true);
		xmlhttp.send(null);
	}
	else 
	{
		alert ("Please try again!");
	}
	
}
	
function clearAll_callback()
{
if (xmlhttp.readyState==4)
{
	var response= xmlhttp.responseText;
	//alert(response);
	if(response!="Error")
	{
		notifContent = '<div class="alert alert-dark media fade in bd-0" style="background:#00921C;" id="message-alert"><div class="media-body width-100p"><h4 class="alert-title f-14">All Devices Cleared!</h4><p class="f-12 alert-message pull-left"></p><p class="pull-right"></p></div></div>';
    setTimeout(function() {
        	generateError(notifContent);
    }, 100);
		 
		 document.getElementById("devicelist").innerHTML="";

		 document.getElementById("checkoutButtons").innerHTML="<a href='deviceList.php'  style='width:100%;' class='btn btn-success'>Checkout!</a>";
	}
	else
	{
		alert("Please try again later!");	
		
	}
}
}

/////////////////////////////////////////////////// send email for registration

function registrationmail()
{
	alert ("sending email");
	did=deviceid;
	var fullname=document.getElementById("fullname").value;
    var employee=document.getElementById("employee").value;
    var email=document.getElementById("email").value;
    var persoemail=document.getElementById("persoemail").value;
    var birthdate=document.getElementById("birthdate").value;
    var desig=document.getElementById("desig").value;
    var company=document.getElementById("company").value;
    var password=document.getElementById("password").value;
    // var password2=document.getElementById("password2").value;
    // var verify=document.getElementById("verify").value;
	xmlhttp=GetXmlHttpObject();
	if (xmlhttp==null)
	{
	alert ("Browser does not support HTTP Request");
	return;
	}

	if(deviceid!=null)
	{
		var url = "./includes/ajax.php";
		url = url + "?func=registrationmail&did="+deviceid;
		url=url+"&sid="+Math.random();
		xmlhttp.onreadystatechange=registrationmail_callback;
		xmlhttp.open("GET",url,true);
		xmlhttp.send(null);
		//alert(url)
		
	}
	else 
	{
		alert ("Please try again!");
	}
}

function registrationmail_callback()
{
if (xmlhttp.readyState==4)
{
	var response= xmlhttp.responseText;
	//alert (response+"checkout callback");
	if(response!="Error")
	{
		notifContent = '<div class="alert alert-dark media fade in bd-0" style="background:#00921C;" id="message-alert"><div class="media-body width-100p"><h4 class="alert-title f-14">Device Clear Successful!</h4><p class="f-12 alert-message pull-left"></p><p class="pull-right"><a href="#" class="f-12" >&nbsp Dismiss</a></p></div></div>';
    setTimeout(function() {
        	generateError(notifContent);
    }, 100);
		 
		 document.getElementById("device"+did+"").innerHTML=response;
		 document.getElementById("clearbttn"+did+"").style.display="none";
	}
	else
	{
		alert("Please try again later!");	
		
	}
}
}

//////////////////////////////////////////////////  signing up

function existingCompany()
{
	xmlhttp=GetXmlHttpObject();
	if (xmlhttp==null)
	{
		alert ("Browser does not support HTTP Request");
		return;
	}

	var company=document.getElementById("company").value;
	var url = "./includes/ajax.php";
	url = url + "?func=existingCompany&company="+company;
	url=url+"&sid="+Math.random();
	xmlhttp.onreadystatechange=existingCompany_callback;
	xmlhttp.open("GET",url,true);
	xmlhttp.send(null);	
}

function existingCompany_callback()
{
if (xmlhttp.readyState==4)
{
	var response= xmlhttp.responseText;
	if(response=="success")
	{
		signup();
	}
	else
	{
		notifContent = '<div class="alert alert-dark media fade in bd-0" style="background:#920000;" id="message-alert"><div class="media-body width-100p"><h4 class="alert-title f-14">Company already exists!</h4><p class="f-12 alert-message pull-left">Search your company and signup instead!</p><p class="pull-right"><a href="#" class="f-12" >&nbsp Dismiss</a></p></div></div>';
    setTimeout(function() {
        if (!$('#quickview-sidebar').hasClass('open') && !$('.page-content').hasClass('page-builder') && !$('.morphsearch').hasClass('open')) generateError(notifContent);
    }, 100);
	}
	
}
}

function existingMail()
{
	xmlhttp=GetXmlHttpObject();
	if (xmlhttp==null)
	{
		alert ("Browser does not support HTTP Request");
		return;
	}

	var email=document.getElementById("email").value;
	var url = "./includes/ajax.php";
	url = url + "?func=existingMail&email="+email;
	url=url+"&sid="+Math.random();
	xmlhttp.onreadystatechange=existingMail_callback;
	xmlhttp.open("GET",url,true);
	xmlhttp.send(null);	
}

function existingMail_callback()
{
if (xmlhttp.readyState==4)
{
	var response= xmlhttp.responseText;
	if(response=="success")
	{
		signup();
	}
	else
	{
		notifContent = '<div class="alert alert-dark media fade in bd-0" style="background:#920000;" id="message-alert"><div class="media-body width-100p"><h4 class="alert-title f-14">Email address already exists!</h4><p class="f-12 alert-message pull-left">Please try another email or login!</p><p class="pull-right"><a href="#" class="f-12" >&nbsp Dismiss</a></p></div></div>';
    setTimeout(function() {
        if (!$('#quickview-sidebar').hasClass('open') && !$('.page-content').hasClass('page-builder') && !$('.morphsearch').hasClass('open')) generateError(notifContent);
    }, 100);
	}
	
}
}

// make this function call back if the email doesn't already exists
function signup()
{
	var todo=document.getElementById("todo").value;
    xmlhttp=GetXmlHttpObject();
    if (xmlhttp==null)
    {
    alert ("Browser does not support HTTP Request");
    return;
    }
    var fullname=document.getElementById("fullname").value;
    var employee=document.getElementById("employee").value;
    var email=document.getElementById("email").value;
    var persoemail=document.getElementById("persoemail").value;
    var birthdate=document.getElementById("birthdate").value;
    var desig=document.getElementById("desig").value;
    var team=document.getElementById("team").value;
    var password=document.getElementById("password").value;

    if(fullname!="" && employee!="" && email!="" && persoemail!="" && birthdate!="" && birthdate!="" && desig!="" &&  password!="" )
    {
    	if(todo=="sendmail")
		{
			//alert("sendingmail");
			var url = "./includes/ajax.php";
        	url = url + "?func=registrationmail&fullname="+fullname+"&employee="+employee+"&email="+email+"&persoemail="+persoemail+"&birthdate="+birthdate+"&desig="+desig+"&password="+password;
        	// +"&verify="+verify;
	        url=url+"&sid="+Math.random();
	        xmlhttp.onreadystatechange=signup_callback;
	        xmlhttp.open("GET",url,true);
	        xmlhttp.send(null);
		}
		else if (todo=="addnewuser")
		{
			//alert ("add new user");

			document.getElementById("adduserbutton").style.display="none";
			var team=document.getElementById("team").value;
			var url = "./includes/ajax.php";
        	url = url + "?func=signupuser&fullname="+fullname+"&employee="+employee+"&email="+email+"&persoemail="+persoemail+"&birthdate="+birthdate+"&desig="+desig+"&password="+password+"&team="+team;
	        url=url+"&sid="+Math.random();
	        xmlhttp.onreadystatechange=signup_callback;
	        xmlhttp.open("GET",url,true);
	        xmlhttp.send(null);
		}
		else if (todo=="register")
		{
			document.getElementById("addadminbutton").style.display="none";
			var company=document.getElementById("company").value;
			// alert ("add new user");
			var url = "./includes/ajax.php";
        	url = url + "?func=signupmain&fullname="+fullname+"&employee="+employee+"&email="+email+"&persoemail="+persoemail+"&birthdate="+birthdate+"&desig="+desig+"&company="+company+"&password="+password;
        	// +"&verify="+verify;
	        url=url+"&sid="+Math.random();
	        xmlhttp.onreadystatechange=signup_callback;
	        xmlhttp.open("GET",url,true);
	        xmlhttp.send(null);
		}
		// when admin updates user profile
		
        
    }
    
}



function signup_callback()
{
if (xmlhttp.readyState==4)
{
    var response= xmlhttp.responseText;
    if(response=="emailsuccess")
    {
        alert("We'll send you an confirmation email when your account is ready to use!");
         
    }
    else if(response=="AdminSucccess")
    {
    	notifContent = '<div class="alert alert-dark media fade in bd-0" style="background:#00921C;" id="message-alert"><div class="media-body width-100p"><h4 class="alert-title f-14">User has been created.</h4><p class="f-12 alert-message pull-left"></p>Please wait for an email verification.<p class="pull-right"></p></div></div>';
    setTimeout(function() {
        if (!$('#quickview-sidebar').hasClass('open') && !$('.page-content').hasClass('page-builder') && !$('.morphsearch').hasClass('open')) generateError(notifContent);
    }, 100);

    setTimeout(function() {
        	window.location.href="index.php";
    }, 1200);
    }
    else if(response=="UserSucccess")
    {
    	notifContent = '<div class="alert alert-dark media fade in bd-0" style="background:#00921C;" id="message-alert"><div class="media-body width-100p"><h4 class="alert-title f-14">User has been created.</h4><p class="f-12 alert-message pull-left"></p>You can now sign in.<p class="pull-right"></p></div></div>';
    setTimeout(function() {
        if (!$('#quickview-sidebar').hasClass('open') && !$('.page-content').hasClass('page-builder') && !$('.morphsearch').hasClass('open')) generateError(notifContent);
    }, 100);

    setTimeout(function() {
        	window.location.href="index.php";
    }, 1200);
    }
    else
    {
        notifContent = '<div class="alert alert-dark media fade in bd-0" style="background:#920000;" id="message-alert"><div class="media-body width-100p"><h4 class="alert-title f-14">Could not complete your request!</h4><p class="f-12 alert-message pull-left">Please try again later!</p><p class="pull-right"><a href="#" class="f-12" >&nbsp Dismiss</a></p></div></div>';
    setTimeout(function() {
        if (!$('#quickview-sidebar').hasClass('open') && !$('.page-content').hasClass('page-builder') && !$('.morphsearch').hasClass('open')) generateError(notifContent);
    }, 100);
    }
}
}

//////////////////////////////////// update profile
function PinCheck_upateprofile()
{
	var pin=document.getElementById("pin").value;
	// if pin does not needs to be chaged set pinchanged=0
	var pinchanged=document.getElementById("pinchanged").value;
	if(pinchanged=="1")
	{
		//alert("Pin was changed");
		//if user PIN is unique
		//updateProfile(1);
		//if user PIN is already being used
		//exit; with an error.
		//alert(pin.length);
		if(pin.length==5)
		{
			var url = "./includes/ajax.php";
			url = url + "?func=pincheck&pin="+pin;
			url=url+"&sid="+Math.random();
			xmlhttp.onreadystatechange=PinCheck_upateprofile_callback;
			xmlhttp.open("GET",url,true);
			xmlhttp.send(null);
		}
		else
		{
			notifContent = '<div class="alert alert-dark media fade in bd-0" style="background:#920000;" id="message-alert"><div class="media-body width-100p"><h4 class="alert-title f-14">Your PIN must be 5 Digits.</h4><p class="f-12 alert-message pull-left"></p><p class="pull-right"></p></div></div>';
    setTimeout(function() {
        if (!$('#quickview-sidebar').hasClass('open') && !$('.page-content').hasClass('page-builder') && !$('.morphsearch').hasClass('open')) generateError(notifContent);
    }, 100);

		}
	}
	else
	{
		//alert("Pin was not chaged");
		updateProfile(0);
	}
}

function PinCheck_upateprofile_callback()
{
if (xmlhttp.readyState==4)
{
	var response= xmlhttp.responseText;
	if(response=="Alraedy Exists")
	{
		notifContent = '<div class="alert alert-dark media fade in bd-0" style="background:#920000;" id="message-alert"><div class="media-body width-100p"><h4 class="alert-title f-14">Please select a unique PIN.</h4><p class="f-12 alert-message pull-left"></p><p class="pull-right"></p></div></div>';
    setTimeout(function() {
        if (!$('#quickview-sidebar').hasClass('open') && !$('.page-content').hasClass('page-builder') && !$('.morphsearch').hasClass('open')) generateError(notifContent);
    }, 100);
	}
	else
	{
		updateProfile(1);
	}
}
}

function updateProfile(pinchanged)
{
	// var frmvalidator = new Validator("formavatar");
 // frmvalidator.addValidation("fullname","req","Please enter your First Name");
	//  alert("test");
	var fullname=document.getElementById("fullname").value;
    var employee=document.getElementById("employee").value;
    var persoemail=document.getElementById("persoemail").value;
    var birthdate=document.getElementById("birthdate").value;
    var desig=document.getElementById("desig").value;
    var team=document.getElementById("team").value;
    var password=document.getElementById("password").value;
    var paschng=document.getElementById("passwordchanged").value;
    var pin=document.getElementById("pin").value;
    //var pinchanged=document.getElementById("pinchanged").value;

    if(fullname!="" && employee!="" && birthdate!="" && desig!="" && team!="")
    {

		var url = "./includes/ajax.php";
			url = url + "?func=updateuser&fullname="+fullname+"&employee="+employee+"&persoemail="+persoemail+"&birthdate="+birthdate+"&desig="+desig+"&team="+team+"&password="+password+"&paschng="+paschng+"&pin="+pin+"&pinchng="+pinchanged;
			url=url+"&sid="+Math.random();
			xmlhttp.onreadystatechange=updateProfile_callback;
			xmlhttp.open("GET",url,true);
			xmlhttp.send(null);
    }
    else
    {
    	notifContent = '<div class="alert alert-dark media fade in bd-0" style="background:#920000;" id="message-alert"><div class="media-body width-100p"><h4 class="alert-title f-14">Please do not leave field(s) empty</h4><p class="f-12 alert-message pull-left"></p><p class="pull-right"></p></div></div>';
			    setTimeout(function() {
			        if (!$('#quickview-sidebar').hasClass('open') && !$('.page-content').hasClass('page-builder') && !$('.morphsearch').hasClass('open')) generateError(notifContent);
			    }, 100);
    }

	
}

function updateProfile_callback()
{
if (xmlhttp.readyState==4)
{
	var response= xmlhttp.responseText;
	if(response=="UserSucccess")
	{
		notifContent = '<div class="alert alert-dark media fade in bd-0" style="background:#00921C;" id="message-alert"><div class="media-body width-100p"><h4 class="alert-title f-14">Profile update Success.</h4><p class="f-12 alert-message pull-left"></p><p class="pull-right"></p></div></div>';
    setTimeout(function() {
        if (!$('#quickview-sidebar').hasClass('open') && !$('.page-content').hasClass('page-builder') && !$('.morphsearch').hasClass('open')) generateError(notifContent);
    }, 100);
	}
	else
	{
		//window.location = "dashboard.php";
		alert(response);
	}
}
}

//////////////////////////////////// update User through admin

function adminupdateUser()
{
	//  alert("test");
	var fullname=document.getElementById("fullname").value;
    var employee=document.getElementById("employee").value;
    var persoemail=document.getElementById("persoemail").value;
    var birthdate=document.getElementById("birthdate").value;
    var desig=document.getElementById("desig").value;
    var team=document.getElementById("team").value;
    var password=document.getElementById("password").value;
    var paschng=document.getElementById("passwordchanged").value;
    var eid=document.getElementById("eid").value;
    //alert(paschng);

    if(fullname!="" && employee!="" && persoemail!="" && birthdate!="" && desig!="" && team!="")
    {

		var url = "./includes/ajax.php";
			url = url + "?func=adminupdateUser&fullname="+fullname+"&employee="+employee+"&persoemail="+persoemail+"&birthdate="+birthdate+"&desig="+desig+"&team="+team+"&password="+password+"&paschng="+paschng+"&eid="+eid;
			url=url+"&sid="+Math.random();
			xmlhttp.onreadystatechange=adminupdateUser_callback;
			xmlhttp.open("GET",url,true);
			xmlhttp.send(null);
    }
    else
    {
    	notifContent = '<div class="alert alert-dark media fade in bd-0" style="background:#920000;" id="message-alert"><div class="media-body width-100p"><h4 class="alert-title f-14">Please do not leave field(s) empty</h4><p class="f-12 alert-message pull-left"></p><p class="pull-right"></p></div></div>';
			    setTimeout(function() {
			        if (!$('#quickview-sidebar').hasClass('open') && !$('.page-content').hasClass('page-builder') && !$('.morphsearch').hasClass('open')) generateError(notifContent);
			    }, 100);
    }

	
}

function adminupdateUser_callback()
{
if (xmlhttp.readyState==4)
{
	var response= xmlhttp.responseText;
	//alert(response);
	if(response=="UserSucccess")
	{
		notifContent = '<div class="alert alert-dark media fade in bd-0" style="background:#00921C;" id="message-alert"><div class="media-body width-100p"><h4 class="alert-title f-14">Profile update Success.</h4><p class="f-12 alert-message pull-left"></p><p class="pull-right"></p></div></div>';
    setTimeout(function() {
        if (!$('#quickview-sidebar').hasClass('open') && !$('.page-content').hasClass('page-builder') && !$('.morphsearch').hasClass('open')) generateError(notifContent);
    }, 100);
	}
	else
	{
		//window.location = "dashboard.php";
		
	}
}
}

///////////////////////////////////////////////////// view edit device page without showing data in link
function editDevice(deviceid)
{
	//alert (deviceid);
	//did=deviceid;
	xmlhttp=GetXmlHttpObject();
	if (xmlhttp==null)
	{
	alert ("Browser does not support HTTP Request");
	return;
	}

	if(deviceid!=null)
	{
		var url = "./includes/ajax.php";
		url = url + "?func=editDevice&did="+deviceid;
		url=url+"&sid="+Math.random();
		xmlhttp.onreadystatechange=editDevice_callback;
		xmlhttp.open("GET",url,true);
		xmlhttp.send(null);
		//alert(url)
		
	}
	else 
	{
		alert ("Please try again!");
	}
	
}
	
function editDevice_callback()
{
if (xmlhttp.readyState==4)
{
	var response= xmlhttp.responseText;
	if(response!="unauthorized")
	{
		window.location = "editDevice.php";	
	}
	else
	{
		window.location = "dashboard.php";
		
	}
}
}

///////////////////////////////////////////////////// view edit user page without showing data in link
function editUser(userid)
{
	//alert (deviceid);
	//did=deviceid;
	xmlhttp=GetXmlHttpObject();
	if (xmlhttp==null)
	{
	alert ("Browser does not support HTTP Request");
	return;
	}

	if(userid!=null)
	{
		var url = "./includes/ajax.php";
		url = url + "?func=editUser&eid="+userid;
		url=url+"&sid="+Math.random();
		xmlhttp.onreadystatechange=editUser_callback;
		xmlhttp.open("GET",url,true);
		xmlhttp.send(null);
		//alert(url)
		
	}
	else 
	{
		alert ("Please try again!");
	}
	
}
	
function editUser_callback()
{
if (xmlhttp.readyState==4)
{
	var response= xmlhttp.responseText;
	if(response!="unauthorized")
	{
		window.location = "mod.php";	
	}
	else
	{
		window.location = "dashboard.php";
		
	}
}
}

///////////////////////////////////////////////////// update data for device

function updateDevice(deviceid)
{
	xmlhttp=GetXmlHttpObject();
	if (xmlhttp==null)
	{
	alert ("Browser does not support HTTP Request");
	return;
	}
	var devicename=document.getElementById("devicename").value;
	var deviceos=document.getElementById("deviceos").value;
	var osversion=document.getElementById("osversion").value;
	var resolution=document.getElementById("resolution").value;
	var vendor=document.getElementById("vendor").value;
	var priority=document.getElementById("priority").value;
	var imei=document.getElementById("imei").value;
	var udid=document.getElementById("udid").value;
	var deviceactive=document.getElementById("active").value;

	if(devicename != "" && deviceos !="" && osversion!="")
	{
		var url = "./includes/ajax.php";
		url = url + "?func=updateDevice&deviceos="+deviceos+"&osversion="+osversion+"&resolution="+resolution+"&vendor="+vendor+"&priority="+priority+"&imei="+imei+"&udid="+udid+"&did="+deviceid+"&deviceactive="+deviceactive;
		url=url+"&sid="+Math.random();
		xmlhttp.onreadystatechange=updateDevice_callback;
		xmlhttp.open("POST",url,true);
		xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xmlhttp.send("devicename="+devicename);


		// alert(url);
		
	}
	else
		{
			notifContent = '<div class="alert alert-dark media fade in bd-0" style="background:#920000;" id="message-alert"><div class="media-body width-100p"><h4 class="alert-title f-14">Please do not leave field(s) empty</h4><p class="f-12 alert-message pull-left"></p><p class="pull-right"></p></div></div>';
			    setTimeout(function() {
			        if (!$('#quickview-sidebar').hasClass('open') && !$('.page-content').hasClass('page-builder') && !$('.morphsearch').hasClass('open')) generateError(notifContent);
			    }, 100);
		}
	
}
	
function updateDevice_callback()
{
	if (xmlhttp.readyState==4)
	{
		var response= xmlhttp.responseText;
		// alert(response);
		if(response=="success")
		{
			//refresh page
			//window.location.href="editDevice.php";
			notifContent = '<div class="alert alert-dark media fade in bd-0" style="background:#00921C;" id="message-alert"><div class="media-body width-100p"><h4 class="alert-title f-14">Update Success.</h4><p class="f-12 alert-message pull-left"></p><p class="pull-right"></p></div></div>';
    setTimeout(function() {
        if (!$('#quickview-sidebar').hasClass('open') && !$('.page-content').hasClass('page-builder') && !$('.morphsearch').hasClass('open')) generateError(notifContent);
    }, 100);
		}
		else
		{
			notifContent = '<div class="alert alert-dark media fade in bd-0" style="background:#920000;" id="message-alert"><div class="media-body width-100p"><h4 class="alert-title f-14">Failure: Please try again later.</h4><p class="f-12 alert-message pull-left"></p><p class="pull-right"></p></div></div>';
	    setTimeout(function() {
	        if (!$('#quickview-sidebar').hasClass('open') && !$('.page-content').hasClass('page-builder') && !$('.morphsearch').hasClass('open')) generateError(notifContent);
	    }, 100);
		}
	}
}

///////////////////////////////////////////////////// add new device

function addDevice()
{
	xmlhttp=GetXmlHttpObject();
	if (xmlhttp==null)
	{
	alert ("Browser does not support HTTP Request");
	return;
	}
	var devicename=document.getElementById("devicename").value;
	var deviceos=document.getElementById("deviceos").value;
	var osversion=document.getElementById("osversion").value;
	var resolution=document.getElementById("resolution").value;
	var vendor=document.getElementById("vendor").value;
	var priority=document.getElementById("priority").value;
	var imei=document.getElementById("imei").value;
	var udid=document.getElementById("udid").value;

	//devicename=devicename.replace("#","/#\##");
	//alert(devicename);
	if(devicename != "" && deviceos !="" && osversion!="")
	{
		var url = "./includes/ajax.php";
		url = url + "?func=addDevice&deviceos="+deviceos+"&osversion="+osversion+"&resolution="+resolution+"&vendor="+vendor+"&priority="+priority+"&imei="+imei+"&udid="+udid;
		url=url+"&sid="+Math.random();
		xmlhttp.onreadystatechange=addDevice_callback;
		xmlhttp.open("POST",url,true);
		xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xmlhttp.send("devicename="+devicename);
		//alert(url);
	}
	else
		{
			notifContent = '<div class="alert alert-dark media fade in bd-0" style="background:#920000;" id="message-alert"><div class="media-body width-100p"><h4 class="alert-title f-14">Please do not leave field(s) empty</h4><p class="f-12 alert-message pull-left"></p><p class="pull-right"></p></div></div>';
			    setTimeout(function() {
			        if (!$('#quickview-sidebar').hasClass('open') && !$('.page-content').hasClass('page-builder') && !$('.morphsearch').hasClass('open')) generateError(notifContent);
			    }, 100);
		}
	
}
	
function addDevice_callback()
{
	if (xmlhttp.readyState==4)
	{
		var response= xmlhttp.responseText;
		//alert(response);
		if(response=="success")
		{
			//refresh page
			//window.location.href="editDevice.php";
			notifContent = '<div class="alert alert-dark media fade in bd-0" style="background:#00921C;" id="message-alert"><div class="media-body width-100p"><h4 class="alert-title f-14">Device added.</h4><p class="f-12 alert-message pull-left"></p><p class="pull-right"></p></div></div>';
    setTimeout(function() {
        if (!$('#quickview-sidebar').hasClass('open') && !$('.page-content').hasClass('page-builder') && !$('.morphsearch').hasClass('open')) generateError(notifContent);
    }, 100);
		}
		else
		{
			notifContent = '<div class="alert alert-dark media fade in bd-0" style="background:#920000;" id="message-alert"><div class="media-body width-100p"><h4 class="alert-title f-14">Failure: Please try again later.</h4><p class="f-12 alert-message pull-left"></p><p class="pull-right"></p></div></div>';
	    setTimeout(function() {
	        if (!$('#quickview-sidebar').hasClass('open') && !$('.page-content').hasClass('page-builder') && !$('.morphsearch').hasClass('open')) generateError(notifContent);
	    }, 100);
		}
	}
}

///////////////////////////////////////////////////// deactivate user
function deactivateUser(userid,state)
{
	//alert (deviceid);
	xmlhttp=GetXmlHttpObject();
	if (xmlhttp==null)
	{
	alert ("Browser does not support HTTP Request");
	return;
	}

	if(userid!=null && state!=null)
	{
		var url = "./includes/ajax.php";
		url = url + "?func=deactivateUser&eid="+userid+"&state="+state;
		url=url+"&sid="+Math.random();
		xmlhttp.onreadystatechange=deactivateUser_callback;
		xmlhttp.open("GET",url,true);
		xmlhttp.send(null);
		//alert(url)
		
	}
	else 
	{
		alert ("Please try again!");
	}
	
}
	
function deactivateUser_callback()
{
if (xmlhttp.readyState==4)
{
	var response= xmlhttp.responseText;
	//alert (response);
	if(response!="Error")
	{
		notifContent = '<div class="alert alert-dark media fade in bd-0" style="background:#00921C;" id="message-alert"><div class="media-body width-100p"><h4 class="alert-title f-14">User state changed successfully.</h4><p class="f-12 alert-message pull-left"></p><p class="pull-right"></p></div></div>';
    

    setTimeout(function() {
        	location.reload();
    }, 1200);
    setTimeout(function() {
        	generateError(notifContent);
    }, 100);
		 

	}
	else
	{
		notifContent = '<div class="alert alert-dark media fade in bd-0" style="background:#920000;" id="message-alert"><div class="media-body width-100p"><h4 class="alert-title f-14">Failure: Unable to change user status.</h4><p class="f-12 alert-message pull-left"></p><p class="pull-right"></p></div></div>';
    setTimeout(function() {
        	generateError(notifContent);
    }, 100);
		
	}
}
}

///////////////////////////////////////////////  set session for current company

function setCompanysession(comId)
{
	xmlhttp=GetXmlHttpObject();
	if (xmlhttp==null)
	{
	alert ("Browser does not support HTTP Request");
	return;
	}

	var url = "./includes/ajax.php";
	url = url + "?func=setCompanysession&comId="+comId;
	url=url+"&sid="+Math.random();
	xmlhttp.onreadystatechange=setCompanysession_callback;
	xmlhttp.open("GET",url,true);
	xmlhttp.send(null);	
}

function setCompanysession_callback()
{
if (xmlhttp.readyState==4)
{
	var response= xmlhttp.responseText;
	if(response=="success")
	{
		location.reload();
	}
	
}
}


///////////////////////////////////////////////  send sample mail

function sampleMail()
{
	xmlhttp=GetXmlHttpObject();
	if (xmlhttp==null)
	{
	alert ("Browser does not support HTTP Request");
	return;
	}

	var url = "./includes/ajax.php";
	url = url + "?func=sendmail";
	url=url+"&sid="+Math.random();
	xmlhttp.onreadystatechange=sampleMail_callback;
	xmlhttp.open("GET",url,true);
	xmlhttp.send(null);	
}

function sampleMail_callback()
{
if (xmlhttp.readyState==4)
{
	var response= xmlhttp.responseText;
	if(response=="sent")
	{
		// location.reload();
		//alert("mail sent");
	}
	
}
}



//////////////////////// field validator function

// function field_validator()
// {
// 	// validating fields - make a separate function #todo
// 	if(fullname=="")
// 	{
// 		document.getElementById("fullname-error").style.display="inline";
// 	}
// 	else
// 	{
// 		document.getElementById("fullname-error").style.display="none";
// 	}
// 	if(employee=="")
// 	{
// 		document.getElementById("employee-error").style.display="inline";
// 	}
// 	else
// 	{
// 		document.getElementById("employee-error").style.display="none";
// 	}
// 	if(email=="")
// 	{
// 		document.getElementById("email-error").style.display="inline";
// 	}
// 	else
// 	{
// 		document.getElementById("email-error").style.display="none";
// 	}
// 	// if(persoemail=="")
// 	// {
// 	// 	document.getElementById("persoemail-error").style.display="inline";
// 	// }
// 	// else
// 	// {
// 	// 	document.getElementById("persoemail-error").style.display="none";
// 	// }
// 	if(birthdate=="")
// 	{
// 		document.getElementById("birthdate-error").style.display="inline";
// 	}
// 	else
// 	{
// 		document.getElementById("birthdate-error").style.display="none";
// 	}
// 	if(company=="")
// 	{
// 		document.getElementById("company-error").style.display="inline";
// 	}
// 	else
// 	{
// 		document.getElementById("company-error").style.display="none";
// 	}
// 	if(desig=="")
// 	{
// 		document.getElementById("desig-error").style.display="inline";
// 	}
// 	else
// 	{
// 		document.getElementById("desig-error").style.display="none";
// 	}
// 	if(password=="")
// 	{
// 		document.getElementById("password-error").style.display="inline";
// 	}
// 	else
// 	{
// 		document.getElementById("password-error").style.display="none";
// 	}
// 	if(todo=="addnewuser")
// 	{
		
// 		if(password2=="")
//     	{
//     		document.getElementById("password2-error").style.display="inline";
//     	}
//     	else
//     	{
//     		document.getElementById("password2-error").style.display="none";
//     	}
//     	if(password2!=password)
//     	{
//     		document.getElementById("password2-error").style.display="inline";
//     		document.getElementById("password2-error").innerHTML="Passwords do not match"
//     	}
//     	else
//     	{
//     		document.getElementById("password2-error").style.display="none";
//     	}
// 	}
// }