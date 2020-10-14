<?php
	if(!isset($_SESSION["admin_id"])){
  header('Location: doclogin.php');
	}else{
		if(isset($_SESSION['sadmin_id'])){
			$sadmin_id = $_SESSION['sadmin_id'];
		}
	  $admin_id = $_SESSION["admin_id"];
	}

	if(isset($_SESSION['sadmin_id'])){
		$admin = $_SESSION['sadmin_id'];
	}
	if(isset($_SESSION['admin_id'])){
		$admin = $_SESSION['admin_id'];
	}

	function getAge($dob,$condate){ 
    $birthdate = new DateTime(date("Y-m-d",  strtotime(implode('-', array_reverse(explode('/', $dob))))));
    $today= new DateTime(date("Y-m-d",  strtotime(implode('-', array_reverse(explode('/', $condate))))));           
    $age = $birthdate->diff($today)->y;
    return $age;

}
	
	$run0 = mysqli_query($con, "SELECT `pat_id`, `pat_uid`, `admin_id`, `pat_name`, `gender`, `dob`, `age`, `address`, `homet`, `contact`, `occ`, `opdn`, `pecn`, `done`, `created_at`, `last_updated` FROM `patient` ORDER BY `pat_id` DESC LIMIT 1");
  while($fff = mysqli_fetch_assoc($run0)){
  	$id = $fff['pat_id'];
  }
  $n = $id + 1;
  $d = date('d');
  $m = date('m');
  $y = date('Y');
  $new_pecn = $n.$m.$y;
  $now = date('d-m-Y');
  $lyear = date('Y') - 1;
  // $dob = '1995-07-20';

  // echo 'age is '.getAge($dob,$now);

if(isset($_POST['add_pat'])){
  $opdn = $_POST['sopdn'];
  $pecn = $_POST['pecn'];
  $pat_uid = $_POST['ssid'];
  $pat_fname = $_POST['pat_fname'];
  $pat_oname = $_POST['pat_oname'];
  $pat_name =  $pat_fname.' '.$pat_oname;
  $gender = $_POST['sex'];
  $dob = $_POST['xTime'];
  $age = $_POST['age'];
  $address = $_POST['address'];
  $homet = $_POST['homet'];
  $phone = $_POST['phone'];
  $occ = $_POST['occ'];
  if(empty($pat_uid)){
  	$pat_uid1 = 'N/A';
  }else{
  	$pat_uid1 = $pat_uid;
  }
  $run = mysqli_query($con, "SELECT `pat_id`, `pat_uid`, `admin_id`, `pat_name`, `gender`, `dob`, `age`, `address`, `homet`, `contact`, `occ`, `opdn`, `pecn`, `done`, `created_at`, `last_updated` FROM `patient` WHERE `pecn`=$pecn");
  $num_rows = mysqli_num_rows($run);
  if($num_rows > 0){
		echo '<script>alert("Patient with Eye Clinic Number '.$pecn.' already exists");</script>';
  }else{
  	$ins = mysqli_query($con, "INSERT INTO `patient`(`pat_uid`, `admin_id`, `pat_name`, `gender`, `dob`, `age`, `address`, `homet`, `contact`, `occ`, `opdn`, `pecn`, `done`) VALUES ('$pat_uid1','$admin','$pat_name','$gender','$dob','$age','$address','$homet','$phone','$occ','$opdn','$pecn',0)");
  	if($ins){
  		echo '<script>alert("Patient Information Saved Successfully");</script>';
	  	echo '<script>window.location = "adminview.php?v=patients";</script>';
  	}else{
  		$err =  'Save Error: '. mysql_error($con);
  	}
  }
  // $sql = mysqli_query($con, "UPDATE `patient` SET `pat_name`='$pat_name',`gender`='$gender',`dob`='$dob',`address`='$address',`homet`='$homet',`contact`='$phone',`occ`='$occ' WHERE `pat_id`=$id");
  // if($sql){
  // 	echo '<script>alert("Patient Information Updated Successfully");</script>';
  // 	echo '<script>window.location = "adminviewall.php?v=patient&id='.$id.'#content";</script>';
  // 	// header('Location: adminviewall.php?v=patient&id='.$id.'#content');
  // }else{
  //   $err =  'Update Error: '. mysql_error($con);
  // }
}
?>

