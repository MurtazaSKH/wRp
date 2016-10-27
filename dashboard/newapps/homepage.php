<?php
	include('sessionHeader.php');
	//global variables
	$adminDsg[0]=0;	//designations with admin rights
	$ativechk = 1;
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="ThemeBucket">
  <link rel="shortcut icon" href="#" type="image/png">

  <title>DashBoard</title>

  <!--icheck-->
  <link href="js/iCheck/skins/minimal/minimal.css" rel="stylesheet">
  <link href="js/iCheck/skins/square/square.css" rel="stylesheet">
  <link href="js/iCheck/skins/square/red.css" rel="stylesheet">
  <link href="js/iCheck/skins/square/blue.css" rel="stylesheet">

  <!--dashboard calendar-->
  <link href="css/clndr.css" rel="stylesheet">

  <!--Morris Chart CSS -->
  <link rel="stylesheet" href="js/morris-chart/morris.css">

  <!--common-->
  <link href="css/style.css" rel="stylesheet">
  <link href="css/style-responsive.css" rel="stylesheet">
<script type="text/javascript">
//get AJAX working
function getXMLHttp()
{
  var xmlHttp

  try
  {
	//Firefox, Opera 8.0+, Safari
	xmlHttp = new XMLHttpRequest();
  }
  catch(e)
  {
	//Internet Explorer
	try
	{
	  xmlHttp = new ActiveXObject("Msxml2.XMLHTTP");
	}
	catch(e)
	{
	  try
	  {
		xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
	  }
	  catch(e)
	  {
		alert("Your browser does not support AJAX!")
		return false;
	  }
	}
  }
  return xmlHttp;
}//end of getXMLHttp function

function addtodo() {

	
	if (document.getElementById('entodo1').value == "") { 
     return;
	}
//  else {
//        var xmlhttp = new XMLHttpRequest();
//        xmlhttp.onreadystatechange = function() {
//            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
//                var todo3 = document.getElementById('entodo1').value;
//            }
//        }
//        xmlhttp.open("GET", "processTodo.php?q=" + todo3, true);
//        xmlhttp.send();
//    }
	
	if (window.XMLHttpRequest)
  	{// code for IE7+, Firefox, Chrome, Opera, Safari
  		xmlhttp=new XMLHttpRequest();
  	}
	else
  	{// code for IE6, IE5
  		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  	}
	
	var todo3 = document.getElementById('entodo1').value;
	

	
    xmlhttp.open("GET","processTodo.php?q=" + todo3 +"&c=2",true);
	xmlhttp.send();	
	
	document.getElementById('entodo1').value = "";
	
	
	
	
	var newcheckeds = 0;

	$('#sortable-todo li').each(function(index, element) {
		
		newcheckeds ++
		
		
		 });
		 

	
	if (newcheckeds != 0)
	{
    	var newelementid = $("#sortable-todo li:last-child").get(0).id;
		var listnumber = newelementid.substring(6,10);
		listnumber ++;
	}
	
	
	

	if (newcheckeds == 0)
	{
		
		
		$("#sortable-todo").append("<li class=\"clearfix\" id=\"litodo1\"><span class=\"drag-marker\"><i></i></span><div class=\"todo-check pull-left\"><input type=\"checkbox\" value=\"None\" id=\"checkb1\" /><label for=\"todo-check\"></label></div><p class=\"todo-title\">"+todo3+"</p><div class=\"todo-actionlist pull-right clearfix\"><a href=\"#\" class=\"todo-remove\"><i class=\"fa fa-times\" onClick=\"removetodo1(this)\"></i></a></div></li>");
		
	}
	else {

	$("#sortable-todo li:last").after("<li class=\"clearfix\" id=\"litodo"+ listnumber +"\"><span class=\"drag-marker\"><i></i></span><div class=\"todo-check pull-left\"><input type=\"checkbox\" value=\"None\" id=\"checkb"+ listnumber+"\" /><label for=\"todo-check\"></label></div><p class=\"todo-title\">"+todo3+"</p><div class=\"todo-actionlist pull-right clearfix\"><a href=\"#\" class=\"todo-remove\"><i class=\"fa fa-times\" onClick=\"removetodo1(this)\"></i></a></div></li>");
	
	}
	
}

