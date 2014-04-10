<?php
$PageTitle = "Home";
?>

<?php 
//Other php files
include"refs/conn.php"; 
include"refs/common.php";
//include"refs/session.php";  
session_start();
?>

<?php 
//header file
include_once('header.php');
?>

<div class="container">
    <p>
<?php
$error = "";
/*
$result=mysql_query('Select * from address_zip;');
if(mysql_num_rows($result) > 0)
    {
        $row = mysql_fetch_array($result); 
        //echo $row['zipcodes']; 

    }
else
    {
         $error .= "No data retrieved"; 
    }
*/
    if(isset($_POST['useremail']))
    {
     //Lets search the databse for the user name and password 
        //Choose some sort of password encryption, I choose sha256 
        //Password function (Not In all versions of MySQL). 
        $usr = mysql_real_escape_string($_POST['useremail']); 
        //$pas = hash('sha256', mysql_real_escape_string($_POST['password'])); 
        $pas = mysql_real_escape_string($_POST['password']);
        $sql = mysql_query("SELECT * FROM user_master WHERE email='".$usr."'");
        //echo $sql;
        
        if(mysql_num_rows($sql) > 0)
        //if($row)
        { 
            $row = mysql_fetch_array($sql); 
            if ($row['verified'] == 1) 
            {
               
                $_SESSION['username'] = $row['email']; 
                $_SESSION['type'] = $row['type']; 
                $_SESSION['logged'] = TRUE; 
                $_SESSION['fname'] = $row['first_name']; 
                $_SESSION['lname'] = $row['last_name']; 
                $_SESSION['id'] = $row['id']; 
                header("Location: profile.php"); // Modify to go to the page you would like 
            }
            else
            {
                //header("Location: index.php?loginmode=-11"); 
                
            }
           
        }
        else{ 
            //user is not found
            //header("Location: index.php?loginmode=-1"); 
            exit; 
        } 
    }
    else
    {    //If the form button wasn't submitted go to the index page, or login page 
        //header("Location: index.php?loginmode=0");     
        //exit; 
    }
    if(isset($_GET['loginmode']))
    {
        if($_GET['loginmode'] == -1 )
        {
             $error .="Invalid email address or password. Please check the details you have entered";
        }
        elseif($_GET['loginmode'] == 0)
        {
            //opened login page directly
             $error .="Please provide you details to proceed";
        }
        elseif($_GET['loginmode'] == -11 )
        {
             $error .="Please verify your email address";
        }
        else
        {
            
            //do nothing
        }
    }
?>
</p>
    <div class="row" style="margin-top:20px">
    <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
    <h3>
         <?php
        
                if(isset($error))
                {
                    echo $error;
                    
                    //echo $error; 
                    unset($error); 
                    
                } 
            
        ?>
    </h3>
        <form role="form" action="login.php" method="post">
            <fieldset>
                <h2>Please Sign In</h2>
                <hr class="colorgraph">
                <div class="form-group">
                    <input type="email" name="useremail" id="email" class="form-control input-lg" placeholder="Email Address">
                </div>
                <div class="form-group">
                    <input type="password" name="password" id="password" class="form-control input-lg" placeholder="Password">
                </div>
                <!--
                <span class="button-checkbox">
                    <button type="button" class="btn" data-color="info">Remember Me</button>
                    <input type="checkbox" name="remember_me" id="remember_me" checked="checked" class="hidden">
                    <a href="" class="btn btn-link pull-right">Forgot Password?</a>
                </span>
                -->
                <hr class="colorgraph">
                <div class="row">
                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <input type="submit" class="btn btn-lg btn-success btn-block" value="Sign In">
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <a href="registration.php" class="btn btn-lg btn-primary btn-block">Register</a>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
</div>
    
</div>


<?php
//footer page
include_once('footer.php');
?>