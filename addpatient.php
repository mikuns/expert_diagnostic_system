<?php include_once("setup/header.php");

if(isset($_POST['submit']))
{
  if(
     isset($_POST['sname']) &&
      isset($_POST['fname']) &&
       isset($_POST['date_of_birth']) &&
        isset($_POST['sex']) &&
         isset($_POST['marital_status']) &&
          isset($_POST['state_of_origin']) &&
           isset($_POST['country']) ) {
    // Escape user inputs for security

        $sname = mysqli_real_escape_string($link, $_POST['sname']);
        $fname = mysqli_real_escape_string($link, $_POST['fname']);
        $date_of_birth = mysqli_real_escape_string($link, $_POST['date_of_birth']);
        $sex = mysqli_real_escape_string($link, $_POST['sex']);
        $marital_status = mysqli_real_escape_string($link, $_POST['marital_status']);
        $home_add = mysqli_real_escape_string($link, $_POST['home_add']);
        $state_of_origin = mysqli_real_escape_string($link, $_POST['state_of_origin']);
        $country = mysqli_real_escape_string($link, $_POST['country']);
        $occupation = mysqli_real_escape_string($link, $_POST['occupation']);
        $name_of_nok = mysqli_real_escape_string($link, $_POST['name_of_nok']);
        $relationship_to_nok = mysqli_real_escape_string($link, $_POST['relationship_to_nok']);
        $add_of_nok = mysqli_real_escape_string($link, $_POST['add_of_nok']);
        $name_of_sponsor = mysqli_real_escape_string($link, $_POST['name_of_sponsor']);
        $add_of_sponsor = mysqli_real_escape_string($link, $_POST['add_of_sponsor']);
        
    if( !empty($sname) && !empty($fname) && !empty($sex) ) {
        $hosp_no = id_generator();
        $query = "SELECT hosp_no FROM patient_personal_info WHERE hosp_no = '$hosp_no'  ";
        $query_run = mysqli_query($link, $query);
        $numRowsCheck = mysqli_num_rows($query_run);
        $dated = date("Y-m-d H:i:s");
     
        if ($numRowsCheck > 0) {
            $_SESSION['addp_error'] = '<h4 class="text text-danger">Patient Already Registered. Try Again </h4>';
        } else {

          $sql = "INSERT INTO patient_personal_info (hosp_no, sname, fname, date_of_birth, sex, marital_status, home_add, state_of_origin, country, occupation, name_of_nok, relationship_to_nok, add_of_nok, name_of_sponsor, add_of_sponsor, dated)
                  VALUES ('$hosp_no', '$sname', '$fname', '$date_of_birth', '$sex', '$marital_status', '$home_add', '$state_of_origin', '$country', '$occupation', '$name_of_nok', '$relationship_to_nok', '$add_of_nok', '$name_of_sponsor', '$add_of_sponsor', '$dated')";
            $sqlResult = mysqli_query($link, $sql);
            if ($sqlResult) {

              if(isset($_POST['checked'])){
                
                $_SESSION['addp_success'] = '<h4 class="text text-success">Registration Successful.. <i class="fa fa-check"></i> Page Will Now Redirect To Diagnose Patient </h4>';
                header("refresh:5, url=diagnose.php?id=".$hosp_no); 
              } else {
                $_SESSION['addp_success'] = '<h4 class="text text-success">Registration Successful. <i class="fa fa-check"></i> </h4>';
              }
            } else {
                $_SESSION['addp_error'] = '<h4 class="text text-danger">Error Adding Patient. Try Again </h4>';
            }
        }
      }
// close connection
            mysqli_close($link);
    }
  }
?>  
<!--close-left-menu-stats-sidebar-->

<div id="content">
<div id="content-header">
  <div id="breadcrumb"> <a href="dashboard.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">New Patient</a> </div>
  <h1>Create New Patients</h1>

</div>
<div class="container-fluid">
  <div class="alert alert-success">
      <strong>Info!</strong> Please file all fields
  </div>
  <div class="text-center">
  <?php if (isset($_SESSION['addp_success'])) {
  echo $_SESSION['addp_success'];
  } elseif (isset($_SESSION['addp_error'])) {
  echo $_SESSION['addp_error'];
  } ?>
  </div>    
</div>