function removetodo1(str) {
	
	var newelementid = $(str).parent().parent().parent().get(0).id;

	var listnumber = newelementid.substring(6,10);
	

	
	if (window.XMLHttpRequest)
  	{// code for IE7+, Firefox, Chrome, Opera, Safari
  		xmlhttp=new XMLHttpRequest();
  	}
	else
  	{// code for IE6, IE5
  		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  	}
	
	if(newelementid== "litodo1")
	{
		trvali = 1;
	}
	else
	{
		trvali = 1;
	}
	
	$('#sortable-todo li').each(function(index, element) {
	
		if ($(element).get(0).id == newelementid)
		{
			$(element).attr("id","litodo"+0);
			trvali = trvali - 1;
		}
 	
		$(element).attr("id","litodo"+trvali);
	
 		trvali++;
	
	});
	
	
    xmlhttp.open("GET","processTodo.php?q=" + listnumber +"&c=1",true);
	xmlhttp.send();	

}

</script>



  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
  <script src="js/html5shiv.js"></script>
  <script src="js/respond.min.js"></script>
  <![endif]-->
</head>

<body class="sticky-header">

<section>
  
<?php  include ("headernew.php");?>

        <!-- page heading start-->
        <div class="page-heading">
            <h3>
                Dashboard
            </h3>
            <ul class="breadcrumb">
                <li>
                    <a href="homepage.php">Dashboard</a>
                </li>
                <li class="active"> My Dashboard </li>
            </ul>
            
        </div>
     
        
        <!-- page heading end-->

        <!--body wrapper start-->
        <div class="wrapper">
            <div class="row">
                <div class="col-md-6">
                    <!--statistics start-->
                    <div class="row state-overview">
                    <a style="display:block; color:#FFFFFF" href="device_rc.php">
                        <div class="col-md-6 col-xs-12 col-sm-6">
                            <div class="panel purple">
                                <div class="symbol">
                                    <i class="fa fa-mobile"></i>
                                </div>
                                <div class="state-value">
                                    <div class="value">Checkout</div>
                                    <div class="title">Device Record</div>
                                </div>
                            </div>
                        </div>
                     </a>
                        <div class="col-md-6 col-xs-12 col-sm-6">
                            <div class="panel red">
                                <div class="symbol">
                                    <i class="fa fa-bug"></i>
                                </div>
                                <div class="state-value">
                                    <div class="value">Ticket</div>
                                    <div class="title">Comming Soon</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row state-overview">
                        <div class="col-md-6 col-xs-12 col-sm-6">
                            <div class="panel blue">
                                <div class="symbol">
                                    <i class="fa fa-users"></i>
                                </div>
                                <div class="state-value">
                                    <div class="value">Directory</div>
                                    <div class="title">Comming Soon</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xs-12 col-sm-6">
                            <div class="panel green">
                                <div class="symbol">
                                    <i class="fa fa-eye"></i>
                                </div>
                                <div class="state-value">
                                    <div class="value">Profile</div>
                                    <div class="title">Comming Soon</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--statistics end-->
                </div>
<?php
						include("mysqlConnect.php");
			
						$query = "SELECT * FROM devicelist where OwnedBy != \"\" ORDER BY OSType, DeviceName";
						$result = mysql_query($query) or die('Query failed: ' . mysql_error());
						$device_avail = mysql_num_rows($result);
						
						$query = "SELECT * FROM devicelist ORDER BY OSType, DeviceName";
						$result = mysql_query($query) or die('Query failed: ' . mysql_error());
						$device_tot = mysql_num_rows($result);	
						
						$query = "SELECT * FROM devicelist where OwnedBy = \"Charging\" ORDER BY OSType, DeviceName";
						$result = mysql_query($query) or die('Query failed: ' . mysql_error());
						$device_ch = mysql_num_rows($result);
						
						$device_co = $device_tot - $device_avail - $device_ch;
						
						$device_cop = ( $device_co / $device_tot ) * 100;
						$device_chp = ( $device_ch / $device_tot ) * 100;
						$device_availp = ( $device_avail / $device_tot ) * 100;
