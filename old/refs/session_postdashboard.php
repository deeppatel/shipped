<? ob_start(); ?>
<?php
session_start();
if (isset($_SESSION['username']))
{
	//echo $_SESSION['username'];
	
}
else
{
	//echo "not started";
	header("Location: index.php"); 
}
?>