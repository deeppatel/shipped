
<?php 

include"refs/conn.php"; 
include"refs/common.php"; 

?>

<?php 
//echo $_POST['submit'];
//echo mysql_real_escape_string($_POST['userid']);

$error = "";
$verificationString = '0';
if(isset($_POST['submit']))
	{ 

	    		$error .= '</p>' ;
    			# If all fields are not empty, and the passwords match, 
		        # create a session, and session variables, 
		        
		        $query = sprintf("INSERT INTO `user_details`(`user_master_id`, `college_id`, `degree_level`, `semester`, `branch_id`, `gender`,`languages`) VALUES ('".
		        //$query = sprintf("INSERT INTO user_master(`email`,`password`,`type`,`cell_number`,`first_name`,`last_name`,`verified`) 
		          //  VALUES('".
		            mysql_real_escape_string($_POST['userid'])."','".
		            mysql_real_escape_string($_POST['College'])."','". 
		            mysql_real_escape_string($_POST['Level'])."','".
		            mysql_real_escape_string($_POST['Semester'])."','".
		            mysql_real_escape_string($_POST['Branch'])."','". 
		            mysql_real_escape_string($_POST['Gender'])."','". 
		        	mysql_real_escape_string($_POST['languages'])."')"
		            ); //or die(mysql_error()); 
		       // echo $query;
		        $sql = mysql_query($query); // or die ('Error updating database: '.mysql_error()); 
		        //email($toEmail, $subject, $addressTo , $vCode);
		        //email(mysql_real_escape_string($_POST['usermail']), "- Email Verificaiton", mysql_real_escape_string($_POST['fname']) , $verificationString);
		        //verificationLinkEmail(mysql_real_escape_string($_POST['email']), mysql_real_escape_string($_POST['first_name']) , $verificationString);
		        # Redirect the user to a login page 
		      // header("Location: aptitude.php"); 
		        //exit; 
    		
        
    
    }  
    else
    {
    	//header("Location: aptitude.php"); 
    }
# echo out each variable that was set from above, 
# then destroy the variable. 

?> 





		 <?php
/*		if (isset($_GET['mode']))
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
*/
		?>

