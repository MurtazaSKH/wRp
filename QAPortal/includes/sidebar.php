<div class="sidebar">
        <div class="logopanel">
          <h1>
            <a href="dashboard.php"></a>
          </h1>
        </div>
        <div class="sidebar-inner">
          <div class="sidebar-top">
          </div>
          <div class="menu-title">
            Navigation 
          </div>
          <ul class="nav nav-sidebar">
            <li class=" nav-active active"><a href="dashboard.php"><i class="fa fa-home"></i><span data-translate="dashboard">Dashboard</span></a></li>
            <li class="nav-parent">
              <a href=""><i class="fa fa-mobile-phone" style="margin-left:7px;"></i><span data-translate="Devices">Devices </span><span class="fa arrow"></span></a>
              <ul class="children collapse">
                <li><a href="viewdevices.php"> View Devices</a></li>
                <li><a href="deviceList.php"> Checkout</a></li>
                <?php
                  if (isset($_SESSION['admin']))
                  {
                    if($_SESSION['admin']=='1' or $_SESSION['admin']=='2')
                    {
                        echo '<li><a href="addDevice.php">Add Device</a></li>';  
                    }
                  }

                ?>
              </ul>
            </li>
            <li class=" nav"><a href="profile.php"><i class="fa fa-user"></i><span data-translate="Profile">Profile</span></a></li>
            
            <!-- if user is admin -->
            <?php 
              session_start();
              if (isset($_SESSION['admin']))
              {
                if($_SESSION['admin']=='1')
                {
                    echo '<li class="nav-parent">
              <a href=""><i class="fa fa-users" ></i><span data-translate="Devices">Manage Users </span><span class="fa arrow"></span></a>
              <ul class="children collapse">
                <li><a href="addUser.php"> Add User</a></li>
                <li><a href="userList.php"> View/Edit Users</a></li>
              </ul>
            </li>';  
                }
                else if ($_SESSION['admin']=='2')
                {
                    echo '<li class="nav-parent">
              <a href=""><i class="fa fa-users" ></i><span data-translate="Devices">Manage Users </span><span class="fa arrow"></span></a>
              <ul class="children collapse">
                <li><a href="addUser.php"> Add User</a></li>
                <li><a href="userList.php"> View/Edit Users</a></li>
                <li><a href="addAdmin.php"> Add Admin User</a></li>
                <li><a href="adminList.php"> Activate Admin</a></li>
              </ul>
            </li>';  
                }
                
              }
            ?>

          </ul>
          
          <div class="sidebar-footer clearfix">
            <!-- <a class="pull-left footer-settings" href="#" data-rel="tooltip" data-placement="top" data-original-title="Settings">
            <i class="icon-settings"></i></a> -->
            <a class="pull-left toggle_fullscreen" href="#" data-rel="tooltip" data-placement="top" data-original-title="Fullscreen">
            <i class="fa fa-arrows-alt"></i></a>
            <!-- <a class="pull-left" href="#" data-rel="tooltip" data-placement="top" data-original-title="Lockscreen">
            <i class="icon-lock"></i></a> -->
            <a class="pull-left btn-effect" onclick="destroySessions()" data-modal="modal-1" data-rel="tooltip" data-placement="top" data-original-title="Logout">
            <i class="fa fa-sign-out"></i></a>
          </div>
        </div>
      </div>