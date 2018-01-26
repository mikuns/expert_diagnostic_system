<?php include_once("setup/header.php");

$maxdisease = disease_rate()['maxdisease'];
$maxno = disease_rate()['maxno'];
$percent = disease_rate()['percent'];
$tot = disease_rate()['total_d'];

?>
<!--main-container-part-->
<div id="content">
<!--breadcrumbs-->
  <div id="content-header">
    <div id="breadcrumb"> <a href="dashboard.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home </a></div>
  </div>
<!--End-breadcrumbs-->

<!--Action boxes-->
  <div class="container-fluid">
    <div class="quick-actions_homepage">
      <ul class="quick-actions">
        <li class="bg_lb span3"> <a href="#"> <i class="icon-user"></i>  Most Frequent Disease <span class="label label-important"><?php echo $maxdisease; ?></span></a> </li>

         <li class="bg_lb span3"> <a href="#"> <i class="icon-user"></i>  Total Registered Patients <span class="label label-important"><?php echo getnumrows('patient_personal_info'); ?></span></a> </li>

        <li class="bg_ls span3"> <a href="#"> <i class="icon-user"></i>  Currently Admitted Patients <span class="label label-important"><?php echo getnumrowswhere('patient_hospital_history','admission_status','IN'); ?></span></a> </li>



      
      </ul>
    </div>
<!--End-Action boxes-->    


<div class="row-fluid">
                <div class="span6">
                
                <div class="widget-box">
                  <div class="widget-title"> <span class="icon"><i class="icon-ok"></i></span>
                    <h5>Most Frequent Disease is <em class="text text-success"><?php echo $maxdisease; ?></em></h5>
                  </div>
                <div class="widget-content">
                  <ul class="unstyled">
                  <li> <span class="icon24 icomoon-icon-arrow-up-2 green"></span> <?php echo $maxdisease.' is '.$percent.'%'; ?> of all diagnoses diseases <span class="pull-right strong">Total Diagnosed Cases: <em class="label label-important"> <?php echo $tot; ?></em></span>
                  <div class="progress progress-danger progress-striped ">
                  <div style="width: <?php echo $percent.'%'; ?>;" class="bar"></div>
                  </div>
                  </li>
                  <li> There are <span class="label label-info"> <?php echo $maxno; ?></span> cases of <span class="label label-info"><?php echo $maxdisease; ?></span> of a Total of <span class="label label-info"> <?php echo $tot; ?></span> Diagnosed Cases 
                  
                  </li>
                  </ul>
                </div>
              </div>

                </div>
                <div class="span6">
                  <div class="widget-box">
                  <div class="widget-title"> <span class="icon"><i class="icon-ok"></i></span>
                    <h5>Instructions on Usage</h5>
                  </div>
                <div class="widget-content">
                    <div class="alert alert-info">
                         <strong> Add Patient</strong>
                        <ul>
                            <li>
                               Fill in all relevant details
                            </li>
                            <li>
                                 There is an option to diagnose patient after registration or stop there. 
                            </li>
                            
                        </ul>
                        <strong> Diagnose Patient</strong>
                        <ul>
                            <li>
                               Fill in all patient compliants or symptoms
                            </li>
                            <li>
                                 Click button to diagnose then continue 
                            </li>
                            
                        </ul>

                        <strong> Patient Lab Form</strong>
                        <ul>
                            <li>
                               Fill in all patient Lab Results and continue
                            </li>
                        </ul>

                        <strong> Patient Report </strong>
                        <ul>
                            <li>
                               View all inputed and diagnosed information on patient
                            </li>
                            <li>
                               Click button to discahrge patient
                            </li>
                        </ul>
                       
                    </div>
                  </div>
                </div>

                </div>
</div>

    </div>
  </div>
</div>

<!--end-main-container-part-->

<?php include_once("setup/footer.php");?>   