<? ob_start(); ?>
<?php 
include"refs/session_postdashboard.php"; 
?>
<!--header-->
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Interest</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
</head>
<body>
	 <div class="container">
	<div class="row">
        <div class="col-md-12">
            <ul class="nav nav-pills nav-justified thumbnail">
                <li class="active"><a href="#">
                    <h4 class="list-group-item-heading">Step 1</h4>
                    <p class="list-group-item-text">Provide Details</p>
                </a></li>
                <li><a href="#">
                    <h4 class="list-group-item-heading">Step 2</h4>
                    <p class="list-group-item-text">Aptitude</p>
                </a></li>
                <li class="disabled"><a href="#">
                    <h4 class="list-group-item-heading">Step 3</h4>
                    <p class="list-group-item-text">Altitude</p>
                </a></li>
				<li class="disabled"><a href="#">
                    <h4 class="list-group-item-heading">Step 4</h4>
                    <p class="list-group-item-text">Attitude</p>
                </a></li>
            </ul>
        </div>
	</div>
</div>

</body>
<script src="js/bootstrap.min.js"></script>
</body>
</html>