<?php include_once("setup/header.php");


?>

<!-- Header Ends Here -->       
<!-- Content Starts Here -->
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Examine Patient</a> </div>
    <h1>Examine a Patient</h1>
  </div>
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="alert alert-info alert-block">
            <h4 class="alert-heading">Info! Patient must first be registered before being examined.</h4>
      </div>
 
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>Search for Patients</h5>
          </div>
          <div class="widget-content nopadding" >
            <table class="table table-bordered data-table js-exportable" style="font-size: 16px">

              <thead>
                <tr>
                  <th>#</th>
                  <th>Hospital Number</th>
                  <th>Name</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
              <?php

            $query = "SELECT * FROM patient_personal_info ";
            $query_run = @mysqli_query($link, $query);
            $count = 1;
            while ($useridrow = @mysqli_fetch_assoc($query_run)) {
             
            $patientid = $useridrow['id'];
            $hosp_no = $useridrow['hosp_no'];
            $sname = $useridrow['sname'];
            $fname = $useridrow['fname'];
            
          echo '<tr class="gradeX">
                  <td >'.$count.'</td>
                  <td>'.$hosp_no.'</td>
                  <td>'.$sname.' '.$fname.'</td>
                  <td><a href="examinepatient.php?id='.$hosp_no.'" class="btn btn-danger btn-mini" style="font-size:16px;"><i class="icon icon-edit"></i> Examine </a></td></tr>';
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