?>
                <div class="col-md-6">
                    <!--more statistics box start-->
                    <div class="panel deep-purple-box">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-7 col-sm-7 col-xs-7">
                                    <div id="graph-donut" class="revenue-graph"></div>

                                </div>
                                <div class="col-md-5 col-sm-5 col-xs-5">
                                    <ul class="bar-legend">
                                        <li><span class="red"></span> Devices Checked-out: <?php echo $device_co; ?> </li>
                                        <li><span class="green"></span> Devices Available: <?php echo $device_avail; ?> </li>
                                        <li><span class="purple"></span> Devices Charging: <?php echo $device_ch; ?> </li>
                                        <li><span class="blue"></span> Total Devices: <?php echo $device_tot; ?> </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--more statistics box end-->
                </div>
            </div>
            <div class="row">
              <div class="col-md-4">
                    <div class="panel">
                        <header class="panel-heading">
                            Devices Checked-out
                            <span class="tools pull-right">
                                <a href="javascript:;" class="fa fa-chevron-down"></a>
                            
                             </span>
                        </header>
                        <div class="panel-body">
                        
                          <?php
						
			
						$query = "SELECT * FROM devicelist where OwnedBy = \"$userName\" ORDER BY OSType, DeviceName";
						$result = mysql_query($query) or die('Query failed: ' . mysql_error());
						$num_results = mysql_num_rows($result);	
						$row = NULL;
						if ($num_results == 0)
						{
						echo"    <a href=\"#\" 
							 class=\"btn btn-success btn-lg btn-block\"><strong class=\"uppercase\">No Device Checked Out</strong></a>   ";						
												}
						for($i = $num_results; $i > 0 ; $i--)
						{
							 $row = mysql_fetch_array($result);
							 $timestamp = strtotime($row['LastUpdate']);
							
						if ( $row['OSType'] == 'Android')
						{	
							 echo"    <a href=\"processCheckOut.php?flag=disownid&pager=3213&did=". $row['DeviceID'] ."\" 
							 class=\"btn btn-success btn-lg btn-block\" style=\"padding:15px 15px 15px 15px;\"><span style=\"text-transform: uppercase; font-weight: bold;\">". $row['DeviceName'] ."</span><br />
                   <span  style=\" font-size: 15px;\"> <i class=\"fa fa-android\"></i>  " . $row['OSVersion'] . "  &nbsp;&nbsp;&nbsp;&nbsp;   <i class=\"fa fa-calendar\"></i> ".date("l, M d, Y", $timestamp)."at " . date("g:i a", $timestamp) . "</a>   ";
						}
						
						if ( $row['OSType'] == 'iOS')
						{	
							 echo"    <a href=\"processCheckOut.php?flag=disownid&pager=3213&did=". $row['DeviceID'] ."\" 
							 class=\"btn btn-primary btn-lg btn-block\" style=\"padding:15px 15px 15px 15px;\"><span  style=\"text-transform: uppercase; font-weight: bold;\">".$row['DeviceName'] ."</span><br />
                   <span  style=\" font-size: 15px;\"> <i class=\"fa fa-apple\"></i>  " . $row['OSVersion'] . "  &nbsp;&nbsp;&nbsp;&nbsp;   <i class=\"fa fa-calendar\"></i> ".date("l, M d, Y", $timestamp)." at " . date("g:i a", $timestamp) . "</a>   ";
						
						}
							
						}//end of for
						
						
						
						?>
                        
                        
                           
                            <div class="text-center" style="margin-top:15px;"><a href="device_rc.php">View all Devices</a></div>
                        </div>
                    </div>
                </div>
              
                <div class="col-md-4">
                    <div class="panel">
                        <header class="panel-heading">
                            Todo List
                            <span class="tools pull-right">
                                <a class="fa fa-chevron-down" href="javascript:;"></a>
                             </span>
                        </header>
                        <div class="panel-body">
                            <ul class="to-do-list" id="sortable-todo">
