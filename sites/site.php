<!DOCTYPE html><html><head>
<link href="//cdn.nokedo.com/css/all.php" rel="stylesheet">
<script src="//cdn.nokedo.com/js/js.php?f=sites"></script>
<title>Nokedo Sites - A Website Info Site</title>
</head><body>
<div id="content">
<?
include('config.php');
$id=$_GET['id'];
$sql=$db->prepare("SELECT * FROM sites WHERE id=?");
$sql->execute(array($id));
while($r=$sql->fetch()){$n=$r['title'];$u=$r['url'];$o=$r['uid'];$t=$r['since'];$c=$r['category'];}
?>
 <h2><a href="site.php?id=<?echo$id;?>"><?echo$n;?></a> - <a href="<?echo$u;?>" target="_blank"><?echo$u;?></a></h2>
 <div style="display:table-cell;">
 <img src="http://api1.thumbalizr.com/?url=<?echo$u;?>&width=250" width="250"/>
 </div>
 <div style="display:table-cell;vertical-align:top;">
 <table><tbody>
  <tr><td>Owner</td><td>:</td><td><?echo un($o)['name'];?></td>
  <tr><td>Online Since</td><td>:</td><td><?echo $t;?></td>
  <tr><td>Category</td><td>:</td><td><a href="search.php?c=<?echo urlencode($c);?>"><?echo $c;?></a></td>
 </tbody></table>
 </div>
</div>
</body></html>
