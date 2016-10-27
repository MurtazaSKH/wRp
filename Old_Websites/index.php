<!DOCTYPE html>
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="en-US"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="en-US"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en-US">  <!--<![endif]-->
	<head>
	
		<title>we.R.play | Home</title>
		
		<!-- META DATA -->
		<meta http-equiv="content-type" content="text/html;charset=UTF-8">
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<meta name="description" content="">
		<meta name="keywords" content="">
		<meta name="author" content="">
		
		<!-- CSS Global Compulsory -->
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="stylesheet" href="style.css" >
		
		<!-- CSS Implementing Plugins -->
		<link rel="stylesheet" href="css/jquery.fullPage.css">
		<link rel="stylesheet" href="css/font-awesome.min.css">
		<link rel="stylesheet" href="css/ionicons.min.css">
		<link rel="stylesheet" href="css/animate.min.css">
		<link rel="stylesheet" href="css/flexslider.css">

		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
			<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
			<script src="js/respond.min.js"></script>
		<![endif]-->
		
		<!--[if lt IE 11]>
			<link rel="stylesheet" type="text/css" href="css/ie.css">
		<![endif]-->
		
		<!-- FONTS -->
		<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,700italic,400,300,700&amp;subset=latin,latin-ext' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Raleway:100,200,300,400,700,900' rel='stylesheet' type='text/css'>
		
		<!-- JS -->
		<script type="text/javascript" src="js/modernizr.js"></script>
		
		<!-- FAVICONS -->
		<link rel="shortcut icon" href="images/favicon.ico">
		<!--<link rel="apple-touch-icon" href="images/apple-touch-icon.png">
		<link rel="apple-touch-icon" sizes="72x72" href="images/apple-touch-icon-72x72.png">
		<link rel="apple-touch-icon" sizes="114x114" href="images/apple-touch-icon-114x114.png">-->
		<script src='https://www.google.com/recaptcha/api.js'></script>
	
	</head>
    <style>
    
	#nav-trigger {
  display: none;
  text-align: center; }
  #nav-trigger span {
    display: inline-block;
    padding: 4px 12px;
    border: 1px solid white;
    color: white;
    cursor: pointer;
    text-transform: uppercase; }
    #nav-trigger span:after {
      display: inline-block;
      margin-left: 10px;
      width: 20px;
      height: 10px;
      content: "";
      border-left: solid 10px transparent;
      border-top: solid 10px #fff;
      border-right: solid 10px transparent; }
    #nav-trigger span:hover {
      /*background-color: #e6002d;*/ }
    #nav-trigger span.open:after {
      border-left: solid 10px transparent;
      border-top: none;
      border-bottom: solid 10px #fff;
      border-right: solid 10px transparent; }

nav {
  margin-bottom: 30px; }

nav#nav-main {
  background-color: #ff0032;
  opacity:0.5;
  padding: 10px 0; }
  nav#nav-main ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    text-align: center; }
  nav#nav-main li {
    display: inline-block;
    border-right: solid 1px #cc0028;
    padding: 0 5px; }
    nav#nav-main li:last-child {
      border-right: none; }
  nav#nav-main a {
    display: block;
    color: white;
    padding: 10px 30px; }
    nav#nav-main a:hover {
      background-color: #e6002d;
      color: #fff; }

nav#nav-mobile {
  position: relative;
  display: none; }
  nav#nav-mobile ul {
    display: none;
    list-style-type: none;
    position: absolute;
    left: 0;
    right: 0;
    margin-left: auto;
    margin-right: auto;
    text-align: center;
    background-color: #ff0032;
	opacity:0.5; }
  nav#nav-mobile li {
    display: block;
    padding: 5px 0;
    margin: 0 5px;
    border-bottom: solid 1px #cc0028; }
    nav#nav-mobile li:last-child {
      border-bottom: none; }
  nav#nav-mobile a {
    display: block;
    color: white;
    padding: 10px 30px; }
    nav#nav-mobile a:hover {
      background-color: #e6002d;
	  opacity:0.5;
      color: #fff; }

