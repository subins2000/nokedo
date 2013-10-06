<!DOCTYPE html><html><head>
<?include('../config.php');check();?>
<script src='http://cdn.nokedo.com/js/js.php'></script>
<link href="//cdn.nokedo.com/css/all.php" rel="stylesheet">
</head><body>
<div id="content">
 <h2>Change Password</h2>
 <div style="margin:0px auto;width: 60%;">
  <form action="" method="POST">
   <table>
   <tbody>
    <tr><td>Current Password:</td><td><input type="password" placeholder="Type Password you use to login to Nokedo" size="32" name="old"/></td></tr>
    <tr><td>New Password:</td><td><input placeholder="Type new Password" type="password" name="new" size="32"/></td></tr>
    <tr><td>Retype Password:</td><td><input placeholder="Retype new Password" type="password" name="new2" size="32"/></td></tr>
    <tr><td></td><td><input type="submit"/></td></tr>
   </tbody>
   </table>
   <span style="color:red;">
    <?
    if($_POST['old']!='' && $_POST['new']!='' && $_POST['new2']!=''){
     if($_POST['new']!=$_POST['new2']){die("Passwords don't match");}
     $sql=$db->prepare("SELECT * FROM users WHERE id=?");
     $sql->execute(array($who));
     while($r=$sql->fetch()){$usalt=$r['salt'];$up=$r['pass'];}
     $site_salt=")!*@($&#&$^%*)_-+=`~/*-?/.,><;:]{[]}";
     $salted_hash = hash('sha256',$_POST['old'].$site_salt.$usalt);
     if($up!=$salted_hash){die("Password you entered is wrong.");}
     if(preg_match('/.{6,100}/',$_POST['new'])==false){die("Password must contain atleast 6 characters.");}
     $sql=$db->prepare("UPDATE users SET pass=?,salt=? WHERE id=?");
     function ras($length){$chars='q!f@g#h#n$m%b^v&h*j(k)q_-=jn+sw47894swwfv1h36y8re879d5d2sd2sdf55sf4rwejeq093q732u4j4320238o/.Qkqu93q324nerwf78ew9q823';$size=strlen($chars);for($i=0;$i<$length;$i++){$str.=$chars[rand(0,$size-1)];}return$str;}
     $rsalt=ras('25');
     $site_salt=")!*@($&#&$^%*)_-+=`~/*-?/.,><;:]{[]}";
     $salted_hash = hash('sha256',$_POST['new'].$site_salt.$rsalt);
     $sql->execute(array($salted_hash,$rsalt,$who));
     setcookie("curuser", false, time()-301014600, "/", "nokedo.com");
     setcookie("wervsi", false, time()-301014600, "/", "nokedo.com");
     echo "<span style='color:green;'>Password Successfully changed.<br/><a href='login.php'>Log In with your new password.</a></span>";
    }
    ?>
   </span>
  </form>
 </div>
</div>
</body></html>
