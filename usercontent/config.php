<?
$db = new PDO('mysql:dbname=d;host=127.0.0.1', 'root', 'backstreetboys');
function deCookie($value){
   if(!$value || $value==null || $value==''){return 'truth';}else{
   $key = '!23r4556gbfre8*^&%$#%^@(ff0434hr5t0+_3=548t[tg;emj';
   $crypttext = base64_decode($value); //decode cookie
   $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
   $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
   $decrypttext = mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $key, $crypttext, MCRYPT_MODE_ECB, $iv);
   return trim($decrypttext);}
}
$who=$_POST['user'];
$whod=deCookie($_POST['whod']);
if($who==$whod){
$info=$db->prepare("SELECT * FROM users WHERE id=?");
$info->execute(array($who));while($r=$info->fetch()){$in=array('name'=>$r['name'],'birth'=>$r['birth'],'join'=>$r['joined'],'gender'=>$r['gender'],'stat'=>$r['stat'],'json'=>$r['json']);$jin=json_decode($in['json'],true);}
$img=$jin['img'];if($img==''){$img="//cdn.nokedo.com/images/guest.png";}
}
if(isset($_GET['echore'])){
error_reporting(E_ALL);
ini_set("display_errors", 1);
}
function ser(){header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found', true, 404);include('primary.php');exit;die();}
function un($n){global$db;$sql=$db->prepare("SELECT * FROM users WHERE `id`=?");$sql->execute(array($n));while($ftw = $sql->fetch()){return $ftw;}}
function save($key,$val){
global $db;global $who;global $whod;
if ($who==$whod){
 $sql=$db->prepare("SELECT * FROM users WHERE `id`=?");
 $sql->execute(array($who));
  while($rcsdvasd=$sql->fetch()){
   $arr = json_decode($rcsdvasd['json'],true);
   $arr[$key]=$val;
   $sql=$db->prepare("UPDATE users SET json=? WHERE `id`=?");
   $sql->execute(array(json_encode($arr),$who));
  }
 }
}
function get($key,$w){
global $db;global $who;global $jin;
 if($w==''){$w=$who;return $jin[$key];exit;}
 $sql=$db->prepare("SELECT * FROM users WHERE `id`=?");
 $sql->execute(array($w));
 while($rcsdvasd=$sql->fetch()){
  if($rcsdvasd['json']=='' || $rcsdvasd['json']==null){
  if($key=='img'){return '//cdn.nokedo.com/images/guest.png';}else{return '';}
  }else{
  $arr = json_decode($rcsdvasd['json'],true);
  if($key=='img' && $arr[$key]==''){return '//cdn.nokedo.com/images/guest.png';}else{return $arr[$key];}
  }
 }
}
function check(){global$who;global$whod;if($who!=$whod){header("Location:http://nokedo.com/accounts/login.php?c=//".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']);}}
?>
