<!DOCTYPE html><html><head>
<title>Reset Password - Nokedo</title>
<script src='http://cdn.nokedo.com/js/js.php'></script>
<link href="//cdn.nokedo.com/css/all.php" rel="stylesheet">
</head><body>
<div id="content">
 <h2>Reset Password</h2>
 Fill up the following form to reset your password.<br/><div clear></div>
 <form method="POST">
 <table style="margin:0px auto;"><tbody>
  <tr><td>Email</td><td>:</td><td><input type="text" placeholder="example@example.com" size="30" name="mail"></td></tr>
  <tr><td>Age</td><td>:</td><td><input type="number" max="100" oninput ="if (this.value.length > 2)this.value = this.value.slice(0,2);" size="30" name="age"></td></tr>
  <tr><td>Gender</td><td>:</td><td><select name="gender"><option value="male">Male</option><option name="female">Female</option></select></td></tr>
  <!--<tr><td>Verification</td><td>:</td><td>
  <?php
   require_once('recaptchalib.php');
   $publickey = "6Lfsp-USAAAAAHxnGOEE14NKwkkFtoqUxwxcmLDK"; // you got this from the signup page
   echo recaptcha_get_html($publickey);
  ?>
  </td></tr>--->
  <tr><td></td><td></td><td><input type="submit"></td></tr>
 </tbody></table>
 </form>
<?
function ra($length) {$chars = "subinsblogabcdefghijklmanopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";$size = strlen( $chars );for( $i = 0; $i < $length; $i++ ) {$str .= $chars[ rand( 0, $size - 1 ) ];}return $str;}
function age($birthday){list($day,$month,$year) = explode("/",$birthday);$year_diff  = date("Y") - $year;$month_diff = date("m") - $month;$day_diff   = date("d") - $day;if ($day_diff <= 0 && $month_diff <= 0)$year_diff--;return $year_diff;}
$m=$_POST['mail'];$a=$_POST['age'];$g=$_POST['gender'];
if(isset($_POST) && $m!='' && $a!='' && $g!=''){
 include('../config.php');
 $sql=$db->prepare("SELECT * FROM users WHERE username=? AND gender=?");
 $sql->execute(array($m,$g));
 while($r=$sql->fetch()){$sb=$r['birth'];$ub=$r['id'];}
 if(age($sb)!=$a || $sql->rowCount()==0){die("<h3 style='color:red;'>No user was found with the given information.</h3>");}
 $rand=ra(35);
 $sql=$db->prepare("INSERT INTO verify(uid,code,posted)VALUES(?,?,NOW())");
 $sql->execute(array($ub,$rand));
 send_mail($m,"Reset Password - Nokedo","<h2>Reset Password</h2>You have requested to reset your password. Click the following link to reset your password. Note that this link will expire in 3 hours.<blockquote><a href='http://nokedo.com/accounts/ConfirmPasswordReset.php?id=$rand'>http://nokedo.com/accounts/ConfirmPasswordReset.php?id=$rand</a></blockquote>If you have not requested to reset your password, ignore this mail. Some jerk is trying to hack your account. Don't worry, Nothing will happen to your account if your password isn't weak. To Change Password click <a href='http://nokedo.com/accounts/ChangePassword.php'>here</a>.");
 echo "<h3 style='color:green;'>A Confirmation Link has been sent to your e-mail address. Click that Link. You can close this window if you want.</h3>";
}
?>
</div>
</body></html>
