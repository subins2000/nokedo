<!DOCTYPE html><html><head>
<?include('config.php');check();?>
<script src="http://cdn.nokedo.com/js/js.php"></script>
<link href="//cdn.nokedo.com/css/all.php" rel="stylesheet">
<title>MyClass - A Social networking site for programmers and Normal people</title>
</head><body>
<div id="content">
<?$ty=get('type');
if(isset($_GET['ty']) && $_GET['ty']=='nor' || $_GET['ty']=='pro'){
if($_GET['ty']=='nor'){$word='Normal Person';}else{$word="Programmer";}
if($ty==''){save('type',$_GET['ty']);header("Location:".$_GET['ty']);die("<h2>You are a ".$word);}else{header("Location:$ty");die("<h2>Already Chosen</h2>");}
}
?>
<?if($ty==''){?><div style="width: 590px;margin:0px auto;"><button onclick="window.location='index.php?ty=nor'" style="font-size: 30px;padding: 20px;">Normal Person</button> <button style="font-size: 30px;padding: 20px;" disabled>OR</button> <button onclick="window.location='index.php?ty=pro'" style="font-size: 30px;padding: 20px;">Programmer</button><?}else{header("Location:$ty");?><?}?>
</div>
</body></html>
