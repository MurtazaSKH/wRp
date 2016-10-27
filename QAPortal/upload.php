<?php
if ($_POST["label"]) {
    $label = $_POST["label"];
}
$allowedExts = array("gif", "jpeg", "jpg", "png");
$temp = explode(".", $_FILES["file"]["name"]);
$extension = end($temp);
if ((($_FILES["file"]["type"] == "image/gif")
|| ($_FILES["file"]["type"] == "image/jpeg")
|| ($_FILES["file"]["type"] == "image/jpg")
|| ($_FILES["file"]["type"] == "image/pjpeg")
|| ($_FILES["file"]["type"] == "image/x-png")
|| ($_FILES["file"]["type"] == "image/png"))
&& ($_FILES["file"]["size"] < 20000000000)
&& in_array($extension, $allowedExts)) {
    if ($_FILES["file"]["error"] > 0) {
        echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
    } else {
        $filename = $label.$_FILES["file"]["name"];
        session_start();
        $temp = explode(".", $_FILES["file"]["name"]);
        $newfilename = $_SESSION['eid'] . '.' . end($temp);
        $move = "assets/avatars/".$newfilename;
        
        include("./includes/mysqlConnect.php");

        if (file_exists("assets/avatars/" . $newfilename)) {
            if (!unlink($move))
              {
              echo ("Please try again!");
              }
            else
              {
              echo ("Avatar Replaced!");
              move_uploaded_file($_FILES["file"]["tmp_name"],$move);
              $sql = "UPDATE employee SET AvatarPath='$newfilename' where EID='".$_SESSION['eid']."' ";
              $_SESSION['avatar']=$newfilename;
                if(mysqli_query($db,$sql))
                {
                    //echo "Record has been updated ";
                }
                else
                {
                     //die('Invalid query: ' . mysql_error());
                }
              }
        } else {
            if(move_uploaded_file($_FILES["file"]["tmp_name"],$move))
            {
                echo "Avatar set.";
                $sql = "UPDATE employee SET AvatarPath='$newfilename' where EID='".$_SESSION['eid']."' ";
                $_SESSION['avatar']=$newfilename;
                if(mysqli_query($db,$sql))
                {
                    //echo "Record has been updated ";
                }
                else
                {
                     //die('Invalid query: ' . mysql_error());
                }  
            }
            else
            {
                echo "Please try again!";
            }
            
        }
    }
} else {
    echo "Invalid file";
}
?>