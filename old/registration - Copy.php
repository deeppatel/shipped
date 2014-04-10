<?php 
include"refs/conn.php"; 
include"refs/common.php"; 

$error = "";
$verificationString = '0';
if(isset($_POST['submit']))
	{ 

	    # connect to the database here 
	    # search the database to see if the user name has been taken or not 
	    $query = "SELECT * FROM user_master WHERE email='".mysql_real_escape_string($_POST['usermail'])."'";
	    $sql = mysql_query($query); 

	    #check too see what fields have been left empty, and if the passwords match 
	   	// if($row||empty($_POST['usermail'])|| empty($_POST['fname'])||empty($_POST['lname'])|| empty($_POST['cellno'])||empty($_POST['password'])|| empty($_POST['re_password'])||$_POST['password']!=$_POST['re_password'])
	    if(empty($_POST['usermail'])|| empty($_POST['fname'])||empty($_POST['lname'])|| empty($_POST['cellno'])||empty($_POST['password'])|| empty($_POST['re_password'])||$_POST['password']!=$_POST['re_password'])
	    	{ 
	        	# if a field is empty, or the passwords don't match make a message 
		        $error = '<p>'; 
		        if(empty($_POST['usermail'])){ 
		            $error .= 'User Email can\'t be empty<br>'; 
		        } 
		        if(empty($_POST['fname'])){ 
		            $error .= 'First Name can\'t be empty<br>'; 
		        } 
		        if(empty($_POST['lname'])){ 
		            $error .= 'Last Name can\'t be empty<br>'; 
		        } 
		        if(empty($_POST['cellno'])){ 
		            $error .= 'Cell Number can\'t be empty<br>'; 
		        } 
		        if(empty($_POST['password'])){ 
		            $error .= 'Password can\'t be empty<br>'; 
		        } 
		        if(empty($_POST['re_password'])){ 
		            $error .= 'You must re-type your password<br>'; 
		        } 
		        if($_POST['password']!=$_POST['re_password']){ 
		            $error .= 'Passwords don\'t match<br>'; 
	        	} 
        //if($row != 1)
        //if(mysql_num_rows($sql) > 0) { 
        //    $error .= 'User Name already exists<br>'; 
        	}
        $row = mysql_fetch_array($sql);
        if($row > 0)
        //if (mysql_num_rows($sql) > 0)
        	{
        		$error .= 'Email Address already registered<br>'; 
        		$error .= '</p>';
        	}
    	else
    		{
    			$error .= '</p>' ;
    			# If all fields are not empty, and the passwords match, 
		        # create a session, and session variables, 
		        $verificationString = generateRandomString(25);
		        $query = sprintf("INSERT INTO user_master(`email`,`password`,`type`,`cell_number`,`first_name`,`last_name`,`verified`) 
		            VALUES('".
		            mysql_real_escape_string($_POST['usermail'])."','".
		            mysql_real_escape_string($_POST['password'])."','". 
		            "1"."','".	
		            mysql_real_escape_string($_POST['cellno'])."','". 
		            mysql_real_escape_string($_POST['fname'])."','".
		            mysql_real_escape_string($_POST['lname'])."','".$verificationString."')"
		            ); //or die(mysql_error()); 
		       // echo $query;
		        $sql = mysql_query($query) or die ('Error updating database: '.mysql_error()); 
		        //email($toEmail, $subject, $addressTo , $vCode);
		        //email(mysql_real_escape_string($_POST['usermail']), "- Email Verificaiton", mysql_real_escape_string($_POST['fname']) , $verificationString);
		        verificationLinkEmail(mysql_real_escape_string($_POST['usermail']), mysql_real_escape_string($_POST['fname']) , $verificationString);
		        # Redirect the user to a login page 
		       // header("Location: registration.php?mode=1"); 
		        exit; 
    		}
    	if(isset($error))
			{
				echo $error;
				
			    //echo $error; 
			    unset($error); 
			    
			} 
		
				//}
			    //else
			    //{ 
			        
			

        
    
    }  
# echo out each variable that was set from above, 
# then destroy the variable. 

?> 
<!-- Start your HTML/CSS/JavaScript here -->
<?php
if (isset($_GET['mode']))
{
	if($_GET['mode'] == 1)
	{
		echo "<p>Thank you for registering. Please check your email address for verificaiton.</p>";
	}
	else
	{
	?>
		<form action="registration.php" method="post">
		    <p>Email Address:<br /><input type="text" name="usermail" /></p>
		    <p>First Name:<br /><input type="text" name="fname" /></p>
		    <p>Last Name:<br /><input type="text" name="lname" /></p>
		    <p>Cell Number:<br /><input type="text" name="cellno" /></p>
		    <p>Password:<br /><input type="password" name="password" /></p>
		    <p>Re-Type Password:<br /><input type="password" name="re_password" /></p>
		    <p><input type="submit" name="submit" value="Sign Up" /></p>
		</form>
	<?php
	}
}
else
	{
	?>
		<form action="registration.php" method="post">
		    <p>Email Address:<br /><input type="text" name="usermail" /></p>
		    <p>First Name:<br /><input type="text" name="fname" /></p>
		    <p>Last Name:<br /><input type="text" name="lname" /></p>
		    <p>Cell Number:<br /><input type="text" name="cellno" /></p>
		    <p>Password:<br /><input type="password" name="password" /></p>
		    <p>Re-Type Password:<br /><input type="password" name="re_password" /></p>
		    <p><input type="submit" name="submit" value="Sign Up" /></p>
		</form>
	<?php
	}

?>