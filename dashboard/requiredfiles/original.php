<!DOCTYPE html>
<html lang="en">
    <?php $pageTitle = "Dashboard - House of QA"; ?>
        <?php include("requiredfiles/head.php"); ?> 
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
            <h2><strong>Blank</strong> Page</h2>
            <div class="breadcrumb-wrapper">
              <ol class="breadcrumb">
                <li><a href="dashboard.php">Make</a>
                </li>
                <li><a href="#">Pages</a>
                </li>
                <li class="active">Dashboard</li>
              </ol>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12" style="height:720px">
              <!-- HERE COMES YOUR CONTENT -->
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
  </body>
</html>