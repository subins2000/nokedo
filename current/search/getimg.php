<?php header('Content-type: image/jpeg;');
$url1 = $_GET['img']; 
if($url1=='google'){echo file_get_contents("https://www.google.co.in/images/google_favicon_128.png");}else{
$url = explode('=', $_GET['img']); $dswe=explode('?', $url[0]);
$url1 = $_GET['img']; $url = explode('=', $_GET['img']);
if(preg_match('/http\:\/\/fd/gi')){
$gravcheck = "http://nokedo.com/accounts/getimg.php?user=".$url[1];$fresponse=file_get_contents($gravcheck);
$response = get_headers($gravcheck);
if ($response[0]!="HTTP/1.0 404 Not Found"){echo $fresponse;}else{echo file_get_contents("images/web.png");}
}else{echo file_get_contents("images/web.png");}}
?>
