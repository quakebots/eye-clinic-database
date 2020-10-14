<?php 
include("includes/header.php");
if(!isset($_SESSION['doc_id'])){
  header('Location: doclogin.php');
}else{
	$doc_id = $_SESSION['doc_id'];
}

if(isset($_POST["changepass"])){
	$pass = md5($_POST['nwpswrd']);
	$run = mysqli_query($con,"UPDATE `doctor` SET `password`='$pass' WHERE `doc_id`=$doc_id");
	if($run){
		$msgpass="<b><font color='#009900'>Password Changed successfully</font></b>";
		header('Location: logout.php');
	}else{
		$msgpass ="<b><font color='#FF0000'>Failed to update: ".mysqli_error($con)."</font></b>";
	}
}

?>
<div id="templatemo_main">
  <div id="sidebar" class="float_l">
    <div class="sidebar_box"><span class="bottom"></span>
      <?php  
		    include("sidebar.php");

				if($_SESSION["logtype"]=='Administrator'){
					adminhome();
				}else if($_SESSION["logtype"]=='Patient'){
					patienthome();
				}else if($_SESSION["logtype"]=='Doctor'){
					doctorhome();
				}
			?>
    </div>
  </div>
  <div id="content" class="float_r">
    <h2>Change  Account Password</h2>
    <script type="application/javascript" >
			function validation(){
				if(document.form1.nwpswrd.value.length<8 || document.form1.nwpswrd.value.length>15 ){
					alert("Minimum charaters for password is 8 and maximum character is 15");
					document.form1.nwpswrd.focus();
					return false;
				}
				if(document.form1.nwpswrd.value != document.form1.cpswrd.value){
					alert("Passwords do not match...");
					return false;
				}
			}
		</script>
        
    <form style="padding:20px;border:1px solid #e5e5e5;border-radius:10px;background:#ffffff;margin-left:100px;margin-right:auto;display:inline-block;align-self:center;align-items:center;" id="form1" name="form1" method="post" action="" onSubmit="return validation()">
    	<div>
    		<?php if(isset($msgpass)){echo $msgpass;} ?>
    	</div>

    	<div style="margin-left:auto;margin-right:auto;display:block;margin:20px 50px;">
    		<input class="right" size="50" type="password" name="nwpswrd" id="nwpswrd" placeholder="Enter New Password" style="border-radius:5px;" required autofocus>
    	</div>

    	<div style="margin-left:auto;margin-right:auto;display:block;margin:20px 50px;">
    		<input class="right" size="50" type="password" name="cpswrd" id="cpswrd" placeholder="Enter New Password" style="border-radius:5px;" required>
    	</div>
    	<div>
    		<button type="submit" name="changepass" style="background-color:#28a745!important;color:#e5e5e5;border:#e0e0e0 1px solid;border-radius:10px;padding:5px 0px;margin-top:20px;display:inline-block;margin-left:150px;margin-right:auto;font-weight:bold;font-size:2em;">
    			&uarr; Update &uarr;
    		</button>
    	</div>
		</form>
    <h1>&nbsp;</h1>
	</div>
  <div class="cleaner"></div>
</div>
<?php  
	include("includes/footer.php");
?>