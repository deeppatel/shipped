<? ob_start(); ?>
<?php 
include"refs/session_postdashboard.php"; 
?>
<!DOCTYPE html>
<html lang="en">


<head>
    <title>Interest</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">

    
    <link href="css/TimeCircles.css" rel="stylesheet">                   

    <script type="text/javascript">

        function formSubmit(){
            document.getElementById("mcqs").submit();
        }

        window.onload=function(){ 
            
            $("#example").TimeCircles({
                "animation": "ticks",
                "bg_width": 0.5,
                "fg_width": 0.1,
                "circle_bg_color": "#60686F",
                "time": {
                    "Days": {
                        "text": "Days",
                        "color": "#FFCC66",
                        "show": false
                    },
                    "Hours": {
                        "text": "Hours",
                        "color": "#99CCFF",
                        "show": false
                    },
                    "Minutes": {
                        "text": "Minutes",
                        "color": "#BBFFBB",
                        "show": true
                    },
                    "Seconds": {
                        "text": "Seconds",
                        "color": "#99CCFF",
                        "show": true
                    }
                }
            }); 
            
            window.setTimeout(formSubmit, 10*60*1000);//20mins
        };
    </script>
</head>
<body>

<div class="navbar navbar-default navbar-fixed-top" role="navigation">
  <div class="container">
  <div class="row">
        <div class="col-md-12">
            <ul class="nav nav-pills nav-justified thumbnail">
                <li class="disabled"><a href="#">
                    <h4 class="list-group-item-heading">Step 1</h4>
                    <p class="list-group-item-text">Provide Details</p>
                </a></li>
                <li><a href="#">
                    <h4 class="list-group-item-heading">Step 2</h4>
                    <p class="list-group-item-text">Aptitude - Interest</p>
                </a></li>
                <li class="active"><a href="#">
                    <h4 class="list-group-item-heading">Step 3</h4>
                    <p class="list-group-item-text">Aptitude - Domain Knowledge Test</p>
                </a></li>
                <li class="disabled"><a href="#">
                    <h4 class="list-group-item-heading">Step 4</h4>
                    <p class="list-group-item-text">Altitude - 6th April</p>
                </a></li>
            </ul>
        </div>
    <div class="row">
        <div class="col-md-4">        
            <div class="row">
                <div class="col-md-5"></div>
                <div class="col-md-7"><div id="example" style="width:95%;align:center;" data-timer="600"></div>
            </div></div>
        </div>
        <div class="col-md-8" style="align:center;">
            <h2><span class="label label-danger">negative marking exits ;)  Start!</span></h2>
        </div>
    </div>
  </div>
</div>
</div>


<?php
    include"refs/conn.php"; 




    //TODO: $_POST['test_id']; or set $_SESSION['test_id']; 
    $test_id = $_GET['id'];

   $query = "SELECT `user_results`.`results` FROM  `user_results` WHERE `user_master_id` = ".$_SESSION['id']. " AND `user_results`.`test_type_id` = ".$test_id;
    $sql = mysql_query($query); 

    $row = 0 ;
    if($sql === FALSE)
    {
        //$row = 0;
        //echo "R0:".$row;
    }
    else
    {   
        $row = mysql_fetch_array($sql);
        //$row['results'];
        
    }
    if ($row['results'] == "1")   
    {
        header("Location: final.php");    
    }
    else
    {

    }

    $query= "select dm.id,dm.question,dm.option1,dm.option2,dm.option3,dm.option4 
from `domain_mcqs` as dm 
join 
(SELECT dmt.domain_mcqs_id 
FROM `test_master` as tm
join `domain_mcqs_test` as dmt
on tm.id=dmt.test_master_id
where tm.id=".$test_id.") as t1
on dm.id=t1.domain_mcqs_id";

    $sql = mysql_query($query); 
?>

<div class="container">
    <br><br><br><br><br><br><br><br><br><br><br><br>
<form role="form" action="final.php" method="post" id="mcqs">
<?php

    $count=0;
    while($row = mysql_fetch_array($sql))
    {
        $count++;
?>

    <div class="row">
        <input type="hidden" name=<?php echo 'Qno'.$count; ?> value=<?php echo $row['id']; ?>>
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <span class="glyphicon glyphicon-circle-arrow-right"></span>  <b><?php echo $row['question'];?></b> 
                    </h3>
                </div>
                <div class="panel-body">
                    <ul class="list-group">
                        <li class="list-group-item">
                            <div class="radio">
                                <label>
                                    <input type="radio" name=<?php echo 'radio'.$count; ?> value=1>
                                    <?php echo $row['option1'];?>
                                </label>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="radio">
                                <label>
                                    <input type="radio" name=<?php echo 'radio'.$count; ?> value=2>
                                    <?php echo $row['option2'];?>
                                </label>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="radio">
                                <label>
                                    <input type="radio" name=<?php echo 'radio'.$count; ?> value=3>
                                    <?php echo $row['option3'];?>
                                </label>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="radio">
                                <label>
                                    <input type="radio" name=<?php echo 'radio'.$count; ?> value=4>
                                    <?php echo $row['option4'];?>
                                </label>
                            </div>
                        </li>
                    </ul>
                </div> 
            </div>
        </div>
        <div class="col-md-3"></div>
    </div>

<?php
}
    //include"refs/conn_close.php"; 
?>


<input type="hidden" name="test_id" value=<?php echo $test_id; ?>>
<input type="hidden" name="mcq_count" value=<?php echo $count; ?>>

<hr>

<div class="container">
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4"><button type="submit" class="btn btn-success btn-block btn-huge"><h3>done</h3></button></div>
        <div class="col-md-4"></div>
    </div>
</div>
</form>
</div>

<br><br>
<div id="footer">
  <div class="container">
    <div class="row" style="text-align:right;">

      <h4><p class="text-muted">Queries: team@interestship.com | +91-7676217177 | +91-9535395934 | +91-9879823914   </p></h4>
    
    </div>
  </div>
</div>
    <script src="js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script type="text/javascript" src="js/TimeCircles.js"></script>
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