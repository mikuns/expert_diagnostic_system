<?php include_once("setup/header.php");

if (isset($_GET['id'])) {
      $hospid = mysqli_real_escape_string($link, $_GET['id']);

      $query2 = "SELECT * FROM patient_personal_info WHERE hosp_no='$hospid' ";
      $q_run2 = mysqli_query($link, $query2);
        if ($useridrow2 = mysqli_fetch_assoc($q_run2)) {
                $sname = $useridrow2['sname'];
                $fname = $useridrow2['fname'];
        }
}

if(isset($_POST['submit']) && isset($_POST['symptoms']))
{
        $dated = date("Y-m-d H:i:s");
        $docotrname = 'Dr. '.$user_firstname.' '.$user_surname;
        $admissionstatus = "IN";
        $caserf = id_generator2();
           
        $quer = "SELECT * FROM patient_hospital_history WHERE case_ref_no='$caserf' ";
        $q_run = mysqli_query($link, $quer);
        $numRsCk = mysqli_num_rows($q_run);
      
        if ($numRsCk < 1) {

          $sql = "INSERT INTO patient_hospital_history (case_ref_no, hosp_no, admission_status, date_of_admission, name_of_doctor, symptoms, doctors_diagnosis, date_of_discharge, status_upon_discharge)
          VALUES ('$caserf','$hospid','$admissionstatus','$dated','$docotrname', NULL ,NULL,NULL,NULL)";
          $sqlResult = mysqli_query($link, $sql);
        }

        $deds = array();
        $ded1 = array();
        foreach ($_POST['symptoms'] as $ded) {
        $deds[] = mysqli_real_escape_string($link,$ded);
        }
        $patient_complaint = join(", ", $deds);
        // echo $patient_complaint;
        $end_ = sizeof($deds);
        for ($i=0; $i < $end_; $i++) { 

          $que = "SELECT `diseases`.diseases_name FROM symptoms, diseases WHERE `symptoms`.disease_id = `diseases`.disease_id AND `symptoms`.symptom_name = '".$deds[$i]."'  ";

          $que_run = @mysqli_query($link, $que);
          while ($exidrow = @mysqli_fetch_assoc($que_run))
          { 
              $ded1[] = $exidrow['diseases_name'];
           }
        }
        $cnt =array_count_values($ded1);
        $top = array_keys($cnt, max($cnt));
        if(sizeof($top)>1){
           $flag = 1;
          $_SESSION['result'] = "<h2 class='bt btn-success'>The possible diseases are: ".strtoupper(join(", ", $top))."</h2><br><a href='labexamination.php?id=".$caserf."' class='btn btn-danger'>Click To Continue (Lab Test)</a><br>";
            $dis =join(", ", $top);
            $upd_q = "UPDATE patient_hospital_history  SET symptoms = '$patient_complaint', doctors_diagnosis = '$dis', date_of_discharge = NULL WHERE case_ref_no='$caserf' ";
            $q_run = mysqli_query($link, $upd_q);
        }else {
           $flag = 1;
          //echo "<br>The diseases is likely ".$top[0]."<br>It could also be ";
          $_SESSION['result'] = "<div><h2 class='btn btn-success'>The disease is likely ".strtoupper($top[0])."</h2></div><br><h5 class='text-info'><a href='labexamination.php?id=".$caserf."' class='btn btn-danger'>Click To Continue (Lab Test)</a></h5><br>";
          $dis = $top[0];
          $upd_q = "UPDATE patient_hospital_history  SET symptoms = '$patient_complaint', doctors_diagnosis = '$dis', date_of_discharge = NULL WHERE case_ref_no='$caserf' ";
            $q_run = mysqli_query($link, $upd_q);
        }
}
?> 

<div id="content">
<div id="content-header">
  <div id="breadcrumb"> <a href="dashboard.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Patient Examination</a> </div>
  <h1>Patient Diagnosis</h1>

</div>
<div class="container-fluid">
  <div class="text-center"><?php if (isset($_SESSION['result'])) {
        echo $_SESSION['result'];
      } ?>
  </div>
            
</div>

<div class="container-fluid">
  <div class="row-fluid">
    <div class="span12">
      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
          <h5>** Patient Diagnosis **</h5>
        </div>
        <div class="widget-content nopadding">
            
            <form id="form-wizard" class="form-horizontal" method="post" action="">
          
            <div class="control-group">
              <label class="control-label">Patient Name: </label>
              <div class="controls">
                <input type="text" required="" value="<?php if(isset($sname) && isset($fname)){echo $sname.' '.$fname;} ?>" disabled name="fullname" class="span8"/>
              </div>
            </div>

            <div class="control-group">
              <label class="control-label">Hospital Number: </label>
              <div class="controls">
                <input type="number" required="" value="<?php if(isset($hospid)){echo $hospid;} ?>" disabled name="hosp_no" class="span8
                "/>
              </div>
            </div>

            <div class="control-group">
              <label class="control-label">Select Symptoms: </label>
              <div class="controls">
                <select multiple name="symptoms[]" class="span8" id="inputInfo" required="" data-placeholder="Select patient complaints">
                <?php
                $query = "SELECT DISTINCT(symptom_name) AS symptom_name FROM symptoms ORDER BY symptom_name ASC ";
            $query_run = @mysqli_query($link, $query);
            while ($exidrow = @mysqli_fetch_assoc($query_run)) { 
                    echo '<option value="'.$exidrow['symptom_name'].'" >'.$exidrow['symptom_name'].'</option>';
                }
                  ?>
                </select>

              </div>
            </div>
             <div class="control-group">
              <div class="controls">
                <span class="text text-info">*** A minimum of 4 symptoms. An increasing amount of symptoms yields a more accurate result</span>
              </div>
            </div>

            <div class="form-actions text-center">
              <button type="submit" class="btn btn-success notification" " name="submit"><i class="icon icon-ok"></i> Submit and Diagnose</button>
                  
            </div>
          </form>

        </div>
      </div>
      
    </div>
    
  </div>

</div></div>
<!--Foot0r-part-->


<?php include_once("setup/footer.php"); unset($_SESSION['result']); ?>   