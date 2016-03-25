<?php
    ini_set('mysql.connect_timeout',10);
    ini_set('default_socket_timeout',5);


    session_start();
	include_once 'dbconnect.php';

	if(!isset($_SESSION['Hotel_User_ID']))
	{
		header("Location: index.php");
	}

	    $res = mysql_query("SELECT * FROM Hotel_Info WHERE Hotel_ID =".$_SESSION['Hotel_User_ID']);
	    $userRow = mysql_fetch_array($res);

?>




<?php
    
    if(isset($_POST['btn_Upload_Image']))
    {

    	$Theme_Name = $_POST['roomStyle'];
    	$Bed_Size = $_POST['bedSize'];
    	$query_ID = mysql_query ("Select Theme_ID From Theme Where Theme_Name = '$Theme_Name' And Bed_Size = '$Bed_Size'");
    	$result_ID = mysql_fetch_array($query_ID);


    	// echo " Theme_Name is " .$Theme_Name. "<br>";
    	// echo " Bed_Size is " .$Bed_Size. "<br>"; 
    	// echo " Theme_ID is " .$result_ID['Theme_ID']. "<br>"; 

    	
    	if(getimagesize($_FILES['image']['tmp_name']) == FALSE)
        {
            echo "Please select an image.";
        }
        else
        {
            $image= addslashes($_FILES['image']['tmp_name']);
            $Name= addslashes($_FILES['image']['name']);
            $image= file_get_contents($image);
            $image= base64_encode($image);
            saveimage($_SESSION['Hotel_User_ID'],$result_ID['Theme_ID'], $Name,$image);
        }
        
    }
    //displayimage();



    function saveimage($Hotel_ID, $Theme_ID,$Name,$Image)
            {

                $qry="Insert into Hotel_Picture (Hotel_ID, Theme_ID, Picture_Name, Picture_Storage) values ('$Hotel_ID', '$Theme_ID', '$Name','$Image')";

                // echo "$qry" ."</br>";
                $result=mysql_query($qry);
                if($result)
                {	
                	?>
                	<script>alert('Image uploaded.');</script>
                	<?php
                    //echo "<br/>Image uploaded.";
                }
                else
                {	
                	?>
                	<script>alert('Image not uploaded.');</script>
                	<?php
                    //echo "<br/>Image not uploaded.";
                }
            }



    function displayimage()
		    {	
		    	$qry = "Select * from Hotel_Picture Where Hotel_ID =". $_SESSION['Hotel_User_ID'];
		    	//$qry = "Select Picture_Storage from Hotel_Picture Where Hotel_ID =". $_SESSION['Hotel_User_ID'] ." And Theme_ID = ".$result_ID['Theme_ID'];
		    	//echo "$qry" ."</br>"; 
		        $result=mysql_query($qry);

		        while($row = mysql_fetch_array($result))
		        {
		            echo '<img height="300" width="300" src="data:image;base64,'.$row[Picture_Storage].' "> ';
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
    <label>Manage & Images For <?php echo $userRow['Hotel_Uname']; ?> </label>
    </div>
    <div id="right">
    	<div id="content">
        	<a href="logout.php?logout">Sign Out</a>
        </div>
    </div>
</div>

<div id="menu">
    <a href="home.php"> Update </a> <br>
    <a href="Hotel_Account.php"> Account </a>

</div>



<div id="body">
    <div id="Hotel-InfoForm">
    	<form method="post" enctype="multipart/form-data">
    		<center>
    		<table align="center" width="40%" border="0">

    		<tr>
        	<td>Style: 
        	<select name="roomStyle">

				<?php 
					$sql = mysql_query("SELECT DISTINCT Theme_Name FROM Theme");
					while ($style_Row = mysql_fetch_array($sql))
					{
						 echo '<option value="'.$style_Row['Theme_Name'].'">'.$style_Row['Theme_Name'].'</option>';
					}
				?>

			</select>
				<br>
				<br>
			</td>

			</tr>
			<tr>
			<td>Size: 
			<select name="bedSize">

				<?php 
					$sql = mysql_query("SELECT DISTINCT Bed_Size FROM Theme");
					while ($size_Row = mysql_fetch_array($sql))
					{
						 echo '<option value="'.$size_Row['Bed_Size'].'">'.$size_Row['Bed_Size'].'</option>';
					}
				?>
			</select>
			<br>
			<br>
			</td>	
			</tr>

			<tr>
			<td>
				<input type="file" name="image" />
	            <br/>
	            <br/>
	            <input type="submit" name="btn_Upload_Image" value="Upload" />

			</td>	
			</tr>
			<center>
        	</table>


        	<br>
			<br>
			<br>
			<br>
			<br>
			<br>


		</form>	

		    <?php
        		displayimage();
        	?>

		<br> 
		<br>
		<br>
		<br>


		<hr>


	</div>
</div>




</body>
</html>