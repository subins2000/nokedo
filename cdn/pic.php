<?
include('config.php');
if($who!=$whod){
 ser();
}
?>
<html xmlns:fb="http://ogp.me/ns/fb#">
<body style="text-align:center;color:black !important;">
<?php 
if (!isset($_FILES['uploadedfile'])){?>
 <form id='cropimage' style="border-bottom:2px solid black;" enctype="multipart/form-data" encoding='multipart/form-data' method='post' action="pic.php">
  <center>
   <input name="uploadedfile" type="file" id="photoimg" value="choose">
   <input type='hidden' id='name' name='name' value="<?echo$user;?>" hidden />
   <input type="submit" value="Upload">
  </center>
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
            var uid = response.authResponse.userID;
            window.location="http://nokedo.com/accounts/social?image=1&id="+response.authResponse.userID;
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
  });
 }
  </script>
 <a onclick="t();" class="fb_butt">Use Facebook Image</a>
 <style>
.fb_butt{display: block;height: 43px;margin: 0px;padding: 0px 0px 0px 72px;font-family: 'Ubuntu', sans-serif;font-size: 18px;font-weight: 400;color: #fff;line-height: 41px;background: #3b579d url(//cdn.nokedo.com/images/fb_icon.png) no-repeat 14px 8px scroll;-webkit-border-radius: 4px;-moz-border-radius: 4px;border-radius: 4px;text-decoration: none;cursor:pointer;}
 </style>
 <br/>
 <a <?if(explode('@',$in['username'])[1]=='gmail.com'){?>href="pic.php?gmail=<?echo urlencode(encrypter($in['username']));?>&image=1"<?}else{?>onclick="document.getElementById('google').style.display='block';"<?}?> style="display: block;height: 43px;margin: 0px;padding: 0px 0px 0px 72px;font-family: 'Ubuntu', sans-serif;font-size: 18px;font-weight: 400;color: #fff;line-height: 41px;background: rgb(213, 109, 109);-webkit-border-radius: 4px;-moz-border-radius: 4px;border-radius: 4px;text-decoration: none;cursor: pointer;">Use Google Picture</a>
 <br/>
 <form id="google" action="pic.php" method="get" hidden>
  <input name="image" value="1" type="hidden">
  <input name="gmail" type="email" placeholder="Type your Google email">
  <input type="submit">
 </form>
<?
}
if (isset($_FILES['uploadedfile'])){
 $filename = $_FILES['uploadedfile']['tmp_name'];
 $handle = fopen($filename, "r");
 $data   = fread($handle, filesize($filename));
 $pvars  = array('input'=>base64_encode($data),'type'=>'pimg','auth'=>md5(md5(md5('dataofusersinnokedo'))),'user'=>$who,'whod'=>$_COOKIE['wervsi']);
 $curl   = curl_init();
 curl_setopt($curl, CURLOPT_URL, 'http://usercontent.nokedo.com/handle.php');
 curl_setopt($curl, CURLOPT_TIMEOUT, 30);
 curl_setopt($curl, CURLOPT_POST, 1);
 curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
 curl_setopt($curl, CURLOPT_POSTFIELDS, $pvars);
 $xml = curl_exec($curl);
 curl_close ($curl);
 $params = json_decode($xml,true);
 if($params['ok']!=''){
  save('fb','no');
  save('g','no');
  save('img',$params['url']);
  save('imgs',$params['urls']);
  sss("Image Uploaded Successfully","Your image has been uploaded and made as your profile picture.<br/>Reload the page to see the changes.");
 }else{
  ser("There was an error uploading your picture.","<a href='pic.php'>Try again.</a><br/>Error given :- ".$params['error']['message']);
 }
}
if (isset($_GET['image']) && $_GET['gmail']!=''){
 $email=decrypter($_GET['gmail']);
 $id = explode("@",$email)[0];
 $headers = get_headers("https://profiles.google.com/s2/photos/profile/".$id, 1);
 $PicUrl = $headers['Location'];
 if($PicUrl==''){
  ser("There was an error uploading your picture.","<a href='pic.php'>Try again.</a>");
 }else{
  sss("Image Uploaded Successfully","Your Google image has been made as your profile picture.<br/>Reload the page to see the changes.");
  save('fb','no');
  save('g','yes');
  save('img',$PicUrl);
  save('imgs',$PicUrl);
 }
}
?>
