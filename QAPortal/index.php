<!DOCTYPE html>
<html>
    <head>
        <!-- BEGIN META SECTION -->
        <meta charset="utf-8">
        <title> Portal | Login</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta content="" name="description" />
        <meta content="themes-lab" name="author" />
        <link rel="shortcut icon" href="assets/images/favicon.ico" type="image/png">
        <!-- END META SECTION -->
        <!-- BEGIN MANDATORY STYLE -->
        <link href="assets/css/style.css" rel="stylesheet">
        <link href="assets/css/ui.css" rel="stylesheet">
        <link href="assets/plugins/bootstrap-loading/lada.min.css" rel="stylesheet">
        <script src="./includes/ajax.js"></script>
        <!-- END  MANDATORY STYLE -->

        
        
    </head>
    <body class="account" data-page="lockscreen">
        <!-- BEGIN LOGIN BOX -->
        <div class="container" id="lockscreen-block">
            <div class="row">
                <div class="col-md-8 col-md-offset-1">
                    <div class="account-wall">
                        <!-- <div class="user-image">
                            <img src="assets/images/profil_page/friend8.jpg" class="img-responsive img-circle" alt="friend 8">
                            <div id="loader"></div>
                        </div> -->

                        <!-- <form class="form-signin" > -->
                            <h2>Welcome!</h2>
                            <p>Enter your Username/Password to view dashboard.</p>
                            <div class="input-group"> 
                                <table>
                                    <td>
                                        <input type="text" class="form-control" name="username" id="username" placeholder="Username"> 
                                    </td>
                                    <td>
                                        <input type="password" class="form-control" name="password" id="password" placeholder="Password" style="    -webkit-border-radius: 0 0 0 0;    -moz-border-radius: 0 0 0 0;    border-radius: 0 0 0 0;"> 
                                    </td>
                                    <td>
                                        <button  onclick="login()" class="btn btn-primary">Log in</button>
                                    </td>
                                    <!-- Option to keep the user logged in -->
                                    <tr>
                                    <td style="padding-top:20px;">
                                        <input type="checkbox" class="form-control" id="loggedin" checked="checked" style="height: 20px; width: 20px;"> <div style="color: white; padding-top:4px;">Remember Me</div>
                                    </td>
                                    </tr>

                                </table>
                                <!-- <input type="text" class="form-control" name="username" id="username" placeholder="Username"> 
                                <input type="password" class="form-control" name="password" id="password" placeholder="Password" style="    -webkit-border-radius: 0 0 0 0;    -moz-border-radius: 0 0 0 0;    border-radius: 0 0 0 0;">  -->
                                <!-- <span class="input-group-btn"> 
                                <button type="submit" class="btn btn-primary">Log In</button>
                                </span>  -->
                            </div>
                        <!-- </form> -->
                    </div>
                </div>
            </div>
        </div>
        <div class="loader-overlay loaded">
            <div class="loader-inner">
                <div class="loader2"></div>
            </div>
        </div>
        <div class="footer" style="position:fixed; bottom:10px;">
            <div class="copyright">
              <p class="pull-left sm-pull-reset" style="position:fixed; bottom:10px; left:10px; color:white;">
                <span>Copyright <span class="copyright">©</span> 2016  </span>
                &nbsp&nbsp|<a href="http://www.werplay.com/" class="m-l-10 m-r-10"><span>we.R.play</span></a>
              </p>
              <p class="pull-right sm-pull-reset" style="position:fixed; bottom:10px; right:10px;">
                <span><a href="signup_check.php" class="m-r-10">Sign Up</a> | <a href="#" class="m-l-10 m-r-10">Terms of use</a>
              </p>
            </div>
          </div>
        <script src="assets/plugins/jquery/jquery-1.11.1.min.js"></script>
        <script src="assets/plugins/noty/jquery.noty.packaged.min.js"></script>  <!-- Notifications -->
        <script src="assets/plugins/jquery/jquery-migrate-1.2.1.min.js"></script>
        <script src="assets/plugins/gsap/main-gsap.min.js"></script>
        <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/plugins/backstretch/backstretch.min.js"></script>
        <script src="assets/plugins/bootstrap-loading/lada.min.js"></script>
        <script src="assets/plugins/progressbar/progressbar.min.js"></script>
        <script src="assets/js/pages/lockscreen.js"></script>
        <script type="text/javascript">
            $(document).keypress(function(event) {
                var keycode = (event.keyCode ? event.keyCode : event.which);
                if(keycode == '13') {
                    login();
                }
            });
        </script>
        <script type="text/javascript">
            window.onload=destroySessions2();

            
        </script>
    </body>
</html>
