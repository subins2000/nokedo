<?include('config.php');check();?>
<!DOCTYPE html><html><head>
<link href="//cdn.nokedo.com/css/all.php" rel="stylesheet">
<script src="//cdn.nokedo.com/js/js.php?f=sites"></script>
<title>MyClass - A Website Info Site</title>
</head><body>
<div id="content">
 <h2>Add your site</h2>
 <form action="" method="POST">
  <input type="text" name="name" placeholder="Site Name"/><br/>
  <input type="text" name="url" placeholder="Site URL"/><br/>
  <input type="submit" value="Submit"/>
 </form>
<?
if($_POST['name']!='' && $_POST['url']!=''){
$n=$_POST['name'];$u=$_POST['url'];
 if(preg_match('/((([A-Za-z]{3,9}:(?:\/\/)?)(?:[-;:&=\+\$,\w]+@)?[A-Za-z0-9.-]+|(?:www.|[-;:&=\+\$,\w]+@)[A-Za-z0-9.-]+)((?:\/[\+~%\/.\w-_]*)?\??(?:[-\+=&;%@.\w_]*)#?(?:[\w]*))?)/',$_POST['url'])==false){die("<span style='color:red;'>URL not valid</span>");}
 $sql=$db->prepare("SELECT * FROM sites WHERE url=?");
 $sql->execute(array($_POST['url']));
 if($sql->rowCount()!=0){die("<span style='color:red;'>Sites exists.</span>");}
 $sql=$db->prepare("INSERT INTO sites (uid,title,url) VALUES(?,?,?)");
 $sql->execute(array($who,$n,$u));
 echo "<span style='color:green;'>Site added</span>";
}
?>
</div>
</body></html>
