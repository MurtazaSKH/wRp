<!DOCTYPE html>
<html lang="en">
   <head>

      <link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css">
      <link href="assets/css/jquery.numpad.css" rel="stylesheet">
      <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,700">
      <script src="http://code.jquery.com/jquery-1.11.2.min.js"></script>
      
      <script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
      
      <style type="text/css">
        .controlgroup-textinput{
          padding-top: .22em;
          padding-bottom: .22em;
        }
      </style>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
      <meta name="description" content="admin-themes-lab">
      <meta name="author" content="themes-lab">
      <link rel="shortcut icon" href="assets/images/favicon.ico" type="image/png">
      <title>Portal | DirectCheckout</title>
      <link href="assets/css/style.css" rel="stylesheet">
      <link href="assets/css/theme.css" rel="stylesheet">
      <link href="assets/css/ui.css" rel="stylesheet">
      <!-- PreLoader CSS -->
      <link href="assets/css/main.css" rel="stylesheet">
      <link href="assets/css/normalize.css" rel="stylesheet">
      <!-- BEGIN PAGE STYLE -->
      <link href="assets/plugins/metrojs/metrojs.min.css" rel="stylesheet">
      <link href="assets/plugins/maps-amcharts/ammap/ammap.min.css" rel="stylesheet">
      <!-- END PAGE STYLE -->
      <script src="assets/plugins/modernizr/modernizr-2.6.2-respond-1.1.0.min.js"></script>
      <script src="./includes/ajax.js"></script>
      <script>
        //window.onload = checkSession;
      </script>
      <!-- Including Connection File -->
      <?php include ('./includes/mysqlConnect.php'); ?>
      <!-- check if logged in -->
   </head>
   <!-- BEGIN BODY -->
   <body class="fixed-topbar fixed-sidebar theme-sdtl color-default">
      <!--[if lt IE 7]>
      <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
      <![endif]-->
      <section>
         <!-- BEGIN SIDEBAR -->
         <?php //include ('./includes/sidebar.php'); ?>
         <!-- END SIDEBAR -->
         <div class="main-content" style="margin-left:0px; background: #f9f9f9;">
            <!-- BEGIN TOPBAR -->
            <?php //include ('./includes/topbar.php'); ?>
            <!-- END TOPBAR -->
            <!-- BEGIN PAGE CONTENT -->
            <div class="page-content page-thin" style="background: #f9f9f9;">
               <div class="row" id="enter_pin">
                  <div data-demo-html="true" style="width:100%; margin:10% 0px;">
                       <label for="text-basic" style="text-align:center;">Enter PIN</label>
                       <!-- onchange="alert(this.value)" -->
                       <input type="number" maxlength="5" name="text-basic" id="text-basic" value="" Placeholder="Tap Here" style="text-align: center; background: whitesmoke none; height: 50px; font-size: 20px;">
                       <a href="#" id="loginbtn" onclick="Directlogin()" style="width:26%; color:white; margin-top:10px; height:46px; font-size:15px; margin-left: 37%;" class="btn btn-success"><span style="display: inline-block; vertical-align: -webkit-baseline-middle; line-height: normal;">Login</span></a>
                  </div><!-- /demo-html -->
               </div>
               <!-- display:none; -->
               <div class="row" id="select_device" style="opacity:0; display:none; margin:10% 0px;">
                  <div data-demo-html="true" style="width:100%;">
                       <label for="text2-basic" style="text-align:center; height: 50px; ">Enter Device ID</label>
                       <input type="number" maxlength="4" name="text2-basic" id="text2-basic" value="" Placeholder="Tap Here" style="text-align: center; background: whitesmoke none; height: 50px; font-size: 20px;">
                       <div id='hidden1' style="display: none;">
                         <a href="#" onclick="directcheckout()" style="width:49%; color:white; margin-top:10px; height:100px; font-size:30px; " class="btn btn-success"><span style="display: inline-block; vertical-align: -webkit-baseline-middle; line-height: normal;">Checkout</span></a>
                         <a href="#" onclick="directclear()" id="clearbtn" style="width:49%; float:right; margin-top:10px; color:white; background-color: #bf1232; height:100px; font-size:30px;" class="btn btn-fail"><span style="display: inline-block; vertical-align: -webkit-baseline-middle; line-height: normal;">Clear</span></a>
                        </div>
                         <div id='hidden2' style="display: none;">
                         <a href="#" onclick="ForceCheckout()" style="width:100%; color:white; margin-top:10px; height:100px; background-color: rgb(0, 114, 255); font-size:30px; " class="btn btn-success"><span style="display: inline-block; vertical-align: -webkit-baseline-middle; line-height: normal;">Force Checkout</span></a>
                        </div>
                       <a href='#' onclick="destroySessionsforDirect()"  style='width:100%; color:white; background-color: #bf1232; margin-top: 30px; height: 50px; font-size: 20px; ' class='btn btn-success'><span style="display: inline-block; vertical-align: -webkit-baseline-middle; line-height: normal;">LOGOUT</span></a>
                  </div>
               </div>
               
               <div class="row" id="devicesdiv" style="display: none;">
                <!-- show device to clear directly -->
                  <div class="col-md-12 col-sm-12  ui-sortable">
                     <div class="panel">
                        <!-- Device that are alraedy checked out by this user -->
                        <div class="panel-header bg-primary">
                           <h3>Clear devices <strong>here</strong>...</h3>
                        </div>
                        <div id="devicelist" class="panel-content">
                           <ul class="todo-list ui-sortable" id="showdevices">
                              <!-- display inner HTML form php here -->
                           </ul>
                        </div>
                        
                     </div>
                   </div>
                 </div>


               <div class="footer">
                  <div class="copyright">
                     <p class="pull-left sm-pull-reset">
                        <span>Copyright <span class="copyright">©</span> 2016 </span>
                        <span>we.R.play</span>.
                     </p>
                     <p class="pull-right sm-pull-reset">
                        <span><a href="http://www.werplay.com/contactus.php" class="m-r-10">Contact</a> | <a href="#" class="m-l-10 m-r-10">Terms of use</a></span>
                     </p>
                  </div>
               </div>
            </div>
            <!-- END PAGE CONTENT -->
         </div>
         <!-- END MAIN CONTENT -->
      </section>
      <!-- BEGIN QUICKVIEW SIDEBAR for chat and notes-->
      <!-- END QUICKVIEW SIDEBAR -->
      <!-- BEGIN SEARCH -->
      <!-- END SEARCH -->
      <!-- BEGIN PRELOADER -->
      <div class="loader-overlay">
         <div class="spinner">
            <div class="bounce1"></div>
            <div class="bounce2"></div>
            <div class="bounce3"></div>
         </div>
      </div>
      <!-- END PRELOADER -->
      <a href="#" class="scrollup"><i class="fa fa-angle-up"></i></a> 
      
      <script src="assets/plugins/jquery/jquery-migrate-1.2.1.min.js"></script>
      <script src="assets/plugins/jquery-ui/jquery-ui-1.11.2.min.js"></script>
      <script src="assets/plugins/gsap/main-gsap.min.js"></script>
      <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
      <script src="assets/plugins/jquery-cookies/jquery.cookies.min.js"></script> <!-- Jquery Cookies, for theme -->
      <script src="assets/plugins/jquery-block-ui/jquery.blockUI.min.js"></script> <!-- simulate synchronous behavior when using AJAX -->
      <script src="assets/plugins/translate/jqueryTranslator.min.js"></script> <!-- Translate Plugin with JSON data -->
      <script src="assets/plugins/bootbox/bootbox.min.js"></script> <!-- Modal with Validation -->
      <script src="assets/plugins/mcustom-scrollbar/jquery.mCustomScrollbar.concat.min.js"></script> <!-- Custom Scrollbar sidebar -->
      <script src="assets/plugins/bootstrap-dropdown/bootstrap-hover-dropdown.min.js"></script> <!-- Show Dropdown on Mouseover -->
      <script src="assets/plugins/charts-sparkline/sparkline.min.js"></script> <!-- Charts Sparkline -->
      <script src="assets/plugins/retina/retina.min.js"></script> <!-- Retina Display -->
      <script src="assets/plugins/select2/select2.min.js"></script> <!-- Select Inputs -->
      <script src="assets/plugins/icheck/icheck.min.js"></script> <!-- Checkbox & Radio Inputs -->
      <script src="assets/plugins/backstretch/backstretch.min.js"></script> <!-- Background Image -->
      <script src="assets/plugins/bootstrap-progressbar/bootstrap-progressbar.min.js"></script> <!-- Animated Progress Bar -->
      <script src="assets/js/builder.js"></script> <!-- Theme Builder -->
      <script src="assets/js/sidebar_hover.js"></script> <!-- Sidebar on Hover -->
      <script src="assets/js/application.js"></script> <!-- Main Application Script -->
      <script src="assets/js/plugins.js"></script> <!-- Main Plugin Initialization Script -->
      <script src="assets/js/widgets/notes.js"></script> <!-- Notes Widget -->
      <script src="assets/js/quickview.js"></script> <!-- Chat Script -->
      <script src="assets/js/pages/search.js"></script> <!-- Search Script -->
      <!-- BEGIN PAGE SCRIPT -->
      <script src="assets/plugins/noty/jquery.noty.packaged.min.js"></script>  <!-- Notifications -->
      <script src="assets/plugins/bootstrap-editable/js/bootstrap-editable.min.js"></script>
      <!-- Inline Edition X-editable -->
      <!-- <script src="assets/plugins/bootstrap-context-menu/bootstrap-contextmenu.min.js"></script> -->
      <!-- Context Menu -->
      <script src="assets/plugins/multidatepicker/multidatespicker.min.js"></script> <!-- Multi dates Picker -->
      <script src="assets/js/widgets/todo_list.js"></script>
      <script src="assets/plugins/metrojs/metrojs.min.js"></script> <!-- Flipping Panel -->
      <script src="assets/plugins/charts-chartjs/Chart.min.js"></script>  <!-- ChartJS Chart -->
      <!-- Financial Charts Export Tool -->
      <script src="assets/plugins/maps-amcharts/ammap/ammap.min.js"></script> <!-- Vector Map -->
      <script src="assets/plugins/maps-amcharts/ammap/maps/js/worldLow.min.js"></script> <!-- Vector World Map  -->
      <script src="assets/plugins/maps-amcharts/ammap/themes/black.min.js"></script> <!-- Vector Map Black Theme -->

      <script src="assets/js/jquery.numpad.js"></script>
      <script src="js/main.js"></script>
      <script type="text/javascript">
        $(function() {
            $("#text-basic").focus()
        });

        $("#text2-basic").bind("change paste input", function(){

            document.getElementById("hidden2").style.display="none";
            if(document.getElementById("text2-basic").value=="")
            {
              document.getElementById("hidden1").style.display="none";
            }
            else
            {
              document.getElementById("hidden1").style.display="Inline";
            }


        });

      </script>
   </body>

   <div id="loading" style="display: none;">
      <div id="loader-wrapper">
         <div id="loader"></div>
      </div>
   </div>
</html>