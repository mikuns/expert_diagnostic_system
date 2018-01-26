<?php include_once("setup/header.php"); ?>

<!-- Header Ends Here -->       
<!-- Content Starts Here -->
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Patients</a> </div>
    <h1>All Registered Patients</h1>
  </div>
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
 
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>List of Registered Patients</h5>
          </div>
          <div class="widget-content nopadding" >
            <table class="table table-bordered data-table js-exportable" style="font-size: 16px">

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
            if ($pidrow = @mysqli_fetch_assoc($qy_prun)) {             
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
                  <td>'; if((isset($admi_stat)) && $admi_stat ==="IN"){echo '<span class="label label-important">Currently Admitted</span>';} else{ echo '<a href="diagnose.php?id='.$hosp_no.'" class="btn btn-info btn-mini"><i class="icon icon-edit"></i> Admit Patient </a></td></tr>';}
                  $count++;
            }
            ?>

                
                
              </tbody>
            </table>
          </div>
        </div>
 
       
      </div>
    </div>
  </div>
</div>
<!--Footer-part-->
<?php 

include_once("setup/footer.php"); ?>