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
$reg = false;
$error = "";
$verificationString = '0';
if(isset($_POST['submit']))
	{ 

	    # connect to the database here 
	    # search the database to see if the user name has been taken or not 
	    $query = "SELECT * FROM user_master WHERE email='".mysql_real_escape_string($_POST['email'])."'";
	    $sql = mysql_query($query); 

	    #check too see what fields have been left empty, and if the passwords match 
	   	// if($row||empty($_POST['usermail'])|| empty($_POST['fname'])||empty($_POST['lname'])|| empty($_POST['cellno'])||empty($_POST['password'])|| empty($_POST['re_password'])||$_POST['password']!=$_POST['re_password'])
	    if(empty($_POST['email'])|| empty($_POST['first_name'])||empty($_POST['last_name'])|| empty($_POST['cell_number'])||empty($_POST['password'])|| empty($_POST['password_confirmation'])||$_POST['password']!=$_POST['password_confirmation'])
	    	{ 
	        	# if a field is empty, or the passwords don't match make a message 
		        $error = '<p>'; 
		        if(empty($_POST['email'])){ 
		            $error .= 'User Email can\'t be empty<br>'; 
		        } 
		        if(empty($_POST['first_name'])){ 
		            $error .= 'First Name can\'t be empty<br>'; 
		        } 
		        if(empty($_POST['last_name'])){ 
		            $error .= 'Last Name can\'t be empty<br>'; 
		        } 
		        if(empty($_POST['cell_number'])){ 
		            $error .= 'Cell Number can\'t be empty<br>'; 
		        } 
		        if(empty($_POST['password'])){ 
		            $error .= 'Password can\'t be empty<br>'; 
		        } 
		        if(empty($_POST['password_confirmation'])){ 
		            $error .= 'You must re-type your password<br>'; 
		        } 
		        if($_POST['password']!=$_POST['password_confirmation']){ 
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
		            mysql_real_escape_string($_POST['email'])."','".
		            mysql_real_escape_string($_POST['password'])."','". 
		            "1"."','".	
		            mysql_real_escape_string($_POST['cell_number'])."','". 
		            mysql_real_escape_string($_POST['first_name'])."','".
		            mysql_real_escape_string($_POST['last_name'])."','".$verificationString."')"
		            ); //or die(mysql_error()); 
		       // echo $query;
		        $sql = mysql_query($query) or die ('Error updating database: '.mysql_error()); 
		        //email($toEmail, $subject, $addressTo , $vCode);
		        //email(mysql_real_escape_string($_POST['usermail']), "- Email Verificaiton", mysql_real_escape_string($_POST['fname']) , $verificationString);
		        verificationLinkEmail(mysql_real_escape_string($_POST['email']), mysql_real_escape_string($_POST['first_name']) , $verificationString);
		        # Redirect the user to a login page 
		       // header("Location: registration.php?mode=1"); 
		        //exit; 
		        $reg = true;
    		}
    	
		
				//}
			    //else
			    //{ 
			        
			

        
    
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
				echo "Thank you for registering. Please check your email address for verificaiton.";
			}
			
		}
		else
			{
				if(isset($error))
				{
					echo $error;
					
				    //echo $error; 
				    unset($error); 
				    
				} 
			}
		?>
	</h3>
