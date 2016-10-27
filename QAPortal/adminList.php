<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta name="description" content="admin-themes-lab">
    <meta name="author" content="themes-lab">
    <link rel="shortcut icon" href="assets/images/favicon.ico" type="image/png">
    <title> Portal | View admins</title>
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
              header('Location: index.php');
            }
            else
            {
              // if(isset($_SESSION['companyview']))
              // {
              //   $company=$_SESSION['companyview'];
              // $query=("SELECT * FROM employee where company='$company' and admin!='2' order by EmployeeID desc");
              // $result = mysqli_query($db,$query);
              // }
              // else
              // {
              //   $company=$_SESSION['company'];
              //   $query=("SELECT * FROM employee where company='$company' and admin='0' order by EmployeeID desc");
              //   $result = mysqli_query($db,$query);
              // }

              $query=("SELECT * FROM employee where admin='1' order by EmployeeID desc");
                $result = mysqli_query($db,$query);

              // if(mysqli_num_rows($result) > 0)
              // {
              //   $row = mysqli_fetch_assoc($result);
              // }
              // $query2=("SELECT * FROM company");
              // $result2 = mysqli_query($db,$query2);              
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
        <div class="page-content">
          <div class="header">
            <h2> <strong>Admins</strong> List</h2>
            <!-- <div class="breadcrumb-wrapper">
              <ol class="breadcrumb">
                <li><a href="dashboard.php">Dashboard</a>
                </li>
                <li><a href="viewdevices.php">Devices</a>
                </li>
                <li class="active">Checkout</li>
              </ol>
            </div> -->
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
                  <!-- <table class="table dataTable" id="table1"> -->
                  <table class="table table-hover table-dynamic dataTable no-footer" id="DataTables_Table_0" role="grid" aria-describedby="DataTables_Table_0_info">
                    <thead>
                      <tr>
                        <!-- <th class="no_sort" tabindex="0" rowspan="1" colspan="1" style="width: 42px;"></th> -->
                        <th class="sorting_asc" tabindex="0" rowspan="1" colspan="1" style="width: 279px;" aria-label="
                          Device Name
                        : activate to sort column ascending" aria-sort="ascending">
                          Employee ID
                        </th>
                        <th class="sorting" tabindex="0" rowspan="1" colspan="1" style="width: 350px;">
                          Employee Name
                        </th>
                        <th class="sorting" tabindex="0" rowspan="1" colspan="1" style="width: 322px;">
                          Designation
                        </th>                 
                        <th style="display:none;">Last checkout</div>
                        <th style="display:none;">IMEI</div>
                        <th style="display:none;">Resolution</div>
                        <th style="display:none;">Vendor</div>
                        <th style="display:none;">Priority</div>
                        <th style="min-width:150px;"></div>  
                      </tr>
                    </thead>
                    <tbody role="alert" aria-live="polite" aria-relevant="all">
                      <?php 
                        if(mysqli_num_rows($result) > 0)
                        {
                          while($row = mysqli_fetch_array($result,MYSQLI_BOTH))
                          { 
                            //echo "checking rows"; 
                            echo '<tr class="gradeA odd">';
                            // echo '<td class="center "></td>';
                            echo '<td class=" sorting_1">'.$row['EmployeeID'].'</td>';
                            echo '<td class=" ">'.$row['Name'].'</td>';
                            echo '<td class=" "id="device'.$row['DeviceID'].'">'.$row['Designation'].'</td>';
                            echo '<td class="center" style="display:none;">'.$row['LastUpdate'].'</td>';                          
                            echo '<td class="center"style="display:none;">'.$row['IMEI'].'</td>';
                            echo '<td class="center"style="display:none;">'.$row['Resolution'].'</td>';
                            echo '<td class="center"style="display:none;">'.$row['Vendor'].'</td>';
                            echo '<td class="center"style="display:none;">'.$row['Priority'].'</td>';

                            // if not checked out
                            echo '<td class="text-right">';
                            
                            echo '<a data-rel="tooltip" data-placement="top" data-original-title="Edit User" style="background:#57C768; color:white;" onclick="editUser('.$row['EID'].')" class="delete btn btn-sm btn-default"  onclick=""><i class="fa fa-edit" style="font-size:18px;"></i></a>
                            <a id="dact'.$row['EID'].'" data-rel="tooltip" data-placement="top" data-original-title="Deactivate" style="background:#c75757; color:white;'.($row['active']=='1'?"display:inline-block;":"display:none;").'" class="delete btn btn-sm btn-default"  onclick="deactivateUser('.$row['EID'].',0)"><i class="fa fa-remove" style="font-size:18px;"></i></a>
                            <a id="act'.$row['EID'].'" data-rel="tooltip" data-placement="top" data-original-title="Activate" style="background:#57C768; color:white; '.($row['active']=='1'?"display:none;":"display:inline-block;").'" class="delete btn btn-sm btn-default"  onclick="deactivateUser('.$row['EID'].',1)"><i class="fa fa-check" style="font-size:18px;"></i></a>
                              ';
                              
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
    <script>
      $('#selectedcompany').on("change",function() {
          setCompanysession(document.getElementById("selectedcompany").value);
      });
    </script>
  </body>
</html>