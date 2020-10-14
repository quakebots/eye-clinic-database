<?php
	require 'includes/header.php';
	if(!isset($_GET['v']) || !isset($_GET['id']) || empty($_GET['v']) || empty($_GET['id'])){
		echo '<script>window.location = "adminhome.php";</script>';
	}else{
		 $v = $_GET['v'];
		 $id = $_GET['id'];
	}
?>

<div id="templatemo_main">
	<div id="sidebar" class="float_l">
	  <div class="sidebar_box"><span class="bottom"></span>				
			<?php  
				include("sidebar.php");
				adminhome();
			?>
	  </div>
	</div>
	<div id="content" class="faq float_r">
		<?php
			if($v =='patient'){
				include('includes/viewpat1.php');
			}
			if($v == 'doctor'){
				include('includes/viewdoc1.php');
			}
			if($v == 'supervisor'){
				include('includes/viewsup1.php');
			}
			if($v == 'product'){
				// echo $proid = $id;
				include('includes/viewprod1.php');
			}
			if($v == 'submitted'){
				// echo $proid = $id;
				include('includes/viewsub1.php');
			}
			if($v == 'branch'){
				echo $branch_id = $id;
			}
		?>
	</div> 
	<div class="cleaner"></div> 
	<?php  
	  include("includes/footer.php");
	?>