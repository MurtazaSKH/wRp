<?php
	include('header.php');
	$_SESSION['ID'] = 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Password Retrieval</title>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="data/js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="data/js/ui/jquery-ui-1.8.17.custom.min.js"></script>
<script type="text/javascript" src="data/js/jquery.corner.js"></script>
<script type="text/javascript" src="data/js/jquery.validate.js"></script>
<script type="text/javascript" src="data/js/css_browser_selector.js"></script>
<script type="text/javascript" src="data/js/jquery.jqplot.min.js"></script>
<script type="text/javascript" src="data/js/plugins/jqplot.highlighter.min.js"></script>
<script type="text/javascript" src="data/js/plugins/jqplot.cursor.min.js"></script>
<script type="text/javascript" src="data/js/plugins/jqplot.dateAxisRenderer.min.js"></script>
<script type="text/javascript" src="data/js/editor/jquery.cleditor.min.js"></script>
<script type="text/javascript" src="data/js/calendar/fullcalendar.min.js"></script>
<script type="text/javascript" src="data/js/jquery.multiselect.min.js"></script>
<script type="text/javascript" src="data/js/tooltip/jquery.tipsy.js"></script>
<script type="text/javascript" src="data/js/validation/jquery.validationEngine.js"></script>
<script type="text/javascript" src="data/js/validation/languages/jquery.validationEngine-en.js"></script>
<script type="text/javascript" src="data/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="data/js/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
<script type="text/javascript" src="data/js/fancybox/jquery.easing-1.4.pack.js"></script>
<script type="text/javascript" src="data/js/js.js"></script>
<link rel="stylesheet" href="data/css/reset.css" type="text/css" />
<link rel="stylesheet" href="data/css/grid.css" type="text/css" />
<link rel="stylesheet" href="data/css/style.css" type="text/css" />
<link rel="stylesheet" href="data/js/plugins.css" type="text/css" />
</head>
<script class="code" type="text/javascript"><!-- Plugin Examples -->

</script>
<body>
	<div id="main" class="container_12"><!-- Body Wrapper Begin -->
		<div id="header"><!-- Header Begin -->
			<div class="grid_3"><a href="#" id="logo" class="float_left">AdminCP</a></div>
		</div><!-- Header End -->
		<div class="clear"></div>
		
		<div id="body">
			<div class="block big"><!-- Block Begin -->
				<div class="titlebar">
					<h3>Password Retrieval</h3>
				</div>
                <div class="block_cont">
                	<form class="form" action="passwordRetrievalProcess.php" method="POST">
                	<div class="form_row"><label>Email Address:</label><input class="input validate[required] tipRight" type="text" style="width: 290px;" name="emailAddress" id="emailAddress" placeholder="Enter Email Address" /></div>
                    <div class="form_row"><input type="submit" class="submit" value="GO!" /></div>
                    </form>
                </div>
			</div>
        </div>
	</div><!-- Body Wrapper End -->
</body>
</html>