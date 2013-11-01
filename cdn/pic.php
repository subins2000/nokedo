<?
include('config.php');
if($who!=$whod){
 ser();
}
?>
<html xmlns:fb="http://ogp.me/ns/fb#">
<body style="text-align:center;">
<?php 
if (!isset($_FILES['uploadedfile'])){?>
 <form id='cropimage' enctype="multipart/form-data" encoding='multipart/form-data' method='post' action="pic.php">
  <center>
   <input name="uploadedfile" type="file" id="photoimg" value="choose">
   <input type='hidden' id='name' name='name' value="<?echo$user;?>" hidden />
   <input type="submit" value="Upload">
  </center>
  <div id="previewci"></div>
 </form>
 <a class="fb_butt" onclick="document.getElementById('fb_user_frm').style.display='block';">Use Facebook Image</a>
 <br/>
 <form method="POST" action="pic.php" style="display:none;" id="fb_user_frm">
  <input type="hidden" name="fb" value="1"/>
  Facebook Username : <input type="text" name="name" <?if($jin['fb']!=""){?>value="<?echo$jin['fb'];?>"<?}?>/>
  <br/>https://www.facebook.com/<b>usernamehere</b>
  <?if($jin['fb']==""){?><br/><input type="checkbox" name="use"/>: Save This To Your Profile<?}?>
  <br/><input type="submit"/>
 </form>
 <style>
.fb_butt{display: block;height: 43px;margin: 0px;padding: 0px 0px 0px 72px;font-family: 'Ubuntu', sans-serif;font-size: 18px;font-weight: 400;color: #fff;line-height: 41px;background: #3b579d url(//cdn.nokedo.com/images/fb_icon.png) no-repeat 14px 8px scroll;-webkit-border-radius: 4px;-moz-border-radius: 4px;border-radius: 4px;text-decoration: none;cursor:pointer;}
 </style>
 <a <?if(explode('@',$in['username'])[1]=='gmail.com'){?>href="pic.php?img=google"<?}else{?>onclick="document.getElementById('google').style.display='block';"<?}?> style="display: block;height: 43px;margin: 0px;padding: 0px 0px 0px 72px;font-family: 'Ubuntu', sans-serif;font-size: 18px;font-weight: 400;color: #fff;line-height: 41px;background: rgb(213, 109, 109);-webkit-border-radius: 4px;-moz-border-radius: 4px;border-radius: 4px;text-decoration: none;cursor: pointer;">Use Google Picture</a>
<?
}
if (isset($_FILES['uploadedfile'])){
 $filename = $_FILES['uploadedfile']['tmp_name'];
 $handle= fopen($filename, "r");
 $data  = fread($handle, filesize($filename));
 $pvars = array('input'=>base64_encode($data),'type'=>'pimg','auth'=>md5(md5(md5('dataofusersinnokedo'))),'user'=>$who,'whod'=>$_COOKIE['wervsi']);
 $curl  = curl_init();
 curl_setopt($curl, CURLOPT_URL, 'http://usercontent.nokedo.com/handle.php');
 curl_setopt($curl, CURLOPT_TIMEOUT, 30);
 curl_setopt($curl, CURLOPT_POST, 1);
 curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
 curl_setopt($curl, CURLOPT_POSTFIELDS, $pvars);
 $xml = curl_exec($curl);
 curl_close ($curl);
 $params = json_decode($xml,true);
 if($params['ok']!=''){
  save('img',$params['url']);
  save('imgs',$params['urls']);
  sss("Image Uploaded Successfully","Your image has been uploaded and made as your profile picture.<br/>Reload the page to see the changes.");
 }else{
  ser("There was an error uploading your picture.","<a href='pic.php'>Try again.</a><br/>Error given :- ".$params['error']['message']);
 }
}
if($_GET['img']=='google'){
 $email=explode("@",$in['username']);
 if($email[1]!='gmail.com'){
  ser("You are not a Googler","The E-mail address you given to us are not of <b>Google</b>'s ie it's host is not <b>gmail.com</b>");
 }
 $headers = get_headers("https://profiles.google.com/s2/photos/profile/".$email[0], 1);
 $gurl = $headers['Location'];
 if($gurl==''){
  ser("There was an error uploading your picture.","<a href='pic.php'>Try again.</a>");
 }else{
  $data  = file_get_contents($gurl);
  $pvars = array('input'=>base64_encode($data),'type'=>'pimg','auth'=>md5(md5(md5('dataofusersinnokedo'))),'user'=>$who,'whod'=>$_COOKIE['wervsi']);
  $curl  = curl_init();
  curl_setopt($curl, CURLOPT_URL, 'http://usercontent.nokedo.com/handle.php');
  curl_setopt($curl, CURLOPT_TIMEOUT, 30);
  curl_setopt($curl, CURLOPT_POST, 1);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($curl, CURLOPT_POSTFIELDS, $pvars);
  $xml = curl_exec($curl);
  curl_close ($curl);
  $params = json_decode($xml,true);
  if($params['ok']!=''){
   save('img',$params['url']);
   save('imgs',$params['urls']);
   sss("Image Uploaded Successfully","Your Google image has been made as your profile picture.<br/>Reload the page to see the changes.");
  }
 }
}
if($_POST['fb']==1 && $_POST['name']!=""){
 $usr=$_POST['name'];
 $headers = get_headers("https://graph.facebook.com/".$usr."/picture?width=1024", 1);
 $furl=$headers['Location'];
 if($furl==''){
  ser("There was an error uploading your picture.","<a href='pic.php'>Try again.</a>");
 }
 $data  = file_get_contents($furl);
 $pvars = array('input'=>base64_encode($data),'type'=>'pimg','auth'=>md5(md5(md5('dataofusersinnokedo'))),'user'=>$who,'whod'=>$_COOKIE['wervsi']);
 $curl  = curl_init();
 curl_setopt($curl, CURLOPT_URL, 'http://usercontent.nokedo.com/handle.php');
 curl_setopt($curl, CURLOPT_TIMEOUT, 30);
 curl_setopt($curl, CURLOPT_POST, 1);
 curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
 curl_setopt($curl, CURLOPT_POSTFIELDS, $pvars);
 $xml = curl_exec($curl);
 curl_close ($curl);
 $params = json_decode($xml,true);
 if($params['ok']!=''){
  save('img',$params['url']);
  save('imgs',$params['urls']);
  if(isset($_POST['use'])){
   save("fb",$usr);
  }
  sss("Image Uploaded Successfully","Your Facebook image has been made as your profile picture.<br/>Reload the page to see the changes.");
 }
}
?>