<script type="text/javascript">
	function validation(){
		if(document.getElementById('xtim').value == ""){
			alert('Date of birth not set');
			document.getElementById('xtim').focus();
			return false;
		}
	}
</script>


					<?php if(isset($err)){echo $err;} ?>
					
					<form method="post" id="update_patient" onsubmit="return validation()">
						<div style="display:block;">
			        <div style="display:inline-block;float:left;">
			          Patient OPD Number<br><input style="border-radius:5px;" id="opdn" type="text" name="sopdn" value="<?php if(isset($_POST['opdn'])){echo $_POST['opdn'];}else{echo mt_rand();}?>" placeholder="opdn" readonly>
			        </div>

			        <div style="display:inline-block;float:right;">
			          Patient Eye Clinic Number<br><input style="border-radius:5px;" id="pecn" type="text" required name="pecn" value="<?php if(isset($_POST['pecn'])){echo $_POST['pecn'];}else{echo $new_pecn;}?>" placeholder="Patien Eye Clinic Number" readonly>
			        </div>
			      </div>

			      <div style="display:block;text-align:center;">
			        <img src="images/ucc1.png" width="100" style=""><br>
			        UNIVERSITY OF CAPE COAST<br>
			        <strong>DEPARTMENT OF OBTOMETRY AND VISION SCIENCE</strong><br><br>
			        <h2>FILL PATIENT INFORMATION</h2>
			      </div>
				    
			      <div style="display:block;text-align:left;margin:10px 0px;">
			        <label for="fdoa">First Date of Attendance</label>
			        <input style="border-radius:5px;" type="text" id="fdoa" required name="fdoa" size="76" value="<?=date('d-m-Y H:i:s');?>" disabled>
			        <br><i style="color:red;text-align:center;float:center;font-size:0.9em;">Asigned automatically (The system will assign the current DATETIME value at the time the form is submited) </i>
			      </div>


			      <div style="display:block;text-align:left;margin:10px 0px;">
			        <label for="pat_fname">Patient's First and Last Name&nbsp;</label><br>
			        <!--input style="border-radius:5px;" type="text" id="pat_fname" pattern=".{6,}" required name="pat_fname" size="85" value="" placeholder="eg. Emmanuella" autofocus-->


			        <input style="border-radius:5px;" type="text" id="pat_fname" name="pat_fname" size="60" value="" aria-describedby="name-format" required aria-required=”true” pattern="[A-Za-z]+\s[A-Za-z]+"><br>
			         <span id="name-format" class="help"><i style="color:green;text-align:center;float:center;font-size:0.9em;">Format: firstname lastname</i></span>
			      </div>

			      <div style="display:block;text-align:left;margin:10px 0px;">
			        <label for="pat_oname">Patient Other Name(s)&nbsp;</label><br>
			        <input style="border-radius:5px;" type="text" id="pat_oname" pattern="[A-Za-z]+" size="45" value="" placeholder="eg. Kofi" >
			      </div>

			      <div style="display:block;text-align:left;margin:10px 0px;">
			        <label for="">Sex:&nbsp;</label>
			        <div style="display:inline-block;margin-left:40px;">
			          <label for="msex">Male</label>
			          <input style="border-radius:5px;" type="radio" id="msex" required name="sex" value="Male">
			          <label for="fsex">Female</label>
			          <input style="border-radius:5px;" type="radio" id="fsex" required name="sex" value="Female">
			        </div>
			      </div>

			      <div style="display:block;text-align:left;margin:10px 0px;">
							<label for="dob">Date of Birth&nbsp;</label><br>
				      <span style="position: relative;display: inline-block;border: 1px solid #a9a9a9;border-radius:5px;height: 24px;width: 160px">
							    <input id="xtim" type="date" class="xDateContainer" max="<?=$lyear.'-'.$m.'-'.$d;?>" onchange="setCorrect(this,'xTime');" style="position: absolute; opacity: 0.0;height: 100%;width: 100%;">
							    <input type="text" id="xTime" name="xTime" value="yyyy - mm - dd" style="border: none;height: 90%;" tabindex="-1" required>
							</span>
						</div>

			      <div style="display:block;text-align:left;margin:10px 0px;">
			        <label for="age">Age&nbsp;</label><br>
			        <input style="border-radius:5px;" type="number" id="age" required name="age" size="25" value="" placeholder="eg. 21" min="1" max="120" readonly> <i style="color:red;">Age will be calculated automatically based on the DOB selected</i>
			      </div>

			      <div style="display:block;text-align:left;margin:10px 0px;">
			        <label for="address">Address&nbsp;</label><br>
			        <textarea style="border-radius:5px;" id="address" required name="address" cols="45" value="" placeholder="eg. Royal Palace Hostel, UCC"></textarea>
			      </div>

			      <div style="display:block;text-align:left;margin:10px 0px;">
			        <label for="homet">Home Town&nbsp;</label><br>
			        <input style="border-radius:5px;" type="text" id="homet" required name="homet" size="45" value="" placeholder="eg. Awuoshi">
			      </div>

			      <div style="display:block;text-align:left;margin:10px 0px;">
			        <label for="phone">Phone Number&nbsp;</label><br>
			        <!--input style="border-radius:5px;" type="tel" id="phone" required name="phone" size="83" minlength="10" maxlength="13" value="" placeholder="eg. 0558058058"-->

			        <input type="tel" id="phone" name="phone" size="40"
       pattern="[0]{1}[0-9]{2}[0-9]{3}[0-9]{4}"
       required>

