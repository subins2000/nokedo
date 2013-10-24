<?$q=$_GET['q'];?>
<!DOCTYPE html><html><head>
<meta name="description" content="Nokedo is a Web Developer Network"></meta>
<script src="http://cdn.nokedo.com/js/js.php"></script>
<link href="//cdn.nokedo.com/css/all.php" rel="stylesheet">
<title><?echo htmlspecialchars($q);?> - nokedo Search</title>
<script type="text/javascript">/*$(document).ready(function() {$("#vl").autocomplete("livesearch.php", {width: parseFloat($("#vl").width())+parseFloat('15'),matchContains: true,selectFirst: false});});*/</script>
</head><body>
<div id="content" style="width:760px;">
 <div id="search">
  <form id="vlform" action="search.php">
  <input type="hidden" value="1" name="p">
  <a href="//nokedo.com"><img src="//cdn.nokedo.com/images/logo.png" height="30" style="display:inline-block;position: absolute;left: 20px;"></a>
  <input placeholder="Type here and press enter" id="vl" value="<?echo htmlspecialchars($q);?>" type="text" size="40" x-webkit-speech name="q">
  <button class="sb sb-b" style="height: 29px;line-height: 29px;min-width: 54px;top: -3px;position: relative;"type="submit"><span style="background: url(//cdn.nokedo.com/images/search.png) no-repeat;display: inline-block;height: 13px;margin: 0px 19px;width: 14px;"></span></button><br /><br />
  <center><?echo'<b id="nrf" style="font-size:18px;"> results found</b>';?></center>
  </form>
 </div><script>localStorage['q']="<?echo htmlspecialchars($q);?>";localStorage['p']="<?echo$_GET['p'];?>";</script>
 <div id="results" style="margin: 5px auto;display: table;">
  <?$_POST['asfvsad']=1;$_POST['q']=$q;include('get.php');?>
 </div>
</div>
<?echo"<script>".file_get_contents('http://cdn.nokedo.com/js/search.js')."</script>";?></div>
</body></html>
