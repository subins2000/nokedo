<?
header('Access-Control-Allow-Origin: *');
Header("content-type: application/x-javascript");
include('../config.php');
include('shrinker.php');
$rf=array("jq"=>"jquery.js",
	 "ac"=>"ac.js",
	 "class"=>'class.js',
	 'chat'=>'chat.js',
	 'store'=>'store.js',
	 'time'=>'time.js',
	 'echat'=>'http://chat.nokedo.com/embed.php?wrevbbfrr='.$who.'&wevotmcdwe='.$whod
);
$f=$_GET['f'];
$j.=file_get_contents($rf['jq']);
$ja = new JSqueeze();
$j=$ja->squeeze("$j",true,false);
echo$j;
?>
$(document).ready(function(){<?
 $j="";
 $j.=file_get_contents($rf['time']);
 if($f!=''){
  $j.=file_get_contents($rf[$f]);
 }
 $j.=file_get_contents($rf['echat']);
 $j=str_replace("\n",'',$j);
 $ch = curl_init();
 $cokes="curuser=".$who."; wervsi=".$_COOKIE['wervsi'];
 curl_setopt($ch, CURLOPT_COOKIE, $cokes);
 curl_setopt($ch, CURLOPT_URL, "http://cdn.nokedo.com/js/main.php");
 curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
 $j .= curl_exec($ch);
 $ja = new JSqueeze();
 $j=$ja->squeeze("$j",true,false);
 echo$j;
 ?>});
