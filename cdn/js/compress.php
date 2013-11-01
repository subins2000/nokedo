<?
include('shrinker.php');
$rf=array("jq"=>"jquery.js",
	 "ac"=>"ac.js",
	 "class"=>'class.js',
	 'chat'=>'chat.js',
	 'store'=>'store.js',
	 'time'=>'time.js'
);
foreach($rf as $v){
 $fl=fopen("./compressed/".$v,"w+");
 $j=file_get_contents($v);
 $ja = new JSqueeze();
 $j=$ja->squeeze($j,true,false);
 fwrite($fl,$j);
}
?>