<span class="note">Format: 0234567890</span>
			      </div>

			      <div style="display:block;text-align:left;margin:10px 0px;">
			        <label for="occ">Occupation&nbsp;</label><br>
			        <input style="border-radius:5px;" type="text" id="occ" required name="occ" size="40" value="" placeholder="eg. student">
			      </div>

			      <div id="is_pat" style="display:block;text-align:left;margin:10px 0px;">
			      	<small><button type="button" style="background-color:#2845a7!important;color:#e5e5e5;border:#e0e0e0 1px solid;border-radius:5px;" id="ispat_btn" onclick="return is_pat()">student Patient</button></small><span id="ispat_btn_info"><i style="color:red;">If patient is a staff/student with a valid ID card, click this button</i></span>

			      	<small><button type="button" style="display:none;background-color:#2845a7!important;color:#e5e5e5;border:#e0e0e0 1px solid;border-radius:5px;" id="ispat_btn1" onclick="return is_pat()">Not student Patient</button></small>
			      	<span id="ispat_btn1_info"><i style="color:red;display:none;">If patient is <b>NOT</b> a staff/student with a valid ID card, click this button</i></span>
			      </div>

			      <div id="mssid" style="display:none;text-align:left;margin:10px 0px;">
			        <label for="ssid">Staff/ Student ID No&nbsp;</label><br>
			        <input style="border-radius:5px;" type="text" id="ssid" name="ssid" size="77" value="" placeholder="eg. AH/OPT/17/0026" autofocus>
			      </div>

			      <div style="display:block;text-align:left;margin:10px 0px;">
			        <button type="submit" name="add_pat" style="background-color:#28a745!important;color:#e5e5e5;border:#e0e0e0 1px solid;border-radius:10px;margin-top:20px;display:inline-block;margin-left:200px;margin-right:auto;font-weight:bold;font-size:2em;" title="update patient information">&deg;Save Information&deg;</button>
			      </div>
			    </form>

			    