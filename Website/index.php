<?php
session_start();
include_once 'dbconnect.php';

if(isset($_SESSION['user'])!="")
{
	header("Location: home.php");
}

if(isset($_POST['btn_Login']))
{
	$Hotel_Email = mysql_real_escape_string($_POST['input_Email']);
	$Hotel_Password = mysql_real_escape_string($_POST['input_Password']);
	
	$Hotel_Email = trim($Hotel_Email);
	$Hotel_Password = trim($Hotel_Password);
	
	$res=mysql_query("SELECT Hotel_ID, Hotel_Password FROM Hotel_Info WHERE Hotel_Email='$Hotel_Email'");
	$row=mysql_fetch_array($res);
	
	$count = mysql_num_rows($res); // if uname/pass correct it returns must be 1 row
	
	if($count == 1 && $row['Hotel_Password']==md5($Hotel_Password))
	{
		$_SESSION['Hotel_User_ID'] = $row['Hotel_ID'];
		header("Location: home.php");
	}
	else
	{
		?>
        <script>alert('Username / Password Seems Wrong !');</script>
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
<div id="login-form">
<form method="post">
<table align="center" width="30%" border="0">
<tr>
<td><input type="text" name="input_Email" placeholder="Hotel Email" required /></td>
</tr>
<tr>
<td><input type="password" name="input_Password" placeholder="Hotel Password" required /></td>
</tr>
<tr>
<td><button type="submit" name="btn_Login">Log In</button></td>
</tr>
<tr>
<td><a href="register.php"> Register </a></td>
</tr>
</table>
</form>
</div>
</center>
</body>
</html>