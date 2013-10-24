<?
include('../../config.php');
if(isset($_GET['image']) && isset($_GET['id']) && $_GET['id']!='undefined'){
 $headers=get_headers("https://graph.facebook.com/".$_GET['id'].'/picture?width=200&height=200', 1);
 if($headers['Location']!=''){
  save('fb','yes');
  save('g','no');
  save('img',$headers['Location']);
  save('imgs',$headers['Location']);
 }else{
  die("<h2>Error</h2><br>Something happened.<br><a href='//cdn.nokedo.com/pic.php'>Try again.</a>");
 }
 if(get('fbid')!=''){
  save('fbid',$_GET['id']);
 }else{
  die("<h2>Error</h2><br>Something happened.<br><a href='//cdn.nokedo.com/pic.php'>Try again.</a>");
 }
 echo "Your image is now Facebook Profile picture.<br>Press \"ESC\" key to close this window.<br>Clear your browser cache to get the result.";
 if(isset($_GET['signup'])){?>
  <script>
  window.top.location='http://nokedo.com/accounts/signup.php?fin';
  </script>
<?
 }
}elseif(isset($_GET['signup'])){
 ?>
  <script>
  window.top.location='http://nokedo.com/accounts/signup.php?fin';
  </script>
 <?
 }
}else{
?>
<html lang="en"><head><meta charset="utf-8"><meta name="viewport" content="initial-scale=1, minimum-scale=1, width=device-width"><title>Error 404 (Not Found)!!1</title><style>*{margin:0;padding:0}html,code{font:15px/22px arial,sans-serif}html{background:#fff;color:#222;padding:15px}body{margin:7% auto 0;max-width:390px;min-height:180px;padding:30px 0 15px}* > body{background:url(//cdn.nokedo.com/images/robot.png) 100% 5px no-repeat;padding-right:205px}p{margin:11px 0 22px;overflow:hidden}ins{color:#777;text-decoration:none}a img{border:0}@media screen and (max-width:772px){body{background:none;margin-top:0;max-width:none;padding-right:0}}</style></head><body><a href="//nokedo.com/"><img src="//cdn.nokedo.com/images/logo.png" alt="Google"></a><p><b>404.</b> <ins>That&acute;s an error.</ins></p><p>The requested URL <b><script>document.write(window.location.pathname);</script></b> was not found on this server.  <ins>That&acute;s all we know.</ins></p></body></html><?}?>
