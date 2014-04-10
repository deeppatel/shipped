<?php
$PageTitle = "Home";
?>

<?php 
//Other php files
include"refs/conn.php"; 
include"refs/common.php"; 
?>

<?php 
//header file
include_once('header.php');
?>

<div class="container">
	<?php
	//active page variable for menu
	$ActivePage = "Home";
	include_once('menu.php');
	?>
	
</div>


<?php
//footer page
include_once('footer.php');
?>