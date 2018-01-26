<?php include_once("setup/header.php");

if (isset($_GET['id'])) {
   $caseid = mysqli_real_escape_string($link, $_GET['id']);

    $qu_ = "SELECT * FROM patient_hospital_history WHERE case_ref_no='$caseid' ";
    $qu_run = mysqli_query($link, $qu_);
    if ($hosidrow = mysqli_fetch_assoc($qu_run)) {
            $hospid = $hosidrow['hosp_no'];
    }

    $qy = "SELECT * FROM patient_personal_info WHERE hosp_no='$hospid' ";
    $qy_run = mysqli_query($link, $qy);
    if ($useridrow = mysqli_fetch_assoc($qy_run)) {
              $sname = $useridrow['sname'];
              $fname = $useridrow['fname'];
    }
}
if(isset($_POST['submit']))
{
  if(isset($_POST['bloodgroup']) &&
     isset($_POST['rhfactor']) &&
      isset($_POST['allergy']))
  {
      $bloodgroup = mysqli_real_escape_string($link, $_POST['bloodgroup']);
      $rhfactor = mysqli_real_escape_string($link, $_POST['rhfactor']);
      $allergy = mysqli_real_escape_string($link, $_POST['allergy']);

        if(!empty($bloodgroup) && !empty($rhfactor) ) {

          $rq = "SELECT case_ref_no FROM patient_lab_info WHERE case_ref_no = '$caseid'  ";
          $rq_run = mysqli_query($link, $rq);
          $nRowsC = mysqli_num_rows($rq_run);
       
          if ($nRowsC > 0) {
            $sql1 = "UPDATE patient_lab_info SET blood_group = '$bloodgroup', rhfactor='$rhfactor', allergy='$allergy' WHERE case_ref_no = '$caseid' ";    
            $sqlResult = mysqli_query($link, $sql1);  
            if(isset($sqlResult)){
            header("refresh:4, url=patientreport.php?id=".$caseid);  
              $_SESSION['lab_success'] = '<h4 class="text text-success">Successful! Page will redirect now or <a href="patientreport.php?id='.$caseid.'">Click Here To Proceed</a> </h4>';
            } else {
              $_SESSION['lab_error'] = '<h4 class="text text-danger">Error Progressing, please try again later</h4>';
            }     
          } else {
            $sql = "INSERT INTO patient_lab_info (case_ref_no, hosp_no, blood_group, rhfactor, allergy)
            VALUES ('$caseid','$hospid','$bloodgroup','$rhfactor','$allergy')";
            $sqlResult = mysqli_query($link, $sql);
            if (isset($sqlResult)) {
              header("refresh:4, url=patientreport.php?id=".$caseid); 
              $_SESSION['lab_success'] = '<h4 class="text text-success">Successful! Page will redirect now or <a href="patientreport.php?id='.$caseid.'">Click Here To Proceed</a> </h4>';
            } else {
              $_SESSION['lab_error'] = '<h4 class="text text-danger">Error Progressing, please try again later</h4>';
            }
            
          }
        }
    }
}
   
?>   

<div id="content">
<div id="content-header">
  <div id="breadcrumb"> <a href="dashboard.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Patient Examination</a> </div>
  <h1>Laboratory Test</h1>

</div>
<div class="container-fluid">

  <div class="text-center">
  <?php if (isset($_SESSION['lab_success'])) {
        echo $_SESSION['lab_success'];
      } elseif (isset($_SESSION['lab_error'])) {
        echo $_SESSION['lab_error'];
      } ?>
  </div>
  
</div>

<div class="container-fluid">
  <div class="row-fluid">
    <div class="span12">
      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
          <h5>Lab Test</h5>
        </div>
        <div class="widget-content nopadding">
            <form id="form-wizard" class="form-horizontal" method="post" action="">
            <div id="form-wizard-1" class="step">

           <div class="control-group">
              <label class="control-label">Patient Name: </label>
              <div class="controls">
                <input type="text" required="" value="<?php if(isset($sname) && isset($fname)){echo $sname.' '.$fname;} ?>" disabled name="fullname" class="span7"/>
              </div>
            </div>

            <div class="control-group">
              <label class="control-label">Hospital Number: </label>
              <div class="controls">
                <input type="number" required="" value="<?php if(isset($hospid)){echo $hospid;} ?>" disabled name="hosp_no" class="span7
                "/>
              </div>
            </div>

            <div class="control-group">
              <label class="control-label">Case Reference Number: </label>
              <div class="controls">
                <input type="number" required="" disabled value="<?php if(isset($caseid)){echo $caseid;} ?>" disabled name="case_no" class="span7"/>
                
              </div>
            </div>

            <div class="control-group">
              <label class="control-label">Blood Group</label>
              <div class="controls">
                <select name="bloodgroup" required="" class="span7" data-placeholder="Choose Your Blood Group">
                  <option value=""></option>
                  <option value="A+">A+</option>
                  <option value="O+">O+</option>
                  <option value="B+">B++</option>
                  <option value="AB+">AB+</option>
                  <option value="A-">A-</option>
                  <option value="O-">O-</option>
                  <option value="B-">B-</option>
                  <option value="AB-">AB-</option>
                </select>
              </div>
            </div>

            <div class="control-group">
              <label class="control-label">Rh Factor</label>
              <div class="controls">
                <select name="rhfactor" required="" class="span7" data-placeholder="Choose Your Rh Factor">
                  <option value=""></option>
                  <option value="Rh Negative">Rh Negative</option>
                  <option value="Rh Positive">Rh Positive</option>
                </select>
              </div>
            </div>


            <div class="control-group">
              <label class="control-label" for="form-field-tags">Allergies (Optional): </label>
              <div class="controls">
                <input type="text" required="" name="allergy" style="margin: 0 auto;" class="span7" placeholder="Please enter any allegies">
                 <span class="help-block">e.g peanut, milk</span>
            </div>
            </div>

            <div class="form-actions text-center">
              <button type="submit" class="btn btn-success notification" name="submit"><i class="icon icon-ok"></i> Submit Lab Result</button>
                  
            </div>
            </div>
          </form>

        </div>
      </div>
      
    </div>
    
  </div>

</div></div>
<!--Foot0r-part-->


<?php include_once("setup/footer.php"); unset($_SESSION['lab_error']); unset($_SESSION['lab_success']);?>   
