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
$client->debug = false;
$client->debug_http = true;
$client->server = 'Facebook';
$client->redirect_uri = 'http://'.$_SERVER['HTTP_HOST'].dirname(strtok($_SERVER['REQUEST_URI'],'?')).'/login_with_facebook.php';

$client->client_id = '496248883778776'; $application_line = __LINE__;
$client->client_secret = '7f6f886bcb24b90ababec191fd6ea4ab';

if(strlen($client->client_id) == 0 || strlen($client->client_secret) == 0){
 die('Please go to Facebook Apps page https://developers.facebook.com/apps , '.
  'create an application, and in the line '.$application_line.
  ' set the client_id to App ID/API Key and client_secret with App Secret');
}
$client->scope = 'email,user_about_me,user_birthday,user_location';
if(($success = $client->Initialize())){
 if(($success = $client->Process())){
  if(strlen($client->access_token)){
   $success = $client->CallAPI('https://graph.facebook.com/me', 'GET', array(), array('FailOnAccessError'=>true), $user);
  }
 }
 $success = $client->Finalize($success);
}
if($success){
 $loc=$_SESSION['continue'];
 $m=$user->email;
 $n=$user->name;
 $g=$user->gender;
 $b=date('d/m/Y', strtotime($user->birthday));
 $i=get_headers("https://graph.facebook.com/me/picture?width=200&height=200&access_token=".$client->access_token,1)['Location'];
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
