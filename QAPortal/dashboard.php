<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
      <meta name="description" content="admin-themes-lab">
      <meta name="author" content="themes-lab">
      <link rel="shortcut icon" href="assets/images/favicon.ico" type="image/png">
      <title>Portal | Dashboard</title>
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
        window.onload = checkSession;
      </script>
      <!-- Including Connection File -->
      <?php include ('./includes/mysqlConnect.php'); ?>
      <!-- check if logged in -->
      <?php 
         session_start();
         if(!isset($_SESSION['email']))
         {
           header('Location: index.php');
         }
         else
         {

          // to get devices info of that company only
          $company=$_SESSION['company'];

           $query=("SELECT * FROM employee where Email='".$_SESSION['email']."'");
           $result = mysqli_query($db,$query);
         
           if(mysqli_num_rows($result) > 0)
           {
             $row = mysqli_fetch_assoc($result);
           }
         
           $query2=("SELECT * FROM devicelist where checkerID='".$_SESSION['eid']."'");
         
           $result2 = mysqli_query($db,$query2);
         
           // counting available devices
           $query3=("SELECT count(*) as avail from devicelist where checkedBy='' and company='$company'");
           $result3 = mysqli_query($db,$query3);         
           $avail = mysqli_fetch_assoc($result3);     
         
           // available devices
           $query4=("SELECT count(*) as charge from devicelist where checkedBy='Charging' and company='$company'");
           $result4 = mysqli_query($db,$query4);         
           $charge = mysqli_fetch_assoc($result4); 
         
           // checked out
           $query5=("SELECT count(*) as total from devicelist where company='$company'");
           $result5 = mysqli_query($db,$query5);         
           $total = mysqli_fetch_assoc($result5);
           $checkedout=$total['total']-$avail['avail']-$charge['charge'];
         
         
         }
         ?>
   </head>
   <!-- BEGIN BODY -->
   <body class="fixed-topbar fixed-sidebar theme-sdtl color-default">
      <!--[if lt IE 7]>
      <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
      <![endif]-->
      <section>
         <!-- BEGIN SIDEBAR -->
         <?php include ('./includes/sidebar.php'); ?>
         <!-- END SIDEBAR -->
         <div class="main-content">
            <!-- BEGIN TOPBAR -->
            <?php include ('./includes/topbar.php'); ?>
            <!-- END TOPBAR -->
            <!-- BEGIN PAGE CONTENT -->
            <div class="page-content page-thin">
               <div class="row">


                <!-- checkout panel -->
                  <div class="col-md-4 col-sm-6  ui-sortable">
                     <div class="panel">
                        <div class="panel-header bg-primary">
                           <h3>Devices <strong>Checked Out!</strong></h3>
                        </div>
                        <div id="devicelist" class="panel-content">
                           <ul class="todo-list ui-sortable">
                              <?php 
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
                                 
                                 
                                 ?>
                           </ul>
                        </div>
                        <div class="panel-footer clearfix" id="checkoutButtons">
                           <?php
                              if(mysqli_num_rows($result2) > 0)
                              {
                                echo "<button onclick='clearAll()' type='button' style='width:48%; float:left' class='btn btn-white m-r-10'>Clear All</button>
                                <a href='deviceList.php'  style='width:48%; float:right' class='btn btn-success'>Checkout!</a>";
                              }
                              else
                              {
                                echo "<a href='deviceList.php'  style='width:100%;' class='btn btn-success'>Checkout!</a>";
                              }
                              ?>
                        </div>
                     </div>
                  </div>

                  <!-- Status Charts -->
                  <div class="col-md-4 col-sm-6 ui-sortable" onclick="test()">
                     <div class="panel">
                        <div class="panel-header bg-primary">
                           <h3><strong>Devices</strong> Status</h3>
                        </div>
                        <div class="panel-content">
                           <div id="charts1" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto">
                           </div>
                        </div>
                     </div>
                  </div>

                  <!-- Don't delete -->
                  <!-- User info -->
                  <div class="col-md-4 col-sm-6 portlets ui-sortable">
                     <div class="panel widget-member clearfix">
                        <div class="col-xs-3">
                           <img <?php echo "src='./assets/avatars/".$_SESSION['avatar']."'" ?> class="pull-left img-responsive">
                        </div>
                        <div class="col-xs-9">
                           <h3 class="m-t-0 member-name"><strong><?php echo $row['Name'];?></strong></h3>
                           <p class="member-job"><?php echo ($row['Designation']?$row['Designation']:"N/A")." | ".($row['Team']?$row['Team']:"N/A");

                            if($row['admin']=="1" or $row['admin']=="2")
                            {
                              echo " | ";
                              echo '<button type="button" class="btn btn-info btn-rounded" style="height:25px; background-color:#B21515; cursor:auto; padding-top:3px;">Admin</button>';
                            }                           
                           ?></p>
                           <div class="row">
                              <div class="col-xlg-6">
                                 <p><i class="icon-envelope c-gray-light p-r-10"></i> <?php echo $row['Email']?$row['Email']:"N/A";?></p>
                              </div>
                              <div class="col-xlg-6 align-right">
                                 <p><i class="icon-calendar c-gray-light p-r-10"></i> <?php echo $row['DateofBirth']?$row['DateofBirth']:"N/A";?></p>
                                 <p><i class="icon-target c-gray-light p-r-10"></i> <?php echo $row['EmployeeID']?$row['EmployeeID']:"N/A";?></p>
                                 <p><i class="icon-target c-gray-light p-r-10"></i> <?php echo $_SESSION['companyname']?$_SESSION['companyname']:"N/A";?></p>
                                 <p id="availabledev" style="display:none;"> <?php echo $avail['avail'];?></p>
                                 <p id="onchargingdev" style="display:none;"> <?php echo $charge['charge'];?></p>
                                 <p id="checkedoutdev" style="display:none;"><?php echo $checkedout;?></p>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-4 col-sm-6 portlets ui-sortable">
                     <div class="widget widget_calendar bg-dark">
                        <div class="multidatepicker"></div>
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
      <script src="assets/plugins/jquery/jquery-1.11.1.min.js"></script>
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
      <script src="assets/plugins/skycons/skycons.min.js"></script> <!-- Animated Weather Icons -->
      <script src="assets/plugins/simple-weather/jquery.simpleWeather.js"></script> <!-- Weather Plugin -->
      <script src="assets/js/widgets/widget_weather.js"></script>
      <!-- <script src="assets/js/pages/dashboard.js"></script>s -->
      <!-- END PAGE SCRIPT -->
      <!-- BEGIN chart SCRIPT -->
      <script src="assets/plugins/charts-highstock/js/highstock.min.js"></script> <!-- financial Charts -->
      <!-- <script src="assets/plugins/charts-highstock/js/modules/exporting.min.js"></script> -->
      <script>
         var cd=document.getElementById("checkedoutdev").innerHTML;
         var chd=document.getElementById("onchargingdev").innerHTML;
         var ad=document.getElementById("availabledev").innerHTML;

           $('#charts1').highcharts({
               chart: {
                   plotBackgroundColor: null,
                   plotBorderWidth: null,
                   plotShadow: false,
                   type: 'pie'
               },
               title: {
                   text: ' '
               },
               tooltip: {
                   // pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
               },
               plotOptions: {
                   pie: {
                       allowPointSelect: true,
                       cursor: 'pointer',
                       dataLabels: {
                           enabled: false
                       },
                       showInLegend: true
                   }
               },
               series: [{
                   name: 'devices',
                   colorByPoint: true,
                   data: [{
                    name: 'Checked Out',
                    y: parseInt(cd)
                }, {
                    name: 'Charging',
                    y: parseInt(chd),
                    sliced: true,
                    selected: true
                }, {
                    name: 'Available',
                    y: parseInt(ad)
                    
                }]
               }]
           });
         
      </script>
      <!-- END chart SCRIPT -->
   </body>
</html>