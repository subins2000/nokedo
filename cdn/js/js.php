<?
header('Cache-Control: no-cache');
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
$j=$ja->squeeze($j,true,false);
echo$j;
?>
$(document).ready(function(){<?
 $j="";
 $j.=file_get_contents($rf['time']);
 ob_start();
 include "main.php";
 $j.= ob_get_contents();
 ob_end_clean();
 if($f!=''){
  $j.=file_get_contents($rf[$f]);
 }
 $j.=file_get_contents($rf['echat']);
 $j=str_replace("\n",'',$j);
 $j=$ja->squeeze($j,true,false);
 echo$j;
 ?>});