/* =Media Queries
-------------------------------------------------------------- */
@media all and (max-width: 900px) {
  #nav-trigger {
    display: block; }

  nav#navigation {
    display: none; }

  nav#nav-mobile {
    display: block; }
	
	
}
	
    </style>
    
    <?php echo "<script language='JavaScript' src='js/temp.js' type='text/javascript'></script>";  ?>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
	
    
	<body class="image-background" style="overflow:hidden; height:100%;">
	
		<!-- START PRELOADER -->
		<!--<div id="preloader">
			<div id="loading-animation">&nbsp;</div>
		</div>-->
		<!-- END PRELOADER -->
		
		<!-- START SITE HEADER -->
		<header class="site-header">
			<div class="site-logo onstart animated" data-animation="fadeInDown" data-animation-delay="1200">
				<img src="images/logo.png" alt="" />
			</div>
			<!-- START NAVIGATION -->
			<nav id="navigation" class="navigation site-nav">
				<div class="nav-container">
					<ul class="onstart animated" id="menu" data-animation="fadeInDown" data-animation-delay="200">
						<li class="active" data-menuanchor="home"><a href="#home" class="active">Home</a></li>
						<li data-menuanchor="services"><a href="#services">Services</a></li>										
                        <li ><a href="http://portfolio.werplay.com/">Porfolio</a></li>
                        <li ><a href="http://press.werplay.com/">Press</a></li>
                        <li data-menuanchor="about"><a href="#about">About</a></li>
                        <li data-menuanchor="contactus"><a href="#contactus">Contact</a></li>
					</ul>
				</div>
			</nav>
            <!--<nav id="nav-main">
                <ul>
                    <li><a href="">Home</a></li>
                    <li><a href="">About</a></li>
                    <li><a href="">Gallery</a></li>
                    <li><a href="">Tutorials</a></li>
                    <li><a href="">Contact</a></li>
                </ul>
            </nav>-->
            <div id="nav-trigger">
                <span>Menu</span>
            </div>
            <nav id="nav-mobile"></nav>
			<!-- END NAVIGATION -->
		</header>
		<!-- END SITE HEADER -->

		<div id="fullpage">
							
			<!-- HOME SECTION -->
			<div class="section home active" id="section0">
				<!-- START CONTAINER -->
				<div class="container">
					<div class="row">
						<div class="col-md-10 col-md-offset-1">
							<!-- START SLIDE CONTENT-->
							<div class="slide-content">
								<div class="flexslider textslider onstart animated" data-animation="fadeInUp" data-animation-delay="800">
									<ul class="slides">
										<li>
											<h1 class="rotate uppercase">A <span class="font-normal">gaming</span> studio located in the heart of <div style="float:right; width:90px;"><img src="images/paki_temp.png" width="10%" alt="" /></div><span class="font-normal">Pakistan </span></h1>
										</li>
										<li>
											<h1 class="rotate uppercase">We <span class="font-normal">love</span> what we do and you’ll <span class="font-normal">love</span> it too!</h1>
										</li>
                                        <li>
											<h1 class="rotate uppercase"><a class="vimeo" href="https://player.vimeo.com/video/118679587"><div style="margin:0px auto; width:30%;"><img src="images/temp.png" alt="" /></div></a>
                                            <div style="font-size:58px;">Our Portfolio</div></h1>
										</li>
										
									</ul>
								</div><br>
								<!--<p class="lead onstart animated" data-animation="fadeInUp" data-animation-delay="1000" ><a style="color:#FFF;" href="http://portfolio.werplay.com/">View our Porfolio</a></p>-->
								<!--<a href="#" class="border-button bt-border-white go-slide onstart animated" data-animation="fadeInUp" data-animation-delay="1200" data-slide="2">Subscribe</a>
								<a href="#" class="default-button bt-transparent go-slide onstart animated" data-animation="fadeInUp" data-animation-delay="1200" data-slide="3">Learn more <i class="fa fa-angle-down"></i></a>-->
                                
							</div><!-- END SLIDE CONTENT-->
						</div>
					</div><!-- END ROW -->
				</div><!-- END CONTAINER -->
			</div>

			<!-- Games SECTION -->
			<div class="section" id="section1">
            	<div class="container">
					<div class="row">
						<div class="col-md-10 col-md-offset-1">
							<!-- START SECTION HEADER -->
							<div class="tour-header">
								<!-- START TITLE -->
								<h2 class="section-title animated" data-animation="fadeInUp">Our Services</h2><!-- END TITLE -->
								<div class="line-separate line-white line-center animated" data-animation="fadeInUp" data-animation-delay="200"><span></span></div>
							</div><!-- END SECTION HEADER -->	
							<!-- START SLIDE CONTENT-->
							<div class="slide-content">
								<p class="animated" data-animation="fadeInUp" data-animation-delay="400">We take pride and passion in our team and believe we have the finest talents available with incredible array of skills. We provide our very own services with a hard working team of artists, animators, developers and testers who are more than willing to contribute to your projects. Their hard work and determination is the reason why many of the world's most popular gaming companies come to us.</p>
								
								<!-- SERVICE -->
								<div class="col-md-4 service animated" data-animation="fadeInLeft" data-animation-delay="800">
									<div class="service-icon">
										<i class="ion-android-checkmark-circle"></i>
									</div>
									<h3>Quality Assurance</h3>
									<p>Bugs got your application? we.R.play has a dedicated team of testers that make sure your apps are bug free and you are stress free. </p>
								</div>
								
								<!-- SERVICE -->
								<div class="col-md-4 service animated" data-animation="fadeInUp" data-animation-delay="600">
									<div class="service-icon">
										<i class="ion-wand"></i>
									</div>
									<h3>Art & Animation</h3>
									<p>We've worked with some of the best in the business and our art work is seen by millions of people everyday across the world on their mobile devices and social networks.</p>
								</div>
								
								<!-- SERVICE -->
								<div class="col-md-4 service animated" data-animation="fadeInRight" data-animation-delay="800">
									<div class="service-icon">
										<i class="ion-images"></i>
									</div>
									<h3>Content Designing</h3>
									<p> When it comes to content, we use pure creativity and develop quests for games so that our users have the most fun filled experience. We make, you play! </p>
								</div>
							
							</div><!-- END SLIDE CONTENT-->
						</div>
					</div><!-- END ROW -->
				</div>
				<!-- START CONTAINER -->
				<!--<div class="container"> Previously Our Games
					<div class="row">
						<div class="col-md-10 col-md-offset-1">
							 START SECTION HEADER 
							<div class="tour-header">
								 START TITLE 
								<h2 class="section-title animated" data-animation="fadeInUp">Our Games</h2> END TITLE 
								<div class="line-separate line-white line-center animated" data-animation="fadeInUp" data-animation-delay="200"><span></span></div>
							</div> END SECTION HEADER 	
							 START SLIDE CONTENT
							<div class="slide-content">
								<p class="animated" data-animation="fadeInUp" data-animation-delay="400">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
								
								 SERVICE 
								<div class="col-md-4 service animated" data-animation="fadeInLeft" data-animation-delay="800">
									<div class="service-icon">
										<i class="ion-ios-book-outline"></i>
									</div>
									<h3>HEX:99</h3>
								</div>
								
								 SERVICE 
								<div class="col-md-4 service animated" data-animation="fadeInUp" data-animation-delay="600">
									<div class="service-icon">
										<i class="ion-ios-speedometer-outline"></i>
									</div>
									<h3>Run Sheeda Run</h3>
								</div>
								
								 SERVICE 
								<div class="col-md-4 service animated" data-animation="fadeInRight" data-animation-delay="800">
									<div class="service-icon">
										<i class="ion-ios-box-outline"></i>
									</div>
									<h3>Scuba Steve</h3>
								</div>
                                
                                 SERVICE 
								<div class="col-md-4 service animated" data-animation="fadeInLeft" data-animation-delay="800">
									<div class="service-icon">
										<i class="ion-ios-book-outline"></i>
									</div>
									<h3>HEX:99</h3>
								</div>
								
								 SERVICE 
								<div class="col-md-4 service animated" data-animation="fadeInUp" data-animation-delay="600">
									<div class="service-icon">
										<i class="ion-ios-speedometer-outline"></i>
									</div>
									<h3>Run Sheeda Run</h3>									
								</div>
								
								 SERVICE 
								<div class="col-md-4 service animated" data-animation="fadeInRight" data-animation-delay="800">
									<div class="service-icon">
										<i class="ion-ios-box-outline"></i>
									</div>
									<h3>Roboquest</h3>									
								</div>
							
							</div> END SLIDE CONTENT
						</div>
					</div> END ROW 
				</div>--><!-- END CONTAINER -->
			</div>
			
			<!-- ABOUT SECTION -->
			<div class="section" id="section2">
				<!-- START CONTAINER -->
				<div class="container">
					<div class="row">
						<div class="col-md-10 col-md-offset-1">
							<!-- START SECTION HEADER -->
							<div class="section-header">
								<!-- START TITLE -->
								<h2 class="section-title animated" data-animation="fadeInUp">About Us</h2><!-- END TITLE -->
								<div class="line-separate line-white line-center animated" data-animation="fadeInUp" data-animation-delay="200"><span></span></div>
							</div><!-- END SECTION HEADER -->	
							<!-- START SLIDE CONTENT-->
							<div class="slide-content animated" data-animation="fadeInUp" data-animation-delay="400">
								<!--<h2 style="text-align: center; font-size:53px; font-weight:bold;"><span style="color: #6ea828;">love</span> <span style="color: #b01f24;">.</span> eat <span style="color: #6a93c3;">.</span> <span style="color: #f8df0a;">work</span> <span style="color: #6ea828;">.</span> <span style="color: #b01f24;">pray</span> <span style="color: #f8df0a;">.</span> <span style="color: #6a93c3;">play</span></h2>-->
                                <p>An awe-inspiring game development studio that holds an arsenal of services at their disposal. Our services range from development, QA testing, arts to content writing. And when we’re not busy putting our hearts into our work, we’re feasting upon scrumptious free food. Because we’re just that awesome.</p>
								<div class="row">
									<div class="col-md-6">
										<!-- START FEATURES-LIST -->
                                        <!-- FEATURE -->
											<div class="feature-item">
												<div class="feature-icon">
													<i class="ion-trophy"></i>
												</div>
												<div class="feature-text">
													<h3>Our Awards</h3>
													<p>Winner of 4 Pasha Awards, Pakistan’s largest IT related award ceremony. Our achievements include Best Startup company, Gender Diversity, Export Growth and Best Mobile application. </p>
												</div>
											</div>
                                            
                                            <!-- FEATURE -->
											<div class="feature-item">
												<div class="feature-icon">
													<i class=" ion-android-contacts"></i>
												</div>
												<div class="feature-text">
													<h3>Our Awesome Team</h3>
													<p>Our team consists of over 100 members. We’re a heap of individuals with a wide array of skillsets. Coding, app-breaking, sketching….you name it, we can do it.</p>
												</div>
											</div>
										<!-- END FEATURES-LIST -->
									</div>
									<div class="col-md-6">
										<!-- START FEATURES-LIST -->
										<div class="features-list">																			
                                            
                                            <!-- FEATURE -->
											<div class="feature-item">
												<div class="feature-icon">
													<i class=" ion-android-contact"></i>
												</div>
												<div class="feature-text">
													<h3>Our Clients</h3>
													<p>We’ve worked with a plethora of clients. Disney, Pocket Gems, Playdom, Zynga and Marvel are just a few of the big names to whom we provide our services. And yes, they all go home very happy!</p>
												</div>
											</div>
											
											<!-- FEATURE -->
											<div class="feature-item">
												<div class="feature-icon">
													<i class=" ion-android-phone-portrait"></i>
												</div>
												<div class="feature-text">
													<h3>Our Products</h3>
													<p>We strive on hard work. Our gaming apps have seen downloads over 100000 with our gaming base ever growing. We like letting our products speak for themselves.
