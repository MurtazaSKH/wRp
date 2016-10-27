<!DOCTYPE html>
<html lang="en">

    <?php $pageTitle = "Sale Packages - House of QA"; ?>

<head>
     <?php include("requiredfiles/head.php"); ?> 

    <!-- BEGIN PAGE STYLE -->
    <link href="assets/plugins/datatables/dataTables.min.css" rel="stylesheet">
    
</head> 
        <?php include("requiredfiles/style.php"); ?> 
    <section>
      <!-- BEGIN SIDEBAR -->
        <?php include("requiredfiles/sidebar.php"); ?>
      <!-- END SIDEBAR -->
      <div class="main-content">
        <!-- BEGIN TOPBAR -->
        <?php include("requiredfiles/topbar.php"); ?>
        <!-- END TOPBAR -->
        <!-- BEGIN PAGE CONTENT -->
        <div class="page-content">
          <div class="header">
            <h2>Sale <strong>Packges</strong></h2>
            <div class="breadcrumb-wrapper">
              <ol class="breadcrumb">
                <li><a href="dashboard.php">Dashboard</a>
                </li>
                <li><a href="#">Admin</a>
                </li>
                <li class="active">Sale Packages</li>
              </ol>
            </div>
          </div>           
          <div class="row">
            <div class="col-lg-12 portlets">
              <div class="panel">
                <div class="panel-header panel-controls">
                  <h3><i class="fa fa-table"></i> <strong>Packages</strong> details <small>export to Excel, CSV, PDF or Print.</small></h3>
                </div>
                <div class="panel-content">
                  <div class="filter-left">
                    <table class="table table-dynamic table-tools">
                      <thead>
                        <tr>
                          <th>Name</th>
                          <th>Price</th>
                          <th class='hidden-350'>Devices</th>
                          <th class='hidden-1024'>Hours</th>
                          <th class='hidden-480'>Actions</th>
                        </tr>
                      </thead>
                      <tbody>
<?php

	include("requiredfiles/mysqlConnect.php");

    $query = "SELECT * FROM packages";
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());
    $num_results = mysql_num_rows($result);	

    $row = NULL;
												
	for($i = $num_results; $i > 0 ; $i--)
	{
		$row = mysql_fetch_array($result);
							 
		echo "<tr>"
            ."<td>" . $row['name'] . "</td>"
            ."<td> $ "
            . $row['amount']
            ."</td>"
            ."<td class='hidden-350'>" . $row['noofdevices'] . "</td>"
            ."<td class='hidden-1024'>" . $row['hours'] . "</td>"
            ."<td class='hidden-480'><div class=\"m-b-10 f-center\">"
            ."<div class=\"btn-group\">"
            ."<button type=\"button\" class=\"btn btn-success\">Perform Actions</button>"
            ."<button type=\"button\" class=\"btn btn-success dropdown-toggle\" data-toggle=\"dropdown\">"
            ."<span class=\"caret\"></span>"
            ."<span class=\"sr-only\">Toggle Dropdown</span>"
            ."</button>"
            ."<span class=\"dropdown-arrow\"></span>"
            ."<ul class=\"dropdown-menu\" role=\"menu\">"
            ."<li><a href=\"removePackage.php?id=>" . $row['id'] . "\">View Details</a>"
            ."</li>"
			."<li><a href=\"removePackage.php?id=>" . $row['id'] . "\">Edit</a>"
            ."</li>"
            ."<li><a href=\"removePackage.php?id=>" . $row['id'] . "\">Remove</a>"
            ."</li>"
            ."</ul>"
            ."</div>"
            ."</div>"
			."</td>"
            ."</tr>";
							 
	}//end of for
?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        <?php include("requiredfiles/footer.php"); ?>
        </div>
        <!-- END PAGE CONTENT -->
      </div>
      <!-- END MAIN CONTENT -->
    </section>
    <!-- BEGIN QUICKVIEW SIDEBAR -->
        <?php include("requiredfiles/quickview.php"); ?>
    <!-- END QUICKVIEW SIDEBAR -->
    <!-- BEGIN PRELOADER -->
        <?php include("requiredfiles/preloader.php"); ?>
    <!-- END PRELOADER -->
        <?php include("requiredfiles/javascript.php"); ?>
    <script src="assets/plugins/datatables/jquery.dataTables.min.js"></script> <!-- Tables Filtering, Sorting & Editing -->
    <script src="assets/js/pages/table_dynamic.js"></script>
  </body>
</html>