<? ob_start(); ?>
<?php 
include"refs/session_postdashboard.php"; 
include"refs/conn.php"; 
$query = "SELECT * FROM `user_details` WHERE `user_master_id` =  ".$_SESSION['id'];
$sql = mysql_query($query); 

if($sql === FALSE) {
    die(mysql_error()); // TODO: better error handling
}
else
{
  $row = mysql_fetch_array($sql);
  if ($row['id'] > 0)
  {
    header("Location: aptitude.php");    
  }

}





     
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
     <div class="col-md-2"></div>
     <div class="col-md-6">
         <h3>
        <?php 
        echo "Welcome ".$_SESSION['fname'];
        ?>
        </h3>
    </div>
     <div class="col-md-4"></div>
 </div>
 <div class="row">
     <div class="col-md-2"></div>
     <div class="col-md-6">Please provide the below details</div>
     <div class="col-md-4"></div>
 </div>

 <div class="row">
     <div class="col-md-2"></div>
     <div class="col-md-6">
      <form class="form-horizontal" action="updateuserdetails.php" method="post" >
<fieldset>

<!-- Form Name -->
<legend></legend>

<!-- Select Basic -->
<div class="form-group">
  <label class="col-md-4 control-label" for="College">Select your College</label>
  <div class="col-md-5">
    <select id="College" name="College" class="form-control">
      <option value="1">L. D. College of Engineering</option>
      <option value="2">Nirma Institute of Technology</option>
      <option value="100">Other</option>
    </select>
  </div>
</div>

<!-- Select Basic -->
<div class="form-group">
  <label class="col-md-4 control-label" for="selectbasic">Select your branch/course</label>
  <div class="col-md-4">
    <select id="Branch" name="Branch" class="form-control">
      <option value="1">Computer Science/Engineering</option>
      <option value="2">Information Technology</option>
      <option value="3">Mechanical Engineering</option>
      <option value="4">Electrical Engineering</option>
      <option value="5">Civil Engineering</option>
      <option value="6">Instrument & Control Engineering</option>

      <option value="7">Chemical Engineering</option>
      <option value="8">MBA</option>
      <option value="9">B. Comm</option>
      <option value="10">M. Comm</option>
      <option value="11">B. Sci.</option>
      <option value="12">M. Sci.</option>
      <option value="100">Other</option>
    </select>
  </div>
</div>

<!-- Select Basic -->
<div class="form-group">
  <label class="col-md-4 control-label" for="selectbasic">Level of degree</label>
  <div class="col-md-4">
    <select id="Level" name="Level" class="form-control">
      <option value="0">Under Graduate</option>
      <option value="1">Graduate</option>
      <option value="2">Post Graduate</option>
    </select>
  </div>
</div>

<!-- Select Basic -->
<div class="form-group">
  <label class="col-md-4 control-label" for="selectbasic">Select current semester</label>
  <div class="col-md-4">
    <select id="Semester" name="Semester" class="form-control">
      <option value="1">1st </option>
      <option value="2">2nd </option>
      <option value="3">3th </option>
      <option value="4">4th </option>
      <option value="5">5th </option>
      <option value="6">6th </option>
      <option value="7">7th </option>
      <option value="8">8th </option>
    </select>
  </div>
</div>
<div class="form-group">
  <label class="col-md-4 control-label" for="selectbasic">Gender</label>
  <div class="col-md-4">
    <select id="Gender" name="Gender" class="form-control">
      <option value="1">Male</option>
      <option value="2">Female</option>
    </select>
  </div>
</div>
<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for=""></label>
  <div class="col-md-4">
    <input type="Submit" id="" name="submit" value="submit" class="btn btn-primary">
  </div>
</div>
</fieldset>
<input type="hidden" name='userid' value="<?php echo $_SESSION['id']; ?>" >
</form>

     </div>
     <div class="col-md-4"></div>
 </div>

</div>
<?

include"refs/conn_close.php"; 
?>
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
<script src="js/bootstrap.min.js"></script>
</body>
</html>