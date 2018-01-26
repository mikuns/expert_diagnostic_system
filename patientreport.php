<?php include_once("setup/header.php");

if (isset($_GET['id'])) {
   $caseno = mysqli_real_escape_string($link, $_GET['id']);

   $qr_ = "SELECT * FROM patient_lab_info WHERE case_ref_no='$caseno' ";

   $qr_run = mysqli_query($link, $qr_);
   if ($labidrow = mysqli_fetch_assoc($qr_run)) {
      $labno = $labidrow['lab_ref_no'];
      $hospno = $labidrow['hosp_no'];
      $bloodgroup = $labidrow['blood_group'];
      $rhfactor = $labidrow['rhfactor'];
      $allergy = $labidrow['allergy'];
    }

    $qr_ = "SELECT * FROM patient_hospital_history WHERE case_ref_no='$caseno'";

   $qr_run = mysqli_query($link, $qr_);
   if ($useridrow = mysqli_fetch_assoc($qr_run)) {
      
      $hospno = $labidrow['hosp_no'];
      $dateofadmission = $useridrow['date_of_admission'];
      $admissionstatus = $useridrow['admission_status'];
      $nameofdoctor = $useridrow['name_of_doctor'];
      $symptoms = $useridrow['symptoms'];
      $doctordiagnosis = $useridrow['doctors_diagnosis'];
      $dateofdischarge = $useridrow['date_of_discharge'];  
      $statusupondischarge = $useridrow['status_upon_discharge'];
    }

   $qr2_ = "SELECT * FROM patient_personal_info WHERE hosp_no='$hospno'";
   $qr2_run = mysqli_query($link, $qr2_);
   if ($useridrow = mysqli_fetch_assoc($qr2_run)) {
      $p_id  = $useridrow['id'];
      $sname = $useridrow['sname'];
      $fname = $useridrow['fname'];
      $dateofbirth = $useridrow['date_of_birth'];
      $age = (date("Y") - date("Y", strtotime($dateofbirth)));
      $sex = $useridrow['sex'];
      $marital_status = $useridrow['marital_status'];
    }
  }

  if (($sex == 'Male') && ($marital_status == 'Single' || $marital_status == 'Maried')) {
      $nametitle = "Mr. ";
  } elseif ($sex == 'Female' && $marital_status == 'Single') {
      $nametitle = "Miss. ";
  } elseif ($sex == 'Female' && $marital_status == 'Maried') {
      $nametitle = "Mrs. ";
  }

  if (isset($_POST['submit'])) {
    $dischargedate = date("Y-m-d H:i:s");
    $r_sql = "UPDATE patient_hospital_history SET admission_status = 'OUT', status_upon_discharge = 'Fully Recovered', date_of_discharge = '$dischargedate' WHERE case_ref_no = '$caseno' ";
    $r_sql_run = mysqli_query($link, $r_sql);
    if (isset($r_sql_run)) {
      $_SESSION['discharge'] = '<h4 class="text text-success">PATIENT DISCHARGED <i class="fa fa-check"></i></h4>';
    }
   }
      ?>   

