<html>
<head>
<script>
function showUser(str)
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
    document.getElementById(str).value=xmlhttp.responseText;
  //  alert("c");
    }
  }
xmlhttp.open("GET","getnext.php?q="+str,true);
xmlhttp.send();
//alert("b");
}
</script>
</head>
<body>

<?php
include"refs/conn.php"; 

?>

<?php 
echo "Welcome to aptitude test, ".$_SESSION['fname'];


$query= "SELECT * 
FROM  attitude_interests_activities ,test_interestv1 
WHERE attitude_interests_activities.id=test_interestv1.attitude_interests_activities_id
ORDER BY  test_interestv1.setid ASC";

$sql = mysql_query($query); 
    echo "<table border = 1>";
    while($row = mysql_fetch_array($sql))
    {
    	echo "<tr>";
    	echo "<td>".$row['setid']."</td>"; 
    	echo "<td>".$row['activity_name']."</td>"; 
    	//echo "<td>".$row['last_name']."</td>"; 
    	//echo "<td>".$row['cell_number']."</td>"; 
    	//echo "<td>".$row['verified']."</td>"; 
    	echo "<td><input type='Button' id='Select".$row['id']."' text='Select' value='Select".$row['id']."' onclick='showUser(this.value)'></td>";
    	echo "</tr>"; 
    }
    echo "</table>";

?>
<p>
</p>
<?

include"refs/conn_close.php"; 
?>
</body>