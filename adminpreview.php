<?php include_once("setup/header.php");

if (isset($_GET['ID'])) {
   $adminid = mysqli_real_escape_string($link, $_GET['ID']);

   $query = "SELECT * FROM admin_tbl WHERE id='$adminid' ";
   $query_run = mysqli_query($link, $query);
   if ($useridrow = mysqli_fetch_assoc($query_run)) {
             
            $username = $useridrow['admin_username'];
            $email = $useridrow['admin_email'];
            $level = $useridrow['admin_level'];
            $dated = $useridrow['dated'];
    }
  }
      ?>   

<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="dashboard.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Admin Preview</a> </div>
    <h1>Admin Preview</h1>
  </div>
  <div class="container-fluid"><hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-briefcase"></i> </span>
            <h5><?php echo $username; ?></h5>
          </div>
          <div class="widget-content">
            <div class="row-fluid">
              <div class="span6">
                <table class="">
                  <tbody>
                    <tr>
                      <td><h4>Email: <?php echo $email; ?></h4></td>
                    </tr>
                    <tr>
                      <td><h5>Admin Level: <?php echo $level; ?></h5></td>
                    </tr>
                    
                  </tbody>
                </table>
              </div>
              
            </div>
            <div class="row-fluid">
              <div class="span12">
              <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>Book(s) Allocated To Users</h5>
          </div>
          <div class="widget-content nopadding" >
                <table class="table table-bordered data-table">
                  <thead>
                    <tr>
                      <th class="head0">S/N</th>
                      <th class="head1">Book Name</th>
                      <th class="head1 ">Allocated User</th>
                      <th class="head1 ">User Matric Number</th>
                      <th class="head1 ">User Phone Number</th>
                      <th class="head1 ">Status</th>
                      <th class="head0 right">Collection Date</th>
                      <th class="head0 right">Return Date</th>

                    </tr>
                  </thead>
                  <tbody>
                      <?php

            $query = "SELECT * FROM book_collection_tbl WHERE WITNESS_ADMIN = '$username' ORDER BY COLLECTION_DATE ASC ";
            $query_run = @mysqli_query($link, $query);
            $count = 1;
            while ($useridrow = @mysqli_fetch_assoc($query_run)) {
             
            $bookname = $useridrow['BOOK_NAME'];
            $user = $useridrow['INDIVIDUAL'];
            $idnumber = $useridrow['MATRIC_NUMBER'];
            $phone = $useridrow['PHONE_NUMBER']; 
            $status = $useridrow['STATUS'];
            $collectiondate = $useridrow['COLLECTION_DATE']; 
            $returneddate = $useridrow['RETURNED_DATE'];        
            
          echo '<tr class="gradeX">
                  <td>'.$count.'</td>
                  <td>'.$bookname.'</td>
                  <td>'.$user.'</td>
                  <td>'.$idnumber.'</td>
                  <td>'.$phone.'</td>
                  <td>'.$status.'</td>
                  <td>'.$collectiondate.'</td>
                  <td>';
                  if ($returneddate == "0000-00-00 00:00:00") { echo "<p class=\"text text-info\">PENDING</p>"; } else { echo $returneddate;}
                  echo '</td>
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
      </div>
    </div>
  </div>
</div>
<!--Footer-part-->


<?php include_once("setup/footer.php");?>   