<?php
session_start();
function encryptCookie($value){
   if(!$value){return false;}
   $key = 'gbfre8*^&%$#%^@(t0+_3a=t[tg;emj';
   $text = $value;
   $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
   $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
   $crypttext = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $key, $text, MCRYPT_MODE_ECB, $iv);
   return trim(base64_encode($crypttext)); //encode for cookie
}
	require('http.php');
	require('oauth_client.php');
	include('../../config.php');
if($_GET['c']=='' && $_SESSION['continue']==''){$_SESSION['continue']="http://nokedo.com";}else{$_SESSION['continue']=$_GET['c'];}

	$client = new oauth_client_class;
	$client->server = 'Google';

	// set the offline access only if you need to call an API
	// when the user is not present and the token may expire
	$client->offline = true;

	$client->debug = false;
	$client->debug_http = true;
	$client->redirect_uri = 'http://'.$_SERVER['HTTP_HOST'].
		dirname(strtok($_SERVER['REQUEST_URI'],'?')).'/login_with_google.php';

	$client->client_id = '1048974531235.apps.googleusercontent.com'; $application_line = __LINE__;
	$client->client_secret = '_9NU4fvXBGiFuIvx2BpRhHgo';

	if(strlen($client->client_id) == 0
	|| strlen($client->client_secret) == 0)
		die('Please go to Google APIs console page '.
			'http://code.google.com/apis/console in the API access tab, '.
			'create a new client ID, and in the line '.$application_line.
			' set the client_id to Client ID and client_secret with Client Secret. '.
			'The callback URL must be '.$client->redirect_uri.' but make sure '.
			'the domain is valid and can be resolved by a public DNS.');
	$client->scope = 'https://www.googleapis.com/auth/userinfo.email https://www.googleapis.com/auth/userinfo.profile https://www.googleapis.com/auth/plus.me';
	if(($success = $client->Initialize()))
	{
		if(($success = $client->Process()))
		{
			if(strlen($client->authorization_error))
			{
				$client->error = $client->authorization_error;
				$success = false;
			}
			elseif(strlen($client->access_token))
			{
				$success = $client->CallAPI(
					'https://www.googleapis.com/oauth2/v1/userinfo',
					'GET', array(), array('FailOnAccessError'=>true), $user);
			}
		}
		$success = $client->Finalize($success);
	}
	//if($client->exit){exit;}
	if($success){
 	 $loc=$_SESSION['continue'];
	 $m=$user->email;
	 $n=$user->name;
	 $g=$user->gender;
	 $b=date('d/m/Y', strtotime($user->birthday));
	 $i=$user->picture;
	 $sql=$db->prepare("SELECT * FROM users WHERE username=?");
	 $sql->execute(array($m));
	 if($sql->rowCount()!=0){
	  while($r=$sql->fetch()){$id=$r['id'];}
	  setcookie("curuser", $id, time()+301014600, "/", "nokedo.com");
	  setcookie("wervsi", encryptCookie($id), time()+301014600, "/", "nokedo.com");
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
	  setcookie("wervsi", encryptCookie($id), time()+301014600, "/", "nokedo.com");
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
