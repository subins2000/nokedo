<!DOCTYPE html><html><head>
<?include('config.php');include('RMI.php');
function curPageURL() {
 $pageURL = 'http';
 if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
 $pageURL .= "://";
 if ($_SERVER["SERVER_PORT"] != "80") {
  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
 } else {
  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
 }
 return $pageURL;
}
$sql=$db->prepare("SELECT * FROM store WHERE id=?");
$sql->execute(array($_GET['id']));
while($r=$sql->fetch()){$t=$r['title'];$wu=$r['uid'];$ty=$r['ty'];$d=$r['ds'];$u=$r['url'];$j=json_decode($r['json'],true);$p=$j['time'];$b=$j['big'];$pl=str_replace('lin','Linux',str_replace('win','Windows',str_replace('mac','Macintosh',$j['pl'])));$ver=$j['ver'];$h=$r['hits'];$bit=$j['bit'];$dv=$j['cn'];}if($pl==''){$pl="All";}
?>
<script src="http://cdn.nokedo.com/js/js.php?f=store"></script>
<link href="//cdn.nokedo.com/css/all.php" rel="stylesheet">
<title><?if($ty!='soft'){echo "Software Not Found";}else{echo$t;}?> - OneStore</title>
</head><body>
<div id="content">
<?if($ty!='soft'){die("<h1>Software Not Found</h1>");}?>
<center style="border-bottom:1px solid #CCC;padding-bottom:5px;"><a href="javascript:window.history.go(-1);" style="float:left;">Go Back</a><a href='//get.nokedo.com'>Home</a><a href="index.php" style="float:right;">All Softwares</a></center>
<h2 style="display:inline-block;"><?echo$t;?></h2><?if($dv!=''){?><h3 style="display:inline-block;font-weight:normal;">&nbsp;- from <?echo$dv;?></h3><?}?>
<?if($b!=''){echo "<img src='$b' style='width:700px;height:200px;'/><br clear/>";}?>
<div style="display:table-cell;vertical-align:middle;">
<?
if($d!=''){echo '<blockquote style="border: 5px dashed #CCC;padding:8px 10px;margin-left:10px;margin-top:10px;">'.$d.'</blockquote>';}
if($pl!=''){echo "Platform : <a href='index.php?pl={$j['pl']}'>$pl</a><br clear/>";}
echo "Version : $ver<br clear/>Bit : $bit<br clear/>".sts($_GET['id']);
?>
</div>
<div style="display:table-cell;vertical-align:middle;">
 <center style='width:282px;'><button class="sb sb-b" style="display:block;margin:0px auto;padding:10px 25px;font-size:22px;" onclick="$('#dw<?echo$_GET['id'];?>').show();$('#dw<?echo$_GET['id'];?>').find('iframe').attr('src','get.php?id=<?echo$_GET['id'];?>');">Download</button><div clear></div>
 <b><?echo$h;?></b> Downloads</center>
 <div id="dw<?echo$_GET['id'];?>"><iframe style="height:0px;width:0px;display:none;" src="about:blank;"/></iframe><center>Download will start in a few moments.<br/>If not <a href="get.php?id=<?echo$_GET['id'];?>">click here.</a></center></div>
</div>
<div clear style="border-top:1px solid black;width:100%;"/>
<div class="footer" style="margin:0px auto;display:table;"><div style="display: inline-block;position: relative;margin-right: 10px;"></div><div style="display: inline-block;position: relative;margin-right: 6px;"><iframe src="https://www.facebook.com/plugins/like.php?href=<?echo curPageURL();?>&layout=box_count" frameborder="0" height="62" width="50"></iframe></div><div style="display: inline-block;position: relative;margin-right: 18px;"><iframe src="https://platform.twitter.com/widgets/tweet_button.html?url=<?echo curPageURL();?>&count=vertical" frameborder="0" height="62" width="58"></iframe></div><div style="display: inline-block;margin-right: 10px;position: relative;top: -1px;"><iframe src="https://plusone.google.com/_/+1/fastbutton?bsv&size=tall&hl=en&url=<?echo curPageURL();?>" frameborder="0" height="60" width="50"></iframe></div><div style="display:inline-block;top: -25px;
position: relative;"><iframe src="http://ct5.addthis.com/static/r07/pinit013.html?url=<?echo curPageURL();?>&media=http://goo.gl/3i1AG" frameborder="0" height="20" width="40"></iframe></div></div>
<div id="disqus_thread"></div>
    <script type="text/javascript">
        /* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
        var disqus_shortname = 'subinsblog'; // required: replace example with your forum shortname
        /* * * DON'T EDIT BELOW THIS LINE * * */
        (function() {
            var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
            dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
            (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
        })();
    </script>
    <noscript>Please enable JavaScript to view the <a href="http://disqus.com/?ref_noscript">comments.</a></noscript></div>
</div>
</div>
</body></html>