<?php                            
						$query = "SELECT * FROM todolist where EID = $userID ORDER BY TOID";
						$result = mysql_query($query) or die('Query failed: ' . mysql_error());
						$num_results = mysql_num_rows($result);	
						$row = NULL;				
						
						for($i = 0 ; $i < $num_results ; $i++)
						{
							 $row = mysql_fetch_array($result);	
							 
							 $j = $i +1;
							 
							 
							 
							  echo "<li class=\"clearfix\" id=\"litodo".$j."\">"
                                   ."<span class=\"drag-marker\">"
                                   ."<i></i>"
                                   ."</span>"
                                   ."<div class=\"todo-check pull-left\">";
									
									if ($row['Checktodo']==0)
									$checkedid = 'checked';
									else
									$checkedid = '';
									
                                    echo "<input type=\"checkbox\" value=\"None\" id=\"checkb".$j."\" $checkedid/>"
                                        ."<label for=\"todo-check\"></label>"
                                        ."</div>"
                                        ."<p class=\"todo-title\">"
                                        .$row['Todo']
                                        ."</p>"
                                        ."<div class=\"todo-actionlist pull-right clearfix\">"
										."<a href=\"#\" class=\"todo-remove\" id=\"dtodo-check\"><i class=\"fa fa-times\" onClick=\"removetodo1(this)\"></i></a>"
										."</div>"
                                		."</li>";
						}
						
						mysql_close();
?>							
                                
                            </ul>
                            <div class="row">
                                <div class="col-md-12">
                                   <!--<form role="form" class="form-inline">-->
                                        <div class="form-group todo-entry">
                                            <input type="text" name="entodo1" id="entodo1" placeholder="Enter your ToDo List" class="form-control" style="width: 100%">
                                        </div>
                                        <button class="btn btn-primary pull-right" onClick="addtodo()">+</button>
                                    <!--</form>-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
               
                <div class="col-md-4">
                    <div class="panel">
                        <div class="panel-body">
                            <div class="calendar-block ">
                                <div class="cal1">

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                
                
            </div>

            

            <div class="row">
                
                
            </div>
        </div>
        <!--body wrapper end-->

        <!--footer section start-->
        <footer>
            2014 &copy; weRplay Apps
        </footer>
        <!--footer section end-->


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


<!--Morris Chart-->
<script src="js/morris-chart/morris.js"></script>
<script src="js/morris-chart/raphael-min.js"></script>

<!--Calendar-->
<script src="js/calendar/clndr.js"></script>
<script src="js/calendar/evnt.calendar.init.js"></script>
<script src="js/calendar/moment-2.2.1.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.5.2/underscore-min.js"></script>

<!--common scripts for all pages-->
<script src="js/scripts.js"></script>

<!--Dashboard Charts-->
<script>
Morris.Donut({
    element: 'graph-donut',
    data: [
        {value: <?php echo $device_cop; ?>, label: 'Checkedout', formatted: '<?php echo round($device_cop, 1); ?>%' },
        {value: <?php echo $device_chp; ?>, label: 'Charging', formatted: '<?php echo round($device_chp, 1); ?>%' },
        {value: <?php echo $device_availp; ?>, label: 'Available', formatted: '<?php echo round($device_availp, 1); ?>%' }
    ],
    backgroundColor: false,
    labelColor: '#fff',
    colors: [
        '#fe8676','#6a8bc0','#4acacb'
    ],
    formatter: function (x, data) { return data.formatted; }
});
</script>


</body>
</html>
