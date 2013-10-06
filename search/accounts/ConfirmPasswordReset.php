<?
include('../config.php');
$sql=$db->prepare("SELECT * FROM verify WHERE code=?");
$sql->execute(array($_GET['id']));
if($sql->rowCount()==0){ser();}
while($r=$sql->fetch()){$who=$r['uid'];}
?>
<!DOCTYPE html><html><head>
<title>Change Password - Nokedo</title>
<script src='http://cdn.nokedo.com/js/js.php'></script>
<link href="//cdn.nokedo.com/css/all.php" rel="stylesheet">
</head><body>
<div id="content">
 <h2>Change Password</h2>
  <div style="margin:0px auto;width: 60%;">
  <form action="" method="POST">
   <table>
   <tbody>
    <tr><td>New Password:</td><td><input placeholder="Type new Password" type="password" name="new"/></td></tr>
    <tr><td>Retype Password:</td><td><input placeholder="Retype new Password" type="password" name="new2"/></td></tr>
    <tr><td></td><td><input type="submit"/></td></tr>
   </tbody>
   </table>
   <span style="color:red;">
    <?
    if($_POST['new']!='' && $_POST['new2']!=''){
     if($_POST['new']!=$_POST['new2']){die("Passwords don't match");}
     if(preg_match('/.{6,100}/',$_POST['new'])==false){die("Password must contain atleast 6 characters.");}
     $sql=$db->prepare("UPDATE users SET pass=?,salt=? WHERE id=?;DELETE FROM verify WHERE code=?");
     function ras($length){$chars='q!f@g#h#n$m%b^v&h*j(k)q_-=jn+sw47894swwfv1h36y8re879d5d2sd2sdf55sf4rwejeq093q732u4j4320238o/.Qkqu93q324nerwf78ew9q823';$size=strlen($chars);for($i=0;$i<$length;$i++){$str.=$chars[rand(0,$size-1)];}return$str;}
     $rsalt=ras('25');
     $site_salt=")!*@($&#&$^%*)_-+=`~/*-?/.,><;:]{[]}";
     $salted_hash = hash('sha256',$_POST['new'].$site_salt.$rsalt);
     $sql->execute(array($salted_hash,$rsalt,$who,$_GET['id']));
     echo "<span style='color:green;'>Password Successfully changed</span>";
    }
    ?>
   </span>
  </form>
 </div>
</div>
</body></html>
