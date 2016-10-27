<div class="clear"></div>
<div id="userbar"><!-- Userbar Begin -->
    <div id="profile"><!-- Profile Begin -->
        <div id="avatar">
            <img src="<?php echo $avatarPath; ?>" alt="Avatar" height="44" width="44" />
        </div>
        <div id="profileinfo">
            <h3 id="username"><?php echo $userName ?></h3>
            <span id="subline"><?php echo $dsgName ?></span>
            <div class="clear"></div>
            <a href="settings.php" class="profilebutton">Profile</a>
            <a href="index.php?flag=kill" class="profilebutton">Logout</a>
        </div>
    </div><!-- Profile End -->
    <ul id="navigation"><!-- Main Navigation Begin -->
        <li class="activepage"><a href="home.php" class="icon_home">Dashboard</a></li>
        <?php
        include("mysqlConnect.php");
        
		//Display the Device Records icon in the Navigation Bar
        $query = "SELECT DsgID FROM operationrights WHERE AppName = 'DeviceRecords' AND RightName = 'Basic'";
        $result = mysql_query($query) or die('Query failed: ' . mysql_error());
        $num_results = mysql_num_rows($result);
        $row = NULL;
        $deviceRecordsDsg[0]=0;
                                
        for($i=0; $i < $num_results ; $i++)
        {
             $row = mysql_fetch_array($result);
             $deviceRecordsDsg[$i] = $row['DsgID'];
             
             if($dsgID == $deviceRecordsDsg[$i])
             {
                 echo "<li><a href='drec_home.php' class='icon_pictures'>Device Records</a></li>";
                 break;
             }//end of if
        }//end of for
        
        mysql_close($db);
        ?>
        
        <li><a href="index.php?flag=kill" class="icon_logout">Logout</a></li>
    </ul><!-- Main Navigation End -->