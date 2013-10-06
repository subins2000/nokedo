<?
include('config.php');
$sql=$db->prepare("SELECT * FROM store WHERE id=?");
$sql->execute(array($_GET['id']));
while($r=$sql->fetch()){$k=json_decode($r['json'],true);$l=$r['url'];if($r['ty']=='soft' || $k['pl']=='Downloadable'){$y=true;}}
if(!is_numeric($_GET['id']) || $sql->rowCount()==0 || $y==false){ser();}
$sql=$db->prepare("UPDATE store SET hits=hits+1 WHERE id=?");
$sql->execute(array($_GET['id']));
echo "<center><h3>The Requested File will start downloading in a few seconds. If the file is not downloading Reload Page</h3></center>";
header("Location:$l");
?>
