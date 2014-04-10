<? ob_start(); ?>
<?php
	include"refs/conn.php"; 
	$vcode = $_GET["vcode"];
	$emailRev = $_GET["email"];
	$query = sprintf("SELECT * FROM user_master where verified='".$vcode."'"); 
	
    $sql = mysql_query($query); 
    
    while($row = mysql_fetch_array($sql))
    {
    	if (strrev($row['email']) == $emailRev)
    	{
    		$sql = mysql_query("UPDATE user_master SET verified='1' WHERE email = '". $row['email'] ."'");
    		echo "Verified";
    		header("Location: index.php");
    		exit;
    	}
    	else
    	{
    		//echo "Please check the link.";
    		header("Location: index.php");
    		
    	}
    	
    }
    header("Location: index.php");
    
 ?>