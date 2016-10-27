		<?php 
		$con=mysqli_connect("localhost",
					"werplayc_test789",
					"Khanz789",
					"werplayc_apps");
		//$W = "";			
// Check connection
	if (mysqli_connect_errno())
  	{
 		 echo "Failed to connect to MySQL: " . mysqli_connect_error();
  	}
	mysqli_query($con,"UPDATE devicelist SET OwnedBy = '' where OwnedBy != 'Charging'");

echo "Success";
mysqli_close($con);

		?>