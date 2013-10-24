<?session_start();include('../../config.php');
if($_GET['continue']==null){$continue="http://nokedo.com";}else{$continue=$_GET['continue'];}
function encryptCookie($value){
   if(!$value){return false;}
   $key = 'gbfre8*^&%$#%^@(t0+_3a=t[tg;emj';
   $text = $value;
   $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
   $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
   $crypttext = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $key, $text, MCRYPT_MODE_ECB, $iv);
   return trim(base64_encode($crypttext)); //encode for cookie
}
function age($bYear,$bMonth,$bDay) {
    list($cYear, $cMonth, $cDay) = explode("-", date("Y-m-d"));
    return ( ($cMonth >= $bMonth && $cDay >= $bDay) || ($cMonth > $bMonth) ) ? $cYear - $bYear : $cYear - $bYear - 1;
}
if($_POST['dt']==''){$_SESSION['bir']='';}else{$_SESSION['bir']=$_POST['dt'];add();}
function add(){
$b=explode('/',$_SESSION['bir']);$email=$_SESSION['email'];$name=$_SESSION['name'];$sex=$_SESSION['gen'];$location=$_SESSION['loc'];$im=$_SESSION['im'];$uid=$_SESSION['uid'];if($location==''){$location="Null";}
mysql_query("INSERT INTO members (username, password, name, age, birthday, sex, location, status, `set`) VALUES ('".mysql_real_escape_string($email)."', MD5('subinsgoogleauth'), '".mysql_real_escape_string($name)."', '".age($b[0],$b[1],$b[2])."', '".$b[2].'/'.$b[1].'/'.$b[0]."', '$sex', '$location', 'on', '{\"fb\":\"no\",\"g\":\"no\",\"gid\":\"$uid\",\"gurl\":\"$im\"}')");
$em=mysql_query("SELECT * FROM members WHERE username=\"".mysql_real_escape_string($email)."\"");
while($r=mysql_fetch_array($em)){$id=$r['id'];}$myusername=$id;
mysql_query("UPDATE members SET status='on' WHERE `id`='".mysql_real_escape_string($myusername)."'") or die(mysql_error());
setcookie("curuser", $myusername, time()+301014600, "/", "nokedo.com");
setcookie("wervsi", encryptCookie($myusername), time()+301014600, "/", "nokedo.com");
header("Location:".$_SESSION['return']."");
}
if($_GET['code']==''){$_SESSION['return']=$continue;header("Location: https://accounts.google.com/o/oauth2/auth?redirect_uri=http%3A%2F%2Fnokedo.com/accounts%2Fsocial%2Fgoogle.php&response_type=code&client_id=1002983817000.apps.googleusercontent.com&approval_prompt=force&scope=https%3A%2F%2Fwww.googleapis.com%2Fauth%2Fplus.me+https%3A%2F%2Fwww.googleapis.com%2Fauth%2Fuserinfo.email+https%3A%2F%2Fwww.googleapis.com%2Fauth%2Fuserinfo.profile&access_type=offline");}else{
$pvars   = 'code='.$_GET['code'].'&redirect_uri=http%3A%2F%2Fnokedo.com/accounts%2Fsocial%2Fgoogle.php&client_id=1002983817000.apps.googleusercontent.com&scope=&client_secret=vdAlizzKwcSFRes4YDIlLNtR&grant_type=authorization_code';
$timeout = 30;
$curl= curl_init();
curl_setopt($curl, CURLOPT_URL, 'https://accounts.google.com/o/oauth2/token');
curl_setopt($curl, CURLOPT_TIMEOUT, $timeout);
curl_setopt($curl, CURLOPT_POST, 1);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_POSTFIELDS, $pvars);
$xml = curl_exec($curl);curl_close ($curl);$xml=json_decode($xml,true);
$at=$xml['access_token'];
$info=file_get_contents('https://www.googleapis.com/oauth2/v2/userinfo?access_token='.$at);$info=json_decode($info,true);$email=$info['email'];
$em=mysql_query("SELECT * FROM members WHERE username=\"".mysql_real_escape_string($email)."\"");
if (mysql_num_rows($em)==1) {
while($r=mysql_fetch_array($em)){$id=$r['id'];}$myusername=$id;
mysql_query("UPDATE members SET status='on' WHERE `id`='".mysql_real_escape_string($myusername)."'") or die(mysql_error());
setcookie("curuser", $myusername, time()+301014600, "/", "nokedo.com");
setcookie("wervsi", encryptCookie($myusername), time()+301014600, "/", "nokedo.com");
header("Location:".$_SESSION['return']."");
}else{
$lin=file_get_contents('https://www.googleapis.com/plus/v1/people/me?access_token='.$at);$lin=json_decode($lin,true);
$_SESSION['email']=$info['email'];$_SESSION['gen']=$info['gender'];$_SESSION['loc']=$lin['placesLived']['0']['value'];$_SESSION['name']=$info['name'];$_SESSION['im']=$info['picture'];$_SESSION['uid']=$info['id'];if($lin==''){$_SESSION['loc']="Null";}
if($info==''){$_SESSION['ud']='';die("Some shit happened. <a href='http://".$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']."'>Try again.</a>");}
if(preg_match('/0000/',$info['birthday']) || $info['birthday']==''){die("Your birth date cannot be fetched. Why don't you manually type it for us. <br/><form method='post'><input placeholder='Year/Month/Date' name='dt'>Example:2000/01/20&nbsp;&nbsp;&nbsp;<input type='submit'></form>");}else{$_SESSION['bir']=$info['birthday'];add();}
}}
?>
