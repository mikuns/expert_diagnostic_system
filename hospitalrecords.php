<?php include_once("setup/header.php");


?>

<!-- Header Ends Here -->       
<!-- Content Starts Here -->
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Hospital Records</a> </div>
    <h1>Hospital Records of Pateints</h1>
  </div>
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="alert alert-info alert-block">
            <h4 class="alert-heading">Info! This show a list of all patient records the hospital has overseen.</h4>
      </div>
 
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>Search for Records</h5>
          </div>
          <div class="widget-content nopadding" >
            <table class="table table-bordered data-table js-exportable" style="font-size: 16px">

              <thead>
                <tr>
                  <th>#</th>
                  <th>Hospital No.</th>
                  <th>Case Ref. No.</th>
                  <th>Admitted Date</th>
                  <th>Admission Status</th>
                  <th>Doctor in Charge</th>
                  <th>Discharged Date</th>
                  <th>Discharged Status</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
              <?php

            $query = "SELECT * FROM patient_hospital_history ORDER BY date_of_admission DESC";
            $query_run = @mysqli_query($link, $query);
            $count = 1;
            while ($useridrow = @mysqli_fetch_assoc($query_run)) {
             
            $caseid = $useridrow['case_ref_no'];
            $hosp_no = $useridrow['hosp_no'];
            $date_of_admission = $useridrow['date_of_admission'];
            $admission_status = $useridrow['admission_status'];
            $name_of_doctor = $useridrow['name_of_doctor'];
            $date_of_discharge = $useridrow['date_of_discharge'];  
            $status_upon_discharge = $useridrow['status_upon_discharge'];  
            
          echo '<tr class="gradeX">
                  <td>'.$count.'</td>
                  <td>'.$hosp_no.'</td>
                  <td>'.$caseid.'</td>
                  <td>'.date("F j, Y, g:i a", strtotime($date_of_admission)).'</td>
                  <td><span class="label label-inverse">'.$admission_status.'</span></td>
                  <td>'.$name_of_doctor.'</td>
                  <td>'; if(($admission_status == "IN")){echo '<span class="label label-warning">Still Admitted</span>';} else {echo '<span class="label label-success">'.date("F j, Y, g:i a", strtotime($date_of_discharge)).'</span>';} echo '</td>
                  <td>'; if($admission_status == "IN"){echo '<span class="label label-warning">Unavailable</span>';} else {echo '<span class="label label-success">'.$status_upon_discharge.'</span>';} echo '</td>
                  <td>'; if($admission_status == "IN"){echo '<a href="labexamination.php?id='.$caseid.'" class="btn btn-danger btn-mini"><i class="icon icon-edit"></i> Continue </a>';} else {echo '<a href="patientreport.php?id='.$caseid.'" class="btn btn-primary btn-mini"><i class="icon icon-edit"></i> View Report </a>';} echo '</td>
                 </tr>';
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

<?php include_once("setup/footer.php"); ?>