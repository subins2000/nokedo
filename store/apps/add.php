<?
include('../config.php');
if($who!='1'){ser();}
?>
<script src='//cdn.nokedo.com/js/jquery.js'></script>
<form method="POST">
Name:<input type="text" name="name" size="50"/><br/>
URL:<textarea name="url" size="50"></textarea><br/>
BigImg:<input name="big" placeholder="700x300" size="50"/><br/>
Description:<textarea name="ds"></textarea><br/>
From:<input name="cn"/><br/>
Type:
<select onload="$(this).find('[value=<?echo$_POST['pl'];?>]').attr('selected')" name="pl">
<option value="acc">Accessories</option>
<option value="edu">Education</option>
<option value="sci">Science</option>
<option value="gra">Graphics</option>
<option value="net">Internet</option>
<option value="off">Office</option>
<option value="pro">Programming</option>
<option value="media">Multimedia</option>
</select><br/>
<input type="submit"/>
</form>
<?
$n=$_POST['name'];$u=$_POST['url'];$b=$_POST['big'];$d=$_POST['ds'];
if($n!='' && $u!='' && isset($_POST)){
$sql=$db->prepare("SELECT * FROM store WHERE url=? OR title=?");
$sql->execute(array($n,$u));
if($sql->rowCount()!=0){die("App Exists.");}
if($b==''){$j='{"time":"'.date("Y-m-d H:i:s").'","pl":"'.$_POST['pl'].'","cn":"'.$_POST['cn'].'"}';}else{$j='{"time":"'.date("Y-m-d H:i:s").'","pl":"'.$_POST['pl'].'","cn":"'.$_POST['cn'].'","big":"'.$b.'"}';}
$sql=$db->prepare("INSERT INTO store(uid,title,ds,url,ty,json)VALUES(?,?,?,?,'app',?)");
$r=$sql->execute(array($who,$n,$d,$u,$j));
if($r==1){echo "Success.---$b";}
}
?>
