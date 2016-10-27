<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta name="description" content="admin-themes-lab">
    <meta name="author" content="themes-lab">
    <link rel="shortcut icon" href="assets/images/favicon.ico" type="image/png">
    <title> Portal | Device Details</title>
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
            $device = $_REQUEST['details'];
            if(!isset($device))
            {
              header('Location: index.php');
            }
            else
            {
              $query=("SELECT * FROM checkoutLog where DeviceID='$device' order by checkOut desc limit 5");
              echo $query;
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
            <h2>Device <strong>info</strong></h2>
            
          </div>
          
          <div class="row">
            <div class="col-md-12 portlets">
              <div class="panel">
                <div class="panel-header panel-controls">
                  <h3>Locate Device</h3>
                </div>
                <div  id="content" style="width:100%; height:100%; opacity:0.5;">
                <div class="panel-content">
                  <div  style="position: relative;">
                                <div class="map-overlay" onclick="style.pointerEvents='none'" style="pointer-events: none;"></div>
                                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3320.601418000041!2d73.05560271553527!3d33.66748818071239!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x38df956f4f307af5%3A0xd6e806e5b39a5bd6!2swe.R.play!5e0!3m2!1sen!2s!4v1455178212838" allowfullscreen="" style="width:100%; height:350px; border:none;"></iframe>
                   </div>
                </div>
                <div class="container overlap"><h2>Coming Soon..</h2>
  
                </div>
              </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12 portlets">
              <div class="panel">
                <div class="panel-header panel-controls">
                  <h3>Checkout Log</h3>
                </div>
                <div class="panel-content">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>Name</th>
                        <th>Checked Out</th>
                        <th>Checked In</th>                        
                      </tr>
                    </thead>

                    <tbody>
                      <!-- <tr class="active">
                        <td>1</td>
                        <td>Column content</td>
                        <td>Column content</td>
                      </tr> -->

                        <!-- 3062AE -->
                      <?php 
                          $count=1;
                          if(mysqli_num_rows($result) > 0)
                          {
                              while($row = mysqli_fetch_array($result,MYSQLI_BOTH))
                              { 
                                  // if($row['OSType']=="Android")
                                  // {
                                $timestamp = strtotime($row['checkOut']); 
                                $tempquery=("SELECT * FROM employee where EID='".$row['ownerId']."'");
                                $tempresult = mysqli_query($db,$tempquery);

                                if(mysqli_num_rows($tempresult) > 0)
                                {
                                  $temprow = mysqli_fetch_assoc($tempresult);
                                }
                                    echo '<tr class="success" style="color:black;"><td style="background-color:rgba(171, 177, 187, 0.49);">'.$temprow['Name'].'</td>';
                                    echo '<a href="#"><td style="background-color:rgba(171, 177, 187, 0.49);">'.date('g:i a', $timestamp).' - '.date('l, F d, Y', $timestamp).'</td></a>';
                                    if($row['checkIn']!="")
                                    {
                                      $timestamp2 = strtotime($row['checkIn']); 
                                      echo '<td style="background-color:rgba(171, 177, 187, 0.49);">'.date('g:i a', $timestamp2).' - '.date('l, F d, Y', $timestamp2).'</td>';  
                                    }
                                    else
                                    {
                                      echo '<td style="background-color:rgba(171, 177, 187, 0.49);">N/A</td>';  
                                    }
                                    
                                    echo '</tr>';
                                  //}
                                  // else
                                  // {
                                  //   echo '<tr class="active" style="color:white;"><td style="background-color:#525761;">'.$count++.'</td>';
                                  //   echo '<td style="background-color:#525761;">'.$row['name'].'</td>';
                                  //   echo '<td style="background-color:#525761;">'.$row['checkedBy'].'</td>';
                                  //   echo '</tr>';
                                  // }
                              }
                          }
                          else
                          {
                            echo '<tr class="danger" style="color:black;"><td colspan="3">No record found for this device.</td></tr>';
                          }

                        ?>
                      <!-- <tr class="success">
                        <td>3</td>
                        <td>Column content</td>
                        <td>Column content</td>
                      </tr>
                      <tr>
                        <td>4</td>
                        <td>Column content</td>
                        <td>Column content</td>
                      </tr>
                      <tr class="danger">
                        <td>9</td>
                        <td>Column content</td>
                        <td>Column content</td>
                      </tr> -->
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
    <script src="assets/js/pages/search.js"></script> <!-- Search Script -->
  </body>
</html>