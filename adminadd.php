<?php  
include("includes/header.php");

if(!isset($_SESSION["admin_id"]) ){
  header('Location: doclogin.php');
}else{
	if(isset($_SESSION['sadmin_id'])){
		$sadmin_id = $_SESSION['sadmin_id'];
	}
  
  $admin_id = $_SESSION["admin_id"];
}
?>


<div id="templatemo_main">
		<div id="sidebar" class="float_l">
    <div class="sidebar_box"><span class="bottom"></span>				
			<?php  
				include("sidebar.php");
				adminhome();
				if(basename($_SERVER['PHP_SELF']) == 'adminadd.php'){
					adminview();
				}
			?>
    </div>
		</div>
		<div id="content" class="float_r" style="padding:10px;">
			<?php
				if(isset($_GET['v'])){
					$v = $_GET['v'];
					if($v == 'patient'){
						include 'includes/admin_add_patients.php';
					}else if($v == 'doctor'){
						include 'includes/admin_add_doctors.php';
					}else if($v == 'supervisor'){
						include 'includes/admin_add_supervisors.php';
					}else if($v == 'product'){
						include 'includes/admin_add_products.php';
					}else if($v == 'branch'){
						include 'includes/admin_add_branches.php';
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