<?php 
require_once("setup/functions.php");
?>

<!DOCTYPE html>
<html lang="en">
    
<head>
        <title>DDS</title>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" href="css/style.css" />
        <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/bootstrap-responsive.min.css" />
        <link rel="stylesheet" href="css/matrix-login.css" />
        <link href="font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>

    </head>
<body style="margin-top: 4%; height: auto; ">


        <div class="lms-container">
  <div class="lms-info text-center" style="">
    <h1 style="color: #28b779">Expert System on Communicable Disease</h1>
  </div>
</div>
        <div id="loginbox" >      
            <form id="loginform" class="" action="" method="POST" >
         <div class="control-group normal_text"> <h3><img src="img/logo.png" alt="Admin Login" style="height: 100px" /></h3></div>
         <div id="alert_text">** Incorrect Login Details, Please Try Again **</div>
                <div class="control-group">
                    <div class="controls">
                        <div class="main_input_box">
                            <span class="add-on bg_lg"><i class="icon-user"> </i></span><input type="text" name="username" placeholder="Username" required="" />
                        </div>
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls">
                        <div class="main_input_box">
                            <span class="add-on bg_ly"><i class="icon-lock"></i></span><input type="password" name="password" placeholder="Password" required="" />
                        </div>
                    </div>
                </div>
              
                <div class="form-actions">
                    <span style="margin-left: 40%;">
                    <button type="submit" class="btn btn-success" style="background-color: #28B779" > LOGIN</button>
                    </span>
                </div>
            </form>

        </div>
        
         <div class="lms-container">
  <div class="lms-info" style="margin-left: 45%; margin-top: 3.5%;"><span style="color: #db3615">Project <i class="icon icon-cogs"></i> by Samuel Sauna Stephen </span>
</div>
        <script src="js/jquery.min.js"></script>  
        <script src="js/matrix.login.js"></script> 
    </body>

</html>

<?php
if(isset($_POST['username']) && isset($_POST['password']) ) {
    // Escape user inputs for security
    $login_username = mysqli_real_escape_string($link, $_POST['username']);
    $login_password = mysqli_real_escape_string($link, md5($_POST['password']));
   
    if(!empty($login_username) && !empty($login_password)) {

        $query = "SELECT id FROM users WHERE username= '$login_username' AND password = '$login_password'  ";
        $query_run = mysqli_query($link, $query);
        $numRowsCheck = mysqli_num_rows($query_run);
        if ($numRowsCheck == 0) {
             echo '<script type="text/javascript">function hideMsg(){
            document.getElementById("alert_text").style.visibility = "hidden"; }         document.getElementById("alert_text").style.visibility = "visible";
           window.setTimeout("hideMsg()", 40000);
            </script>';
        } elseif ($numRowsCheck == 1) {

            $useridrow = mysqli_fetch_assoc($query_run);
            $userid = $useridrow['id'];
            ob_start();
            session_start();
            $_SESSION['user_id'] = $userid;
            $_SESSION['activiteit'] = time();
            header("Location: dashboard.php");
        }
    }
} 

?>