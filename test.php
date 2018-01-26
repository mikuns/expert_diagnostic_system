<?php

require_once("setup/connect.php");

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
<!-- <link rel="stylesheet" href="css/style.css" /> -->
<link rel="stylesheet" href="css/matrix-style.css" />
<link rel="stylesheet" href="css/matrix-media.css" />
<link href="font-awesome/css/font-awesome.css" rel="stylesheet" />
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>

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
    <li id="profile-messages" ><a title="" href="#" ><i class="fa fa-user"></i>  <span class="text">Welcome</span></a>
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


<div id="content">
<div class="container-fluid">

<div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>List of Registered Patients</h5>
          </div>
          <div class="widget-content nopadding" >

            <table class="table table-bordered data-table js-exportable">

              <thead>
                <tr>
                  <th>#</th>
                  <th>Hospital Number</th>
                  <th>Name</th>
                  <th>Sex</th>
                  <th>Marital Status</th>
                  <th>Age</th>
                  <th></th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
              <?php

            $query = "SELECT * FROM patient_personal_info ORDER BY dated DESC ";
            $query_run = @mysqli_query($link, $query);
            $count = 1;

            while ($useridrow = @mysqli_fetch_assoc($query_run)) {
             
            $patientid = $useridrow['id'];
            $hosp_no = $useridrow['hosp_no'];
            $sname = $useridrow['sname'];
            $fname = $useridrow['fname'];
            $sex = $useridrow['sex'];
            $marital_status = $useridrow['marital_status'];
            $dob = $useridrow['date_of_birth'];
            $age= date("Y") - date("Y", strtotime($dob));

            $qyp = "SELECT * FROM patient_hospital_history WHERE hosp_no = '$hosp_no' ";
            $qy_prun = @mysqli_query($link, $qyp);
            while ($pidrow = @mysqli_fetch_assoc($qy_prun)) {             
            $admi_stat = $pidrow['admission_status'];
            }

            echo '<tr class="gradeX">
                  <td>'.$count.'</td>
                  <td>'.$hosp_no.'</td>
                  <td>'.$sname.' '.$fname.'</td>
                  <td>'.$sex.'</td>
                  <td>'.$marital_status.'</td>
                  <td>'.$age.'</td>
                  <td><a href="patientpreview.php?id='.$patientid.'" class="btn btn-primary btn-mini"><i class="icon icon-edit"></i> View Profile </a></td>
                  <td>'; if($admi_stat =="IN"){echo '<span class="label label-important">Currently Admitted</span>';} else{ echo '<a href="diagnose.php?id='.$hosp_no.'" class="btn btn-info btn-mini"><i class="icon icon-edit"></i> Admit Patient </a></td></tr>';}
                  $count++;
            }
            ?>

                
                
              </tbody>
            </table>
          </div>
        </div>

</div></div>
<!--Footer-part-->

<div class="row-fluid">
  <div id="footer" class="span12"> 2017 &copy; Project by <a href="">Samuel Sauna Stephen</a> </div>
</div>


<!--end-Footer-part-->

<script src="js/jquery.min.js"></script> 
<script src="js/jquery.ui.custom.js"></script> 
<script src="js/bootstrap.min.js"></script> 

<script src="js/jquery.uniform.js"></script> 
<script src="js/select2.min.js"></script> 
<script src="js/jquery.dataTables.min.js"></script> 
<script src="js/matrix.js"></script> 
<script src="js/matrix.tables.js"></script>
<script src="jGrowl/jquery.jgrowl.js"></script>

<script src="jGrowl/jquery.jgrowl.js"></script>

<script src="js/masked.js"></script> 
<script src="js/matrix.form_common.js"></script> 


</body>
</html>
