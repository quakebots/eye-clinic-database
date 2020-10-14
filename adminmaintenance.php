<?php 
  include("includes/header.php");

  if(!isset($_SESSION["admin_id"])){
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
			?>
    </div>
	</div>
  <div id="content" class="float_r" style="padding:10px;">
  	<div style="display:inline-block;background:#999999;color:white;border-radius:10px;width:25%;margin-right:50px;">
  		<div style="display:block;background:#000000;padding:10px;">PATIENTS</div>
  		<div>
  			<a href="adminadd.php?v=patient" style="margin:10px 0px;"><button style="border-radius:7px;padding:5px;display:block;font-weight:bold;border-bottom:white 1px solid;width:100%;">Add</button></a>
  			<a href="adminview.php?v=patients" style="margin:10px 0px;"><button style="border-radius:7px;padding:5px;display:block;background:#f7bb00;font-weight:bold;border-bottom:white 1px solid;width:100%;">View</button></a>
  			<a href="adminview.php?v=patients" style="margin:10px 0px;"><button style="border-radius:7px;padding:5px;display:block;background:#00d3fe ;font-weight:bold;border-bottom:white 1px solid;width:100%;">Edit</button></a>
  			<a href="adminview.php?v=patients" style="margin:10px 0px;"><button style="border-radius:7px;padding:5px;display:block;background:FF5733;font-weight:bold;width:100%;">Delete</button></a>
  		</div>
  	</div>

  	<div style="display:inline-block;background:#999999;color:white;border-radius:10px;width:25%;margin-right:50px;">
  		<div style="display:block;background:#000000;padding:10px;">STUDENT DOCTORS</div>
  		<div>
  			<a href="adminadd.php?v=doctor" style="margin:10px 0px;"><button style="border-radius:7px;padding:5px;display:block;font-weight:bold;border-bottom:white 1px solid;width:100%;">Add</button></a>
  			<a href="adminview.php?v=doctors" style="margin:10px 0px;"><button style="border-radius:7px;padding:5px;display:block;background:#f7bb00;font-weight:bold;border-bottom:white 1px solid;width:100%;">View</button></a>
  			<a href="adminview.php?v=doctors" style="margin:10px 0px;"><button style="border-radius:7px;padding:5px;display:block;background:#00d3fe ;font-weight:bold;border-bottom:white 1px solid;width:100%;">Edit</button></a>
  			<a href="adminview.php?v=doctors" style="margin:10px 0px;"><button style="border-radius:7px;padding:5px;display:block;background:FF5733;font-weight:bold;width:100%;">Delete</button></a>
  		</div>
  	</div>

  	<div style="display:inline-block;background:#999999;color:white;border-radius:10px;width:25%;margin-right:50px;">
  		<div style="display:block;background:#000000;padding:10px;">SUPERVISORS/LECTURERS</div>
  		<div>
  			<a href="adminadd.php?v=supervisor" style="margin:10px 0px;"><button style="border-radius:7px;padding:5px;display:block;font-weight:bold;border-bottom:white 1px solid;width:100%;">Add</button></a>
  			<a href="adminview.php?v=supervisors" style="margin:10px 0px;"><button style="border-radius:7px;padding:5px;display:block;background:#f7bb00;font-weight:bold;border-bottom:white 1px solid;width:100%;">View</button></a>
  			<a href="adminview.php?v=supervisors" style="margin:10px 0px;"><button style="border-radius:7px;padding:5px;display:block;background:#00d3fe ;font-weight:bold;border-bottom:white 1px solid;width:100%;">Edit</button></a>
  			<a href="adminview.php?v=supervisors" style="margin:10px 0px;"><button style="border-radius:7px;padding:5px;display:block;background:FF5733;font-weight:bold;width:100%;">Delete</button></a>
  		</div>
  	</div>
  	<br><hr><br>

  	<div style="display:inline-block;background:#999999;color:white;border-radius:10px;width:25%;margin-right:50px;">
  		<div style="display:block;background:#000000;padding:10px;">PRODUCTS</div>
  		<div>
  			<a href="adminadd.php?v=product" style="margin:10px 0px;"><button style="border-radius:7px;padding:5px;display:block;font-weight:bold;border-bottom:white 1px solid;width:100%;">Add</button></a>
  			<a href="adminview.php?v=products" style="margin:10px 0px;"><button style="border-radius:7px;padding:5px;display:block;background:#f7bb00;font-weight:bold;border-bottom:white 1px solid;width:100%;">View</button></a>
  			<a href="adminview.php?v=products" style="margin:10px 0px;"><button style="border-radius:7px;padding:5px;display:block;background:#00d3fe ;font-weight:bold;border-bottom:white 1px solid;width:100%;">Edit</button></a>
  			<a href="adminview.php?v=products" style="margin:10px 0px;"><button style="border-radius:7px;padding:5px;display:block;background:FF5733;font-weight:bold;width:100%;">Delete</button></a>
  		</div>
  	</div>

  	<div style="display:inline-block;background:#999999;color:white;border-radius:10px;width:25%;margin-right:50px;">
  		<div style="display:block;background:#000000;padding:10px;">SUBMITTED RECORDS</div>
  		<div>
  			
  			<a href="adminview.php?v=submitted" style="margin:10px 0px;"><button style="border-radius:7px;padding:5px;display:block;background:#f7bb00;font-weight:bold;border-bottom:white 1px solid;width:100%;">View</button></a>
  			<a href="adminview.php?v=submitted" style="margin:10px 0px;"><button style="border-radius:7px;padding:5px;display:block;background:#00d3fe ;font-weight:bold;border-bottom:white 1px solid;width:100%;">Edit</button></a>
  			<a href="adminview.php?v=submitted" style="margin:10px 0px;"><button style="border-radius:7px;padding:5px;display:block;background:FF5733;font-weight:bold;width:100%;">Delete</button></a>
  		</div>
  	</div>

  	<div style="display:inline-block;background:#999999;color:white;border-radius:10px;width:25%;margin-right:50px;">
  		<div style="display:block;background:#000000;padding:10px;">BRANCHES</div>
  		<div>
  			<a href="adminadd.php?v=branch" style="margin:10px 0px;"><button style="border-radius:7px;padding:5px;display:block;font-weight:bold;border-bottom:white 1px solid;width:100%;">Add</button></a>
  			<a href="adminview.php?v=branches" style="margin:10px 0px;"><button style="border-radius:7px;padding:5px;display:block;background:#f7bb00;font-weight:bold;border-bottom:white 1px solid;width:100%;">View</button></a>
  			<a href="adminview.php?v=branches" style="margin:10px 0px;"><button style="border-radius:7px;padding:5px;display:block;background:#00d3fe ;font-weight:bold;border-bottom:white 1px solid;width:100%;">Edit</button></a>
  			<a href="adminview.php?v=branches" style="margin:10px 0px;"><button style="border-radius:7px;padding:5px;display:block;background:FF5733;font-weight:bold;width:100%;">Delete</button></a>
  		</div>
  	</div>

	</div>
</div>
<div class="cleaner"></div> 
<?php  
  include("includes/footer.php");
?>