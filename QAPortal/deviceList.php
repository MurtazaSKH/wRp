<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta name="description" content="admin-themes-lab">
    <meta name="author" content="themes-lab">
    <link rel="shortcut icon" href="assets/images/favicon.ico" type="image/png">
    <title> Portal | Checkout</title>
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/theme.css" rel="stylesheet">
    <link href="assets/css/ui.css" rel="stylesheet">
    <script src="assets/plugins/modernizr/modernizr-2.6.2-respond-1.1.0.min.js"></script>
    
    <!--  -->
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
              // javascript function will do the checking and redirection
            }
            else
            {
              $query=("SELECT * FROM devicelist where company='".$_SESSION['company']."' AND device_active='1'");
              $result = mysqli_query($db,$query);

              // if(mysqli_num_rows($result) > 0)
              // {
              //   $row = mysqli_fetch_assoc($result);
              // }
            }
         ?>
  </head>
  <!-- BEGIN BODY -->
  <body class="fixed-topbar fixed-sidebar theme-sdtl color-default">
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
            <h2>Device <strong>Checkout</strong></h2>
          </div>
          <div class="row">
            <div class="col-lg-12 portlets">
              <div class="panel">
                <div class="panel-header panel-controls">
                  <!-- <h3><i class="fa fa-table"></i> <strong>Editable</strong> Tables</h3> -->
                </div>
                
                <div class="panel-content">
                  <table id="tableinfo">
                    <tr>
                      <td>
                      </td>
                    </tr>
                  </table>
                  <!-- <table class="table dataTable" id="table2"> -->
                  <table class="table table-hover table-dynamic dataTable no-footer" id="DataTables_Table_0" role="grid" aria-describedby="DataTables_Table_0_info">
                    <thead>
                      <tr>
                        <!-- <th class="no_sort" tabindex="0" rowspan="1" colspan="1" style="width: 42px;"></th> -->
                        <th class="sorting_asc" tabindex="0" rowspan="1" colspan="1" style="width: 279px;" aria-label="
                          Device Name
                        : activate to sort column ascending" aria-sort="ascending">
                          Device Name
                        </th>
                        <th class="sorting" tabindex="0" rowspan="1" colspan="1" style="width: 350px;">
                          OS Version
                        </th>
                        <th class="sorting" tabindex="0" rowspan="1" colspan="1" style="width: 322px;">
                          Owner
                        </th>                 
                        <th style="display:none;">Last checkout</th>
                        <th style="display:none;">IMEI</th>
                        <th style="display:none;">Resolution</th>
                        <th style="display:none;">Vendor</th>
                        <th style="display:none;">Priority</th>
                        <th style="display:none;">OS Type</th>
                        <th style="min-width:150px;"></th>  
                      </tr>
                    </thead>
                    <tbody role="alert" aria-live="polite" aria-relevant="all">
                      <?php 
                        if(mysqli_num_rows($result) > 0)
                        {
                          while($row = mysqli_fetch_array($result,MYSQLI_BOTH))
                          { 
                            //echo "checking rows";
                            $timestamp = strtotime($row['LastUpdate']); 
                            echo '<tr class="gradeA odd">';
                            // echo '<td class="center "></td>';
                            echo '<td class=" sorting_1">'.$row['name'].'</td>';
                            echo '<td class=" ">'.$row['OSVersion'].'</td>';
                            echo '<td class=" "id="device'.$row['DeviceID'].'">'.$row['checkedBy'].'</td>';
                            echo '<td class="center" style="display:none;">'.date('g:i a', $timestamp).' - '.date('l, F d, Y', $timestamp).'</td>';                          
                            echo '<td class="center"style="display:none;">'.$row['IMEI'].'</td>';
                            echo '<td class="center"style="display:none;">'.$row['Resolution'].'</td>';
                            echo '<td class="center"style="display:none;">'.$row['Vendor'].'</td>';
                            echo '<td class="center"style="display:none;">'.$row['Priority'].'</td>';
                            echo '<td class="center"style="display:none;">'.$row['OSType'].'</td>';

                            // if not checked out - charge,clear display:none
                            echo '<td class="text-right">';
                            if($row['checkedBy']==null || $row['checkedBy']=='Charging')
                            {
                              echo '
                                <a href="deviceDetails.php?details='.$row['DeviceID'].'" data-rel="tooltip" data-placement="top" data-original-title="Device info" style="background:#09A7AB; color:white;" class="edit btn btn-sm btn-default"  onclick=""><i class="fa fa-info" style="font-size:18px;"></i></a>
                                <a id="cbttn'.$row['DeviceID'].'" data-rel="tooltip" data-placement="top" data-original-title="Checkout" style="background:#57C768; color:white;" class="delete btn btn-sm btn-default"  onclick="checkout('.$row['DeviceID'].')"><i class="fa fa-check-square-o" style="font-size:18px;"></i></a>
                                <a data-rel="tooltip" data-placement="top" data-original-title="Put on Charging" id="charge'.$row['DeviceID'].'"style="background:#E7C500; color:white; display:none;" class="edit btn btn-sm btn-default"  onclick="chargeDev('.$row['DeviceID'].')"><i class="fa fa-battery-1" style="font-size:18px;"></i></a>

                                <a data-rel="tooltip" data-placement="top" data-original-title="Clear Device" id="clearbttn'.$row['DeviceID'].'" style="background:#c75757; color:white; display:none;" class="delete btn btn-sm btn-default"  onclick="cleardevice('.$row['DeviceID'].')"><i class="fa fa-remove" style="font-size:18px;"></i></a>
                                ';
                            }
                            // if checked out by current user - clearbutton display:none
                            else if ($row['checkedBy']==$_SESSION['username'])
                            {
                              echo '<a href="deviceDetails.php?details='.$row['DeviceID'].'" data-rel="tooltip" data-placement="top" data-original-title="Device info" style="background:#09A7AB; color:white;" class="edit btn btn-sm btn-default"  onclick=""><i class="fa fa-info" style="font-size:18px;"></i></a>

                              <a id="cbttn'.$row['DeviceID'].'" data-rel="tooltip" data-placement="top" data-original-title="Checkout" style="background:#57C768; color:white; display:none;" class="delete btn btn-sm btn-default"  onclick="checkout('.$row['DeviceID'].')"><i class="fa fa-check-square-o" style="font-size:18px;"></i></a>

                              <a data-rel="tooltip" data-placement="top" data-original-title="Put on Charging" id="charge'.$row['DeviceID'].'"style="background:#E7C500; color:white;" class="edit btn btn-sm btn-default"  onclick="chargeDev('.$row['DeviceID'].')"><i class="fa fa-battery-1" style="font-size:18px;"></i></a>
                              <a data-rel="tooltip" data-placement="top" data-original-title="Clear Device" id="clearbttn'.$row['DeviceID'].'" style="background:#c75757; color:white;" class="delete btn btn-sm btn-default"  onclick="cleardevice('.$row['DeviceID'].')"><i class="fa fa-remove" style="font-size:18px;"></i></a>

                                ';
                            }
                            // if checked out by someone else
                            else
                            {
                              echo '<a href="deviceDetails.php?details='.$row['DeviceID'].'" data-rel="tooltip" data-placement="top" data-original-title="Device info" style="background:#09A7AB; color:white;" class="delete btn btn-sm btn-default"  onclick=""><i class="fa fa-info" style="font-size:18px;"></i></a>
                                ';
                            }
                              
                            echo '</td>';
                            echo '</tr>';
                            
                        
                            
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
        </div>
        <!-- END PAGE CONTENT -->
      </div>
      <!-- END MAIN CONTENT -->
    </section>
    
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
    
    <script src="assets/js/application.js"></script> <!-- Main Application Script -->
    <script src="assets/js/plugins.js"></script> <!-- Main Plugin Initialization Script -->
    <!-- BEGIN PAGE SCRIPTS -->
    <script src="assets/plugins/noty/jquery.noty.packaged.min.js"></script>
    <link href="assets/plugins/datatables/dataTables.min.css" rel="stylesheet">
    <script src="assets/plugins/datatables/jquery.dataTables.min.js"></script> <!-- Tables Filtering, Sorting & Editing -->
    <!-- 
    editable tables
    <script src="assets/js/pages/table_editable.js"></script>
     -->
    
    <script src="assets/js/pages/table_dynamic.js"></script>
    <!-- END PAGE SCRIPTS -->
  </body>
</html>