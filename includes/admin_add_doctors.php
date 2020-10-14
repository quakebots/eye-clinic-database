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

	$branch = mysqli_query($con, "SELECT `branch_id`, `branch_name`, `description` FROM `branch`");


	if(isset($_POST['add_doc'])){
		$doc_uid = sanitize($con, $_POST['doc_uid']);
		$branch_id = sanitize($con, $_POST['branch_id']);
		$doc_fname = sanitize($con, $_POST['doc_fname']);
		$doc_oname = sanitize($con, $_POST['doc_oname']);
		$doc_name = $doc_fname.' '.$doc_oname;
		// $clinic_name = $_POST['clinic_name'];
		$email_id = sanitize($con, $_POST['email_id']);
		$phone = sanitize($con, $_POST['phone']);
		$login_id = sanitize($con, $_POST['login_id']);
		$password = md5('password');

		$branch1 = mysqli_query($con, "SELECT `branch_id`, `branch_name`, `description` FROM `branch` WHERE `branch_id`=$branch_id");
		while ($br = mysqli_fetch_assoc($branch1)) {
			$clinic_name = $br['branch_name'];
			// die($b_name);
		}

		$seldoc = mysqli_query($con, "SELECT `doc_id`, `doc_uid`, `branch_id`, `doc_name`, `clinic_name`, `email_id`, `phone`, `login_id`, `password`, `created_at`, `last_login`, `last_updated` FROM `doctor` WHERE `doc_uid`= '$doc_uid'");
		$num = mysqli_num_rows($seldoc);
		if($num < 1){
			$docs = mysqli_query($con, "INSERT INTO `doctor`(`doc_uid`, `branch_id`, `doc_name`, `clinic_name`, `email_id`, `phone`, `login_id`, `password`) VALUES ('$doc_uid','$branch_id','$doc_name','$clinic_name','$email_id','$phone','$login_id','$password')");
			if($docs){
				echo '<script>alert("Doctor Information Saved Successfully");</script>';
		  	echo '<script>window.location = "adminview.php?v=doctors";</script>';
			}else{
				$err =  'Save Error: '. mysql_error($con);
			}
		}else{
			echo '<script>alert("Student doctor with Staff ID '.$doc_uid.' already exists");</script>';
		}

		
	}

?>


<form method="post" id="update_patient" onsubmit="return validation()">

			      <div style="display:block;text-align:center;">
			        <img src="images/ucc1.png" width="100" style=""><br>
			        UNIVERSITY OF CAPE COAST<br>
			        <strong>DEPARTMENT OF OPTOMETRY AND VISION SCIENCE</strong><br><br>
			        <h2>FILL DOCTOR INFORMATION</h2>
			      </div>


			      <div style="display:block;text-align:left;margin:10px 0px;">
			        <label for="doc_uid">Student Doctor ID&nbsp;</label><br><br>
			        <input style="border-radius:5px;" type="text" id="admin_uid" name="admin_uid" required name="admin_uid "size="25" value="" pattern="[M]{1}[S]{1}[/]{1}[O]{1}[P]{1}[T]{1}[/]{1}[0-9]{2}[/]{1}[0-9]{4}" placeholder="MS/OPT/17/0010" autofocus=""><br>

<span id="CAPS" class="help"><i style="color:green;text-align:center;float:center;font-size:0.9em;">Case Sensitive : TURN CAPS LOCK ON</i></span>
			      </div>

			      <div style="display:block;text-align:left;margin:10px 0px;">
			        <label for="doc_fname">Doctor's First and Last Names&nbsp;</label><br>
			        <input style="border-radius:5px;" type="text" id="doc_fname" name="doc_fname" size="40" value="" aria-describedby="name-format" required aria-required=”true” pattern="[A-Za-z]+\s[A-Za-z]+" placeholder="eg:  Stephen Adomako"><br>
			         <span id="name-format" class="help"><i style="color:green;text-align:center;float:center;font-size:0.9em;">Format: firstname lastname</i></span>
			      </div>

			      <div style="display:block;text-align:left;margin:10px 0px;">
			        <label for="doc_oname">Doctor Other Name(s)&nbsp;</label><br>
			        <input style="border-radius:5px;" type="text" id="doc_oname" pattern="[A-Za-z]+" size="25" value="" placeholder="eg. Kofi" >
			      </div>

			      <div style="display:block;text-align:left;margin:10px 0px; ">
			        <label for="email_id">Email&nbsp;</label><br>
			        <input style="border-radius:5px;" type="email" id="email_id" required name="email_id" size="25" value="<?php if(isset($_POST['email_id'])){echo $_POST['email_id'];}else{echo "";} ?>" placeholder="eg. ellaboahen@gmail.com">
			      </div>

			      <div style="display:block;text-align:left;margin:10px 0px;">
			        <label for="phone">Phone Number&nbsp;</label><br>
			         <input type="tel" id="phone" name="phone" size="40"
       pattern="[0]{1}[0-9]{2}[0-9]{3}[0-9]{4}"
       required placeholder="0557892953"><br>

<span class="note">Format: 0234567890</span>
			      </div>

			      <div style="display:block;text-align:left;margin:10px 0px;">
			        <label for="phone">Branch&nbsp;</label><br>
			        <select name="branch_id" style="border-radius:5px;" required>
			        	<option value="" selected disabled>Select Branch</option>
			        	<?php
			        		while($fet = mysqli_fetch_assoc($branch)){
										$branch_id = $fet['branch_id'];
			        			$branch_name = ucfirst($fet['branch_name']);
			        			if($_POST['branch_id'] == $branch_id){
			        				$sell = 'selected';
			        			}else{
			        				$sell = '';
			        			}

			        			echo '<option value="'.$branch_id.'" '.$sell.'>'.$branch_name.'</option>';
			        		}
			        	?>
			        </select>
			      </div>

			      <div style="display:block;text-align:left;margin:10px 0px;">
			        <label for="login_id">Login ID&nbsp;</label><br>
			        <input style="border-radius:5px;" type="text" id="login_id" required name="login_id" size="30" value="<?php if(isset($_POST['login_id'])){echo $_POST['login_id'];}else{echo "";} ?>" placeholder="eg. ellaboahen">
			      </div>

			      <div style="display:block;text-align:left;margin:10px 0px;">
			        <button type="submit" name="add_doc" style="background-color:#28a745!important;color:#e5e5e5;border:#e0e0e0 1px solid;border-radius:10px;margin-top:20px;display:inline-block;margin-left:200px;margin-right:auto;font-weight:bold;font-size:2em;" title="save doctor information">&deg;Save Information&deg;</button>
			        <input type="reset" value="Clear" name="clear" style="color:#000000;border:#000000 1px solid;border-radius:5px;display:inline-block;margin-left:200px;margin-right:auto;font-weight:bold;font-size:1.0em;float:right;" title="Reset form">
			      </div>
			    </form>