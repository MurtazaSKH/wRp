<!DOCTYPE html>
<html lang="en">

<?php $pageTitle="Dashboard - House of QA" ; ?>

<head>
    <?php include( "requiredfiles/head.php"); ?>

    <!-- BEGIN PAGE STYLE -->
    <link href="assets/plugins/metrojs/metrojs.min.css" rel="stylesheet">
    <link href="assets/plugins/charts-morris/morris.min.css" rel="stylesheet">

</head>
<?php include( "requiredfiles/style.php"); ?>
<section>
    <!-- BEGIN SIDEBAR -->
    <?php include( "requiredfiles/sidebar.php"); ?>
    <!-- END SIDEBAR -->
    <div class="main-content">
        <!-- BEGIN TOPBAR -->
        
        <?php include( "requiredfiles/topbar.php"); ?>
        <!-- END TOPBAR -->
        <!-- BEGIN PAGE CONTENT -->
        <div class="page-content">
            <div id="hidden-small-screen-message">
                <h2 class="m-t-40"><strong>Page Builder</strong> is not available on small screen</h2>
                <p>Editor is not adapted to screen smaller than 1024px.</p>
                <p>For that reason, page builder is only visible on screen bigger.</p>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="header">
                        <h2>Main <strong>Dashboard</strong></h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="active">Dashboard</li>
                            </ol>
                        </div>
                        <p>Welcome to House of QA - Dashboard!</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xlg-3 col-lg-5">
                    <div class="panel">
                        <div class="panel-header">
                            <h3><i class="icon-list"></i> <strong>News</strong> List</h3>
                            <div class="control-btn">
                                <span class="pull-right badge badge-primary">12</span>
                            </div>
                        </div>
                        <div class="panel-content widget-news">
                            <div class="withScroll mCustomScrollbar _mCS_31" data-height="400" style="height: 400px;">
                                <div class="mCustomScrollBox mCS-light" id="mCSB_31" style="position:relative; height:100%; overflow:hidden; max-width:100%;">
                                    <div class="mCSB_container" style="position: relative; top: -139px;">
                                        <a href="#" class="message-item media">
                                            <div class="media">
                                                <div class="media-body">
                                                    <div class="pull-left p-r-10">
                                                        <i class="icon-lock-open pull-left"></i>
                                                    </div>
                                                    <div> <small class="pull-right">28 Feb</small>
                                                        <h4 class="c-dark">Reset your account password</h4>
                                                        <p class="f-14 c-gray">Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                        <a href="#" class="message-item media">
                                            <div class="media">
                                                <div class="media-body">
                                                    <div class="pull-left p-r-10">
                                                        <i class="icon-cloud-upload pull-left"></i>
                                                    </div>
                                                    <div> <small class="pull-right">27 Feb</small>
                                                        <h4 class="c-dark">Check Dropbox</h4>
                                                        <p class="f-14 c-gray">Hello Steve, I have added new files in your Dropbox in order to show you how to...</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                        <a href="#" class="message-item media">
                                            <div class="media">
                                                <div class="media-body">
                                                    <div class="pull-left p-r-10">
                                                        <i class="icon-rocket pull-left"></i>
                                                    </div>
                                                    <div> <small class="pull-right">24 Feb</small>
                                                        <h4 class="c-dark">Trip to Mars begin</h4>
                                                        <p class="f-14 c-gray">Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="mCSB_scrollTools" style="position: absolute; display: block; opacity: 0;">
                                        <div class="mCSB_draggerContainer">
                                            <div class="mCSB_dragger" style="position: absolute; height: 263px; top: 91px;" oncontextmenu="return false;">
                                                <div class="mCSB_dragger_bar" style="position: relative; line-height: 263px;">
                                                </div>
                                            </div>
                                            <div class="mCSB_draggerRail">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xlg-7 col-lg-7">
                    <h3><strong>Line</strong> Charts</h3>
                    <p>A line chart is a way of plotting data points on a line.
                        <br> Often, it is used to show trend data, and the comparison of two data sets.
                    </p>
                    <canvas id="line-chart" class="full" height="140"></canvas>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 col-sm-6 portlets">
                    <div class="panel widget-member clearfix">
                        <div class="col-xs-3">
                            <img src="assets/images/avatars/user2.png" alt="avatar 12" class="pull-left img-responsive">
                        </div>
                        <div class="col-xs-9">
                            <h3 class="m-t-0 member-name"><strong>John Snow</strong></h3>
                            <p class="member-job">Software Engineer</p>
                            <div class="row">
                                <div class="col-xlg-6">
                                    <p><i class="icon-envelope c-gray-light p-r-10"></i> cameso@it.com</p>
                                    <p><i class="fa fa-facebook c-gray-light p-r-10"></i> fb.com/jsnow</p>
                                </div>
                                <div class="col-xlg-6 align-right">
                                    <p><i class="icon-calendar c-gray-light p-r-10"></i> 6 may 2014</p>
                                    <p><i class="icon-target c-gray-light p-r-10"></i> New York</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 portlets">
                    <div class="panel widget-weather"></div>
                </div>
                <div class="col-md-4 col-sm-6 portlets">

                    <div class="widget widget_calendar bg-dark">
                        <div class="multidatepicker"></div>
                    </div>
                </div>
            </div>
            <!-- END PAGE CONTENT -->
        </div>
        <!-- END MAIN CONTENT -->
</section>
<!-- BEGIN QUICKVIEW SIDEBAR -->
<?php include( "requiredfiles/quickview.php"); ?>
<!-- END QUICKVIEW SIDEBAR -->
<!-- BEGIN PRELOADER -->
<?php include( "requiredfiles/preloader.php"); ?>
<!-- END PRELOADER -->
<?php include( "requiredfiles/javascript.php"); ?>
<script src="assets/plugins/noty/jquery.noty.packaged.min.js"></script>
<!-- Notifications -->
<script src="assets/plugins/bootstrap-editable/js/bootstrap-editable.min.js"></script>
<!-- Inline Edition X-editable -->
<script src="assets/plugins/bootstrap-context-menu/bootstrap-contextmenu.min.js"></script>
<!-- Context Menu -->
<script src="assets/plugins/multidatepicker/multidatespicker.min.js"></script>
<!-- Multi dates Picker -->
<script src="assets/plugins/metrojs/metrojs.min.js"></script>
<!-- Flipping Panel -->
<script src="assets/plugins/charts-chartjs/Chart.min.js"></script>
<!-- ChartJS Chart -->
<script src="assets/plugins/skycons/skycons.min.js"></script>
<!-- Animated Weather Icons -->
<script src="assets/plugins/simple-weather/jquery.simpleWeather.js"></script>
<!-- Weather Plugin -->
<script src="assets/js/widgets/widget_weather.js"></script>
<script src="assets/js/pages/dashboard.js"></script>

<script src="assets/plugins/charts-morris/raphael.min.js"></script>
<script src="assets/plugins/charts-morris/morris.min.js"></script>

</body>

</html>