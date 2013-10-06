<?header('Access-Control-Allow-Origin: *');include('config.php');if($who!=$whod){die();}?>
<html xmlns:fb="http://ogp.me/ns/fb#">
<body style="text-align:center;color:black !important;">
<?php $who=$_COOKIE["curuser"]; 
if (!isset($_FILES['uploadedfile'])){?>
<form id='cropimage' style="border-bottom:2px solid black;" enctype="multipart/form-data" encoding='multipart/form-data' method='post' action="pic.php">
<center><input name="uploadedfile" type="file" id="photoimg" value="choose">
<input type='hidden' id='name' name='name' value="<? echo $user;?>" hidden />
<input type="submit" value="Upload"></center>
<div id="previewci"></div>
</form>	
<div id="fb-root"></div>
 <script src="http://connect.facebook.net/en_US/all.js#xfbml=1&appId=165714296941476"></script>
  <script>
      FB.init({
          appId: '165714296941476', cookie: true,
          status: true, xfbml: true
      });
function login() {
    FB.login(function(response) {
        if (response.authResponse) {
            // connected
        } else {
            // cancelled
        }
    });
}
function t(){
FB.getLoginStatus(function(response) {
  if (response.status === 'connected') {
    var uid = response.authResponse.userID;
    window.location="http://nokedo.com/accounts/social?image=1&id="+response.authResponse.userID;
    var accessToken = response.authResponse.accessToken;
     } else if (response.status === 'not_authorized') {
        login();
    } else {
        login();
    }
 });}
  </script>
<img onclick="t();" style="height:22px;width:145px;" src="images/ufbi"><br><br>
<a onclick="document.getElementById('google').style.display='block';" style="width: 100px;height:20px;background: #0C5FF1;color: white;display: inline-block;border: 2px solid black;cursor: pointer;">Use Google</a>
<form id="google" action="http://nokedo.com/accounts/social" method="get" hidden>
<input name="image" value="1" type="hidden">
<input name="gmail" type="email" placeholder="Type your Google email"><input type="submit">
</form>
<?}?>
<?php 
if (isset($_FILES['uploadedfile'])){
    $filename = $_FILES['uploadedfile']['tmp_name'];
    $handle = fopen($filename, "r");
    $data = fread($handle, filesize($filename));
    $pvars   = array('input'=>base64_encode($data),'type'=>'pimg','auth'=>md5(md5(md5('dataofusersinnokedo'))),'user'=>$who,'whod'=>$_COOKIE['wervsi']);
    $curl    = curl_init();
    curl_setopt($curl, CURLOPT_URL, 'http://usercontent.nokedo.com/handle.php');
    curl_setopt($curl, CURLOPT_TIMEOUT, 30);
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $pvars);
    $xml = curl_exec($curl);
    curl_close ($curl);
    $params = json_decode($xml,true);
if ($params['ok']!=''){
save('fb','no');save('g','no');
save('img',$params['url']);
save('imgs',$params['urls']);
echo "Your image has been uploaded and made as your profile picture. Reload the page to see the changes.";
}else{echo "There was an error uploading your picture. <a href='pic.php'>Try again.</a><br>Error given :- ".$params['error']['message'];}
}
?>
