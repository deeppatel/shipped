<? ob_start(); ?>
/<!DOCTYPE html>
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
</body>
<p>
<?php

$error = "";

$result=mysql_query('Select * from address_zip;');
if(mysql_num_rows($result) > 0)
	{
		$row = mysql_fetch_array($result); 
		//echo $row['zipcodes']; 

	}
else
	{
		 $error .= "No data retrieved"; 
	}

if(isset($_GET['loginmode']))
{
	if($_GET['loginmode'] == -1 )
	{
		 $error .="Invalid email address or password. Please check the details you have entered";
	}
	elseif($_GET['loginmode'] == 0)
	{
		//opened login page directly
		 $error .="Please provide you details to proceed";
	}
	elseif($_GET['loginmode'] == -11 )
	{
		 $error .="Please verify your email address";
	}
	else
	{
		
		//do nothing
	}
}
	

?>
</p>
 <div class="row" style="margin-top:20px">
    <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
    <h3>
		 <?php
		
				if(isset($error))
				{
					echo $error;
					
				    //echo $error; 
				    unset($error); 
				    
				} 
			
		?>
	</h3>
		<form role="form" action="login.php" method="post">
			<fieldset>
				<h2>Please Sign In</h2>
				<hr class="colorgraph">
				<div class="form-group">
                    <input type="email" name="useremail" id="email" class="form-control input-lg" placeholder="Email Address">
				</div>
				<div class="form-group">
                    <input type="password" name="password" id="password" class="form-control input-lg" placeholder="Password">
				</div>
				<!--
				<span class="button-checkbox">
					<button type="button" class="btn" data-color="info">Remember Me</button>
                    <input type="checkbox" name="remember_me" id="remember_me" checked="checked" class="hidden">
					<a href="" class="btn btn-link pull-right">Forgot Password?</a>
				</span>
				-->
				<hr class="colorgraph">
				<div class="row">
					<div class="col-xs-6 col-sm-6 col-md-6">
                        <input type="submit" class="btn btn-lg btn-success btn-block" value="Sign In">
					</div>
					<div class="col-xs-6 col-sm-6 col-md-6">
						<a href="registration.php" class="btn btn-lg btn-primary btn-block">Register</a>
					</div>
				</div>
			</fieldset>
		</form>
	</div>
</div>
	<!--
<form action="login.php" method="post">
    Email Address:<br>
    <input type="text" name="useremail"><br><br>
    Password:<br>
    <input type="password" name="password"><br><br>
    <input type="submit" name="submit" value="Login">
</form> 
-->

<?php
include"refs/conn_close.php"; 
?>

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