</div>
</div>
<?php
if ($reg)
{
?>
<div class="row">
<div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3"><br>
	<h3>Thank you for registering with us. Please check your email address for verification.</h3>
</div>
</div>
<?php
}
else
{

?>
<div class="row">

    <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">

		<form role="form" action="registration.php" method="post">
			<h2>Please Sign Up <small>It's free and always will be.</small></h2>
			<hr class="colorgraph">
			<div class="row">
				<div class="col-xs-12 col-sm-6 col-md-6">
					<div class="form-group">
                        <input type="text" name="first_name" id="first_name" class="form-control input-lg" placeholder="First Name" tabindex="1">
					</div>
				</div>
				<div class="col-xs-12 col-sm-6 col-md-6">
					<div class="form-group">
						<input type="text" name="last_name" id="last_name" class="form-control input-lg" placeholder="Last Name" tabindex="2">
					</div>
				</div>
			</div>
			<div class="form-group">
				<input type="text" name="cell_number" id="cell_number" class="form-control input-lg" placeholder="Cell Number" tabindex="3">
			</div>
			<div class="form-group">
				<input type="email" name="email" id="email" class="form-control input-lg" placeholder="Email Address" tabindex="4">
			</div>
			<!--
			<div class="form-group">
				<input type="text" name="display_name" id="display_name" class="form-control input-lg" placeholder="Display Name" tabindex="3">
			</div>
			-->
			
			<div class="row">
				<div class="col-xs-12 col-sm-6 col-md-6">
					<div class="form-group">
						<input type="password" name="password" id="password" class="form-control input-lg" placeholder="Password" tabindex="5">
					</div>
				</div>
				<div class="col-xs-12 col-sm-6 col-md-6">
					<div class="form-group">
						<input type="password" name="password_confirmation" id="password_confirmation" class="form-control input-lg" placeholder="Confirm Password" tabindex="6">
					</div>
				</div>
			</div>
			<div class="row">
				<!--<div class="col-xs-4 col-sm-3 col-md-3">
					<span class="button-checkbox">
						<button type="button" class="btn" data-color="info" tabindex="7">I Agree</button>
                        <input type="checkbox" name="t_and_c" id="t_and_c" class="hidden" value="1">
					</span>
				</div>
				-->
				<div class="col-xs-8 col-sm-12 col-md-12">
					 By clicking <strong class="label label-primary">Register</strong>, you agree to the <a href="#" data-toggle="modal" data-target="#t_and_c_m">Terms and Conditions</a> set out by this site, including our Cookie Use.
				</div>
			</div>
			
			<hr class="colorgraph">
			<div class="row">
				<div class="col-xs-12 col-md-6"><input type="submit" name="submit" value="Register" class="btn btn-primary btn-block btn-lg" tabindex="7"></div>
				<div class="col-xs-12 col-md-6"><a href="index.php" class="btn btn-success btn-block btn-lg">Log In</a></div>
			</div>
		</form>
	</div>
</div>
<!-- Modal -->
<div class="modal fade" id="t_and_c_m" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title" id="myModalLabel">Terms & Conditions - Interestship(Interestship.com-Students and Employers)</h4>
			</div>
			<div class="modal-body">
				

<p><b>Acceptance of Terms of Use.</b></p>

<p>This page states the Terms of Use under which you may access and use the website, www.Interestship.com. This website is maintained by Interestship.com, which is part of Angaros (India) Pvt. Ltd.</p>

<p>Please read the document carefully. If you do not accept the Terms stated here, please do not use Interestship.com and its services. By using the website and services of Interestship.com, you agree to abide by these terms.</p>

<p>Interestship.com may change the Terms of Use any time, by updating this post. Use of the website after such changes are posted, will signify your agreement to these revised terms. You should visit this page periodically to review the current Terms.</p>


<p><b>Terms for Student Users</b></p>

<p>These specific Terms of Use for student users are in addition to the other general Terms of Use listed in this page, which are applicable for all users.</p>

<p>You need to provide accurate and complete information at the time of registration with Interestship.com. Any false information or incorrect data can result into cancellation of your registration. Please remember that misrepresentation of information reflects badly upon your profile and you can end up losing good internship opportunities as well.
It is advised to read all internship postings carefully, before applying. Understand the requirement, scope of learning, area of work and judge every opportunity with regards to your talent and need. Irrelevant applications considerably diminish your chance of getting a suitable internship opportunity. Once you apply for an internship, you cannot withdraw you application.
Interestship.com is a platform for dedicated students and hence expects utmost decorum and discipline from students, while dealing with other users or employers. A professional and dignified code of conduct is mandatory for all users.
Sharing of any illegal, unconstitutional and/or un-ethical content or data on Interestship.com is strictly prohibited. Users indulging in such suspicious activities will be blocked from using Interestship.com and might face legal actions taken against them. If you come across any such unwanted activities on Interestship.com, immediately report it. You can do so by mailing us at info@Interestship.com
Registering with Interestship.com does not assure a guaranteed internship to any student. We provide students with the best internship opportunities that they can explore. Interestship.com is an internship portal only and is not to be mistaken as a recruitment agency.</p>

<p><b>Terms for Employers</b></p>

<p>These specific Terms of Use for employers are in addition to the other general Terms of Use listed in this page, which are applicable for all users.</p>

<p>While posting an internship requirement, it is your responsibility to provide accurate and updated information about your organization and the internship. Vague descriptions or incorrect details will fetch you less number of applications.
By uploading logos and images along with an internship or during registration, you are authorizing Interestship.com to use it for any promotional use on all its forums or in the list of our clients.
If you are making any job posting on behalf of your company, it is your responsibility to establish your authorization to do so. In case of any legal dispute related to unauthorized posting, you will be solely responsible for it. You would also indemnify Interestship.com of all possible consequences arising out of such issues.
If your internship postings contain false information or inaccurate data, Interestship.com reserves the rights to delete or block your postings and can terminate your registration, basis the severity of the breach of conduct.
Interestship.com gives you an access to quality talents. However, posting your internship requirement does not assure hiring of an intern.</p>

<p><b>Intellectual Property Rights</b></p>

<p>All materials displayed or reproduced, on the websitewww.Interestship.com, including and not limited to names, words, titles, phrases, logos, designs, graphics, icons, trademarks, images, photographs, illustrations, audio clips, video clips, are protected and owned by Interestship.com. While certain trademarks of third parties may be used by Interestship.com under license, the display of third-party trademarks on the website should not be taken to imply any relationship or license between Interestship.com and the owner of said trademark or to imply that Interestship.com endorses the wares, services or business of the owner of said trademark.</p>

<p>Nothing contained on the website should be construed as granting you any license or right to use any trademark logo or design of Interestship.com or any third party, without the written permission of Interestship.com or the respective owner of any third-party trademark. In addition, Interestship.com reserves the right to display the information submitted by you on the site for information purpose and will try not to mislead or misrepresent this information while respecting users privacy. ANY USE, REPRODUCTION, ALTERATION, MODIFICATION, PUBLIC PERFORMANCE OR DISPLAY, UPLOADING OR POSTING ONTO THE INTERNET, TRANSMISSION, REDISTRIBUTION OR OTHER EXPLOITATION OF THE WEBSITE OR OF ANY CONTENT, WHETHER IN WHOLE OR IN PART, IS PROHIBITED WITHOUT THE EXPRESS WRITTEN PERMISSION OF Interestship.COM.</p>

<p>The information provided under the Trending Events Tab is solely for the benefit (as a value addition) of users. Interestship.com is not responsible for content, logo, marketing material displayed. However on request, the information can be modified or deleted.</p>


<p><b>Cyber Security Rights</b></p>

<p>Users are strictly prohibited from violating or attempting to violate the security of Interestship.com’s website and its other related websites, including and not limited to, through the following activities:</p>
<ul>

<ol> (a) accessing secured data not intended for such users, or logging into a server which is not authorized to be accessed; </ol>
<ol> (b) to probe or test the vulnerability of a network, system or a website or to violate security without proper authorization; </ol>
<ol> (c) attempting to interfere with the server or network, including and not limited to, by submitting / uploading a virus to the Interestship.com site, spamming, or crashing. Infringement of any kind into the system or network security might result into civil or criminal action against such users.</ol></ul>

<p>Interestship.com will take due legal action against such violations and collaborate with law enforcement authorities to prosecute users who are involved into such illegal activities.</p>


<p><b>Indemnity</b></p>

<p>Interestship.com and its allied partners, employees, agents and third party information providers, are hereby indemnified, against any claim of damage, destruction, costs, liabilities or expenses, as a result of postings, conduct, unauthorized use of the content of the website, breach of terms and Privacy Policy of the site, or breach of any other rights and terms.</p>

<p>Interestship.com and its allied partners, employees, agents and third party information providers, are also indemnified of any and all damages arising out of unauthorized use of Content on the site, or any other illegal activities, categorically falling under the Terms of Use and Privacy Policy.</p>


<p><b>Disclaimer of warranties</b></p>

<p>by accessing and using the website you acknowledge and agree that use of the website and the content is entirely at your own risk. Interestship.com makes no representations or warranties regarding the website and the content, including, without limitation, no representation or warranty</p>

(i) that the website and/or content will be accurate, complete, reliable, suitable or timely; <br>
(ii) that any content, including, without limitation, any information, data, software, product or service contained in or made available through the website will be of merchantable quality or fit for a particular purpose; <br>
(iii) that the operation of the website will be uninterrupted or error free; <br>
(iv) that defects or errors in the website will be corrected; <br>
(v) that the website will be free from viruses or harmful components; <br>
(vi) that communications to or from the website will be secure or not intercepted.<br>

<p>the responses provided by the individuals are their personal opinion and neither Interestship.com nor angaros (india) pvt ltd are responsible for any legal, financial and personal trouble or loss arising out of application of advice given herein. please seek a certified career advisor for professional growth.</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" data-dismiss="modal">I Agree</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php
}
?>
</div> <!-- container -->
<div id="footer">
  <div class="container">
    <div class="row" style="text-align:right;">

      <h4><p class="text-muted">Queries: team@interestship.com | +91-7676217177 | +91-9535395934 | +91-9879823914   </p></h4>
    
    </div>
  </div>
</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/bootsnip.js"></script>	
	<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-49737929-1', 'interestship.com');
  ga('send', 'pageview');

</script>
</body>
</html>

