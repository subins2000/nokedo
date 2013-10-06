<!DOCTYPE html><html><head>
<link href="css/all.php" rel="stylesheet"><script src="//cdn.nokedo.com/js/jquery.js"></script><script src="//cdn.nokedo.com/js/ac.js"></script>
</head><body>
<div id="content">
 <div id="search">
  <center><a href="//nokedo.com"><h1 style="color:green;">Nokedo</h1></a></center>
  <form id="vlform" action="search.php">
  <input type="hidden" value="1" name="p">
  <input id="vl" type="text" size="35" name="q"><input type="button" value="Search">
  </form>
 </div>
</div>
<script type="text/javascript">
$(document).ready(function() {$("#vl").autocomplete("livesearch.php", {width: $("#vl").width(),matchContains: true,selectFirst: false});	
$(".ac_results ul li").live('click',function(){var qtitle = $(this).attr('id');$('#vl').val(qtitle);$("#vlform").submit();});});
</script>
</body></html>
