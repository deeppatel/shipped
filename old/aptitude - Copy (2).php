<!DOCTYPE html>
<html lang="en">
<?php 

include"refs/conn.php"; 
?>
<head>
	<title>Interest</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
	<script>
	function completeTest(str)	
		{
			//alert(document.getElementById("2").tagName);
		//alert(str);	
		if (str=="")
		  {
		  document.getElementById("txtHint").innerHTML="";
		  return;
		  } 
		if (window.XMLHttpRequest)
		  {// code for IE7+, Firefox, Chrome, Opera, Safari
		  xmlhttp=new XMLHttpRequest();
		  }
		else
		  {// code for IE6, IE5
		  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		  }
		xmlhttp.onreadystatechange=function()
		  {
		  if (xmlhttp.readyState==4 && xmlhttp.status==200)
		    {
		    //document.getElementById(str).innerText=xmlhttp.responseText;
		    document.getElementById("replaceablediv").innerHTML=xmlhttp.responseText;
		    checkProgress();
		    //alert("response received");
		    }
		  }
		//setid = document.getElementById("setid").value; 
		
		xmlhttp.open("GET","getnext.php?m=c&setid="+setid+"&aid="+str,true);
		xmlhttp.send();
		//alert("b");
		}
	function chooseAnswer(str)
		{
			//alert(document.getElementById("2").tagName);
		//alert(str);	
		if (str=="")
		  {
		  document.getElementById("txtHint").innerHTML="";
		  return;
		  } 
		if (window.XMLHttpRequest)
		  {// code for IE7+, Firefox, Chrome, Opera, Safari
		  xmlhttp=new XMLHttpRequest();
		  }
		else
		  {// code for IE6, IE5
		  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		  }
		xmlhttp.onreadystatechange=function()
		  {
		  if (xmlhttp.readyState==4 && xmlhttp.status==200)
		    {
		    //document.getElementById(str).innerText=xmlhttp.responseText;
		    document.getElementById("replaceablediv").innerHTML=xmlhttp.responseText;
		    checkProgress();
		    //alert("response received");
		    }
		  }
		setid = document.getElementById("setid").value; 
		
		xmlhttp.open("GET","getnext.php?m=n&setid="+setid+"&aid="+str,true);
		xmlhttp.send();
		//alert("b");
		}
	function skipAnswer(str)
		{
			//alert(document.getElementById("2").tagName);
		//alert("a");	
		if (str=="")
		  {
		  document.getElementById("txtHint").innerHTML="";
		  return;
		  } 
		if (window.XMLHttpRequest)
		  {// code for IE7+, Firefox, Chrome, Opera, Safari
		  xmlhttp=new XMLHttpRequest();
		  }
		else
		  {// code for IE6, IE5
		  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		  }
		xmlhttp.onreadystatechange=function()
		  {
		  if (xmlhttp.readyState==4 && xmlhttp.status==200)
		    {
		    //document.getElementById(str).innerText=xmlhttp.responseText;
		    document.getElementById("replaceablediv").innerHTML=xmlhttp.responseText;
		    checkProgress();
		  //  alert("response received");
		    }
		  }
		setid = document.getElementById("setid").value; 
		xmlhttp.open("GET","getnext.php?m=s&setid="+setid+"&aid=-1",true);
		xmlhttp.send();
		//alert("b");
		}
	function checkProgress()
		{
			
			//document.getElementById("progress").aria-valuenow = "52.5";
			progressval = Math.round(document.getElementById("setid").value/0.86);
			//alert(progressval);
			document.getElementById("progressbar").style.width = progressval + '%';
			document.getElementById("progressbar").innerHTML = "<span class='sr-only'>" + progressval + "% Complete</span>"
			
		}
	function orderChanged(rowid)
		{
			//id="interestOrder"
			alert(document.getElementById("interestOrder").length); // = progressval + '%';
		}
	</script>
</head>

<body onload="checkProgress()">
<br>
<hr>
	
	<div class="container">
		<div class="row">
       		<div class="col-md-4"></div>
       			<div class="col-md-4">
					<div class="progress progress-striped">
						<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 1%" id="progressbar">
							<span class="sr-only">0% Complete (success)</span>
						</div>
					</div>
				</div>
			<div class="col-md-2"></div>
		</div>

		<div class="panel panel-primary">

		<br>

		<div class="row">
			<div class="col-md-4"></div>
			<div class="col-md-4">
				<h4><b>Choose one option which you like doing</b></h4>
			</div>
			<div class="col-md-4"></div>
		</div>

		<br>
		<div class="row">


			<div class="col-md-1"></div>
	<div id="replaceablediv">
<?php
	
	
	$query2 = "SELECT test_interestv1_setid 
			FROM test_interestv1_result 
			WHERE user_master_id=".$_SESSION['id']." 
			ORDER BY test_interestv1_setid DESC LIMIT 1";
	
	$sql = mysql_query($query2); 
	$row = 0 ;
	if($sql === FALSE)
	{
		//$row = 0;
		//echo "R0:".$row;
	}
	else
	{	
		$row = mysql_fetch_array($sql);
		$row = $row['test_interestv1_setid'];
		//echo "Row:".$row;
	}

	
	$query= "SELECT * 
			FROM  attitude_interests_activities ,test_interestv1 
			WHERE attitude_interests_activities.id=test_interestv1.attitude_interests_activities_id
			AND test_interestv1.setid = ".(1+$row);
			//ORDER BY  test_interestv1.setid ASC;
	//echo $query;

	$sql = mysql_query($query); 
	$setid = -1;
    //echo "<table border = 1>";
    if($sql === FALSE)
	{
	}
	else
	{
    	$rowCount = mysql_num_rows($sql);
    }

    while($row = mysql_fetch_array($sql))
    {
    	$setid = $row['setid'];
    	?>
    	<div class="col-md-5">
    		<?php echo $row['id']; ?>
			<a href="#" class="btn btn-success btn-lg btn-block btn-huge">
				<h4 onclick="chooseAnswer(this.id)" id='<?php echo $row['id']; ?>'><?php echo $row['activity_name']; ?></h4>
			</a>
		</div>
		<?php
    	
    }
?>
<input type="hidden" id='setid' name="setid" value='<?php echo $setid; ?>'/>
</div>
			<div class="col-md-1"></div>
		</div>

		<br>


		<div class="row">
			<div class="col-md-5"></div>
			<div class="col-md-2">
				<?php
				if ($rowCount == 0)
				{
					?>
					<a href="#" class="btn btn-primary btn-lg btn-block btn-huge" onclick="completeTest(this.id)" id="com">
					<h4>Click to Complete</h4>
					</a>
					<?php
				}
				else
				{
					?>

					<a href="#" class="btn btn-primary btn-lg btn-block btn-huge" onclick="skipAnswer(this.id)" id="skip">
					<h4>Skip</h4>
					</a>
					<?php

				}
				else
					?>
					<div class="row">
						<div class="col-md-5"></div>
						<div class="col-md-2">
							<a href="#" class="btn btn-primary btn-lg btn-block btn-huge" onclick="submitInterestOrders()" id="submit">
							<h4>Submit</h4>
								</a>
						</div>
					</div>
					<?php
				?>
				
			</div>
			<div class="col-md-5"></div>
		</div>

		<hr>

	</div>


</div>


	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/bootsnippet.js"></script>
	
</body>
</html>
