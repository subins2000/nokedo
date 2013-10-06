<?
include('../config.php');if($_GET['c']!=''){$continue=$_GET['c'];}else{$continue="http://nokedo.com";}$u=$_POST['user'];$p=$_POST['pass'];
function encryptCookie($value){if(!$value){return false;}$key = '!23r4556gbfre8*^&%$#%^@(ff0434hr5t0+_3=548t[tg;emj';$text = $value;$iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);$iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);$crypttext = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $key, $text, MCRYPT_MODE_ECB, $iv);return trim(base64_encode($crypttext));}
if($u!='' && $p!=''){
 $sql=$db->prepare("SELECT * FROM users WHERE username=?");
 $sql->execute(array($u));
 while($r=$sql->fetch()){$id=$r['id'];$usalt=$r['salt'];$up=$r['pass'];}
 $site_salt=")!*@($&#&$^%*)_-+=`~/*-?/.,><;:]{[]}";
 $salted_hash = hash('sha256',$p.$site_salt.$usalt);
 if($up==$salted_hash){
  if(isset($_POST['rm'])){
   setcookie("curuser", $id, time()+301014600, "/", "nokedo.com");
   setcookie("wervsi", encryptCookie($id), time()+301014600, "/", "nokedo.com");
  }else{
   setcookie("curuser", $id, false, "/", "nokedo.com");
   setcookie("wervsi", encryptCookie($id), false, "/", "nokedo.com");
  }
  header("Location: $continue");
  $s=1;
 }else{
  $s=0;
 }
}
if(isset($_POST['logout'])){
 session_destroy();
 setcookie("curuser", $id, time()-301014600, "/", "nokedo.com");
 setcookie("wervsi", encryptCookie($id), time()-301014600, "/", "nokedo.com");
}
if($who==$whod){
 header("Location:$continue");
}
?>
<!DOCTYPE html><html><head>
<title>Login to Nokedo</title>
<script src='http://cdn.nokedo.com/js/js.php'></script>
<link href="//cdn.nokedo.com/css/all.php" rel="stylesheet">
</head><body>
<div style="margin: 8% auto;display:table;">
<div style="width: 300px;background:#EEE;padding: 1px 20px 2px;display:table-cell;vertical-align:top;border-top-left-radius:10px;border-bottom-left-radius:10px;border:3px solid black;padding-top:10px;">
<h1>Sign In</h1>
<form action="<?echo $_SERVER['REQUEST_URI'];?>" method="POST">
<b>Email</b><input style="font-size:15px;width:95%;" type="text" value="<?echo$_POST['user'];?>" name="user"><br/><br/>
<b>Password</b><input style="font-size:15px;width:95%;" type="password" name="pass"><br/><br/>
<input type='checkbox' checked name="rm"/>Keep Me Logged In
<br/><br/><button type="submit" value="Login" class="sb sb-b">Sign In</button>
<a href="signup.php"><button type="button" value="Login" style="margin:2px;" class="sb sb-red">Sign Up</button></a>
<a href="ResetPassword.php"><button type="button" value="Login" class="sb sb-g">Forgot Password ?</button></a>
</form>
<?
if(isset($_POST['pass'])){if($s==1){echo "<span style='color:green;'>Redirecting.....</span>";}else{echo "<span style='color:red;'>Username/Password is wrong.</span><br/><br/>";}}
?><br/>
</div>
<div style="width: 300px;background:#EEE;padding: 1px 20px 30px;display:table-cell;border-left:1px solid black;vertical-align:top;border-top-right-radius:10px;border-bottom-right-radius:10px;border:3px solid black;padding-top:10px;">
<h1>Social Sign In</h1>
<a href="//nokedo.com/accounts/oauth/login_with_facebook.php?c=<?echo$continue;?>"><img src="//cdn.nokedo.com/images/facebookloginx.png" border="0"></a><br /><div clear/>
<a href="//nokedo.com/accounts/oauth/login_with_google.php?c=<?echo$continue;?>"><img height="23" src="//cdn.nokedo.com/images/pluslogin.png" border="0"></a><br/><div clear/>
<a href="//nokedo.com/accounts/oauth/login_with_microsoft.php?c=<?echo$continue;?>"><img src="//cdn.nokedo.com/images/mslogin.png" border="0"></a>
</div>
</div>
<div style="background: #EEE;border-top: 1px solid black;padding:4px 5px 8px 5px;position: absolute;right: 0px;left: 0px;bottom:0px;"><div style="display: inline-block;margin-left: 40px;">&copy; <a href="//class.nokedo.com/profile.php?id=1">Subin Siby</a> <?echo date('Y');?> (Forever and ever)</div><div style="float: right;display: inline-block;margin-right: 20px;"><a href="//nokedo.com/about.php#privacy">Privacy Policy</a>, <a href="//nokedo.com/about.php#terms">Terms and Conditions</a>, <a href="//nokedo.com/about.php">About Nokedo</a></div></div>
</body></html>
