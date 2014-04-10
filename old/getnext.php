<? ob_start(); ?>
<?php 
include"refs/conn.php"; 
include"refs/session_postdashboard.php"; 
if (isset($_GET['m'])) //m as in mode
{
	if ($_GET['m'] == "n") // n is for inserting the current set results & fetching the next set
	{
		//echo "setid".$_GET['setid']."aid".$_GET['aid'];
		if ($_GET['aid'] == -1) //skipped
		{
			//echo "aid - 1";
		}	
		else
		{	
			$query = "INSERT INTO test_interestv1_result(user_master_id,test_interestv1_setid,attitude_interests_activities_id) 
				VALUES('".$_SESSION['id']."','".$_GET['setid']."','".$_GET['aid']."')";
			$sql = mysql_query($query) or die ('Error updating database: '.mysql_error()); 
		}
		?>

		<!-- section 1 start-->
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
		<!-- section 1 end-->
		<?php
				$query= "SELECT * 
						FROM  attitude_interests_activities ,test_interestv1 
						WHERE attitude_interests_activities.id=test_interestv1.attitude_interests_activities_id
						AND test_interestv1.setid = ".($_GET['setid'] + 1);
						//ORDER BY  test_interestv1.setid ASC;

				$sql = mysql_query($query); 
				$setid = -1;
			    //echo "<table border = 1>";
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
			    }
			?>
			<input type="hidden" id='setid' name="setid" value='<?php echo $setid; ?>'/>

			<!--section 3 start -->
			<div class="col-md-1"></div>
		</div>

		<br>


		<div class="row">
			<div class="col-md-5"></div>
			<div class="col-md-2">
				<?php
				//if ($rowCount == 0)
				if ($_GET['setid'] >= 85)
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
	<!--section 3 end -->
		<?php
	} 
	elseif ($_GET['m'] == "c") //this secion is for fetching the domains and giving it to the user for arraning as per his priority
	{
		/*
		$query = "SELECT  `attitude_interests_areas`.`area_letter` , COUNT(  `attitude_interests_areas`.`area_letter` ) 
				FROM  `attitude_interests_areas` ,  `attitude_interests_activities` ,  `test_interestv1_result` 
				WHERE  `attitude_interests_areas`.`id` =  `attitude_interests_activities`.`area_id` 
				AND  `attitude_interests_activities`.`id` =  `test_interestv1_result`.`attitude_interests_activities_id` 
				GROUP BY (
				`attitude_interests_areas`.`area_letter`
				)
				LIMIT 0 , 100";
				//above query for areas of studente
		

		$query = "SELECT `attitude_interests_clusters`.`cluster_name`,COUNT(`attitude_interests_clusters`.`cluster_name`)
				FROM `attitude_interests_areas`,`attitude_interests_activities`,`test_interestv1_result`, `attitude_interests_clusters`
				WHERE `attitude_interests_areas`.`id` = `attitude_interests_activities`.`area_id`
				AND `attitude_interests_activities`.`id`=`test_interestv1_result`.`attitude_interests_activities_id`
				AND `attitude_interests_clusters`.`id`=`attitude_interests_areas`.`career_cluster_id`
				GROUP BY(`attitude_interests_clusters`.`cluster_name`)"		
				//above for cluster of stuents


		$query = "SELECT `attitude_interests_clusters`.`id`,`attitude_interests_clusters`.`cluster_name`,COUNT(`attitude_interests_clusters`.`cluster_name`)
				FROM `attitude_interests_areas`,`attitude_interests_activities`,`test_interestv1_result`, `attitude_interests_clusters`
				WHERE `attitude_interests_areas`.`id` = `attitude_interests_activities`.`area_id`
				AND `attitude_interests_activities`.`id`=`test_interestv1_result`.`attitude_interests_activities_id`
				AND `attitude_interests_clusters`.`id`=`attitude_interests_areas`.`career_cluster_id`
				GROUP BY(`attitude_interests_clusters`.`cluster_name`)
				ORDER BY COUNT(`attitude_interests_clusters`.`cluster_name`) DESC
				LIMIT 0,5"
				//above for top 5 cluster of student
		*/
		?>
		<div class="row">
        <div class="col-md-4">
            <div class="alert alert-info">
                Please Wait...</div>
            <div class="alert alert-success" style="display:none;">
                <span class="glyphicon glyphicon-ok"></span> Sort the below domains as per your interest. Just follow your gut feeling!</div>
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
			<tr class="success" onclick="orderChanged(this.id)" id='<?php echo $row['id']; ?>'>
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
		
		
                    <!--
                    <tr class="active">
                        <td>
                            Column content
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Column content
                        </td>
                    </tr>
                    -->
                    <!--
                    <tr>
                        <td>
                            Column content
                        </td>
                    </tr>
                    <tr class="warning">
                        <td>
                            Column content
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Column content
                        </td>
                    </tr>
                    <tr class="danger">
                        <td>
                            Column content
                        </td>
                    </tr>
                    -->
		</tbody>
            </table>
	        </div>
	    </div>
	    


		<?php


	}
	else 
	{
		//this section is for skipping the set and giving the user the next set
		//echo "setid".$_GET['setid']."aid".$_GET['aid'];
		/*
				$query= "SELECT * 
						FROM  attitude_interests_activities ,test_interestv1 
						WHERE attitude_interests_activities.id=test_interestv1.attitude_interests_activities_id
						AND test_interestv1.setid = ".($_GET['setid'] + 1);
						//ORDER BY  test_interestv1.setid ASC;

				$sql = mysql_query($query); 
				$setid = -1;
			    //echo "<table border = 1>";

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
		<?php
		*/
	}
}

?>