<? ob_start(); ?>
<?php 
include"refs/session_postdashboard.php"; 
include"refs/conn.php"; 

if (isset($_GET['m']))
{
	if ($_GET['m'] == "d")
	{
		if($_GET['order'] == -1)
		{

		}
		else
		{
			$query = "INSERT INTO user_results(user_master_id,test_type_id,results) 
				VALUES('".$_SESSION['id']."','10','".$_GET['order']."')";

			$sql = mysql_query($query) or die ('Error updating database: '.mysql_error()); 			
		}

		
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
		*/

		$query = "SELECT `attitude_interests_clusters`.`id`,`attitude_interests_clusters`.`cluster_name`,COUNT(`attitude_interests_clusters`.`cluster_name`)
				FROM `attitude_interests_areas`,`attitude_interests_activities`,`test_interestv1_result`, `attitude_interests_clusters`
				WHERE `attitude_interests_areas`.`id` = `attitude_interests_activities`.`area_id`
				AND `test_interestv1_result`.`user_master_id` = ".$_SESSION['id']."
				AND `attitude_interests_activities`.`id`=`test_interestv1_result`.`attitude_interests_activities_id`
				AND `attitude_interests_clusters`.`id`=`attitude_interests_areas`.`career_cluster_id`
				GROUP BY(`attitude_interests_clusters`.`cluster_name`)
				ORDER BY COUNT(`attitude_interests_clusters`.`cluster_name`) DESC
				LIMIT 0,5"
				//above for top 5 cluster of student
		
		?>
		<div class="panel panel-primary">
			<br>
			<div class="row">
			<div class="col-md-4"></div>
			<div class="col-md-4">
				<h4><b>Based on your inputs, following are the domains in priority of your interest</b></h4>
			</div>
			<div class="col-md-4"></div>
			</div>

		<br>

		<div class="col-md-1"></div>
		<div class="row">
		<div class="col-md-3"></div>
        <div class="col-md-4">
            
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
		//$query = "SELECT * FROM  `attitude_interests_clusters`";
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
		</tbody>
            </table>

	        </div>
	        <div class="col-md-5"></div>
	    </div>
	    <hr>

	    <div class="row">
			<div class="col-md-4"></div>
			<div class="col-md-4">
	    	<h4><b>Below are the internships which are available on Interestship based on your inputs </b></h4>
	    	</div>
	    	<div class="col-md-4"></div>

	    </div>
	    <br>

		<div class="col-md-1"></div>
		<div class="row">
		<div class="col-md-3"></div>
        <div class="col-md-4">

	    	
		<?php		
		//$query = "SELECT * FROM  `internships`";
		//$query = "SELECT * FROM  `internships`";
		$query = "SELECT `test_master`.`id`,`test_type`.`test_type` 
FROM  `test_master` ,  `test_type` 
WHERE  `test_master`.`test_type_id` =  `test_type`.`id` 
AND `test_type`.`active` = 1
LIMIT 0 , 30";

		$sql = mysql_query($query) or die ('Error updating database: '.mysql_error()); 
		while($row = mysql_fetch_array($sql))
		{
			?>
			<a href="aptitude2.php?id=<?php echo $row['id']; ?>"  class="btn btn-success btn-lg btn-block btn-huge">
				<h4><?php echo $row['test_type']; ?></h4>
			</a>
            

            <?php
            	//echo "<a href = 'aptitude2.php?id=".$row['id']."'>".$row['name']."</a>";
            ?>
            
            <?php
			//echo "<a href='#' id='cluster".$row['id']."'>".$row['cluster_name']."</a><br>";
			
		}
		?>
		
         </div>
         <div class="col-md-5"></div>
         </div>   
		</div>



		<?php


	}
	
}

?>