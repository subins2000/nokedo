<?
include('config.php');
if(isset($_POST) && $action=='anq' && $_POST['q']!=null && $_POST['q']!=''){
$page=$_POST['p'];
if (isset($page) || !$page==null || !$page==''){$page=$page;}else{$page=1;}$limit=10;
$start = ($page-1)*$limit; echo $start;
$html = file_get_contents('https://google.com/search?start='.$start.'&q='.$_POST['q'].'&ss=327j69485j3#gsc.tab=0&gsc.q=Hi&gsc.page=1');
    $dom = new domDocument;
    $dom->loadHTML($html);
    $dom->preserveWhiteSpace = false;
    $lis = $dom->getElementsByTagName('h3');
    foreach($lis  as $li){
        if($li->getAttribute('class')=='r'){
            $links = $li->getElementsByTagName('a');
            if($links->length){
                $url=str_replace('url?q=http://','',$links->item(0)->getAttribute('href'));
                $url=str_replace('url?q=https://','',$url);
                $url=explode('&sa',$url);
                $url=$url[0];
if (preg_match("/images\?/i",$url)) {
$url='/google.com'.$url;
}
if (preg_match("/search\?q/i",$url)) {
$url='/google.com'.$url;
}
$t=$links->item(0)->nodeValue; $usercheck = 'http:/'.$url;
 $check = mysql_query("SELECT url FROM search WHERE url = '$usercheck'") or die(mysql_error());
 $check2 = mysql_num_rows($check);
 //if the name exists it gives an error
 if ($check2>=1) {
 		echo('Sorry, the Topic/Person <b>'.$usercheck.'</b> is already added. We\'l add a +1<br>');
}else{
 		$_POST['url'] = addslashes($_POST['url']);
 		$_POST['title'] = addslashes($_POST['title']);
 	mysql_query("INSERT INTO search (title, url, `from`) VALUES ('".mysql_real_escape_string($t)."', '".mysql_real_escape_string($usercheck)."', 'google')");
        echo "Added ".$t." to Subins <a target='_parent' href='search?q=".$t."'>Reload</a> URL - $usercheck<br>";}
}              
            
        }
    }}
?>
