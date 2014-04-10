<? ob_start(); ?>
<?php
include"refs/session_postdashboard.php"; 
session_destroy();
header("Location: index.php"); 
?>