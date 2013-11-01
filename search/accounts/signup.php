<?include('../config.php');
function age($birthday){list($day,$month,$year) = explode("/",$birthday);$year_diff  = date("Y") - $year;$month_diff = date("m") - $month;$day_diff   = date("d") - $day;if ($day_diff <= 0 && $month_diff <= 0)$year_diff--;return $year_diff;}
if(isset($_POST['name'])){
 $n=$_POST['name'];$m=$_POST['mail'];$d=$_POST['bir'];$g=$_POST['gender'];$p=$_POST['pass'];
 if(preg_match('/^(?:[a-z]|[A-Z]).{4}/',$n) && preg_match('/^[a-zA-Z0-9]+[a-zA-Z0-9_.-]+[a-zA-Z0-9_-]+@[a-zA-Z0-9]+[a-zA-Z0-9.-]+[a-zA-Z0-9]+.[a-z]{2,4}$/',$m) && preg_match('/[0-9]{2}\/[0-9]{2}\/[0-9]{4}/',$d) && preg_match('/^(?:male|Male|female|Female)$/',$g) && preg_match('/.{6,100}/',$p)){
 $sql=$db->prepare('SELECT * FROM users WHERE username=?');
 $sql->execute(array($m));if($sql->rowCount()!=0){die("<span style=\"color:red;\">There is already an user with this email id. <a href='forgot.php'>Forgot your password ?</a></span>");}
 if(preg_match('/\-/',age($d))){die("<span style=\"color:red;\">You cannot add a future user (Check birthdate)</span>");}
 function ras($length){$chars='q!f@g#h#n$m%b^v&h*j(k)q_-=jn+sw47894swwfv1h36y8re879d5d2sd2sdf55sf4rwejeq093q732u4j4320238o/.Qkqu93q324nerwf78ew9q823';$size=strlen($chars);for($i=0;$i<$length;$i++){$str.=$chars[rand(0,$size-1)];}return$str;}
 $rt=ras('25');
 $sql=$db->prepare('INSERT INTO `users` (username,pass,name,gender,birth,joined,json,salt)VALUES(?,?,?,?,?,NOW(),?,?)');
 $sql->execute(array($m,hash('sha256',$p.")!*@($&#&$^%*)_-+=`~/*-?/.,><;:]{[]}".$rt),$n,$g,$d,'{"img":"//cdn.nokedo.com/images/guest.png","imgs":"//cdn.nokedo.com/images/guest.png","privacy":{"mail":"prt"}}',$rt));
 $sql=$db->prepare('SELECT * FROM users WHERE username=?');
 $sql->execute(array($m));while($r=$sql->fetch()){$id=$r['id'];}
 setcookie("wervsi", encrypter($id), time()+3600, "/", "nokedo.com");
 setcookie("curuser", $id, time()+3600, "/", "nokedo.com");
 echo 'Successfull. See your profile <a href="//class.nokedo.com/profile.php">here</a>';
}else{die('<span style="color:red;">Something\' Wrong. It may be your fault or mine. Anyways just contact <a href="mailto:subins2000@gmail.com">Subin</a></span>');}
}else{?>
<!DOCTYPE html><html><head>
<script src='http://cdn.nokedo.com/js/js.php'></script>
<link href="//cdn.nokedo.com/css/all.php" rel="stylesheet">
</head><body>
<div id="content"><img style="vertical-align:middle;" src="//cdn.nokedo.com/images/logo.png"/><span style="vertical-align:middle;margin-left:20px;">A Programmer Network</span><br/>
<input type="text" class="input" style="position: absolute;opacity: 0;height: 0px;width: 0px;padding: 0px;">
<div class="terminal">
<div class="line" id="1"><span class="txt"></span><span class="cursor"></span></div>
</div>
<?echo"<style type='text/css'>".file_get_contents('sg.css')."</style>";?>
<?echo"<script>".file_get_contents('sg.js')."</script>";?>
</body></html>
<?}?>