<div class="container-fluid">
  <div class="row-fluid">
    <div class="span12">
      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
          <h5>New Patient</h5>
        </div>
        <div class="widget-content nopadding">
            <form id="form-wizard" class="form-horizontal" method="post" action="">
              <div id="form-wizard-1" class="step">

            <div class="control-group text-center" ><h4>** Patient Personal Information **</h4></div>

            <div class="control-group">
              <label class="control-label">Surname: </label>
              <div class="controls">
                <input type="text" required="" name="sname" class="span7"/>
              </div>
            </div>

            <div class="control-group">
              <label class="control-label">First name: </label>
              <div class="controls">
                <input type="text" required="" name="fname" class="span7" />
              </div>
            </div>

            <div class="control-group">
              <label class="control-label">Date of Birth: </label>
              <div class="controls">
                <input type="date" required="" name="date_of_birth" class="span7"/>
              </div>
            </div>

            <div class="control-group">
              <label class="control-label">Sex</label>
              <div class="controls">
                <select name="sex" required="" class="span7" data-placeholder="Choose Your Sex">
                  <option value=""></option>
                  <option value="Male">Male</option>
                  <option value="Female">Female</option>
                </select>
              </div>
            </div>

            <div class="control-group">
              <label class="control-label">Marital Status: </label>
              <div class="controls">
                <select name="marital_status" required="" class="span7" data-placeholder="Choose Your Marital Status">
                  <option value=""></option>
                  <option value="Single">Single</option>
                  <option value="Maried">Maried</option>
                </select>
              </div>
            </div>

            <div class="control-group">
              <label class="control-label">Home Address: </label>
              <div class="controls">
                <input type="text" required="" name="home_add" class="span7" />
              </div>
            </div>

            <div class="control-group">
              <label class="control-label">State of Origin: </label>
              <div class="controls">
                <input type="text" required="" name="state_of_origin" class="span7"/>
              </div>
            </div>

            <div class="control-group">
              <label class="control-label">Country: </label>
              <div class="controls">
                <input type="text" required="" name="country" class="span7"/>
              </div>
            </div>

            <div class="control-group">
              <label class="control-label">Occupation: </label>
              <div class="controls">
                <input type="text" required="" name="occupation" style="margin: 0 auto;" data-provide="typeahead" data-items="4" data-source="[&quot;Civil Servant&quot;,&quot;Military Personnel&quot;,&quot;Governemnt Official&quot;,&quot;Student&quot;,&quot;None&quot;,&quot;Doctor&quot;,&quot;Lawyer&quot;,&quot;Entrepreneur&quot;]" class="span7"/>
              </div>
            </div>

            <div class="control-group text-center" ><h4>** Next of Kin **</h4></div>

            <div class="control-group">
              <label class="control-label">Name of Next of Kin: </label>
              <div class="controls">
                <input type="text" required="" name="name_of_nok" class="span7"/>
              </div>
            </div>

            <div class="control-group">
              <label class="control-label">Relationship to Next of Kin: </label>
              <div class="controls">
                <select name="relationship_to_nok" required="" class="span7" data-placeholder="Choose Your Next of Kin">
                  <option value=""></option>
                  <option value="Father">Father</option>
                  <option value="Mother">Mother</option>
                  <option value="Sibling">Sibling</option>
                  <option value="Husband">Husband</option>
                  <option value="Wife">Wife</option>
                  <option value="Other">Other</option>
                </select>
              </div>
            </div>

            <div class="control-group">
              <label class="control-label">Address of Next of Kin: </label>
              <div class="controls">
                <input type="text" required="" name="add_of_nok" class="span7"/>
              </div>
            </div>

            <div class="control-group text-center" ><h4> ** Sponsor **</h4></div>

            <div class="control-group">
              <label class="control-label">Name of Sponsor: </label>
              <div class="controls">
                <input type="text" required="" name="name_of_sponsor" class="span7" />
              </div>
            </div>

            <div class="control-group">
              <label class="control-label">Address of Sponsor: </label>
              <div class="controls">
                <input type="text" required="" name="add_of_sponsor" class="span7" />
              </div>
            </div>

            <div class="control-group">
            <div class="controls">
                <label>
                  <input type="checkbox" name="checked" style="opacity: 0;"><em class="text-info" style="font-weight: bold; font-size: large;"> ** Please Check if only if you intend to diagnose patient afterwards</em>
                </label>
              </div>
            </div>
            
            <div class="form-actions text-center">
              <button type="submit" class="btn btn-success notification" id="sbtn" name="submit"><i class="icon icon-ok"></i> Submit</button>
                     
                  
            </div>
            </div>
          </form>

           <script src="jGrowl/jquery.jgrowl.js"></script>
  <script>
        $(function() {
            $('.tooltip').tooltip();  
      
      $('.tooltip-top').tooltip({ placement: 'top' });  

      $('.notification').click(function() {
        var $id = $(this).attr('id');
        switch($id) {
          case 'notification-sticky':
            $.jGrowl("Successful", { sticky: true });
          break;

          case 'sbtn':
            $.jGrowl("", { header: 'Successful' });
          break;

        
          default:
            $.jGrowl("Hello world!");
          break;
        }
      });
        });
        </script>
        </div>
      </div>
    </div>
    
  </div>

</div></div>
<!--Footer-part-->

<?php include_once("setup/footer.php");
  unset($_SESSION['addp_error']); unset($_SESSION['addp_success']); ?>
