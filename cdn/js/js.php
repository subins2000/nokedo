<?
header('Cache-Control: no-cache');
Header("content-type: application/x-javascript");
include('../config.php');
include('shrinker.php');
$rf=array("jq"=>"compressed/jquery.js",
	 "ac"=>"compressed/ac.js",
	 "class"=>'compressed/class.js',
	 'chat'=>'compressed/chat.js',
	 'store'=>'compressed/store.js',
	 'time'=>'compressed/time.js',
	 'echat'=>'http://chat.nokedo.com/embed.php?wrevbbfrr='.$who.'&wevotmcdwe='.$whod
);
$f=$_GET['f'];
$j=file_get_contents($rf['jq']);
$ja = new JSqueeze();
$j.=file_get_contents($rf['time']);
echo$j;
echo"$(document).ready(function(){";
ob_start();
include "main.php";
$j=ob_get_contents();
ob_end_clean();
if($f!=''){
 $j.=file_get_contents($rf[$f]);
}
if($who==$whod){
 $j.=file_get_contents($rf['echat']);
}
$j=str_replace("\n",'',$j);
$j=$ja->squeeze($j,true,false);
echo$j;
?>
});