</p>
												</div>
											</div>
											
										</div><!-- END FEATURES-LIST -->
									</div>
								</div>
							</div><!-- END SLIDE CONTENT-->
						</div>
					</div><!-- END ROW -->
				</div><!-- END CONTAINER -->
			</div>
			
			<!-- FEATURES SECTION -->
			<!--<div class="section" id="section3">
				 START CONTAINER 
				 END CONTAINER 
			</div>	-->

			<!-- CONTACT SECTION -->
			<div class="section" id="section4">
				<!-- START CONTAINER -->
				<div class="container">
					<div class="row">
						<div class="col-md-10 col-md-offset-1">
							<!-- START SECTION HEADER -->
							<div class="section-header">
								<!-- START TITLE -->
								<h2 class="section-title animated" data-animation="fadeInUp">Do You Have a Question ?</h2><!-- END TITLE -->
								<div class="line-separate line-white line-center animated" data-animation="fadeInUp" data-animation-delay="200"><span></span></div>
							</div><!-- END SECTION HEADER -->	
							<!-- START SLIDE CONTENT-->
							<div class="slide-content">
								<p class="animated" data-animation="fadeInUp" data-animation-delay="400">Please feel free to Contact us.</p>
								<!-- START CONTACT FORM -->
								<form method="post" action="sendmail.php" class="contact-form">
									<div class="row">
										<div class="col-md-4 animated" data-animation="fadeInUp" data-animation-delay="600">
											<input type="text" id="name" name="name" placeholder="Name" class="required">
										</div><!-- END COLUMN 4 -->
										<div class="col-md-4 animated" data-animation="fadeInUp" data-animation-delay="700">
											<input type="email" id="email" name="email" placeholder="Email address" class="contact-form-email required">
										</div><!-- END COLUMN 4 -->
										<div class="col-md-4 animated" data-animation="fadeInUp" data-animation-delay="800">
											<input type="text" id="subject" name="subject" placeholder="Subject" class="contact-form-subject">
										</div><!-- END COLUMN 4 -->
									</div><!-- END ROW -->
									<textarea name="message" id="message" placeholder="Message" class="required animated" data-animation="fadeInUp" data-animation-delay="900" rows="7"></textarea>
									<div class="response-message"></div>
									
                                    <div class="g-recaptcha" data-sitekey="6LfOFwgTAAAAAPsOyoUfGRzBZhy4FL0RLt08rg41"></div>
                                    <input type="submit" class="border-button animated" data-animation="fadeInUp" data-animation-delay="1000" name="Submit"/>
									<!--<button class="border-button animated" data-animation="fadeInUp" data-animation-delay="1000" type="submit" id="submit" name="submit">Send Message</button>-->
								
                                </form><!-- END CONTACT FORM -->
							</div><!-- END SLIDE CONTENT-->
						</div>
					</div><!-- END ROW -->
				</div><!-- END CONTAINER -->
			</div>
				
		</div>
		
		<!-- START SOCIAL ICONS -->
		<nav class="socials-icons">
			<ul>
				<li class="onstart animated" data-animation="fadeInRightBig" data-animation-delay="800"><a href="https://www.facebook.com/we.R.play"><i class="ion-social-facebook"></i></a></li>
				<li class="onstart animated" data-animation="fadeInRightBig" data-animation-delay="950"><a href="https://twitter.com/werplay"><i class="ion-social-twitter"></i></a></li>
				<li class="onstart animated" data-animation="fadeInRightBig" data-animation-delay="1100"><a href="https://plus.google.com/113291225463287748497"><i class="ion-social-googleplus"></i></a></li>
				<li class="onstart animated" data-animation="fadeInRightBig" data-animation-delay="1250"><a href="http://www.linkedin.com/company/1660632"><i class="ion-social-linkedin"></i></a></li>
				<li class="onstart animated" data-animation="fadeInRightBig" data-animation-delay="1400"><a href="https://vimeo.com/user14630406"><i class="ion-social-vimeo"></i></a></li>
			</ul> 
		</nav>
		<!-- END SOCIAL ICONS -->
		
		<!-- START VIEWPORT BORDER -->
		<div class="viewport-border">
			<!--<div class="vb-l"></div>-->
			<div class="vb-r"></div>
			<div class="vb-t"></div>
			<!--<div class="vb-b"></div>-->
		</div>
		<!-- END VIEWPORT BORDER -->
		
		<!-- OVERLAY -->
		<div class="overlay">
			<div class="gradient-overlay gradient-17 opacity-80"></div>
		</div>

		<!-- JS -->
		<script type="text/javascript" src="js/jquery-1.11.0.min.js"></script>
		<script type="text/javascript" src="js/jquery-migrate-1.2.1.min.js"></script>
		<script type="text/javascript" src="js/bootstrap.min.js"></script>
		<script type="text/javascript" src="js/jquery.appear.js"></script>
		<script type="text/javascript" src="js/jquery.easing.js"></script>
		<script type="text/javascript" src="js/jquery.fullPage.min.js"></script>
		<script type="text/javascript" src="js/jquery.backstretch.min.js"></script>
		<script type="text/javascript" src="js/jquery.waitforimages.js"></script>
		<script type="text/javascript" src="js/retina-1.1.0.min.js"></script>
		<script type="text/javascript" src="js/jquery.countdown.js"></script>
		<script type="text/javascript" src="js/jquery.fitvids.js"></script>
		<script type="text/javascript" src="js/jquery.mb.YTPlayer.js"></script>
		<script type="text/javascript" src="js/jquery.ajaxchimp.js"></script>
		<script type="text/javascript" src="js/jquery.placeholder.js"></script>
		<script type="text/javascript" src="js/jquery.flexslider-min.js"></script>
		<script type="text/javascript" src="js/waypoints.min.js"></script>	
		<script type="text/javascript" src="js/main.js"></script>
		<script type="text/javascript" src="js/temp.js"></script>
        <script type="text/javascript" src="lightbox/jquery.fancybox-1.3.4.pack.js"></script>
		<link rel="stylesheet" type="text/css" href="lightbox/jquery.fancybox-1.3.4.css" media="screen" />
		<script type="text/javascript">
        var $ = jQuery.noConflict();
            $(document).ready(function() {
				document.body.style.overflow="hidden";
                $(".vimeo").fancybox({
                  width: 700,
                  height: 500,
                  type: 'iframe',
                  fitToView : false
				  
                 });
            });
        </script>
	</body>
</html>