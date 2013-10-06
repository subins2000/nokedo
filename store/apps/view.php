<!DOCTYPE html><html><head>
<?include('../config.php');include('../RMI.php');
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
while($r=$sql->fetch()){
 $t=$r['title'];
 $wu=$r['uid'];
 $ty=$r['ty'];
 $d=$r['ds'];
 $u=$r['url'];
 $j=json_decode($r['json'],true);
 $p=$j['time'];
 $b=$j['big'];
 $pl=str_replace('acc','Accessories',str_replace('edu','Education',str_replace('gra','Graphics',str_replace('net','Internet',str_replace('media','Multimedia',str_replace('off','Office',str_replace('pro','Programming',str_replace('sci','Science',$j['pl']))))))));
 $ver=$j['ver'];
 $h=$r['hits'];
 $bit=$j['bit'];
 $dv=$j['cn'];
}
?>
<script src="http://cdn.nokedo.com/js/js.php?f=store"></script>
<link href="//cdn.nokedo.com/css/all.php" rel="stylesheet">
<title><?if($ty!='app'){echo "App Not Found";}else{echo$t;}?> - OneStore</title>
</head><body>
<script>
function getDocHeight(doc) {
    doc = doc || document;
    var body = doc.body, html = doc.documentElement;
    var height = Math.max( body.scrollHeight, body.offsetHeight, 
        html.clientHeight, html.scrollHeight, html.offsetHeight );
    return height;
}
function setIframeHeight(id) {
    var ifrm = id;
    var doc = ifrm.contentDocument? ifrm.contentDocument: ifrm.contentWindow.document;
    ifrm.style.visibility = 'hidden';
    ifrm.style.height = "10px"; // reset to minimal height in case going from longer to shorter doc
    // some IE versions need a bit added or scrollbar appears
    if(getDocHeight(doc)<35){
     ifrm.style.height = "100%";
    }else{
     ifrm.style.height = getDocHeight( doc ) + 4 + "px";
    }
    ifrm.style.visibility = 'visible';
}
</script>
<div id="content" style="padding-top:10px;width:60%;">
<?if($ty!='app'){die("<h1>App Not Found</h1>");}?>
<center style="border-bottom:1px solid #CCC;padding-bottom:5px;"><a href="javascript:window.history.go(-1);" style="float:left;">Go Back</a><a href='//get.nokedo.com'>Home</a><a href="index.php" style="float:right;">All Apps</a></center>
<h2 style="display:inline-block;"><?echo$t;?></h2><?if($dv!=''){?><h3 style="display:inline-block;font-weight:normal;">&nbsp;- by <?echo$dv;?></h3><?}?>
<?
echo "<iframe src='$u' onload='setIframeHeight(this)' frameborder='0' width='100%' height='95%'></iframe><br clear/>";
$sql=$db->prepare("UPDATE store SET hits=hits+1 WHERE id=?");$sql->execute(array($_GET['id']));
?>
<div style="display:table-cell;vertical-align: top;">
<?
if($d!=''){echo '<blockquote style="border: 5px dashed #CCC;padding:8px 10px;margin-left:10px;margin-top:10px;">'.$d.'</blockquote>';}
if($pl!=''){echo "App Category : <a href='index.php?pl=".$j['pl']."'>$pl</a><br clear/>";}
?>
</div>
<div style="display:table-cell;vertical-align:top;padding-left: 22px;">
 Viewed <?echo$h.' times';?><br/>
 Added on <?echo$p;?><br/>
 <?
 if($dv!=''){echo "Created By <b>".$dv."</b><br/>";}
 echo"Added By <a href='//class.nokedo.com/profile.php?id=$wu' target='_blank'>".un($wu)['name'].'</a>';
 ?>
</div><br/>
<div style="border-top:1px solid black;width:100%;"></div>
<div class="footer" style="margin:0px auto;display:table;margin-top:4px;"><div style="display: inline-block;position: relative;margin-right: 10px;"></div><div style="display: inline-block;position: relative;margin-right: 6px;"><iframe src="https://www.facebook.com/plugins/like.php?href=<?echo curPageURL();?>&layout=box_count" frameborder="0" height="62" width="50"></iframe></div><div style="display: inline-block;position: relative;margin-right: 18px;"><iframe src="https://platform.twitter.com/widgets/tweet_button.html?url=<?echo curPageURL();?>&count=vertical" frameborder="0" height="62" width="58"></iframe></div><div style="display: inline-block;margin-right: 10px;position: relative;top: -1px;"><iframe src="https://plusone.google.com/_/+1/fastbutton?bsv&size=tall&hl=en&url=<?echo curPageURL();?>" frameborder="0" height="60" width="50"></iframe></div><div style="display:inline-block;top: -25px;
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
