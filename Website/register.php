<?php
session_start();
if(isset($_SESSION['Hotel_User_ID'])!="")
{
	header("Location: home.php");
}
include_once 'dbconnect.php';

if(isset($_POST['btn_Register']))
{
	$Hotel_Uname = mysql_real_escape_string($_POST['register_Name']);
	$Hotel_Email = mysql_real_escape_string($_POST['register_Email']);
	$Hotel_Password = md5(mysql_real_escape_string($_POST['register_Password']));
	
	$Hotel_Uname = trim($Hotel_Uname);
	$Hotel_Email = trim($Hotel_Email);
	$Hotel_Password = trim($Hotel_Password);
	
	// email exist or not
	$query = "SELECT Hotel_Email FROM Hotel_Info WHERE Hotel_Email='$Hotel_Email'";
	$result = mysql_query($query);
	
	$count = mysql_num_rows($result); // if email not found then register
	
	if($count == 0)
	{
		
		if(mysql_query("INSERT INTO Hotel_Info(Hotel_Uname,Hotel_Email,Hotel_Password) VALUES('$Hotel_Uname','$Hotel_Email','$Hotel_Password')"))
		{
			?>
			<script>alert('successfully registered ');</script>
			<?php
		}
		else
		{
			?>
			<script>alert('error while registering you...');</script>
			<?php
		}		
	}

	else
	{
			?>
			<script>alert('Sorry Email ID already taken ...');</script>
			<?php
	}
	
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Login & Registration System</title>
<link rel="stylesheet" href="style.css" type="text/css" />

</head>
<body>
<center>
<div id="Register_Form">
<form method="post">
<table align="center" width="30%" border="0">
<tr>
<td><input type="text" name="register_Name" placeholder="User Name" required /></td>
</tr>
<tr>
<td><input type="email" name="register_Email" placeholder="Hotel Email" required /></td>
</tr>
<tr>
<td><input type="password" name="register_Password" placeholder="Hotel Password" required /></td>
</tr>
<tr>
<td><button type="submit" name="btn_Register">Register</button></td>
</tr>
<tr>
<td><a href="index.php">Log In</a></td>
</tr>
</table>
</form>
</div>
</center>
</body>
</html>