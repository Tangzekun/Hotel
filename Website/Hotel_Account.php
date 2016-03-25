<?php

session_start();
include_once 'dbconnect.php';

if(!isset($_SESSION['Hotel_User_ID']))
{
	header("Location: index.php");
}

    $res = mysql_query("SELECT * FROM Hotel_Info WHERE Hotel_ID =".$_SESSION['Hotel_User_ID']);
    $userRow = mysql_fetch_array($res);

    $HA_Res = mysql_query("SELECT * FROM Hotel_Account WHERE Hotel_ID =".$_SESSION['Hotel_User_ID']);
    //$HA_Row = mysql_fetch_array($HA_Res);
    $HA_Count = mysql_num_rows($HA_Res);

    // echo "$HA_Count". "<br>";
    // echo "$HA_Row[Check_In_Date]";

    function ageCalculator($dob)
			{
				if(!empty($dob))
				{
					$birthdate = new DateTime($dob);
					$today   = new DateTime('today');
					$age = $birthdate->diff($today)->y;
					return $age;
				}
				else
				{
					return 0;
				}
			}

?>










<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Hello - <?php echo $userRow['Hotel_Email']; ?></title>
<link rel="stylesheet" href="style.css" type="text/css" />
</head>
<body>


<div id="header">
	<div id="left">
    <label>Welcome <?php echo $userRow['Hotel_Uname']; ?> </label>
    </div>
    <div id="right">
    	<div id="content">
        	<a href="logout.php?logout">Sign Out</a>
        </div>
    </div>
</div>

<div id="menu">
    <a href="manage.php"> Manage </a> <br>
    <a href="home.php"> Update </a>

</div>


<div id="body">
	<center>
    <div id="Hotel-InfoForm">
    	<form method="post" enctype="multipart/form-data">

<!--     		<table.ver2 align="center" width="60%" border="0"> -->
			<table align="center" width="85%" border = "1">
    			<tr>
    			<th>Check In Data</th>
   				<th>Check Out Data</th>	
   				<th>Theme</th>	
   				<th>Bed Size</th>		
    			<th>First Name</th>
    			<th>Last Name</th>
    			<th>Gender</th>
    			<th>Age</th>
    			<th>Phone Number</th>
    			<th>Email</th>
  				</tr>





  				<?php
  				//for($counter = 0; $counter < $HA_Count; $counter = $counter + 1)
  				while($HA_Row = mysql_fetch_assoc($HA_Res))
  				{		

  					// using $counter for $HA_Row[....]

  					echo "<tr>";

  					echo "<td>";
  					echo "$HA_Row[Check_In_Date]";
					echo "</td>";

					echo "<td>";
  					echo "$HA_Row[Check_Out_Date]";
					echo "</td>";

					
					$Theme_Res = mysql_query("SELECT * FROM Theme WHERE Theme_ID = ".$HA_Row[Theme_ID]);
					$Theme_Row = mysql_fetch_array($Theme_Res);

					echo "<td>";
  					echo "$Theme_Row[Theme_Name]";
					echo "</td>";

					echo "<td>";
  					echo "$Theme_Row[Bed_Size]";
					echo "</td>";



					$Guest_Res = mysql_query("SELECT * FROM Guest_Info WHERE Guest_ID = ".$HA_Row[Guest_ID]);
					$Guest_Row = mysql_fetch_array($Guest_Res);
					

					echo "<td>";
  					echo "$Guest_Row[First_Name]";
					echo "</td>";

					echo "<td>";
  					echo "$Guest_Row[Last_Name]";
					echo "</td>";

					echo "<td>";
  					echo "$Guest_Row[Gender]";
					echo "</td>";


					echo "<td>";
  					echo ageCalculator($Guest_Row[Birth_Day]);
					echo "</td>";
					

					echo "<td>";
  					echo "$Guest_Row[Phone_Num]";
					echo "</td>";

					echo "<td>";
  					echo "$Guest_Row[Email]";
					echo "</td>";
					


  					echo "</tr>\n";

  				}

  				?>


    		</table>



    	</form>
    </div>
	</center>

</div>

</body>
</html>






