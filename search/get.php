<?
if($_POST['asfvsad']!=''){
$start = (1-1)*10;$q=str_replace(' ','+',$_POST['q']);
$st=array();$w3=array();$sb=array();$php=array();$wk=array();
 $html = file_get_contents('http://google.com/search?q='.$q);
 $dom = new domDocument;
 $dom->loadHTML($html);
 $dom->preserveWhiteSpace = false;
 $lis = $dom->getElementsByTagName('h3');
 foreach($lis  as $li){
  if($li->getAttribute('class')=='r'){
   $links = $li->getElementsByTagName('a');
   if($links->length){
     $t=htmlspecialchars($links->item(0)->nodeValue);
     $url=str_replace('url?q=http://','',$links->item(0)->getAttribute('href'));
     $url=str_replace('url?q=https://','',$url);
     $url=explode('&sa',$url);
     $url='http:/'.$url[0];
     if (preg_match("/stackoverflow/i",$url)){$st[$t]=$url;}
     if (preg_match("/w3schools/i",$url)){$w3[$t]=$url;}
     if (preg_match("/php\.net/i",$url)){$php[$t]=$url;}
     if (preg_match("/sag\-3\.blogspot\.com/i",$url)){$sb[$t]=$url;}
     if (preg_match("/en\.wikipedia\.org/i",$url)){$wk[$t]=$url;}
   }
  }
 }
if(!empty($st)){
 $img='http://cdn.nokedo.com/images/stackoverflow.png';
 echo "<div style='display:inline-block;border:2px solid black;vertical-align:top;'>";
 foreach($st as $k=>$v){
  echo '<div title="'.$k.'" style="border: 2px dashed #EEE;margin-right:10px;"><div style="display:inline-block;"><img src="'.$img.'" height="32px" width="32px"></div><div style="display: inline-block;position: relative;left: 5px;max-width: 326px;text-overflow: ellipsis;white-space: nowrap;overflow: hidden;"><a target="_blank" style="color:blue !important;" onmousedown="$(this).attr(\'href\',\'link.php?url='.urlencode($v).'&q='.urlencode($q).'\')" href="'.$v.'">'.$k.'</a><br/><span style="color: gray;" title="'.$v.'">'.$v.'</span></div></div>';
 }
 echo"</div>";
}
if(!empty($w3)){
 $img='http://cdn.nokedo.com/images/w3.png';
 echo "<div style='display:inline-block;border:2px solid black;vertical-align:top;'>";
 foreach($w3 as $k=>$v){
  echo '<div title="'.$k.'" style="border: 2px dashed #EEE;margin-right:10px;"><div style="display:inline-block;"><img src="'.$img.'" height="32px" width="32px"></div><div style="display: inline-block;position: relative;left: 5px;max-width: 326px;text-overflow: ellipsis;white-space: nowrap;overflow: hidden;"><a target="_blank" style="color:blue !important;" onmousedown="$(this).attr(\'href\',\'link.php?url='.urlencode($v).'&q='.urlencode($q).'\')" href="'.$v.'">'.$k.'</a><br/><span style="color: gray;" title="'.$v.'">'.$v.'</span></div></div>';
 }
 echo"</div>";
}
if(!empty($sb)){
 $img='data:image/jpeg;base64,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';
 echo "<div style='display:inline-block;border:2px solid black;vertical-align:top;'>";
 foreach($sb as $k=>$v){
  echo '<div title="'.$k.'" style="border: 2px dashed #EEE;margin-right:10px;"><div style="display:inline-block;"><img src="'.$img.'" height="32px" width="32px"></div><div style="display: inline-block;position: relative;left: 5px;max-width: 326px;text-overflow: ellipsis;white-space: nowrap;overflow: hidden;"><a target="_blank" style="color:blue !important;" onmousedown="$(this).attr(\'href\',\'link.php?url='.urlencode($v).'&q='.urlencode($q).'\')" href="'.$v.'">'.$k.'</a><br/><span style="color: gray;" title="'.$v.'">'.$v.'</span></div></div>';
 }
 echo"</div>";
}
if(!empty($php)){
 $img='http://cdn.nokedo.com/images/php.png';
 echo "<div style='border:2px solid black;vertical-align:top;'>";
 foreach($php as $k=>$v){
  echo '<div title="'.$k.'" style="border: 2px dashed #EEE;margin-right:10px;"><div style="display:inline-block;"><img src="'.$img.'" height="32px" width="32px"></div><div style="display: inline-block;position: relative;left: 5px;max-width: 326px;text-overflow: ellipsis;white-space: nowrap;overflow: hidden;"><a target="_blank" style="color:blue !important;" onmousedown="$(this).attr(\'href\',\'link.php?url='.urlencode($v).'&q='.urlencode($q).'\')" href="'.$v.'">'.$k.'</a><br/><span style="color: gray;" title="'.$v.'">'.$v.'</span></div></div>';
 }
 echo"</div>";
}
if(!empty($wk)){
 $img='http://cdn.nokedo.com/images/wiki.jpg';
 echo "<div style='border:2px solid black;vertical-align:top;'>";
 foreach($wk as $k=>$v){
  echo '<div title="'.$k.'" style="border: 2px dashed #EEE;margin-right:10px;"><div style="display:inline-block;"><img src="'.$img.'" height="32px" width="32px"></div><div style="display: inline-block;position: relative;left: 5px;max-width: 326px;text-overflow: ellipsis;white-space: nowrap;overflow: hidden;"><a target="_blank" style="color:blue !important;" onmousedown="$(this).attr(\'href\',\'link.php?url='.urlencode($v).'&q='.urlencode($q).'\')" href="'.$v.'">'.$k.'</a><br/><span style="color: gray;" title="'.$v.'">'.$v.'</span></div></div>';
 }
 echo"</div>";
}
$nrf=count($php)+count($sb)+count($w3)+count($st)+count($wk);
}
if($nrf==0){echo "<h2>Not Found anything with what you have searched.</h2><ul><li>Check whether your Internet connection is active.</li><li>See if there is a spelling mistake in your search query.</li><li>You may have not searched for a term that is related to programming.</li></ul>";}
?>
<script>$("#nrf").html("<?echo$nrf;?> results found");</script>
