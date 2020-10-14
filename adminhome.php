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

  $patients = mysqli_num_rows(mysqli_query($con, "SELECT `pat_id`, `pat_uid`, `admin_id`, `pat_name`, `gender`, `dob`, `age`, `address`, `homet`, `contact`, `occ`, `opdn`, `pecn`, `done`, `created_at`, `last_updated` FROM `patient`"));

  $doctors = mysqli_num_rows(mysqli_query($con, "SELECT `doc_id`, `doc_uid`, `branch_id`, `doc_name`, `clinic_name`, `email_id`, `phone`, `login_id`, `password`, `created_at`, `last_login`, `last_updated` FROM `doctor`"));

  $supervisors = mysqli_num_rows(mysqli_query($con, "SELECT * FROM `admin` WHERE `admin_id`!=1"));

  $products = mysqli_num_rows(mysqli_query($con, "SELECT `prod_id`, `branch_id`, `name`, `product_type`, `sub_type`, `image`, `color`, `cost`, `quantity`, `descr`, `date_added`, `last_updated` FROM `products`"));

  $submitted = mysqli_num_rows(mysqli_query($con, "SELECT `pat_id`, `pat_uid`, `admin_id`, `pat_name`, `gender`, `dob`, `age`, `address`, `homet`, `contact`, `occ`, `opdn`, `pecn`, `done`, `created_at`, `last_updated` FROM `patient` WHERE `done`=1"));

  $branches = mysqli_num_rows(mysqli_query($con, "SELECT `branch_id`, `branch_name`, `description` FROM `branch`"));


  if(isset($_GET['prodid'])){
    $dt= date("Y-m-d");
    mysqli_query($con,"UPDATE orders SET dispatch_date='$dt',payment='$_GET[balamt]', status='Delivered' where order_id='$_GET[prodid]'");
    $resrec = "Order status updated successfully...<br>";
    $resrec = $resrec.  " <a href='billingreport.php?prodid=$_GET[prodid]&balamt=$_GET[balamt]&advpaid=$_GET[advpaid]' target='_blank'>Print billing report</a>";
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
        <div style="display:block;padding:20px;">
          <a href="adminview.php?v=patients" title="View Patients">
            <div style="display:inline-block;width:125px;height:125px;padding:20px;margin:50px 20px;border:1px solid #ffffff;border-radius:50%;text-align:center;padding-top:30px;font-family:Comic Sans MS;color:#05e5e5;font-size:3em;background:#222222;">
              <?=$patients;?><br><br><br><i style="font-size:0.5em;">Patients</i>
            </div>
          </a>

          <a href="adminview.php?v=doctors" title="View Doctors">
            <div style="display:inline-block;width:125px;height:125px;padding:20px;margin:50px 20px;border:1px solid #ffffff;border-radius:50%;text-align:center;padding-top:30px;font-family:Comic Sans MS;color:#05e5e5;font-size:3em;background:#222222;">
              <?=$doctors;?><br><br><br><i style="font-size:0.5em;">Doctors</i>
            </div>
          </a>

          <a href="adminview.php?v=supervisors" title="View Supervisors">
            <div style="display:inline-block;width:125px;height:125px;padding:20px;margin:50px 20px;border:1px solid #ffffff;border-radius:50%;text-align:center;padding-top:30px;font-family:Comic Sans MS;color:#05e5e5;font-size:3em;background:#222222;">
              <?=$supervisors;?><br><br><br><i style="font-size:0.5em;">Supervisors</i>
            </div>
          </a>

          <a href="adminview.php?v=products" title="View Products">
            <div style="display:inline-block;width:125px;height:125px;padding:20px;margin:50px 20px;border:1px solid #ffffff;border-radius:50%;text-align:center;padding-top:30px;font-family:Comic Sans MS;color:#05e5e5;font-size:3em;background:#222222;">
              <?=$products;?><br><br><br><i style="font-size:0.5em;">Products</i>
            </div>
          </a>

          <a href="adminview.php?v=submitted" title="View Submitted Patient Records">
            <div style="display:inline-block;width:125px;height:125px;padding:20px;margin:50px 20px;border:1px solid #ffffff;border-radius:50%;text-align:center;padding-top:30px;font-family:Comic Sans MS;color:#05e5e5;font-size:3em;background:#222222;">
              <?=$submitted;?><br><br><br><i style="font-size:0.5em;">Submitted</i>
            </div>
          </a> 

          <a href="adminview.php?v=branches" title="View Branches">
            <div style="display:inline-block;width:125px;height:125px;padding:20px;margin:50px 20px;border:1px solid #ffffff;border-radius:50%;text-align:center;padding-top:30px;font-family:Comic Sans MS;color:#05e5e5;font-size:3em;background:#222222;">
              <?=$branches;?><br><br><br><i style="font-size:0.5em;">Branches</i>
            </div>
          </a>
        </div>
    </div>
  </div>
  <div class="cleaner"></div> 
<?php  
  include("includes/footer.php");
?>