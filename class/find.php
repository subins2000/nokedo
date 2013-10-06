<?include('config.php');check();?>
<!DOCTYPE html><html><head>
<script src="http://cdn.nokedo.com/js/js.php?f=class"></script>
<link href="//cdn.nokedo.com/css/all.php" rel="stylesheet">
<title>Find Programmers and other people</title>
</head><body>
<div id="content" style="width:600px;">
<?
if($_GET['lang']==''){
$sql=$db->prepare("SELECT * FROM users WHERE id!=? AND id NOT IN (SELECT fid FROM fds WHERE uid=?)");
$sql->execute(array($who,$who));
}else{
$sql=$db->prepare("SELECT * FROM users WHERE id!=? AND id NOT IN (SELECT fid FROM fds WHERE uid=?) AND json LIKE ?");
$sql->execute(array($who,$who,'%\\"'.$_GET['lang'].'\\\\":\\\\"true\\\\"%'));?>
<form>People who know the language <select onchange="$(this).parents('form').submit();" name="lang" style="display:inline-block;vertical-align: middle;"><option value="HTML">HTML</option><option value="CSS">CSS</option><option value="Javascript">Javascript</option><option value="jQuery">jQuery</option><option value="PHP">PHP</option><option value="NodeJS">NodeJS</option><option value="ASP">ASP</option><option value="JSP">JSP</option><option value="VBScript">VBScript</option><option value="SMX">SMX</option><option value="WebDNA">WebDNA</option><option value="Python">Python</option><option value="C">C</option><option value="C#">C#</option><option value="C++">C++</option><option value="Java">Java</option><option value="Perl">Perl</option><option value="Ruby">Ruby</option><option value="SQL">SQL</option><option value="WebQl">WebQl</option></select></form>
<script>$('select[name=lang]').find('[value=<?echo urldecode($_GET["lang"]);?>]').attr('selected','true');</script>
<?}?><div style="margin:0px auto;display:table;">
<?while($r=$sql->fetch()){
 echo "<div style='height:200px;width:200px;display:inline-block;position:relative;' class='qcwr'><a href='profile.php?id=".$r['id']."'><img height='200' src='".json_decode($r['json'],true)['imgs']."'/></a><a  href='profile.php?id=".$r['id']."' style='position:absolute;background:black;left:0px;right:0px;bottom:0px;padding:8px 10px;text-align:center;color:white;'>".$r['name']."</a>";
if($r['id']!=$who){echo "<button class='sb sb-g follow' id='".$r['id']."' style='position:absolute;left:0px;width: 100%;top: -2px;padding:0px 10px;text-align:center;color:white;'>Follow</button>";}
echo "</div>";
}
?>
<script>
 $(".follow").bind('click',function(){$(this).parents('.qcwr').remove();});
</script>
</div><?if($sql->rowCount()==0){echo "<h1>You've completed your destiny.</h1>You followed every little living thing on MyClass";if($_GET['lang']!=''){echo " who knows the language <b>".$_GET['lang']."</b>";}}?></div>
</body></html>
