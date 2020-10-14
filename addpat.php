<?php
	$con=mysqli_connect("localhost","root","","onlineeyeclinic");
 if(!$con){
	 die('Error: '.mysqli_error($con));
 }
 	$pat_id = $_GET['pat'];
	$opdn = $_GET['opdn'];
  $pecn = $_GET['pecn'];
  $pat_name = $_GET['pat_name'];
  $sex = $_GET['sex'];
  $dob = $_GET['dob'];
  $age = $_GET['age'];
  $address = $_GET['address'];
  $homet = $_GET['homet'];
  $phone = $_GET['phone'];
  $occ = $_GET['occ'];
  $ssid = $_GET['ssid'];
  $doc_id = $_GET['id'];
  $update = mysqli_query($con, "UPDATE `patient` SET `done`=1 WHERE `pat_id`=$pat_id");
  if($update){
  	$run=mysqli_query($con,"INSERT INTO `patient`(`pat_uid`, `admin_id`, `pat_name`, `gender`, `dob`, `age`, `address`, `homet`, `contact`, `occ`, `opdn`, `pecn`, `done`) VALUES ('$ssid',$doc_id,'$pat_name','$sex','$dob',$age,'$address','$homet','$phone','$occ','$opdn','$pecn',0)");

	  if ($run){
	    header('Location: patientrecords.php');
	    // $rcsucc = "<i style='color:green;'>Patient record inserted successfully..</i>";
	  }else{
	    die('Save Error: '.mysql_error($con).'\nTry again');
	  } 
  }else{
  	die('Update Error: '.mysql_error($con).'\nTry again');
  }
  
?>