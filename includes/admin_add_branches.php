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


	if(isset($_POST['add_branch'])){
		$branch_name = sanitize($con, $_POST['branch_name']);
		$description = sanitize($con, $_POST['description']);

		$selbr = mysqli_query($con, "SELECT `branch_id`, `branch_name`, `description` FROM `branch` WHERE `branch_name`= '$branch_name'");
		$num = mysqli_num_rows($selbr);
		if($num < 1){
			$bra = mysqli_query($con, "INSERT INTO `branch`(`branch_name`, `description`) VALUES ('$branch_name','$description')");
			if($bra){
				echo '<script>alert("Branch Information Saved Successfully");</script>';
		  	echo '<script>window.location = "adminview.php?v=branches";</script>';
			}else{
				$err =  'Save Error: '. mysql_error($con);
			}
		}else{
			echo '<script>alert("Branh with name '.$branch_name.' already exists");</script>';
		}

		
	}

?>


<form method="post" id="update_patient" onsubmit="return validation()">

			      <div style="display:block;text-align:center;">
			        <img src="images/ucc1.png" width="100" style=""><br>
			        UNIVERSITY OF CAPE COAST<br>
			        <strong>DEPARTMENT OF OBTOMETRY AND VISION SCIENCE</strong><br><br>
			        <h2>FILL BRANCH INFORMATION</h2>
			      </div>


			      <div style="display:block;text-align:left;margin:10px 0px;">
			        <label for="branch_name">Branch Name&nbsp;</label>
			        <input style="border-radius:5px;" type="text" id="branch_name" required name="branch_name" size="80" value="<?php if(isset($_POST['branch_name'])){echo $_POST['branch_name'];}else{echo "";} ?>" placeholder="eg. ucc branch" autofocus>
			      </div>

			      <div style="display:block;text-align:left;margin:10px 0px;">
			        <label for="description">Branch Description&nbsp;</label>
			        <textarea style="border-radius:5px;" id="description" required name="description" cols="65" rows="3" placeholder="eg. Main branch" >
			        	<?php if(isset($_POST['description'])){echo $_POST['description'];}else{echo "";} ?>
			        </textarea>
			      </div>

			      <div style="display:block;text-align:left;margin:10px 0px;">
			        <button type="submit" name="add_branch" style="background-color:#28a745!important;color:#e5e5e5;border:#e0e0e0 1px solid;border-radius:10px;margin-top:20px;display:inline-block;margin-left:200px;margin-right:auto;font-weight:bold;font-size:2em;" title="save branch information">&deg;Save Information&deg;</button>
			        <input type="reset" value="Clear" name="clear" style="color:#000000;border:#000000 1px solid;border-radius:5px;display:inline-block;margin-left:200px;margin-right:auto;font-weight:bold;font-size:1.0em;float:right;" title="Reset form">
			      </div>
			    </form>