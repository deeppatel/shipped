<?php
	include"../refs/conn.php"; 

	//$query = sprintf("SELECT * FROM user_master"); 
    //$query = sprintf("SELECT * FROM `user_details`, `user_master` WHERE `user_details`.`user_master_id` = `user_master`.`id`"); 
    $query = sprintf("SELECT `user_master`.`email`, `user_master`.`cell_number`, `user_master`.`first_name`,`user_master`.`last_name`,
        `user_master`.`verified`,`college_master`.`name`,`test_master`.`test_name`,`user_results`.`results`
        FROM  `user_master` , `user_results`,`user_details`,`test_master`,`college_master`
        WHERE  `user_master`.`id` =  `user_results`.`user_master_id` 
        AND `user_master`.`id` =  `user_details`.`user_master_id` 
        AND `test_master`.`id` = `user_results`.`test_type_id`        
        AND `college_master`.`id` = `user_details`.`college_id`");

    $sql = mysql_query($query); 
    echo "<table border = 1>";
    while($row = mysql_fetch_array($sql))
    {
    	echo "<tr>";
    	echo "<td>".$row['email']."</td>"; 
    	echo "<td>".$row['first_name']."</td>"; 
    	echo "<td>".$row['last_name']."</td>"; 
    	echo "<td>".$row['cell_number']."</td>"; 
    	echo "<td>".$row['verified']."</td>"; 
        echo "<td>".$row['name']."</td>"; 
        echo "<td>".$row['test_name']."</td>"; 
        echo "<td>".$row['results']."</td>"; 
    	echo "</tr>"; 
    }
    echo "</table>";
 ?>
 <?php
    //$query = sprintf("SELECT * FROM user_master"); 
    //$query = sprintf("SELECT * FROM `user_details`, `user_master` WHERE `user_details`.`user_master_id` = `user_master`.`id`"); 
    $query = sprintf("SELECT `user_master`.`email`, `user_master`.`cell_number`, `user_master`.`first_name`,`user_master`.`last_name`,
        `user_master`.`verified`,`college_master`.`name`
        FROM  `user_master` , `user_results`,`user_details`,`test_master`,`college_master`
        WHERE  `user_master`.`id` =  `user_results`.`user_master_id` 
        AND `user_master`.`id` =  `user_details`.`user_master_id` 
        AND `college_master`.`id` = `user_details`.`college_id`");

    $sql = mysql_query($query); 
    echo "<table border = 1>";
    while($row = mysql_fetch_array($sql))
    {
        echo "<tr>";
        echo "<td>".$row['email']."</td>"; 
        echo "<td>".$row['first_name']."</td>"; 
        echo "<td>".$row['last_name']."</td>"; 
        echo "<td>".$row['cell_number']."</td>"; 
        echo "<td>".$row['verified']."</td>"; 
        echo "<td>".$row['name']."</td>"; 
        
        echo "</tr>"; 
    }
    echo "</table>";
 ?>