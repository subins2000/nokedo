<!DOCTYPE html><html><head><?include('config.php');$q = $_GET['q'];$q=strip_tags($q);$q=trim($q);$tbl_name="search";$sql=mysql_query("SELECT * FROM $tbl_name WHERE title LIKE'".mysql_real_escape_string($q)."%'"); echo "<p>";$rows = mysql_num_rows($sql);?>
<link href="css/all.php" rel="stylesheet"><script src="//cdn.nokedo.com/js/jquery.js"></script><script src="js/search.js"></script><script src="//cdn.nokedo.com/js/ac.js"></script>
</head><body>
<div id="content" style="margin-top:0px;">
 <div id="search">
  <center><a href="//nokedo.com"><h1 style="color:green;">Nokedo</h1></a></center>
  <form id="vlform" action="search.php">
  <input type="hidden" value="1" name="p">
  <input id="vl" value="<?echo$q?>" type="text" size="35" name="q">
  <input type="button" value="Search"><br /><br />
  <center><?echo'<b id="nrf" style="font-size:18px;">'.$rows.' results found</b>';?></center>
  </form>
 </div><script>localStorage['q']="<?echo$_GET['q'];?>";localStorage['p']="<?echo$_GET['p'];?>";</script>
 <div id="results">
  <?$page=$_GET['p'];if($q==""){echo "<h2><p>Please Enter a search term</p></h2>";exit;}if ($rows==0) {die('<div class="med"><p style="padding-top:.33em">Your search - <b>'.$_GET["q"].'</b> - did not match any documents.  </p><p style="margin-top:1em">Suggestions:</p><ul style="margin:0 0 2em;margin-left:1.3em"><li>Make sure all words are spelled correctly.</li><li>Try different keywords.</li><li>Try more general keywords.</li></ul><h3>We are adding new results each time you are submitting a search term. So try again after 20 seconds. Max 1 minute.</h3></div>');}else{mysql_query("UPDATE $tbl_name SET hits = hits + 1 WHERE title='".mysql_real_escape_string($q)."'");if (isset($_COOKIE['rp'])){if (!$_COOKIE['rp']==null){$limit = $_COOKIE['rp'];}else{$limit = 20; }}else{$limit = 20; }$start = ($page-1)*$limit; $dataz = mysql_query('SELECT * FROM '.$tbl_name.' WHERE title LIKE "'.$q.'%" ORDER BY hits DESC LIMIT '.$start.', '.$limit); ?><div style="display: inline-block;"><?while($rv = mysql_fetch_array($dataz)){$r=$r+1;if($rv['from']!='' || $rv['from']!=null){$img='getimg.php?img='.$rv['from'];}else{$img='getimg.php?img='.$rv['url'];}if($r==11){echo"</div><div style='display: inline-block;position: absolute;right: 0px;'>";}echo '<div style="border: 2px dashed #EEE;margin-right:10px;"><div style="display:inline-block;"><img src="'.$img.'" height="32px" width="32px"></div><div style="display: inline-block;position: relative;top: -12px;left: 5px;max-width: 244px;text-overflow: ellipsis;white-space: nowrap;overflow: hidden;"><a target="_blank" style="color:blue !important;" href="link.php?url='.$rv['url'].'">'.$rv['title'].'</a></div></div>';}}?>
 </div>
<ul id="pagination">
<center style="position: relative;left: -45px;">
<table style="display: inline-block;"><tbody><tr height="30px">
<td class="nc sb pointer" id="prev"><</td>
<?php
if (isset($_COOKIE['rp'])){if (!$_COOKIE['rp']==null){$limit = $_COOKIE['rp'];}else{$limit = 10; }}else{$limit = 10; }
$start = ($page-1)*$limit; 
$q = $_GET['q'];
$pages = ceil($rows/$limit);
if (!$_GET['q']==''){
for($i=1; $i<=$pages; $i++){echo '<td class="pgn sb" id="'.$i.'">'.$i.'</td>';$l=$i;
}}
?>
<td class="nc sb pointer" id="next">></td>
</tr></tbody></table></center>
</ul>
</div>
<script type="text/javascript">
$(document).ready(function() {$("#vl").autocomplete("livesearch.php", {width: $("#vl").width(),matchContains: true,selectFirst: false});	
$(".ac_results ul li").live('click',function(){var qtitle = $(this).attr('id');$('#vl').val(qtitle);$("#vlform").submit();});});
</script>
</body></html>
