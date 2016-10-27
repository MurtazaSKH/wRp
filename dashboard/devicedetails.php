<!DOCTYPE html>
<html lang="en">

    <?php $pageTitle = "Device Details - House of QA"; ?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta name="description" content="House of QA - Dashboard">
    <meta name="author" content="we.R.play">
    <link rel="shortcut icon" href="assets/images/favicon.png" type="image/png">
    <title><?php echo $pageTitle; ?></title>
    <link href="assets/css/dash.css" rel="stylesheet">
    <link href="assets/css/themecustom.css" rel="stylesheet">
    <link href="assets/css/ui.css" rel="stylesheet">
    <script src="assets/plugins/modernizr/modernizr-2.6.2-respond-1.1.0.min.js"></script>

    <!-- BEGIN PAGE STYLE -->
    <link href="assets/plugins/datatables/dataTables.min.css" rel="stylesheet">
    
</head> 

    <section>
      <!-- BEGIN SIDEBAR -->

      <!-- END SIDEBAR -->
      <div class="main-content">
        <!-- BEGIN TOPBAR -->

        <!-- END TOPBAR -->
        <!-- BEGIN PAGE CONTENT -->
        <div class="page-content">          
          <div class="row">
            <div class="col-lg-12 portlets">
              <div class="panel">
                <div class="panel-header">
                  <h3><i class="fa fa-device"></i> <strong>Device</strong> details</h3>
                </div>
                <div class="panel-content">
                  <div class="filter-left">
                    <table  id="myTable" class="table table-dynamic table-tools">
                      <thead>
                        <tr>
                          <th>Name</th>
                          <th>OS Version</th>
                          <th>Resolution</th>
                        </tr>
                      </thead>
                      <tbody>
<?php

	include("requiredfiles/mysqlConnect.php");

    $query = "SELECT * FROM devicelist WHERE DeviceName NOT LIKE '%evo%' ORDER BY OSType, DeviceName";
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());
    $num_results = mysql_num_rows($result);	

    $row = NULL;
												
	for($i = $num_results; $i > 0 ; $i--)
	{
		$row = mysql_fetch_array($result);
		
		if ( $row['OSType'] == 'Android')
            echo "<td style=\"vertical-align:middle;\"><i class=\"fa fa-android\"></i> " . $row['DeviceName'] . "</td>";
		if ( $row['OSType'] == 'iOS')
			echo "<td style=\"vertical-align:middle;\"><i class=\"fa fa-apple\"></i> " . $row['DeviceName'] . "</td>";
		
		echo "<td style=\"vertical-align:middle;\"> " . $row['OSVersion'] . "</td>";
		echo "<td style=\"vertical-align:middle;\">" . $row['Resolution'] . "</td>";
        echo "</tr>";
							 
	}//end of for
?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- END PAGE CONTENT -->
      </div>
      <!-- END MAIN CONTENT -->
    </section>
    <!-- BEGIN QUICKVIEW SIDEBAR -->
    <!-- END QUICKVIEW SIDEBAR -->
    <!-- BEGIN PRELOADER -->
    <!-- END PRELOADER -->
    <script src="assets/plugins/jquery/jquery-1.11.1.min.js"></script>
    <script src="assets/plugins/jquery/jquery-migrate-1.2.1.min.js"></script>
    <script src="assets/plugins/jquery-ui/jquery-ui-1.11.2.min.js"></script>
    <script src="assets/plugins/gsap/main-gsap.min.js"></script>
    <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/plugins/jquery-cookies/jquery.cookies.min.js"></script> <!-- Jquery Cookies, for theme -->
    <script src="assets/plugins/jquery-block-ui/jquery.blockUI.min.js"></script> <!-- simulate synchronous behavior when using AJAX -->
    <script src="assets/plugins/bootbox/bootbox.min.js"></script> <!-- Modal with Validation -->
    <script src="assets/plugins/retina/retina.min.js"></script> <!-- Retina Display -->
    <script src="assets/plugins/select2/select2.min.js"></script> <!-- Select Inputs -->
    <script src="assets/plugins/icheck/icheck.min.js"></script> <!-- Checkbox & Radio Inputs -->
    <script src="assets/plugins/backstretch/backstretch.min.js"></script> <!-- Background Image -->
    <script src="assets/js/plugins.js"></script> <!-- Main Plugin Initialization Script -->
    <script src="assets/js/application.js"></script> <!-- Main Application Script -->
    <script src="assets/plugins/datatables/jquery.dataTables.min.js"></script> <!-- Tables Filtering, Sorting & Editing -->
    <script src="assets/js/pages/table_dynamic.js"></script>
  </body>
</html>