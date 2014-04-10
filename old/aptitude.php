<? ob_start(); ?>
<!DOCTYPE html>
<html lang="en">
<?php 
include"refs/session_postdashboard.php"; 
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
		    //alert("response received");
		    }
		  }
		setid = document.getElementById("setid").value; 
		xmlhttp.open("GET","getnext.php?m=n&setid="+setid+"&aid=-1",true);
		xmlhttp.send();
		//alert("b");
		}
	function checkProgress()
		{
			
			//document.getElementById("progress").aria-valuenow = "52.5";
			progressval = Math.round(document.getElementById("setid").value/0.86);
			if (progressval < 0)
			{
				progressval = 100;
			}
			//alert(progressval);
			document.getElementById("progressbar").style.width = progressval + '%';
			//document.getElementById("progressbar").innerHTML = "<span class='sr-only'>" + progressval + "% Complete</span>";
			//document.getElementById("progressbar").innerText = progressval + "% Complete";
			
		}
	</script>
</head>

<body onload="checkProgress()">
<br>
<hr>
	
	<div class="container">
	   <div class="row">
        <div class="col-md-12">
            <ul class="nav nav-pills nav-justified thumbnail">
                <li class="disabled"><a href="#">
                    <h4 class="list-group-item-heading">Step 1</h4>
                    <p class="list-group-item-text">Provide Details</p>
                </a></li>
                <li class="active"><a href="#">
                    <h4 class="list-group-item-heading">Step 2</h4>
                    <p class="list-group-item-text">Aptitude - Interest</p>
                </a></li>
                <li class="disabled"><a href="#">
                    <h4 class="list-group-item-heading">Step 3</h4>
                    <p class="list-group-item-text">Aptitude - Domain Knowledge Test</p>
                </a></li>
                <li class="disabled"><a href="#">
                    <h4 class="list-group-item-heading">Step 4</h4>
                    <p class="list-group-item-text">Altitude - 6th April</p>
                </a></li>
            </ul>
        </div>
    </div>
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

		
<div id="replaceablediv">
<div class="panel panel-primary">

			<br>

		<div class="row">
			<div class="col-md-4"></div>
			<div class="col-md-4">
				<h4><b>Select an activity you would rather do</b></h4>
			</div>
			<div class="col-md-4"></div>
		</div>

		<br>
		<div class="row">


			<div class="col-md-1"></div>
	<?php
	
	
	$query2 = "SELECT test_interestv1_setid 
			FROM test_interestv1_result 
			WHERE user_master_id=".$_SESSION['id']." 
			ORDER BY test_interestv1_setid DESC LIMIT 1";

			//check the last set attempted
	
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
			//increment by 1 to fetch the next test 

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
    		<?php //echo $row['id']; ?>
			<a href="#" class="btn btn-success btn-lg btn-block btn-huge">
				<h4 onclick="chooseAnswer(this.id)" id='<?php echo $row['id']; ?>'><?php echo $row['activity_name']; ?></h4>
			</a>
		</div>
		<?php
    	//echo "<tr>";
    	//echo "<td>".$row['setid']."</td>"; 
    	
    	//echo "<td>".$row['last_name']."</td>"; 
    	//echo "<td>".$row['cell_number']."</td>"; 
    	//echo "<td>".$row['verified']."</td>"; 
    	//echo "<td><input type='Button' id='Select".$row['id']."' text='Select' value='Select".$row['id']."' onclick='showUser(this.value)'></td>";
    	//echo "</tr>"; 
    }
    

    //echo "</table>";
	?>
	<input type="hidden" id='setid' name="setid" value='<?php echo $setid; ?>'/>


		
			<!--
			<div class="col-md-5">
				<a href="#" class="btn btn-success btn-lg btn-block btn-huge">
					<h4>Check products wether they are good or not</h4>
				</a>
			</div>

			<div class="col-md-5">
				<a href="#" class="btn btn-success btn-lg btn-block btn-huge">
					<h4>code and build stuff and be awesome</h4>
				</a>
			</div>
			-->
			<div class="col-md-1"></div>
		</div>

		<br>


		<div class="row">
			<div class="col-md-5"></div>
			<div class="col-md-2">
				<?php
				if ($rowCount == 0 || $setid >= 86)
				{
					?>
					<a href="aptitude_complete.php" class="btn btn-primary btn-lg btn-block btn-huge" onclick="completeTest(this.id)" id="com">
					<h4>Click to Complete</h4>
					</a>
					<?php
				}
				else
				{
					?>

					<a href="#" class="btn btn-primary btn-lg btn-block btn-huge" onclick="skipAnswer(this.id)" id="skip">
					<h4>Dislike Both</h4>
					</a>
					<?php

				}
				?>
				
			</div>
			<div class="col-md-5"></div>
		</div>

		<hr>

	</div> <!-- panel Div tag -->
</div> <!-- Replacable Div tag -->

</div> <!-- container Div tag -->


	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
<div id="footer">
  <div class="container">
    <div class="row" style="text-align:right;">

      <h4><p class="text-muted">Queries: team@interestship.com | +91-7676217177 | +91-9535395934 | +91-9879823914   </p></h4>
    
    </div>
  </div>
</div>
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
