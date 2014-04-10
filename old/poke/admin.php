<?php
	include"../refs/conn.php"; 

	$query = sprintf("SELECT * FROM user_master
                    LEFT JOIN `user_details` ON `user_details`.`user_master_id` = `user_master`.`id`
                    LEFT JOIN`college_master` ON `college_master`.`id` = `user_details`.`college_id`"); 
    //$query = sprintf("SELECT * FROM `user_details`, `user_master` WHERE `user_details`.`user_master_id` = `user_master`.`id`"); 
    $sql = mysql_query($query); 
    echo "<table border = 1>";
    while($row = mysql_fetch_array($sql))
    {
    	echo "<tr>";

        echo "<td>".$row['user_master.id']."</td>"; 
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