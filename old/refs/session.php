<?php
session_start();
if (isset($_SESSION['username']))
{
	//echo $_SESSION['username'];
	header("Location: dashboard.php"); 
}
else
{
	//echo "not started";
	header("Location: index.php"); 
}
?>