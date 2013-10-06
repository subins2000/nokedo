<?php
include ('config.php');header("Content-type:text/html");
$page=$_POST['p'];
if (isset($page) || !$page==null || !$page==''){$page=$page;}else{$page=1;}
if (isset($_POST['service'])){
$tbl_name='musics'; // Table name
}else{
$tbl_name="search"; // Table name
}
$q = $_POST['q'];
 $q = strip_tags($q);
 $q = str_replace('+',' ',$q);
 $q = trim ($q); 
 $data = mysql_query("SELECT * FROM $tbl_name WHERE title LIKE '$q%'"); 
 $rn = mysql_num_rows($data);if($rn==0){$rn = 'No';}else{$rn = mysql_num_rows($data);}
 //If they did not enter a search term we give them an error 
 if ($q == "") 
 { 
 die('error:"yes",msg:"<h2><p>Please Enter a search term</p></h2>"'); 
 exit; 
 }
 // First we check if we are on page one. If we are then we don't need a link to the previous page or the first page so we do nothing. If we aren't then we generate links to the first page, and to the previous page. 
$rows = mysql_num_rows($data); 
 //This counts the number or results - and if there wasn't any it gives them a little message explaining that
echo "{"; 
 if ($rows == 0) 
 {
   die('error:"yes",msg:"<div class=\'med\'><p style=\'padding-top:.33em\'>Your search - <b>'.$q.'</b> - did not match any documents.  </p><p style=\'margin-top:1em\'>Suggestions:</p><ul style=\'margin:0 0 2em;margin-left:1.3em\'><li>Make sure all words are spelled correctly.</li><li>Try different keywords.</li><li>Try more general keywords.</li></ul><h3>We are adding new results each time you are submitting a search term. So try again after 20 seconds. Max 1 minute.</h3></div>",no:"'.$rn.' results found"}'); 
 }  
else{
mysql_query("UPDATE $tbl_name SET hits = hits + 1 WHERE title = '".$q."'");
if (isset($_COOKIE['rp'])){if (!$_COOKIE['rp']==null){$limit = $_COOKIE['rp'];}else{$limit = 20; }}else{$limit = 20; }
$start = ($page-1)*$limit; 
 $dataz = mysql_query('SELECT * FROM '.$tbl_name.' WHERE title LIKE "'.$q.'%" ORDER BY hits DESC LIMIT '.$start.', '.$limit.''); ?>
results:[<?$rfg=1;
 while($rv = mysql_fetch_array($dataz)) 
 {$title=str_replace("$q",'<b>'.$q.'</b>',$rv['title']);
 if($rv['from']!='' || $rv['from']!=null){$img='getimg.php?img='.$rv['from'];}else{$img='getimg.php?img='.$rv['url'];}
 echo '{img:"'.$img.'",url:"link.php?url='.$rv['url'].'",title:"'.$title.'",ds:"'.$ds.'"}';if(mysql_num_rows($dataz)!=$rfg){echo ',';}
 $rfg=$rfg+1;}
$result = $data;
$count = mysql_num_rows($result);
$pages = ceil($count/$limit);
echo"],ps:\"$pages\",no:\"$rn results found\"";
}?>}
