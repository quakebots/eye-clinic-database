<?php  
// session_start();
include("includes/header.php");
if(isset($_SESSION['admin_id'])){
  echo '<script>window.location = "adminadd.php?v=patient";</script>';
}else{
  if(!isset($_SESSION['doc_id'])){
    header('Location: doclogin.php');
  }else{
    $doc_id = $_SESSION['doc_id'];
  }
}

$run0 = mysqli_query($con, "SELECT `pat_id`, `pat_uid`, `admin_id`, `pat_name`, `gender`, `dob`, `age`, `address`, `homet`, `contact`, `occ`, `opdn`, `pecn`, `done`, `created_at`, `last_updated` FROM `patient`");
  $num_rows = mysqli_num_rows($run0);
  $n = $num_rows + 1;
  $d = date('d');
  $m = date('m');
  $y = date('Y');
  $new_pecn = $n.$m.$y;
  $now = date('d-m-Y');
  $lyear = date('Y') - 1;

include("sidebar.php");
 
if(isset($_POST['submit'])){
  $opdn = strtolower(sanitize($con, $_POST['opdn']));
  $pecn = strtolower(sanitize($con, $_POST['pecn']));
  $sname = strtolower(sanitize($con, $_POST['sname']));
  $oth_name = strtolower(sanitize($con, $_POST['oth_name']));
  $pat_name = $oth_name.' '.$sname;
  $sex = strtolower(sanitize($con, $_POST['sex']));
  $dob = strtolower(sanitize($con, $_POST['xTime']));
  $age = strtolower(sanitize($con, $_POST['age']));
  $address = strtolower(sanitize($con, $_POST['address']));
  $homet = strtolower(sanitize($con, $_POST['homet']));
  $phone = strtolower(sanitize($con, $_POST['phone']));
  $occ = strtolower(sanitize($con, $_POST['occ']));
  $ssid = strtolower(sanitize($con, $_POST['ssid']));

  $check = mysqli_query($con, "SELECT `pat_id`, `pat_uid`, `admin_id`, `pat_name`, `gender`, `dob`, `age`, `address`, `homet`, `contact`, `occ`, `opdn`, `pecn`, `done`, `created_at`, `last_updated` FROM `patient` WHERE `pat_uid`='$ssid' AND `pat_name`='$pat_name' AND `dob`='$dob' AND `contact`='$phone' AND `done`=0");
  $num_rows = mysqli_num_rows($check);
  if($num_rows > 0){
    while($fetchin = mysqli_fetch_assoc($check)){
      $pat_id = $fetchin['pat_id'];
    }
   ?>
    <script type="text/javascript">
      var confirm = confirm('Warning!!! An incomplete file for this patient has been found.\nDo you want to Continue with adding this new file?\n(*NOTE* Choosing OK renders the old file inaccessible, otherwise, page will be redirect to patient records page). Continue?');
      if (confirm == true) {
        // alert('true');
        window.location = "addpat.php?pat=<?=$pat_id;?>&opdn=<?=$opdn;?>&pecn=<?=$pecn;?>&pat_name=<?=$pat_name;?>&sex=<?=$sex;?>&dob=<?=$dob;?>&age=<?=$age;?>&address=<?=$address;?>&homet=<?=$homet;?>&phone=<?=$phone;?>&occ=<?=$occ;?>&ssid=<?=$ssid;?>&id=<?=$doc_id;?>";
      }else{
        alert('Add Patient has been cancelled');
        window.location = "patientrecords.php";
      }
    </script>
  <?php }else{
      $run=mysqli_query($con,"INSERT INTO `patient`(`pat_uid`, `admin_id`, `pat_name`, `gender`, `dob`, `age`, `address`, `homet`, `contact`, `occ`, `opdn`, `pecn`, `done`) VALUES ('$ssid',$doc_id,'$pat_name','$sex','$dob',$age,'$address','$homet','$phone','$occ','$opdn','$pecn',0)");
      if ($run){
        echo '<script>alert("Patient Information Has Been Saved Successfully");</script>';
        echo '<script>window.location = "patientrecords.php";</script>';
        // $rcsucc = "<i style='color:green;'>Patient record inserted successfully..</i>";
      }else{
        $rcsucc = 'Save Error: '.mysql_error($con).'\nTry again';
      } 
    }
  // 
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
<div id="templatemo_main">
  <div id="sidebar" class="float_l">
    <div class="sidebar_box"><span class="bottom"></span>
        
      <?php  
        
        if($_SESSION["logtype"]=='Administrator'){
          patienthome();
        }
        else if($_SESSION["logtype"]=='Doctor'){
          patientrecords();
        }
      ?>
    </div>
  </div>
  <div id="content" class="float_r">
    <h2>Add Patient Information</h2>
    <p> <?php if(isset($rcsucc)){echo $rcsucc;}   ?></p>
          
    
    <form id="adpat" name="adpat" method="post" action="" onsubmit="return validation()">
      <div style="display:block;">
        <div style="display:inline-block;float:left;">
          Patient OPD Number<br><input style="border-radius:5px;" id="opdn" type="text" required name="opdn" value="<?php if(isset($_POST['opdn'])){echo $_POST['opdn'];}else{echo mt_rand();}?>" placeholder="opdn" readonly>
        </div>

        <div style="display:inline-block;float:right;">
          Patient Eye Clinic Number<br><input style="border-radius:5px;" id="pecn" type="text" required name="pecn" value="<?php if(isset($_POST['pecn'])){echo $_POST['pecn'];}else{echo $new_pecn;}?>" placeholder="pecn" readonly>
        </div>
      </div>

      <div style="display:block;text-align:center;">
        <img src="images/ucc1.png" width="100" style=""><br>
        UNIVERSITY OF CAPE COAST<br>
        <strong>DEPARTMENT OF OBTOMETRY</strong><br><br>
        <h2>PATIENT RECORD</h2>
      </div>

      <div style="display:block;text-align:left;margin:10px 0px;">
        <label for="fdoa">First Date of Attendance</label>
        <input style="border-radius:5px;" type="text" id="fdoa" required name="fdoa" size="85" value="<?= date('d-m-Y H:i:s');?>" disabled>
        <br><i style="color:red;text-align:center;float:center;font-size:0.9em;">Asigned automatically (The system will assign the current DATETIME value at the time the form is submited) </i>
      </div>


      <div style="display:block;text-align:left;margin:10px 0px;">
        <label for="sname">Surname&nbsp;</label>
        <input style="border-radius:5px;" type="text" id="sname" required name="sname" size="99" value="<?php if(isset($_POST['sname'])){echo $_POST['sname'];} ?>" placeholder="eg. Boahen" value="" autofocus>
      </div>

      <div style="display:block;text-align:left;margin:10px 0px;">
        <label for="oth_name">Other Name(s)&nbsp;</label>
        <input style="border-radius:5px;" type="text" id="oth_name" required name="oth_name" size="93" value="<?php if(isset($_POST['oth_name'])){echo $_POST['oth_name'];} ?>" placeholder="eg. Ella" value="">
      </div>

      <div style="display:block;text-align:left;margin:10px 0px;">
        <label for="">Sex:&nbsp;</label>
        <div style="display:inline-block;margin-left:40px;">
          <label for="msex">Male</label>
          <input style="border-radius:5px;" type="radio" id="msex" required name="sex" value="Male" <?php if(isset($sex) == 'male'){echo 'checked';}else{echo '';}?>>
          <label for="fsex">Female</label>
          <input style="border-radius:5px;" type="radio" id="fsex" required name="sex" value="Female" <?php if(isset($sex) == 'female'){echo 'checked';}else{echo '';}?>>
        </div>
      </div>

      <div style="display:block;text-align:left;margin:10px 0px;">
        <label for="dob">Date of Birth&nbsp;</label>
        <span style="position: relative;display: inline-block;border: 1px solid #a9a9a9;border-radius:5px;height: 24px;width: 160px">
            <input id="xtim" type="date" class="xDateContainer" max="<?=$lyear.'-'.$m.'-'.$d;?>" onchange="setCorrect(this,'xTime');" style="position: absolute; opacity: 0.0;height: 100%;width: 100%;">
            <input type="text" id="xTime" name="xTime" value="yyyy - mm - dd" style="border: none;height: 90%;" tabindex="-1" required>
        </span>
      </div>

      <div style="display:block;text-align:left;margin:10px 0px;">
        <label for="age">Age&nbsp;</label>
        <input style="border-radius:5px;" type="number" id="age" required name="age" size="93" value="" placeholder="eg. 21" min="1" max="120" readonly> <i style="color:red;">Age will be calculated automatically based on the DOB selected</i>
      </div>

      <div style="display:block;text-align:left;margin:10px 0px;">
        <label for="address">Address&nbsp;</label>
        <textarea style="border-radius:5px;" id="address" required name="address" cols="75" value="" placeholder="eg. Royal Palace Hostel, UCC"><?php if(isset($_POST['address'])){echo $_POST['address'];} ?></textarea>
      </div>

      <div style="display:block;text-align:left;margin:10px 0px;">
        <label for="homet">Home Town&nbsp;</label>
        <input style="border-radius:5px;" type="text" id="homet" required name="homet" size="95" value="<?php if(isset($_POST['homet'])){echo $_POST['homet'];} ?>" placeholder="eg. Awuoshi">
      </div>

      <div style="display:block;text-align:left;margin:10px 0px;">
        <label for="phone">Phone Number&nbsp;</label>
        <input style="border-radius:5px;" type="tel" id="phone" required name="phone" size="93" minlength="10" value="<?php if(isset($_POST['phone'])){echo $_POST['phone'];} ?>" placeholder="eg. 0558058058">
      </div>

      <div style="display:block;text-align:left;margin:10px 0px;">
        <label for="occ">Occupation&nbsp;</label>
        <input style="border-radius:5px;" type="text" id="occ" required name="occ" size="96" value="<?php if(isset($_POST['occ'])){echo $_POST['occ'];} ?>" placeholder="eg. student">
      </div>

      <div id="is_pat" style="display:block;text-align:left;margin:10px 0px;">
        <small><button type="button" style="background-color:#2845a7!important;color:#e5e5e5;border:#e0e0e0 1px solid;border-radius:5px;" id="ispat_btn" onclick="return is_pat()">student Patient</button></small><span id="ispat_btn_info"><i style="color:red;">If patient is a staff/student with a valid ID card, click this button</i></span>

        <small><button type="button" style="display:none;background-color:#2845a7!important;color:#e5e5e5;border:#e0e0e0 1px solid;border-radius:5px;" id="ispat_btn1" onclick="return is_pat()">Not student Patient</button></small>
        <span id="ispat_btn1_info"><i style="color:red;display:none;">If patient is <b>NOT</b> a staff/student with a valid ID card, click this button</i></span>
      </div>

      <div id="mssid" style="display:none;text-align:left;margin:10px 0px;">
        <label for="ssid">Staff/ Student ID No&nbsp;</label>
        <input style="border-radius:5px;" type="text" id="ssid" name="ssid" size="77" value="" placeholder="eg. AH/OPT/17/0026" autofocus>
      </div>

      <div style="display:block;text-align:left;margin:10px 0px;">

        <button type="submit" name="submit" style="background-color:#28a745!important;color:#e5e5e5;border:#e0e0e0 1px solid;border-radius:10px;margin-top:20px;display:inline-block;margin-left:100px;margin-right:auto;font-weight:bold;font-size:2em;">&deg;Save&deg;</button>

          <button type="reset" style="float:right;width:20%;border:black 1px solid;border-radius:5px;margin-top:20px;display:inline-block;font-weight:bold;font-size:1em;" title="Clear Form">
            Clear
          </button>
      </div>

    </form>
  </div>
</div>
<div class="cleaner"></div>
  
<?php include("includes/footer.php");?>