<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="dashboard.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Patient Report</a> </div>
    <h1>Patient Hospital Report</h1>
  </div>
  <div class="container-fluid"><hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="text-center">
        <?php if (isset($_SESSION['discharge'])) {
        echo $_SESSION['discharge'];
        } ?>
  </div>
        <div class="widget-box" id="printsection">
          <div class="widget-title"> <span class="icon"> <i class="icon-briefcase"></i> </span>
            <h5>Case Reference No.: <?php echo '#'.$caseno; ?></h5>
            <h5 class="pull-right">Hospital No.: <?php echo '#'.$hospno; ?></h5>
            <h5 class="pull-right">Lab Reference No.: <?php echo '#'.$labno; ?></h5>
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
                      <td><h4><?php echo $sex.' | '.$age.' Years'; ?></h4></td>
                    </tr>
                 
                  </tbody>
                </table>
              </div>
              <div class="span6">
                <table class="table table-bordered table-invoice">
                  <tbody>
                    <tr>
                      <td class="width30">Doctor's Name:</td>
                      <td class="width70"><strong><?php echo $nameofdoctor; ?></strong></td>
                    </tr>
                    
                    </tbody></table>

                 <table class="table table-bordered table-invoice">
                  <tbody>
                    <tr>
                    <tr>
                      <td class="width30">Blood Group:</td>
                      <td class="width70"><strong><?php echo $bloodgroup; ?></strong></td>
                    </tr>
                    <tr>
                      <td>Rh Factor:</td>
                      <td><strong><?php echo $rhfactor; ?></strong></td>
                    </tr>
                    <tr>
                      <td>Allergy:</td>
                      <td><strong><?php echo $allergy; ?></strong></td>
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
                      <td class="msg-invoice" width="65%"><h4>Symptoms: </h4><strong> <?php echo $symptoms; ?></strong></td>

                      <td class="right"><h4>Most Likely Disease(s):</h4><strong> <?php echo $doctordiagnosis; ?></strong></td>
                    </tr>
                    <tr>
                      <td><h4>Discharge Stutus:</h4><strong> <?php if(getpatientreportfield('admission_status', $caseno) == "OUT"){ echo $statusupondischarge;} else { echo '<span class="label label-warning">Still Admitted</span>';} ?></strong></td> 
                      <td><h4>Discharge Date:</h4><strong> <?php if(getpatientreportfield('admission_status', $caseno) == "OUT"){echo date("F j, Y, g:i a", strtotime($dateofdischarge));} else {echo '<span class="label label-warning">Still Admitted</span>';} ?></strong></td>                           
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <?php
        if (isset($admissionstatus)) {
          if (getpatientreportfield('admission_status', $caseno) == "IN"){
            echo '<div class="pull-left" >
            <form id="form-wizard" class="form-horizontal" method="post" action="">
            <button type="submit" class="btn btn-success notification" name="submit"> Discharge Patient <i class="fa fa-check"></i></button> 
            </form>
          </div>';
              }
              else if(getpatientreportfield('admission_status', $caseno) == "OUT"){
                echo '<div class="pull-right" style="margin-right: 2px;">
                <a class="btn btn-primary pull-right" href="patientpreview.php?id='.$p_id.'">View Patient Info <i class="fa fa-user"></i></a> 
              </div>
              <div class="pull-right" style="margin-right: 2px;">
                <a class="btn btn-info pull-right" href="" onclick="printpage()">Print Page <i class="fa fa-print"></i></a> 
              </div>';
              }
          }
              ?>
        
      </div>
    </div>
  </div>
</div>

<!-- Modal Part  -->
  

<!--Footer-part-->
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

<script type="text/javascript">     
 //Print Page 
    function printpage(){
        var prtContent = document.getElementById("printsection");
        var WinPrint = window.open('', '', 'left=0,top=10,width=900,height=1000,toolbar=0,scrollbars=0,status=0');
        WinPrint.document.write('<html><head>');
        WinPrint.document.write('<link rel="stylesheet" href="css/bootstrap.min.css">');
        WinPrint.document.write('<link rel="stylesheet" href="css/bootstrap-responsive.min.css">');
        WinPrint.document.write('<link rel="stylesheet" href="css/uniform.css">');
        WinPrint.document.write('<link rel="stylesheet" href="css/matrix-style.css">');
        WinPrint.document.write(' <link rel="stylesheet" href="css/style.css">');
        WinPrint.document.write(' <link rel="stylesheet" href="css/matrix-media.css">');
        WinPrint.document.write(' <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet">');
        WinPrint.document.write('</head><body style="margin: 10px;" onload="print();close();">');
        WinPrint.document.write(prtContent.innerHTML);
        WinPrint.document.write('</body></html>');
        WinPrint.document.close();
        WinPrint.focus();
    };


 </script> 

<?php include_once("setup/footer.php"); unset($_SESSION['discharge']); unset($_SESSION['discharge']);?>   