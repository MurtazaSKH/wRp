<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta name="description" content="admin-themes-lab">
    <meta name="author" content="themes-lab">
    <link rel="shortcut icon" href="assets/images/favicon.ico" type="image/png">
    <title> Portal | View Devices</title>
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/theme.css" rel="stylesheet">
    <link href="assets/css/ui.css" rel="stylesheet">
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
              $query=("SELECT * FROM devicelist where company='".$_SESSION['company']."'");
              $result = mysqli_query($db,$query);

              // if(mysqli_num_rows($result) > 0)
              // {
              //   $row = mysqli_fetch_assoc($result);
              // }
            }
         ?>w
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
        <div class="page-content">
          <div class="header">
            <h2>View <strong>All Devices</strong></h2>
            
          </div>
          <div class="row">
            <div class="col-md-12 portlets">
              <div class="panel">
                <div class="panel-header panel-controls">
                  <!-- <h3><i class="fa fa-table"></i> <strong>Contextual</strong> Table</h3> -->
                </div>
                <div class="panel-content">
                  <!-- <table class="table"> -->
                  <table class="table dataTable" id="table2">
                    <thead>
                      <tr>
                        <th class="no_sort" tabindex="0" rowspan="1" colspan="1" style="width: 42px;"></th>
                        <th>#</th>
                        <th>Device Name</th>
                        <th>Current Owner</th>   
                        <?php
                          if($_SESSION['admin']=='1' or $_SESSION['admin']=='2')
                          {
                            echo "<th>Edit</th>";
                          }

                        ?>                     
                        
                      </tr>
                    </thead>

                    <tbody>
                      <!-- <tr class="active">
                        <td>1</td>
                        <td>Column content</td>
                        <td>Column content</td>
                      </tr> -->

                        <!-- 3062AE -->
                        <!-- <a id="cbttn'.$row['DeviceID'].'" data-rel="tooltip" data-placement="top" data-original-title="Checkout" style="background:#57C768; color:white; display:none;" class="delete btn btn-sm btn-default"  onclick="checkout('.$row['DeviceID'].')"><i class="fa fa-check-square-o" style="font-size:18px;"></i></a> -->
                      <?php 
                          $count=1;
                          if(mysqli_num_rows($result) > 0)
                          {
                              while($row = mysqli_fetch_array($result,MYSQLI_BOTH))
                              { 
                                  if($row['OSType']=="Android")
                                  {
                                    echo '<tr class="success" style="color:black;">';
                                    echo '<td class="center "></td>';
                                    echo '<td style="background-color:#ABB1BB;">'.$count++.'</td>';
                                    echo '<a href="#"><td style="background-color:#ABB1BB;">'.$row['name'].'</td></a>';

                                    echo '<td style="background-color:#ABB1BB;">'.$row['checkedBy'].'</td>';
                                    if($_SESSION['admin']=='1' or $_SESSION['admin']=='2')
                                    {
                                     echo '<td class="text-right"style="background-color:#ABB1BB; width:5%;"><a data-rel="tooltip" data-placement="top" data-original-title="Edit Device" style="background:#57C768; color:white; " class="delete btn btn-sm btn-default"  "  onclick=editDevice('.$row['DeviceID'].')><i class="fa fa-check-square-o" style="font-size:18px;"></i></a></td>';
                                    }
                                    echo '</tr>';

                                  }
                                  else
                                  {
                                    echo '<tr class="" style="color:white;">';
                                    echo '<td class="center "></td>';
                                    echo '<td style="background-color:#525761;">'.$count++.'</td>';
                                    echo '<td style="background-color:#525761;">'.$row['name'].'</td>';
                                    echo '<td style="background-color:#525761;">'.$row['checkedBy'].'</td>';
                                    if($_SESSION['admin']=='1' or $_SESSION['admin']=='2')
                                    {                                   
                                      echo '<td class="text-right"style="background-color:#525761; width:5%;"><a data-rel="tooltip" data-placement="top" data-original-title="Edit Device" style="background:#57C768; color:white; " class="delete btn btn-sm btn-default" onclick=editDevice('.$row['DeviceID'].')><i class="fa fa-check-square-o" style="font-size:18px;"></i></a></td>';
                                    }
                                    echo '</tr>';
                                  }
                              }
                          }

                        ?>
                      
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <?php include ('./includes/footer.php'); ?>
        <!-- END PAGE CONTENT -->
      </div>
      <!-- END MAIN CONTENT -->
    </section>
    <!-- END QUICKVIEW SIDEBAR -->
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
    <script src="assets/plugins/charts-chartjs/Chart.min.js"></script>
    <script src="assets/js/builder.js"></script> <!-- Theme Builder -->
    <script src="assets/js/sidebar_hover.js"></script> <!-- Sidebar on Hover -->
    <script src="assets/js/application.js"></script> <!-- Main Application Script -->
    <script src="assets/js/plugins.js"></script> <!-- Main Plugin Initialization Script -->
    <script src="assets/js/widgets/notes.js"></script> <!-- Notes Widget -->
    <script src="assets/js/quickview.js"></script> <!-- Chat Script -->
    <script src="assets/js/pages/search.js"></script> <!-- Search 
    Script -->
    <link href="assets/plugins/datatables/dataTables.min.css" rel="stylesheet">
    <script src="assets/plugins/datatables/jquery.dataTables.min.js"></script> <!-- Tables Filtering, Sorting & Editing -->
    <!-- 
    editable tables
    <script src="assets/js/pages/table_editable.js"></script>
     -->
    
    <script src="assets/js/pages/table_dynamic.js"></script>
  </body>
</html>