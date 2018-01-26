<?php
require_once("setup/connect.php");
ob_start();
session_start();

// Login
function loggedin(){
    if (isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])){
        if(isset($_SESSION['activiteit']) && (time() - $_SESSION['activiteit'] > 24000)){
         session_unset();     
         session_destroy(); 
        return false;
        } else {
        return true;
        }
    } else {
        return false;
    }

}

// Unique ID Generation Starts
function id_generator(){
global $link;
function uniqueid(){
$timestampz=time();
function generateRandomString($length = 3) {
    $characters = '0123456789';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
$tokenparta = generateRandomString();
return $tokenparta;
}
do{
    $uniqueid_ = uniqueid();
    $query = "SELECT hosp_no FROM patient_personal_info WHERE hosp_no='$uniqueid_' ";
    $query_run = mysqli_query($link, $query);
    $numRowsCheck = mysqli_num_rows($query_run);
 } while ($numRowsCheck > 0);
 return $uniqueid_;
}

// Unique ID Generation Starts
function id_generator2(){
global $link;
function uniqueid2(){
$timestampz=time();
function generateRandomString2($length = 3) {
    $characters = '0123456789';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
$tokenparta = generateRandomString2();
return $tokenparta;
}
do{
    $uniqueid2_ = uniqueid2();
    $query = "SELECT case_ref_no FROM patient_hospital_history WHERE case_ref_no='$uniqueid2_' ";
    $query_run = mysqli_query($link, $query);
    $numRowsCheck = mysqli_num_rows($query_run);
 } while ($numRowsCheck > 0);
 return $uniqueid2_;
}


function getuserfield($field){
	global $link;
	$query = "SELECT $field FROM users WHERE id = ' ".$_SESSION['user_id']."'" ;
	if($query_run = mysqli_query($link, $query)){
	$useridrow = mysqli_fetch_assoc($query_run);
        if($userid = $useridrow[$field]){
    	return $userid;
    	}
    }
}

function getpatientfieldbyhospno($field, $hosp_no){
    global $link;
    $query = "SELECT $field FROM patient_personal_info WHERE hosp_no = '$hosp_no' " ;
    if($query_run = mysqli_query($link, $query)){
    $useridrow = mysqli_fetch_assoc($query_run);
        if($userid = $useridrow[$field]){
        return $userid;
        }
    }
}

//GET NUMBER OF ROWS AFFECTED
function getnumrows($tablename){
    global $link;
    $query = "SELECT * FROM $tablename " ;
    $query_run = mysqli_query($link, $query);
    $numrows = mysqli_num_rows($query_run);
    return $numrows;
}

//GET NUMBER OF ROWS AFFECTED GIVEN WHERE
function getnumrowswhere($tablename, $tablevalue, $inputvalue ){
    global $link;
    $query = "SELECT * FROM $tablename WHERE $tablevalue = '$inputvalue' " ;
    $query_run = mysqli_query($link, $query);
    $numrows = mysqli_num_rows($query_run);
    return $numrows;
}

function getpatientreportfield($field, $caseno){
    global $link;
    $query = "SELECT $field FROM patient_hospital_history WHERE case_ref_no='$caseno' " ;
    if($query_run = mysqli_query($link, $query)){
    $useridrow = mysqli_fetch_assoc($query_run);
        if($userid = $useridrow[$field]){
        return $userid;
        }
    }
}

function disease_rate(){
    global $link;
    $disease_ = "SELECT doctors_diagnosis, COUNT(doctors_diagnosis) AS max FROM patient_hospital_history GROUP BY doctors_diagnosis ORDER BY max DESC LIMIT 1";
    $sqlR_ = mysqli_query($link, $disease_);
    $numrows2_ = mysqli_num_rows($sqlR_);
    if ($numrows2_ >0) {
    while($uidrow = mysqli_fetch_assoc($sqlR_)){
        $maxno = $uidrow['max'];
        $maxdisease = $uidrow['doctors_diagnosis'];
        } 
    } else {
        $maxno = 0;
        $maxdisease = "Nil";
    }
    $dis_total = "SELECT doctors_diagnosis FROM patient_hospital_history";
    $qt_run = mysqli_query($link, $dis_total);
    $numrows_ = mysqli_num_rows($qt_run);
    if ($numrows_>0) { $percent = intval(($maxno/$numrows_)*100); }
    else { $percent = 0; }
    $results = array(
        'maxno' => $maxno,
        'maxdisease' => $maxdisease,
        'percent' => $percent,
        'total_d' => $numrows_
    );
    return $results;
}

?>