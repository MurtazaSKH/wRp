  <!-- left side start-->
    <div class="left-side sticky-left-side">

        <!--logo and iconic logo start-->
        <div class="logo">
            <a href="homepage.php"><img src="images/logo.png" alt=""></a>
        </div>

        <div class="logo-icon text-center">
            <a href="homepage.php"><img src="images/logo_icon.png" alt=""></a>
        </div>
        <!--logo and iconic logo end-->
		<?php
        include("mysqlConnect.php");
			
							$query = "SELECT DsgID FROM operationrights 
							WHERE RightName = 'Admin' AND AppName = 'DeviceRecords'";
							$result = mysql_query($query) or die('Query failed: ' . mysql_error());
							$num_results = mysql_num_rows($result);	
							$row = NULL;
							
							//check if current user is admin or lead
							for($i = 0; $i < $num_results ; $i++)
							{
								 $row = mysql_fetch_array($result);
								 $adminDsg[$i] = $row['DsgID'];
								 
								 if ($dsgID == $adminDsg[$i])
								 {
									 break;
								 }//end of if
							}	
							
							for($j=0; $j< count($adminDsg) ; $j++)
							 {
							     if($dsgID == $adminDsg[$j])
								 {
								 
								 break ;
								 
								 }
								 
								 						
								 
							 }//end of for
							
							
?>
        <div class="left-side-inner">

            <!-- visible to small devices only -->
            <div class="visible-xs hidden-sm hidden-md hidden-lg">
                <div class="media logged-user">
                    <img alt="" src="<?php echo $avatarPath; ?>" class="media-object">
                    <div class="media-body">
                        <h4><a href="#"><?php echo $userName ?></a></h4>
                        <span>"Hello There..."</span>
                    </div>
                </div>

                <h5 class="left-nav-title">Account Information</h5>
                <ul class="nav nav-pills nav-stacked custom-nav">
                    <li><a href="#"><i class="fa fa-user"></i> <span>Profile</span></a></li>
                    <li><a href="#"><i class="fa fa-cog"></i> <span>Settings</span></a></li>
                    <li><a href="index.php?flag=kill"><i class="fa fa-sign-out"></i> <span>Sign Out</span></a></li>
                </ul>
            </div>

            <!--sidebar nav start-->
            <ul class="nav nav-pills nav-stacked custom-nav">
                <li <?php 
				if ($ativechk == 1)
				echo "class=\"active\""; 
				?>
                ><a href="homepage.php"><i class="fa fa-home"></i> <span>Dashboard</span></a></li>
                <li class="menu-list"><a href=""><i class="fa fa-mobile"></i> <span>Devices Section</span></a>
                    <ul class="sub-menu-list">
                        <li <?php 
				if ($ativechk == 3)
				echo "class=\"active\""; 
				?>
                ><a href="deviceCheckout.php"><i class="fa fa-sign-out"></i> Checkout Device </a></li>
                        <li <?php 
				if ($ativechk == 2)
				echo "class=\"active\""; 

				?>
                ><a href="device_rc.php"><i class="fa fa-check-circle"></i> Device Details </a></li>
                <li <?php 
				if ($ativechk == 4)
				echo "class=\"active\""; 

				?>
                ><a href="processCheckOut.php?flag=disown"><i class="fa fa-minus-circle"></i> Clear All </a></li>
                <?php
                if($dsgID == $adminDsg[$j])
				{
                ?>
                <li <?php 
				if ($ativechk == 5)
				echo "class=\"active\""; 

				?>
                ><a href="addevice.php"><i class="fa fa-plus-square"></i> Add Device </a></li>
                <?php
				}
                ?>
                <li <?php 
				if ($ativechk == 6)
				echo "class=\"active\""; 

				?>
                ><a href="devicePolice.php"><i class="fa fa-eye"></i> Device Police </a></li>
                    </ul>
                </li>
                <li class="menu"><a href="index.php?flag=kill"><i class="fa fa-sign-out"></i> <span>Sign Out</span></a></li>
            </ul>
            <!--sidebar nav end-->

        </div>
    </div>
    <!-- left side end-->
    
    <!-- main content start-->
    <div class="main-content" >

        <!-- header section start-->
        <div class="header-section">

        <!--toggle button start-->
        <a class="toggle-btn"><i class="fa fa-bars"></i></a>
        <!--toggle button end-->

       

        <!--notification menu start -->
        <div class="menu-right">
            <ul class="notification-menu">
                
                <li>
                    <a href="#" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                        <img src="<?php echo $avatarPath; ?>" alt="" />
                        <?php echo $userName ?>
                        <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-usermenu pull-right">
                        <li><a href="#"><i class="fa fa-user"></i>  Profile</a></li>
                        <li><a href="#"><i class="fa fa-cog"></i>  Settings</a></li>
                        <li><a href="index.php?flag=kill"><i class="fa fa-sign-out"></i> Log Out</a></li>
                    </ul>
                </li>

            </ul>
        </div>
        <!--notification menu end -->

        </div>
        <!-- header section end-->