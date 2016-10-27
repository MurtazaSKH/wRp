<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="ThemeBucket">
  <link rel="shortcut icon" href="#" type="image/png">

  <title>Device Record</title>

  <!--dynamic table-->
  <link href="js/advanced-datatable/css/demo_page.css" rel="stylesheet" />
  <link href="js/advanced-datatable/css/demo_table.css" rel="stylesheet" />
  <link rel="stylesheet" href="js/data-tables/DT_bootstrap.css" />

  <link href="css/style.css" rel="stylesheet">
  <link href="css/style-responsive.css" rel="stylesheet">

  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
  <script src="js/html5shiv.js"></script>
  <script src="js/respond.min.js"></script>
  <![endif]-->
</head>

<body class="sticky-header" style="background:#FAFAFA;">

<section>

<?php  include("mysqlConnect.php"); ?>

        

        <!--body wrapper start-->
        <div class="wrapper">
        <div class="row">
        <div class="col-sm-12">
        <section class="panel">
        <header class="panel-heading">
            Devices with Details
            <span class="tools pull-right">
                <a href="javascript:;" class="fa fa-chevron-down"></a>
             </span>
        </header>
        <div class="panel-body">
        <div class="adv-table">
        <table class="display table table-bordered table-striped" id="dynamic-table">
        <thead>
        <tr>
            <th>Device Name</th>
            <th>OS Version</th>
            <th>Vendor</th>
            <th>Priority</th>
            <th>Resolution</th>
        </tr>
        </thead>
        <tbody>
        <?php
							include("mysqlConnect.php");
			
							
		
						$query = "SELECT * FROM devicelist WHERE DeviceName NOT LIKE '%evo%' ORDER BY OSType, DeviceName";
						$result = mysql_query($query) or die('Query failed: ' . mysql_error());
						$num_results = mysql_num_rows($result);	
						$row = NULL;
												
						for($i = $num_results; $i > 0 ; $i--)
						{
							 $row = mysql_fetch_array($result);
							 
							 
							 
							 echo "<tr class=\"gradeX\" >";
							
							if ( $row['OSType'] == 'Android')
							{
							 echo "<td style=\"vertical-align:middle;\"><i class=\"fa fa-android\"></i> " . $row['DeviceName'] . "</td>";
							}
							
							if ( $row['OSType'] == 'iOS')
							{
							 echo "<td style=\"vertical-align:middle;\"><i class=\"fa fa-apple\"></i> " . $row['DeviceName'] . "</td>";
							}
								
							echo "<td style=\"vertical-align:middle;\"> " . $row['OSVersion'] . "</td>";
							
							 
							
								echo "<td style=\"vertical-align:middle;\">" . $row['Vendor'] . "</td>";
								echo "<td style=\"vertical-align:middle;\">" . $row['Priority'] . "</td>";
								echo "<td style=\"vertical-align:middle;\">" . $row['Resolution'] . "</td>";
							 
							 echo "</tr>";
						}//end of for
						
						
						mysql_close();
						?>
       
       
        </tbody>
        </table>

        </div>
        </div>
        </section>
        </div>
        </div>
        
        
        
       
        </div>
        <!--body wrapper end-->

       

    </div>
    <!-- main content end-->
</section>

<!-- Placed js at the end of the document so the pages load faster -->
<script src="js/jquery-1.10.2.min.js"></script>
<script src="js/jquery-ui-1.9.2.custom.min.js"></script>
<script src="js/jquery-migrate-1.2.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/modernizr.min.js"></script>
<script src="js/jquery.nicescroll.js"></script>

<!--dynamic table-->
<script type="text/javascript" language="javascript" src="js/advanced-datatable/js/jquery.dataTables.js"></script>
<script type="text/javascript" src="js/data-tables/DT_bootstrap.js"></script>
<!--dynamic table initialization -->
<script src="js/dynamic_table_init.js"></script>

<!--common scripts for all pages-->
<script src="js/scripts.js"></script>

</body>
</html>