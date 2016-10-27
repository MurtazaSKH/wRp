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
      <?php 
         // session_start();
         // if(!isset($_SESSION['email']))
         // {
         //   header('Location: index.php');
         // }
         // else
         // {

         //  // to get devices info of that company only
         //  $company=$_SESSION['company'];

         //   $query=("SELECT * FROM employee where Email='".$_SESSION['email']."'");
         //   $result = mysqli_query($db,$query);
         
         //   if(mysqli_num_rows($result) > 0)
         //   {
         //     $row = mysqli_fetch_assoc($result);
         //   }
         
         //   $query2=("SELECT * FROM devicelist where checkedBy='".$_SESSION['username']."'");
         
         //   $result2 = mysqli_query($db,$query2);
         
         //   // counting available devices
         //   $query3=("SELECT count(*) as avail from devicelist where checkedBy='' and company='$company'");
         //   $result3 = mysqli_query($db,$query3);         
         //   $avail = mysqli_fetch_assoc($result3);     
         
         //   // available devices
         //   $query4=("SELECT count(*) as charge from devicelist where checkedBy='Charging' and company='$company'");
         //   $result4 = mysqli_query($db,$query4);         
         //   $charge = mysqli_fetch_assoc($result4); 
         
         //   // checked out
         //   $query5=("SELECT count(*) as total from devicelist where company='$company'");
         //   $result5 = mysqli_query($db,$query5);         
         //   $total = mysqli_fetch_assoc($result5);
         //   $checkedout=$total['total']-$avail['avail']-$charge['charge'];
         
         
         // }
         ?>
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
                       <input type="number" onchange="Directlogin()" maxlength="5" name="text-basic" id="text-basic" value="" Placeholder="Tap Here" style="text-align: center; background: whitesmoke none; height: 50px; font-size: 20px;">
                  </div><!-- /demo-html -->
               </div>
               <!-- display:none; -->
               <div class="row" id="select_device" style="opacity:0; display:none; margin:10% 0px;">
                  <div data-demo-html="true" style="width:100%;">
                       <label for="text2-basic" style="text-align:center; height: 50px; ">Enter Device ID</label>
                       <input type="number" maxlength="4" name="text-basic" id="text2-basic" value="" Placeholder="Tap Here" style="text-align: center; background: whitesmoke none; height: 50px; font-size: 20px;">
                       <div id='hidden1' style="display: none;">
                         <a href="#" onclick="directcheckout()" style="width:49%; color:white; margin-top:10px; height:100px; font-size:30px; " class="btn btn-success"><span style="display: inline-block; vertical-align: -webkit-baseline-middle; line-height: normal;">Checkout</span></a>
                         <a href="#" onclick="directclear()" style="width:49%; float:right; margin-top:10px; color:white; background-color: #bf1232; height:100px; font-size:30px;" class="btn btn-fail"><span style="display: inline-block; vertical-align: -webkit-baseline-middle; line-height: normal;">Clear</span></a>
                        </div>
                       <a href='#' onclick="destroySessionsforDirect()"  style='width:100%; color:white; background-color: #bf1232; margin-top: 30px; height: 50px; font-size: 20px; ' class='btn btn-success'><span style="display: inline-block; vertical-align: -webkit-baseline-middle; line-height: normal;">LOGOUT</span></a>
                  </div>
               </div>
               <div class="row" id="testiFrame" style="margin-top:30px; opacity:0; display:none; margin:10% 0px;">
                  <!-- <iframe height="500px" width="100%" src="http://portal.werplay.com/deviceList.php" name="iframe_a"></iframe> -->
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
      <script type="text/javascript">
        // Set NumPad defaults for jQuery mobile. 
        // These defaults will be applied to all NumPads within this document!
        $.fn.numpad.defaults.gridTpl = '<table class="ui-bar-a" id="numtable" style="width:400px; height:300px;"></table>';
        $.fn.numpad.defaults.backgroundTpl = '<div class="ui-popup-screen ui-overlay-a"></div>';
        $.fn.numpad.defaults.displayTpl = '<input data-theme="b" type="text" />';
        $.fn.numpad.defaults.buttonNumberTpl =  '<a data-role="button" data-theme="b" style="margin-left:4px; margin-right:4px;"></a>';
        $.fn.numpad.defaults.buttonFunctionTpl = '<a data-role="button" data-theme="a"></a>';
        $.fn.numpad.defaults.onKeypadCreate = function(){$(this).enhanceWithin();};
        
        // Instantiate NumPad once the page is ready to be shown
        $(document).on('pageshow', function(){
          $('#text-basic').numpad({
            // displayTpl: '<input data-theme="b" type="password" />',
            hidePlusMinusButton: true,
            hideDecimalButton: true
          });
          $('#text2-basic').numpad({
            //displayTpl: '<input data-theme="b" type="password" />',
            hidePlusMinusButton: true,
            hideDecimalButton: true
          });
          $('#numpadButton-btn').numpad({
            target: $('#numpadButton'),
          });
          $('#numpad4div').numpad();
          $('#numpad4column .qtyInput').numpad();
        });

        $("#text2-basic").bind("change paste input", function(){
            if(document.getElementById("text2-basic").value=="")
            {
              document.getElementById("hidden1").style.display="none";
            }
            else
            {
              document.getElementById("hidden1").style.display="Inline";
            }


        });

        $( "text2-basic" ).trigger( "click" );
        //window.onload=destroySessionsforDirect();


      </script>
   </body>
</html>