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
	function submitDomains(str)	
		{
			domainorder  = "";
			//alert(document.getElementById("interestOrder").rows.length);
			for (var i = 0; i < document.getElementById("interestOrder").rows.length; i++) {
				//alert(document.getElementById("interestOrder").rows[i].id);
				domainorder = domainorder + ";" + document.getElementById("interestOrder").rows[i].id
			};
			//alert(domainorder);
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
			
			xmlhttp.open("GET","loadnext.php?m=d&order="+domainorder,true);
			xmlhttp.send();
			//alert("b");
		}
	function getNext()	
		{
			domainorder  = "";
			//alert(document.getElementById("interestOrder").rows.length);
			for (var i = 0; i < document.getElementById("interestOrder").rows.length; i++) {
				//alert(document.getElementById("interestOrder").rows[i].id);
				domainorder = domainorder + ";" + document.getElementById("interestOrder").rows[i].id
			};
			//alert(domainorder);
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
			
			xmlhttp.open("GET","loadnext.php?m=d&order="+domainorder,true);
			xmlhttp.send();
			//alert("b");
		}
		function checkProgress()
		{
			
			//alert(document.getElementById("getnext").value);
			if (document.getElementById("getnext").value != 1)
			{
				return;
			}


			
			//alert(domainorder);
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
			
			xmlhttp.open("GET","loadnext.php?m=d&order=-1",true);
			xmlhttp.send();
			//alert("b");	
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
		<!--
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
		-->
<div id="replaceablediv">
		<div class="panel panel-primary">

			<br>
			<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-8">
				<h4><b>Rearrange the below listed domains as per your INTEREST. Use your mouse to move the domain up or down on the list. Click, submit once done.</b></h4>
			</div>
			<div class="col-md-2"></div>
		</div>

		<br>

		<div class="row">


			<div class="col-md-1"></div>
			<div class="row">
        <div class="col-md-4">
            
                <!--<span class="glyphicon glyphicon-ok"></span> Sort the below domains as per your interest. Just follow your gut feeling!</div>-->
                
             <?php
             	$query = "SELECT results FROM user_results
				WHERE user_master_id = '".$_SESSION['id']."'AND test_type_id = 10";
				//VALUES('".$_SESSION['id']."','10','".$_GET['order']."')";
				$sql = mysql_query($query) or die ('Error updating database: '.mysql_error()); 
				$row = 0;
				if ($sql === FALSE)
				{
					//echo "yep no result";
				}
				else
				{
					$row = mysql_fetch_array($sql);
					//echo $row;
					
				}
				if ($row == 0 || $row['results'] == "" )
				{

             ?>
             		<div class="alert alert-info">
                Please Wait...</div>
            <div class="alert alert-success" style="display:none;"> 
             		<span class="glyphicon glyphicon-ok"></span> Sort them.</div>  
	            	<table class="table" >
	                <thead>
	                    <tr>
	                        <th>
	                            Domains
	                        </th>
	                    </tr>
	                </thead>
	                <tbody id="interestOrder">
					<?php		
					
					
					$query = "SELECT * FROM  `attitude_interests_clusters`";
					$sql = mysql_query($query) or die ('Error updating database: '.mysql_error()); 
					while($row = mysql_fetch_array($sql))
					{
						?>
						<tr class="success" id='<?php echo $row['id']; ?>'>
						<td>
			            <input type = "hidden" id='cluster<?php echo $row['id']; ?>' value='<?php echo $row['id']; ?>'>
			            <?php
			            echo $row['cluster_name'];
			            ?>
			            </td> 
			            </tr>          
			            <?php
						//echo "<a href='#' id='cluster".$row['id']."'>".$row['cluster_name']."</a><br>";
						
					}
					?>
		
					</tbody>
			        </table>
			      <?php 
			  	} // if not done then display the cluster
			  	else
			  	{
			  		?>
			  		<input type="hidden" name="getnext" id="getnext" value="1">
			  		<?php
			  	}
			      ?>
			  	
	        </div>
	    </div>
	    


		<div class="col-md-1"></div>
		</div>

		<br>


		<div class="row">
			<div class="col-md-5"></div>
			<div class="col-md-2">
				

					<a href="#" class="btn btn-primary btn-lg btn-block btn-huge" onclick="submitDomains(this.id)" id="submit">
					<h4>Click to Submit</h4>
					</a>
					
				
			</div>
			<div class="col-md-5"></div>
		</div>

		<hr>

	</div>

</div>
	</div> <!--Container-->

<div id="footer">
  <div class="container">
    <div class="row" style="text-align:right;">

      <h4><p class="text-muted">Queries: team@interestship.com | +91-7676217177 | +91-9535395934 | +91-9879823914   </p></h4>
    
    </div>
  </div>
</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/bootsnippet.js"></script>
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
