<? ob_start(); ?>
<?php

include"refs/session_postdashboard.php"; 

if(isset($_POST['test_id']) && isset($_POST['mcq_count']))
{
    include"refs/conn.php";

    //TODO:
    $uid = $_SESSION['id']; 

    $test_id = mysql_real_escape_string($_POST['test_id']);
    $mcq_count = mysql_real_escape_string($_POST['mcq_count']);

    $count = 0;

    $query = "INSERT INTO user_results(user_master_id,test_type_id,results) 
                VALUES('".$_SESSION['id']."',$test_id,'1')";
            $sql = mysql_query($query);

    while($count < $mcq_count)
    {
        $count++;

        if(!empty($_POST["radio".$count])) 
        {
            $mcq_id = mysql_real_escape_string($_POST["Qno".$count]);
            $answer = mysql_real_escape_string($_POST["radio".$count]);
            $query = "select answer from `domain_mcqs` where id=".$mcq_id;
            $sql = mysql_query($query);
            $marks = 0;
            if(mysql_num_rows($sql) > 0)
            { 
                $row = mysql_fetch_array($sql);             
                if($answer === $row['answer'])
                {
                    $marks = 1;
                }
                else 
                {
                    $marks = -0.5;
                }
            }

            $query = "select id from `domain_mcqs_test` where domain_mcqs_id=".$mcq_id." and test_master_id=".$test_id;
            $sql = mysql_query($query);
            $domain_mcqs_test_id = 0;
            if(mysql_num_rows($sql) > 0)
            { 
                $row = mysql_fetch_array($sql);             
                $domain_mcqs_test_id = $row['id'];
            }
            $query = "insert into `domain_mcqs_test_results` (`user_master_id`, `domain_mcqs_test_id`, `marks`) values (".$uid.",".$domain_mcqs_test_id.",".$marks.")";
            $sql = mysql_query($query);

            

        }
    }
    session_destroy();
    include"refs/conn_close.php";

    //tell him thank you and send him a mail
    //header("Location: dashboard.php");

}
else
{
    //destroy all session vars and route him to home screen
    session_destroy();
}
?>
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
                <li class="disabled"><a href="#">
                    <h4 class="list-group-item-heading">Step 1</h4>
                    <p class="list-group-item-text">Provide Details</p>
                </a></li>
                <li class="disabled"><a href="#">
                    <h4 class="list-group-item-heading">Step 2</h4>
                    <p class="list-group-item-text">Aptitude - Interest</p>
                </a></li>
                <li class="disabled"><a href="#">
                    <h4 class="list-group-item-heading">Step 3</h4>
                    <p class="list-group-item-text">Aptitude - Domain Knowledge Test</p>
                </a></li>
                <li class="active"><a href="#">
                    <h4 class="list-group-item-heading">Step 4</h4>
                    <p class="list-group-item-text">Altitude - 6th April</p>
                </a></li>
            </ul>
        </div>
    </div>
    <div class="container">
    <div class="row" style="text-align:center;">
        <div class="jumbotron" style="background-color:#47a447;color: white">
            <h1 style="text-align:center;">Thank you</h1>
            <h3>We will contact you soon for the <b>ALTITUDE</b> round <span class="glyphicon glyphicon-heart"></span><br> Which will be held at 11:00 am, 6th April 2014 <br> Venue: <a href="https://www.google.co.in/maps/place/Venture+Studio/@23.039812,72.553569,17z/data=!3m1!4b1!4m2!3m1!1s0x395e8492fbaccf57:0xfe520db897fc4575" style= "color:#000000; text-decoration:underline;">Venture Studio </a></h3>
        </div>
  </div>
</div>
    </div>
    <script src="js/bootstrap.min.js"></script>
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
</body>
</html>