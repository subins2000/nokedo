<!DOCTYPE html><html><head>
<link href="//cdn.nokedo.com/css/all.php" rel="stylesheet">
<script src="//cdn.nokedo.com/js/js.php?f=sites"></script>
<title>Nokedo Sites - A Website Info Site</title>
</head><body>
<div id="content">
<form action="">Search for Something:<input style="vertical-align: middle;" name="q" type="text" size="35"/><select style="display:inline-block;" name="c"><option value="">All</option><option value="Search+Engine">Search Engines</option><option value="Blog">Blogs</option><option value="Community">Comunities</option><option value="Media">Media Sites</option><option value="Gaming">Gaming Sites</option><option value="Forum">Forums</option></select></form>
<table><tbody>
<?
include('config.php');
$id=urldecode($_GET['c']);
$sql=$db->prepare("SELECT * FROM sites WHERE category=?");
$sql->execute(array($id));
while($r=$sql->fetch()){$n=$r['title'];$u=$r['url'];$o=$r['uid'];$t=$r['since'];$c=$r['category'];
echo "<tr><td><img src='http://api1.thumbalizr.com/?url=".$u."&width=100' width='32'/></td><td style='vertical-align: top;'><b><a href='site.php?id=$o'>$n</a></b> - <a href='http://nokedo.com/link.php?url=$u' target='_blank'>$u</a></td></tr>";
}
?>
</tbody></table>
</div>
</body></html>
