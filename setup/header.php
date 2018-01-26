<?php

require_once("functions.php");

if (!loggedin()){
        header("Location: index.php");
}
elseif (loggedin()){
        $username = getuserfield('username');
        $user_surname = getuserfield('sname');
        $user_firstname = getuserfield('fname');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>CD DIAG</title>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" href="css/bootstrap.min.css" />
<link rel="stylesheet" href="css/bootstrap-responsive.min.css" />
<link rel="stylesheet" href="css/uniform.css" />
<link rel="stylesheet" href="css/select2.css" />
<link rel="stylesheet" href="css/style.css" />
<link rel="stylesheet" href="css/matrix-style.css" />
<link href="font-awesome/css/font-awesome.css" rel="stylesheet" />
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="css/matrix-media.css" />
<link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" />

</head>
<body>

<!--Header-part-->
<div id="header">
  <h1><a href="">CD DIAG Dashboard</a></h1>
</div>
<!--close-Header-part--> 

<!--top-Header-menu-->
<div id="user-nav" class="navbar navbar-inverse">
  <ul class="nav">
    <li id="profile-messages" ><a title="" href="#" ><i class="fa fa-user"></i>  <span class="text">Welcome <?php echo $user_surname.' '.$user_firstname; ?></span></a>
    </li>
  </ul>
</div>

<!--start-top-serch-->
<div id="user1-nav" class="navbar navbar-inverse">
<ul class="nav">
        <li class=""><a title="" href="dashboard.php"><i class="fa fa-cog fa-2x"></i> <span class="text" style="font-size: 25px">EXPERT SYSTEM ON COMMUNICABLE DISEASE</span></a></li>
  </ul>
</div>
<!--close-top-serch--> 

<!--sidebar-menu-->

<div id="sidebar"> <a href="#" class="visible-phone"><i class="fa fa-th"></i>Dashboard</a>
  <ul>
    <li class="active"><a href="dashboard.php"><i class="fa fa-home"></i> <span>Dashboard</span></a></li>
    <li><a href="addpatient.php"><i class="fa fa-user"></i> <span>Add Patients</span></a></li>
    <li><a href="allpatients.php"><i class="fa fa-users"></i> <span>View Patients</span></a></li>
    <li><a href="hospitalrecords.php"><i class="fa fa-file"></i> <span>Hospital Records</span></a></li>
    
    <li><a href="logout.php"><i class="fa fa-key"></i> <span>Log Out</span></a></li>
    
  </ul>
</div>
