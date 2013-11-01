<?php
session_start();
require('http.php');
require('oauth_client.php');
include('../../config.php');
if($_GET['c']=='' && $_SESSION['continue']==''){
 $_SESSION['continue']="http://nokedo.com";
}else{
 $_SESSION['continue']=$_GET['c'];
}
$client = new oauth_client_class;
$client->server = 'Microsoft';
$client->debug = true;
$client->debug_http = true;
$client->redirect_uri = 'http://'.$_SERVER['HTTP_HOST'].dirname(strtok($_SERVER['REQUEST_URI'],'?')).'/login_with_microsoft.php';

$client->client_id = '00000000440FF009'; $application_line = __LINE__;
$client->client_secret = 'EjLvH2K3dldsQuBGk2pcBDPRO3J3sdLd';

if(strlen($client->client_id) == 0 || strlen($client->client_secret) == 0){
 die('Please go to Microsoft Live Connect Developer Center page '.
  'https://manage.dev.live.com/AddApplication.aspx and create a new'.
  'application, and in the line '.$application_line.
  ' set the client_id to Client ID and client_secret with Client secret. '.
  'The callback URL must be '.$client->redirect_uri.' but make sure '.
  'the domain is valid and can be resolved by a public DNS.');
}
/* API permissions
 */
$client->scope = 'wl.basic wl.emails wl.birthday';
if(($success = $client->Initialize())){
 if(($success = $client->Process())){
  if(strlen($client->authorization_error)){
   $client->error = $client->authorization_error;
   $success = false;
  }
  elseif(strlen($client->access_token)){
   $success = $client->CallAPI(
    'https://apis.live.net/v5.0/me',
    'GET', array(), array('FailOnAccessError'=>true), $user);
  }
 }
 $success = $client->Finalize($success);
}
//if($client->exit){exit;}
if($success){
 $loc=$_SESSION['continue'];
 $m=$user->emails->account;
 $n=$user->name;
 $g=$user->gender;
 if($g==''){$g="male";}
 $b=date('d/m/Y', strtotime($user->birth_day.$user->birth_month.$user->birth_year));/*Because returned birthday is in single digit - 04/08/2013*/
 $i=get_headers("https://apis.live.net/v5.0/me/picture?access_token=".$client->access_token, 1)['Location'];
 $sql=$db->prepare("SELECT * FROM users WHERE username=?");
 $sql->execute(array($m));
 if($sql->rowCount()!=0){
  while($r=$sql->fetch()){$id=$r['id'];}
  setcookie("curuser", $id, time()+301014600, "/", "nokedo.com");
  setcookie("wervsi", encrypter($id), time()+301014600, "/", "nokedo.com");
  header("Location:$loc");
 }else{
  function ras($length){$chars='q!f@g#h#n$m%b^v&h*j(k)q_-=jn+sw47894swwfv1h36y8re879d5d2sd2sdf55sf4rwejeq093q732u4j4320238o/.Qkqu93q324nerwf78ew9q823';$size=strlen($chars);for($i=0;$i<$length;$i++){$str.=$chars[rand(0,$size-1)];}return$str;}
  $rt=ras('25');
  $sql=$db->prepare('INSERT INTO `users` (username,pass,name,gender,birth,joined,json,salt)VALUES(?,?,?,?,?,NOW(),?,?)');
  $sql->execute(array($m,hash('sha256',"it2bio".")!*@($&#&$^%*)_-+=`~/*-?/.,><;:]{[]}".$rt),$n,$g,$b,'{"img":"'.$i.'","imgs":"'.$i.'","privacy":{"mail":"prt"}}',$rt));
  $sql=$db->prepare("SELECT * FROM users WHERE username=?");
  $sql->execute(array($m));
  while($r=$sql->fetch()){$id=$r['id'];}
  setcookie("curuser", $id, time()+301014600, "/", "nokedo.com");
  setcookie("wervsi", encrypter($id), time()+301014600, "/", "nokedo.com");
  header("Location:$loc");
 }
}
else{
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Error</title>
</head>
<body>
<h1>OAuth client error</h1>
<pre>Error: <?php echo HtmlSpecialChars($client->error); ?></pre>
</body>
</html>
<?}?>
