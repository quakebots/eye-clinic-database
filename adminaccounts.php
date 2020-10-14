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
  // Get patients
  $run = mysqli_query($con, "SELECT `pat_id`, `pat_uid`, `admin_id`, `pat_name`, `gender`, `dob`, `age`, `address`, `homet`, `contact`, `occ`, `opdn`, `pecn`, `done`, `created_at`, `last_updated` FROM `patient`");
  $num = mysqli_num_rows($run);

  // Get doctors
	$run1 = mysqli_query($con, "SELECT `doc_id`, `doc_uid`, `branch_id`, `doc_name`, `clinic_name`, `email_id`, `phone`, `login_id`, `password`, `created_at`, `last_login`, `last_updated` FROM `doctor`");
	$num1 = mysqli_num_rows($run1);

	// Get supervisors
	$run2 = mysqli_query($con, "SELECT * FROM `admin` WHERE `admin_id`!=1");
	$num2 = mysqli_num_rows($run2);

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
  	<div>
			<style type="text/css">
				.tg  {border-collapse:collapse;border-spacing:0;border-color:#93a1a1;}
				.tg td{font-family:Arial, sans-serif;font-size:14px;padding:5px 3px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#93a1a1;color:#002b36;background-color:#fdf6e3;}
				.tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:5px 3px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#93a1a1;color:#fdf6e3;background-color:#657b83;}
				.tg .tg-19vq{font-weight:bold;background-color:#9b9b9b;color:#000000;border-color:inherit;text-align:left}
				.tg .tg-cz33{background-color:#eee8d5;border-color:inherit;text-align:left}
				.tg-sort-header::-moz-selection{background:0 0}.tg-sort-header::selection{background:0 0}.tg-sort-header{cursor:pointer}.tg-sort-header:after{content:'';float:right;margin-top:7px;border-width:0 5px 5px;border-style:solid;border-color:#404040 transparent;visibility:hidden}.tg-sort-header:hover:after{visibility:visible}.tg-sort-asc:after,.tg-sort-asc:hover:after,.tg-sort-desc:after{visibility:visible;opacity:.4}.tg-sort-desc:after{border-bottom:none;border-width:5px 5px 0}@media screen and (max-width: 767px) {.tg {width: auto !important;}.tg col {width: auto !important;}.tg-wrap {overflow-x: auto;-webkit-overflow-scrolling: touch;}}
			</style>
			<div class="tg-wrap">
				<table id="tg-SCjZP" class="tg" width="100%">
				  <tr>
				  	<th colspan="5" style="background:black;color:white;text-align:center;font-size:1.5em;" class="">Patients</th>
				  </tr>
				  <tr>
				    <th class="tg-19vq">Eye Clinic #</th>
				    <th class="tg-19vq">Name</th>
				    <th class="tg-19vq">Date Of Birth</th>
				    <th class="tg-19vq">Sex</th>
				    <th class="tg-19vq">Contact</th>
				  </tr>
				  <?php
				  if($num < 1){
			  		echo '
			  			<tr>
			  				<td colspan="6" style="color:red;">No Records yet</td>
			  			</tr>
			  		';
			  	}else{
				  	while($fetch = mysqli_fetch_assoc($run)){
				  		$pat_id = $fetch['pat_id'];
				  		$pat_uid = $fetch['pat_uid'];
				  		$admin_id = $fetch['admin_id'];
				  		$pat_name = $fetch['pat_name'];
				  		$gender = $fetch['gender'];
				  		$dob = $fetch['dob'];
				  		$age = $fetch['age'];
				  		$address = $fetch['address'];
				  		$homet = $fetch['homet'];
				  		$contact = $fetch['contact'];
				  		$occ = $fetch['occ'];
				  		$opdn = $fetch['opdn'];
				  		$pecn = $fetch['pecn'];
				  		$created_at = $fetch['created_at'];
				  		$last_updated = $fetch['last_updated'];
				  		
				  		echo '
				  			<tr>
							    <td class="tg-cz33"><a href="adminviewall.php?v=patient&id='.$pat_id.'" title="View Patient Info.">'.$pecn.'</a></td>
							    <td class="tg-cz33">'.$pat_name.'</td>
							    <td class="tg-cz33">'.$dob.'</td>
							    <td class="tg-cz33">'.$gender.'</td>
							    <td class="tg-cz33">'.$contact.'</td>
							  </tr>
				  		';
					  	}
				  	}
				  ?>
				</table>
			</div>
			<script charset="utf-8">var TGSort=window.TGSort||function(n){"use strict";function r(n){return n.length}function t(n,t){if(n)for(var e=0,a=r(n);a>e;++e)t(n[e],e)}function e(n){return n.split("").reverse().join("")}function a(n){var e=n[0];return t(n,function(n){for(;!n.startsWith(e);)e=e.substring(0,r(e)-1)}),r(e)}function o(n,r){return-1!=n.map(r).indexOf(!0)}function u(n,r){return function(t){var e="";return t.replace(n,function(n,t,a){return e=t.replace(r,"")+"."+(a||"").substring(1)}),l(e)}}function i(n){var t=l(n);return!isNaN(t)&&r(""+t)+1>=r(n)?t:NaN}function s(n){var e=[];return t([i,m,g],function(t){var a;r(e)||o(a=n.map(t),isNaN)||(e=a)}),e}function c(n){var t=s(n);if(!r(t)){var o=a(n),u=a(n.map(e)),i=n.map(function(n){return n.substring(o,r(n)-u)});t=s(i)}return t}function f(n){var r=n.map(Date.parse);return o(r,isNaN)?[]:r}function v(n,r){r(n),t(n.childNodes,function(n){v(n,r)})}function d(n){var r,t=[],e=[];return v(n,function(n){var a=n.nodeName;"TR"==a?(r=[],t.push(r),e.push(n)):("TD"==a||"TH"==a)&&r.push(n)}),[t,e]}function p(n){if("TABLE"==n.nodeName){for(var e=d(n),a=e[0],o=e[1],u=r(a),i=u>1&&r(a[0])<r(a[1])?1:0,s=i+1,v=a[i],p=r(v),l=[],m=[],g=[],h=s;u>h;++h){for(var N=0;p>N;++N){r(m)<p&&m.push([]);var T=a[h][N],C=T.textContent||T.innerText||"";m[N].push(C.trim())}g.push(h-s)}var L="tg-sort-asc",E="tg-sort-desc",b=function(){for(var n=0;p>n;++n){var r=v[n].classList;r.remove(L),r.remove(E),l[n]=0}};t(v,function(n,t){l[t]=0;var e=n.classList;e.add("tg-sort-header"),n.addEventListener("click",function(){function n(n,r){var t=d[n],e=d[r];return t>e?a:e>t?-a:a*(n-r)}var a=l[t];b(),a=1==a?-1:+!a,a&&e.add(a>0?L:E),l[t]=a;var i=m[t],v=function(n,r){return a*i[n].localeCompare(i[r])||a*(n-r)},d=c(i);(r(d)||r(d=f(i)))&&(v=n);var p=g.slice();p.sort(v);for(var h=null,N=s;u>N;++N)h=o[N].parentNode,h.removeChild(o[N]);for(var N=s;u>N;++N)h.appendChild(o[s+p[N-s]])})})}}var l=parseFloat,m=u(/^(?:\s*)([+-]?(?:\d+)(?:,\d{3})*)(\.\d*)?$/g,/,/g),g=u(/^(?:\s*)([+-]?(?:\d+)(?:\.\d{3})*)(,\d*)?$/g,/\./g);n.addEventListener("DOMContentLoaded",function(){for(var t=n.getElementsByClassName("tg"),e=0;e<r(t);++e)try{p(t[e])}catch(a){}})}(document);</script>
		</div><br><br><hr><br><br>


<!-- DOCTOR ACCOUNTS -->
<div>
	<style type="text/css">
		.tg  {border-collapse:collapse;border-spacing:0;border-color:#93a1a1;}
		.tg td{font-family:Arial, sans-serif;font-size:14px;padding:5px 3px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#93a1a1;color:#002b36;background-color:#fdf6e3;}
		.tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:5px 3px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#93a1a1;color:#fdf6e3;background-color:#657b83;}
		.tg .tg-19vq{font-weight:bold;background-color:#9b9b9b;color:#000000;border-color:inherit;text-align:left}
		.tg .tg-cz33{background-color:#eee8d5;border-color:inherit;text-align:left}
		.tg-sort-header::-moz-selection{background:0 0}.tg-sort-header::selection{background:0 0}.tg-sort-header{cursor:pointer}.tg-sort-header:after{content:'';float:right;margin-top:7px;border-width:0 5px 5px;border-style:solid;border-color:#404040 transparent;visibility:hidden}.tg-sort-header:hover:after{visibility:visible}.tg-sort-asc:after,.tg-sort-asc:hover:after,.tg-sort-desc:after{visibility:visible;opacity:.4}.tg-sort-desc:after{border-bottom:none;border-width:5px 5px 0}@media screen and (max-width: 767px) {.tg {width: auto !important;}.tg col {width: auto !important;}.tg-wrap {overflow-x: auto;-webkit-overflow-scrolling: touch;}}
	</style>
	<div class="tg-wrap">
		<table id="tg-SCjZP" class="tg" width="100%">
		  <tr>
		  	<th colspan="7" style="background:black;color:white;text-align:center;font-size:1.5em;" class="">Doctors</th>
		  </tr>
		  <tr>
		  	<th class="tg-19vq">ID<br></th>
		    <th class="tg-19vq">Name<br></th>
		    <th class="tg-19vq">Clinic</th>
		    <th class="tg-19vq">Email</th>
		    <th class="tg-19vq">Contact<br></th>
		  </tr>
		  <?php
		  if($num1 < 1){
	  		echo '
	  			<tr>
	  				<td colspan="7" style="color:red;">No Records yet</td>
	  			</tr>
	  		';
	  	}else{
		  	while($fetch = mysqli_fetch_assoc($run1)){
		  		$doc_id = $fetch['doc_id'];
		  		$doc_uid = $fetch['doc_uid'];
		  		$branch_id = $fetch['branch_id'];
		  		$doc_name = $fetch['doc_name'];
		  		$clinic_name = $fetch['clinic_name'];
		  		$email_id = $fetch['email_id'];
		  		$phone = $fetch['phone'];
		  		$login_id = $fetch['login_id'];
		  		$password = $fetch['password'];
		  		$created_at = $fetch['created_at'];
		  		$last_login = $fetch['last_login'];
		  		$last_updated = $fetch['last_updated'];
		  		
		  		echo '
		  			<tr  width="100%">
			  			<td class="tg-cz33"><a href="adminviewall.php?v=doctor&id='.$doc_id.'">'.$doc_uid.'</a></td>
					    <td class="tg-cz33">'.$doc_name.'<br></td>
					    <td class="tg-cz33">'.$clinic_name.'</td>
					    <td class="tg-cz33">'.$email_id.'</td>
					    <td class="tg-cz33">'.$phone.'<br></td>
					  </tr>
		  		';
		  	}
	  	}
		  ?>
		</table>
	</div>
	<script charset="utf-8">var TGSort=window.TGSort||function(n){"use strict";function r(n){return n.length}function t(n,t){if(n)for(var e=0,a=r(n);a>e;++e)t(n[e],e)}function e(n){return n.split("").reverse().join("")}function a(n){var e=n[0];return t(n,function(n){for(;!n.startsWith(e);)e=e.substring(0,r(e)-1)}),r(e)}function o(n,r){return-1!=n.map(r).indexOf(!0)}function u(n,r){return function(t){var e="";return t.replace(n,function(n,t,a){return e=t.replace(r,"")+"."+(a||"").substring(1)}),l(e)}}function i(n){var t=l(n);return!isNaN(t)&&r(""+t)+1>=r(n)?t:NaN}function s(n){var e=[];return t([i,m,g],function(t){var a;r(e)||o(a=n.map(t),isNaN)||(e=a)}),e}function c(n){var t=s(n);if(!r(t)){var o=a(n),u=a(n.map(e)),i=n.map(function(n){return n.substring(o,r(n)-u)});t=s(i)}return t}function f(n){var r=n.map(Date.parse);return o(r,isNaN)?[]:r}function v(n,r){r(n),t(n.childNodes,function(n){v(n,r)})}function d(n){var r,t=[],e=[];return v(n,function(n){var a=n.nodeName;"TR"==a?(r=[],t.push(r),e.push(n)):("TD"==a||"TH"==a)&&r.push(n)}),[t,e]}function p(n){if("TABLE"==n.nodeName){for(var e=d(n),a=e[0],o=e[1],u=r(a),i=u>1&&r(a[0])<r(a[1])?1:0,s=i+1,v=a[i],p=r(v),l=[],m=[],g=[],h=s;u>h;++h){for(var N=0;p>N;++N){r(m)<p&&m.push([]);var T=a[h][N],C=T.textContent||T.innerText||"";m[N].push(C.trim())}g.push(h-s)}var L="tg-sort-asc",E="tg-sort-desc",b=function(){for(var n=0;p>n;++n){var r=v[n].classList;r.remove(L),r.remove(E),l[n]=0}};t(v,function(n,t){l[t]=0;var e=n.classList;e.add("tg-sort-header"),n.addEventListener("click",function(){function n(n,r){var t=d[n],e=d[r];return t>e?a:e>t?-a:a*(n-r)}var a=l[t];b(),a=1==a?-1:+!a,a&&e.add(a>0?L:E),l[t]=a;var i=m[t],v=function(n,r){return a*i[n].localeCompare(i[r])||a*(n-r)},d=c(i);(r(d)||r(d=f(i)))&&(v=n);var p=g.slice();p.sort(v);for(var h=null,N=s;u>N;++N)h=o[N].parentNode,h.removeChild(o[N]);for(var N=s;u>N;++N)h.appendChild(o[s+p[N-s]])})})}}var l=parseFloat,m=u(/^(?:\s*)([+-]?(?:\d+)(?:,\d{3})*)(\.\d*)?$/g,/,/g),g=u(/^(?:\s*)([+-]?(?:\d+)(?:\.\d{3})*)(,\d*)?$/g,/\./g);n.addEventListener("DOMContentLoaded",function(){for(var t=n.getElementsByClassName("tg"),e=0;e<r(t);++e)try{p(t[e])}catch(a){}})}(document);</script><br><br><hr><br><br>

	<div>
	<style type="text/css">
		.tg  {border-collapse:collapse;border-spacing:0;border-color:#93a1a1;}
		.tg td{font-family:Arial, sans-serif;font-size:14px;padding:5px 3px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#93a1a1;color:#002b36;background-color:#fdf6e3;}
		.tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:5px 3px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#93a1a1;color:#fdf6e3;background-color:#657b83;}
		.tg .tg-19vq{font-weight:bold;background-color:#9b9b9b;color:#000000;border-color:inherit;text-align:left}
		.tg .tg-cz33{background-color:#eee8d5;border-color:inherit;text-align:left}
		.tg-sort-header::-moz-selection{background:0 0}.tg-sort-header::selection{background:0 0}.tg-sort-header{cursor:pointer}.tg-sort-header:after{content:'';float:right;margin-top:7px;border-width:0 5px 5px;border-style:solid;border-color:#404040 transparent;visibility:hidden}.tg-sort-header:hover:after{visibility:visible}.tg-sort-asc:after,.tg-sort-asc:hover:after,.tg-sort-desc:after{visibility:visible;opacity:.4}.tg-sort-desc:after{border-bottom:none;border-width:5px 5px 0}@media screen and (max-width: 767px) {.tg {width: auto !important;}.tg col {width: auto !important;}.tg-wrap {overflow-x: auto;-webkit-overflow-scrolling: touch;}}
	</style>
	<div class="tg-wrap">
		<table id="tg-SCjZP" class="tg" width="100%">
		  <tr>
		  	<th colspan="7" style="background:black;color:white;text-align:center;font-size:1.5em;" class="">Supervisors/Lecturers</th>
		  </tr>
		  <tr>
		  	<th class="tg-19vq">Staff ID</th>
		  	<th class="tg-19vq">Name</th>
		    <th class="tg-19vq">Email</th>
		    <th class="tg-19vq">Contact</th>
		    <th class="tg-19vq">Last Login</th>
		    <th class="tg-19vq">Date Added</th>
		    <!-- <th class="tg-19vq"></th> -->
		  </tr>
		  <?php
		  if($num2 < 1){
	  		echo '
	  			<tr>
	  				<td colspan="6" style="color:red;">No Records yet</td>
	  			</tr>
	  		';
	  	}else{
		  	while($fetch = mysqli_fetch_assoc($run2)){
		  		$sup_id = $fetch['admin_id'];
		  		// $branch_id = $fetch['branch_id'];
		  		$sup_name = $fetch['admin_name'];
		  		$sup_uid = $fetch['admin_uid'];
		  		$login_id = $fetch['login_id'];
		  		$phone = $fetch['phone'];
		  		$password = $fetch['password'];
		  		$email_id = $fetch['email_id'];
		  		$lastlogin = $fetch['lastlogin'];
		  		$date_added = $fetch['date_added'];
		  		$last_updated = $fetch['last_updated'];

		  		if(isset($_SESSION['sadmin_id'])){
		  			$uid = '<a href="adminviewall.php?v=supervisor&id='.$sup_id.'">'.$sup_uid.'</a>';
		  		}else{
		  			$uid = $sup_uid;
		  		}
		  		
		  		echo '
		  			<tr>
			  			<td class="tg-cz33">'.$uid.'</td>
			  			<td class="tg-cz33">'.$sup_name.'</td>
					    <td class="tg-cz33">'.$email_id.'</td>
					    <td class="tg-cz33">'.$phone.'</td>
					    <td class="tg-cz33">'.$lastlogin.'</td>
					    <td class="tg-cz33">'.$date_added.'</td>
					  </tr>
		  		';
			  	}
		  	}
		  ?>
		</table>
	</div>
	<script charset="utf-8">var TGSort=window.TGSort||function(n){"use strict";function r(n){return n.length}function t(n,t){if(n)for(var e=0,a=r(n);a>e;++e)t(n[e],e)}function e(n){return n.split("").reverse().join("")}function a(n){var e=n[0];return t(n,function(n){for(;!n.startsWith(e);)e=e.substring(0,r(e)-1)}),r(e)}function o(n,r){return-1!=n.map(r).indexOf(!0)}function u(n,r){return function(t){var e="";return t.replace(n,function(n,t,a){return e=t.replace(r,"")+"."+(a||"").substring(1)}),l(e)}}function i(n){var t=l(n);return!isNaN(t)&&r(""+t)+1>=r(n)?t:NaN}function s(n){var e=[];return t([i,m,g],function(t){var a;r(e)||o(a=n.map(t),isNaN)||(e=a)}),e}function c(n){var t=s(n);if(!r(t)){var o=a(n),u=a(n.map(e)),i=n.map(function(n){return n.substring(o,r(n)-u)});t=s(i)}return t}function f(n){var r=n.map(Date.parse);return o(r,isNaN)?[]:r}function v(n,r){r(n),t(n.childNodes,function(n){v(n,r)})}function d(n){var r,t=[],e=[];return v(n,function(n){var a=n.nodeName;"TR"==a?(r=[],t.push(r),e.push(n)):("TD"==a||"TH"==a)&&r.push(n)}),[t,e]}function p(n){if("TABLE"==n.nodeName){for(var e=d(n),a=e[0],o=e[1],u=r(a),i=u>1&&r(a[0])<r(a[1])?1:0,s=i+1,v=a[i],p=r(v),l=[],m=[],g=[],h=s;u>h;++h){for(var N=0;p>N;++N){r(m)<p&&m.push([]);var T=a[h][N],C=T.textContent||T.innerText||"";m[N].push(C.trim())}g.push(h-s)}var L="tg-sort-asc",E="tg-sort-desc",b=function(){for(var n=0;p>n;++n){var r=v[n].classList;r.remove(L),r.remove(E),l[n]=0}};t(v,function(n,t){l[t]=0;var e=n.classList;e.add("tg-sort-header"),n.addEventListener("click",function(){function n(n,r){var t=d[n],e=d[r];return t>e?a:e>t?-a:a*(n-r)}var a=l[t];b(),a=1==a?-1:+!a,a&&e.add(a>0?L:E),l[t]=a;var i=m[t],v=function(n,r){return a*i[n].localeCompare(i[r])||a*(n-r)},d=c(i);(r(d)||r(d=f(i)))&&(v=n);var p=g.slice();p.sort(v);for(var h=null,N=s;u>N;++N)h=o[N].parentNode,h.removeChild(o[N]);for(var N=s;u>N;++N)h.appendChild(o[s+p[N-s]])})})}}var l=parseFloat,m=u(/^(?:\s*)([+-]?(?:\d+)(?:,\d{3})*)(\.\d*)?$/g,/,/g),g=u(/^(?:\s*)([+-]?(?:\d+)(?:\.\d{3})*)(,\d*)?$/g,/\./g);n.addEventListener("DOMContentLoaded",function(){for(var t=n.getElementsByClassName("tg"),e=0;e<r(t);++e)try{p(t[e])}catch(a){}})}(document);</script>
</div>






  </div>
</div>
<div class="cleaner"></div> 
<?php  
  include("includes/footer.php");
?>