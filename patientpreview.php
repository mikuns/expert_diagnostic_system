<?php include_once("setup/header.php");

if (isset($_GET['id'])) {
   $patientid = mysqli_real_escape_string($link, $_GET['id']);

   $query = "SELECT * FROM patient_personal_info WHERE id='$patientid' ";
   $query_run = mysqli_query($link, $query);
   if ($useridrow = mysqli_fetch_assoc($query_run)) {
             
            $patientid = $useridrow['id'];
            $hosp_no = $useridrow['hosp_no'];
            $sname = $useridrow['sname'];
            $fname = $useridrow['fname'];
            $date_of_birth = $useridrow['date_of_birth'];
            $age= (date("Y") - date("Y", strtotime($date_of_birth)));
            $sex = $useridrow['sex'];
            $marital_status = $useridrow['marital_status'];
            $home_add = $useridrow['home_add'];
            $state_of_origin = $useridrow['state_of_origin'];
            $country = $useridrow['country'];
            $occupation = $useridrow['occupation'];
            $name_of_nok = $useridrow['name_of_nok'];
            $relationship_to_nok = $useridrow['relationship_to_nok'];
            $add_of_nok = $useridrow['add_of_nok'];
            $name_of_sponsor = $useridrow['name_of_sponsor'];
            $add_of_sponsor = $useridrow['add_of_sponsor'];
            $dated = $useridrow['dated'];
    }
  }

  if (($sex == 'Male') && ($marital_status == 'Single' || $marital_status == 'Maried')) {
      $nametitle = "Mr. ";
  } elseif ($sex == 'Female' && $marital_status == 'Single') {
      $nametitle = "Miss. ";
  } elseif ($sex == 'Female' && $marital_status == 'Maried') {
      $nametitle = "Mrs. ";
  }
      ?>   

<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="dashboard.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Patient Preview</a> </div>
    <h1>Patient Preview</h1>
  </div>
  <div class="container-fluid"><hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-briefcase"></i> </span>
            <h5>Profile Page of <?php echo strtoupper($sname.' '.$fname); ?></h5>
          </div>
          <div class="widget-content">
            <div class="row-fluid">
              <div class="span6">
                <table class="">
                  <tbody>
                    <tr>
                      <td><h3><?php if(isset($nametitle)){echo $nametitle.' '.$sname.' '.$fname;}else{ echo $sname.' '.$fname; } ?></h3></td>
                    </tr>
                    <tr>
                      <td><h4><?php echo $sex.' | '.$marital_status; ?></h4></td>
                    </tr>
                    <tr>
                      <td><h4><?php echo $age.' Years' ; ?></h4></td>
                    </tr>
                    
                  </tbody>
                </table>
              </div>
              <div class="span6">
                <table class="table table-bordered table-invoice">
                  <tbody>
                    <tr>
                    <tr>
                      <td class="width30">Home Address:</td>
                      <td class="width70"><strong><?php echo $home_add; ?></strong></td>
                    </tr>
                    <tr>
                      <td>State of Origin:</td>
                      <td><strong><?php echo $state_of_origin; ?></strong></td>
                    </tr>
                    <tr>
                      <td>Country:</td>
                      <td><strong><?php echo $country; ?></strong></td>
                    </tr>
                    <tr>
                      <td class="width30">Occupation:</td>
                    <td class="width70">
                    <strong><?php echo $occupation; ?></strong>
                    </tr>
                    
                  </tr>
                    </tbody>
                  
                </table>
              </div>
            </div>
            <div class="row-fluid">
              <div class="span12">
              <table class="table table-bordered ">
                  <tbody>
                    <tr>
                      <td class="msg-invoice" width="65%"><h4>Next of Kin </h4> <br>
                        Relationship:<strong> <?php echo $relationship_to_nok; ?></strong><br>
                        Name:<strong> <?php echo $name_of_nok; ?></strong><br>
                        Address:<strong> <?php echo $add_of_nok; ?></strong></td>

                      <td class="right"><h4>Sponsor</h4> <br>
                        Name:<strong> <?php echo $name_of_sponsor; ?></strong><br>
                        Address:<strong> <?php echo $add_of_sponsor; ?></strong></td>
                      
                  </tbody>
                </table>
              <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>Patient Medical Records and History</h5>
          </div>
          <div class="widget-content nopadding" >
                <table class="table table-bordered data-table">
                  <thead>
                    <tr>
                      <th class="head0">S/N</th>
                      <th class="head1">Admitted Date</th>
                      <th class="head0 ">Admission Status</th>
                      <th class="head1 ">Doctor in charge</th>
                      <th class="head1 ">Date of Discharge</th>
                      <th class="head0 right">Discharge Status</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $query = "SELECT * FROM patient_hospital_history WHERE hosp_no = '$hosp_no' ORDER BY date_of_admission DESC ";
                    $query_run = @mysqli_query($link, $query);
                    $count = 1;
                    while ($useridrow = @mysqli_fetch_assoc($query_run)) {
                     
                    $caseid = $useridrow['case_ref_no'];
                    $date_of_admission = $useridrow['date_of_admission'];
                    $admission_status = $useridrow['admission_status'];
                    $name_of_doctor = $useridrow['name_of_doctor'];
                    $date_of_discharge = $useridrow['date_of_discharge'];  
                    $status_upon_discharge = $useridrow['status_upon_discharge'];       
                    
                    echo '<tr class="gradeX">
                          <td>'.$count.'</td>
                          <td>'.date("F j, Y, g:i a", strtotime($date_of_admission)).'</td>
                          <td>'; if(($admission_status == "IN")){echo '<span class="label label-warning">Still Admitted</span>';} else {echo '<span class="label label-success">'.date("F j, Y, g:i a", strtotime($date_of_discharge)).'</span>';} echo '</td>
                          <td>'.$name_of_doctor.'</td>
                          <td>'; if($admission_status == "IN"){echo '<span class="label label-warning">Unavailable</span>';} else {echo '<span class="label label-success">'.date("F j, Y, g:i a", strtotime($date_of_discharge)).'</span>';} echo '</td>
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
          <?php

          $qu = "SELECT admission_status FROM patient_hospital_history WHERE hosp_no = '$hosp_no' AND admission_status = 'IN' ";
          $qu_run = @mysqli_query($link, $qu); 
          $numrows = mysqli_num_rows($qu_run); 
          if($numrows < 1){
            echo '<div class="pull-right">
                  <a class="btn btn-danger btn-large pull-right" href="diagnose.php?id='.$hosp_no.'">Admit Patient</a> 
                </div>';} ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!--Footer-part-->


<?php include_once("setup/footer.php");?>   