<?php
session_start();

if(!isset($_SESSION['Hotel_User_ID']))
{
	header("Location: index.php");
}
else if(isset($_SESSION['Hotel_User_ID'])!="")
{
	header("Location: home.php");
}

if(isset($_GET['logout']))
{
	session_destroy();
	unset($_SESSION['Hotel_User_ID']);
	header("Location: index.php");
}
?>