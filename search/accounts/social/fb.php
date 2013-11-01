<?
if($_GET['continue']==null){$continue="http://nokedo.com";}else{$continue=$_GET['continue'];}
include('../../config.php');
require_once("core/facebook.php");
$app_id = "496248883778776";
$app_secret = "7f6f886bcb24b90ababec191fd6ea4ab";
$url = "http://nokedo.com/accounts/social/fb.php";
session_start();
$config = array();
$config['appId'] = '496248883778776';
$config['secret'] = '7f6f886bcb24b90ababec191fd6ea4ab';
$config['fileUpload'] = false; // optional
$facebook = new Facebook($config);
$code = $_REQUEST["code"];
if(empty($code)) {
 $_SESSION['return']=$continue;
 $_SESSION['state'] = md5(uniqid(rand(), TRUE)); // CSRF protection
 header("Location:https://www.facebook.com/dialog/oauth?scope=email,user_about_me,user_birthday,user_location&client_id=$app_id&redirect_uri=$url&state=".$_SESSION['state']);
}
   if($_SESSION['state'] && ($_SESSION['state'] === $_REQUEST['state'])) {
     $token_url = "https://graph.facebook.com/oauth/access_token?"
       . "client_id=" . $app_id . "&redirect_uri=" . urlencode($url)
       . "&client_secret=" . $app_secret . "&code=" . $code;
     $response = file_get_contents($token_url);
     $params = null;
     parse_str($response, $params);$facebook->setAccessToken($params['access_token']);
     $facebook->setExtendedAccessToken();
     $_SESSION['access_token'] = $facebook->getAccessToken();
  $access_token = $_SESSION['access_token'];
  // run fql query
  $fql_query_url = 'https://graph.facebook.com/fql?q=SELECT+uid,name,email,current_location,birthday_date,sex+FROM+user+WHERE+uid=me()&access_token='.$access_token;
  $fql_query_result = file_get_contents($fql_query_url);
  $fql_query_obj = json_decode(preg_replace('/"uid":(\d+)/', '"uid":"$1"', $fql_query_result), true);
  // display results of fql query
  $uid=$fql_query_obj['data'][0]['uid'];
  $email=$fql_query_obj['data'][0]['email'];
  $name=$fql_query_obj['data'][0]['name'];
  $sex=$fql_query_obj['data'][0]['sex'];
  $em=mysql_query("SELECT * FROM members WHERE username=\"$email\"");
if ($email==null){die('Something happened with Facebook. <a href="http://nokedo.com/accounts/social/fb.php">Try Again</a>');}
if (mysql_num_rows($em)==1) {
while($r=mysql_fetch_array($em)){$id=$r['id'];}
$myusername=$id;save('at',$access_token);save('fbid',$uid);
mysql_query("UPDATE members SET status='on' WHERE `id`='".mysql_real_escape_string($myusername)."'") or die(mysql_error());
setcookie("curuser", $myusername, time()+301014600, "/", "nokedo.com");
setcookie("wervsi", encrypter($myusername), time()+301014600, "/", "nokedo.com");
header("Location:".$_SESSION['return']."");
}else{
function age($bMonth,$bDay,$bYear) {
    list($cYear, $cMonth, $cDay) = explode("-", date("Y-m-d"));
    return ( ($cMonth >= $bMonth && $cDay >= $bDay) || ($cMonth > $bMonth) ) ? $cYear - $bYear : $cYear - $bYear - 1;
}
$location=$fql_query_obj['data'][0]['current_location']['city'].', '.$fql_query_obj['data'][0]['current_location']['state'].', '.$fql_query_obj['data'][0]['current_location']['country'];
$b=explode('/',$fql_query_obj['data'][0]['birthday_date']);
mysql_query("INSERT INTO members (username, password, name, age, birthday, sex, location, status, `set`) VALUES ('".mysql_real_escape_string($email)."', MD5('subinsfacebookauth'), '".mysql_real_escape_string($name)."', '".age($b[1],$b[0],$b[2])."', '".mysql_real_escape_string($fql_query_obj['data'][0]['birthday_date'])."', '$sex', '$location', 'on', '{\"fb\":\"yes\",\"fbid\":\"$uid\",\"at\":\"$access_token\"}')");
$em=mysql_query("SELECT * FROM members WHERE username=\"$email\"");
while($r=mysql_fetch_array($em)){$id=$r['id'];}
$myusername=$id;
setcookie("curuser", $myusername, time()+301014600, "/", "nokedo.com");
setcookie("wervsi", encrypter($myusername), time()+301014600, "/", "nokedo.com");
$to = $email;$mail = $email;$name=$name;$subject = "Subins - Welcome to Subins Family, ".$name;
$message = "<div style=\"width:100%;background:#CCC;border:2px solid black;height:100px;\"><h1><a href=\"http://subins.hp.af.cm?utm_source=mail&mail=$mail\"><img style=\"margin-left:40px;float:left;\" src=\"http://cdn-subins.hp.af.cm/images/logo.png?utm_source=mail&mail=$mail\"></a></h1><div style=\"float:right;margin-right:40px;font-size:20px;margin-top:20px\"><a href=\"http://accounts-subins.hp.af.cm\">Manage Account</a>&nbsp;&nbsp;&nbsp;<a href=\"http://accounts-subins.hp.af.cm/repass.php\">Forgot password ?</a></div></div>
<div><h2>Thanks for Signing Up.</h2>
<u><h3>Welcome to the Subins , <a href=\"http://fd-subins.hp.af.cm/profile.php?user=$myusername\">$name</a></h3></u>
See your Friendshood profile <a href=\"http://fd-subins.hp.af.cm/profile.php?user=$myusername\">here</a><br><br>
<a href=\"http://subins.hp.af.cm?utm_source=mail&mail=$mail\">Subins</a> services are 100% free. Any one can add a link to <a href=\"http://subins.hp.af.cm?utm_source=mail&mail=$mail\">Subins</a> Search Engine <a href=\"http://subins.hp.af.cm/addlink.php?utm_source=mail&mail=$mail\">here</a>.
See Other <a href=\"http://subins.hp.af.cm?utm_source=mail&mail=$mail\">Subins</a> Services:<br>
<ul>
<li><a href=\"http://subins.hp.af.cm?utm_source=mail&mail=$mail\">Subins Search</a></li>
<li><a href=\"http://sag-3.blogspot.com?utm_source=mail&mail=$mail\">Subins Blog</a></li>
<li><a href=\"http://chat-subins.hp.af.cm?utm_source=mail&mail=$mail\">Subins Chat</a></li>
<li><a href=\"http://fd-subins.hp.af.cm?utm_source=mail&mail=$mail\">Friendshood</a></li>
<li><a href=\"http://get-subins.hp.af.cm?utm_source=mail&mail=$mail\">Subins GET</a></li>
<li><a href=\"http://msurl.tk?utm_source=mail&mail=$mail\">My Short URL</a></li>
</ul>
Bugs and problems of sites will be fixed. It might take some time because <a href=\"http://fd-subins.hp.af.cm/profile.php?user=1\">I am</a> the only one who is working on <a href=\"http://subins.hp.af.cm?utm_source=mail&mail=$mail\">Subins</a> !!<br><br>Report bugs, errors and problems on <a href=\"http://chat-subins.hp.af.cm?utm_source=mail&mail=$mail\">Subins Chat</a></a></div><br>";
function send_complex_message() {
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
  curl_setopt($ch, CURLOPT_USERPWD, 'api:key-18xuhhzd8p99ghky6hmojisgbjr-cp36');
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
  curl_setopt($ch, CURLOPT_URL, 'https://api.mailgun.net/v2/subin.mailgun.org/messages');
  curl_setopt($ch, CURLOPT_POSTFIELDS, array('from' => 'Subins <noreply@subins.hp.af.cm>',
  'to' => $mail,
  'subject' => $subject,
  'text' => 'Subins!',
  'html' => $message));
  $result = curl_exec($ch);
  curl_close($ch);
  return $result;
}
$headers = "MIME-Version: 1.0" . "\r\n";$headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";$headers .= 'From: Subins <noreply@subins.hp.af.cm>' . "\r\n";
$smsg='Source- Facebook,'.$name.",mail= ".$email.", Age-".age($b[1],$b[0],$b[2])."<br />Mailgun(info)-".send_complex_message();
mail('subins2000@gmail.com',"Subins-New Person Joined",$smsg,$headers);
header("Location:".$_SESSION['return']."");
}
   }
   else {
     echo("The state does not match. You may be a victim of CSRF.");
   }
?>
