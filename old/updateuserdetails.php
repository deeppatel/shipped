<? ob_start(); ?>
<!DOCTYPE html>
<html lang="en">
<?php 

include"refs/conn.php"; 
include"refs/common.php"; 

?>
<head>
	<title>Interest</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
	<link href="css/colorgraf.css" rel="stylesheet" media="screen">
</head>

<body>
<?php 
echo $_POST['submit'];
echo mysql_real_escape_string($_POST['userid']);

$error = "";
$verificationString = '0';
if(isset($_POST['submit']))
	{ 

	    		$error .= '</p>' ;
    			# If all fields are not empty, and the passwords match, 
		        # create a session, and session variables, 
		        
		        $query = sprintf("INSERT INTO `user_details`(`user_master_id`, `college_id`, `degree_level`, `semester`, `branch_id`, `gender`) VALUES ('".
		        //$query = sprintf("INSERT INTO user_master(`email`,`password`,`type`,`cell_number`,`first_name`,`last_name`,`verified`) 
		          //  VALUES('".
		            mysql_real_escape_string($_POST['userid'])."','".
		            mysql_real_escape_string($_POST['College'])."','". 
		            mysql_real_escape_string($_POST['Level'])."','".
		            mysql_real_escape_string($_POST['Semester'])."','".
		            mysql_real_escape_string($_POST['Branch'])."','". 
		            mysql_real_escape_string($_POST['Gender'])."')"
		            ); //or die(mysql_error()); 
		       // echo $query;
		        $sql = mysql_query($query); // or die ('Error updating database: '.mysql_error()); 
		        //email($toEmail, $subject, $addressTo , $vCode);
		        //email(mysql_real_escape_string($_POST['usermail']), "- Email Verificaiton", mysql_real_escape_string($_POST['fname']) , $verificationString);
		        //verificationLinkEmail(mysql_real_escape_string($_POST['email']), mysql_real_escape_string($_POST['first_name']) , $verificationString);
		        # Redirect the user to a login page 
		       header("Location: aptitude.php"); 
		        //exit; 
    		
        
    
    }  
    else
    {
    	header("Location: aptitude.php"); 
    }
# echo out each variable that was set from above, 
# then destroy the variable. 

?> 



<div class="container">
<div class="row">
<div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
	<h3>
		 <?php
		if (isset($_GET['mode']))
		{
			if($_GET['mode'] == 1)
			{
				//echo "Thank you for registering. Please check your email address for verificaiton.";
			}
			
		}
		else
			{
				if(isset($error))
				{
					//echo $error;
					
				    //echo $error; 
				    unset($error); 
				    
				} 
			}
		?>
	</h3>
</div>
</div>


</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/bootsnip.js"></script>	
</body>
</html>

