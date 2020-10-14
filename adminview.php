<?php  
include("includes/header.php");

	if(!isset($_SESSION["admin_id"])){
  header('Location: doclogin.php');
	}else{
		if(isset($_SESSION['sadmin_id'])){
			echo $sadmin_id = $_SESSION['sadmin_id'];
		}
	  echo $admin_id = $_SESSION["admin_id"];
	}
?>


<div id="templatemo_main">
		<div id="sidebar" class="float_l">
    <div class="sidebar_box"><span class="bottom"></span>				
			<?php  
				include("sidebar.php");
				adminhome();
				if(basename($_SERVER['PHP_SELF']) == 'adminview.php'){
					adminview();
				}
			?>
    </div>
		</div>
		<div id="content" class="float_r" style="padding:10px;">
			<?php
				if(isset($_GET['v'])){
					$v = $_GET['v'];
					if($v == 'patients'){
						include 'includes/admin_patients.php';
					}else if($v == 'doctors'){
						include 'includes/admin_doctors.php';
					}else if($v == 'supervisors'){
						include 'includes/admin_supervisors.php';
					}else if($v == 'products'){
						include 'includes/admin_products.php';
					}else if($v == 'submitted'){
						include 'includes/admin_submitted.php';
					}else if($v == 'branches'){
						include 'includes/admin_branches.php';
					}else{
						echo'<script>window.location = "adminhome.php";</script>';
					}
				}else{
					include 'includes/admin_admins.php';
				}
			?>
		</div>
</div>
<div class="cleaner"></div> 
<?php  
  include("includes/footer.php");
?>