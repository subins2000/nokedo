<!DOCTYPE html><html><head>
<link href="//cdn.nokedo.com/css/all.php" rel="stylesheet">
<script src="//cdn.nokedo.com/js/js.php?f=sites"></script>
<title>MyClass - A Website Info Site</title>
</head><body>
<div id="content">
<h2>Home</h2>
 <?
 include('config.php');
 $sql=$db->prepare("SELECT * FROM sites WHERE uid=?");
 $sql->execute(array($who));
 if($sql->rowCount()==0){die("You haven't added any site. <a href='add.php'>Add a site.</a>");}
 while($r=$sql->fetch()){
  echo "<a href='site.php?id=".$r['id']."'>".$r['title']."</a>";
 }
 ?>
</div>
</body></html>
