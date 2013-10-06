<!DOCTYPE html><html><head>
<?include('../config.php');check();?>
<link href="//cdn.nokedo.com/css/all.php" rel="stylesheet">
<script src="http://cdn.nokedo.com/js/js.php?f=class"></script>
<title>MyClass - A Social networking site for programmers and Normal people</title>
</head><body>
<div id="content">
 <div class='lside'>
  <div style="left: 0px;padding: 8px 15px;background: rgba(0, 0, 0, 0.2);border-top-right-radius: 10px;" id="tgfeed"><button class="sb" style="width: 100%;">Normal Posts</button><br/><button class="sb sb-g" style="width: 100%;">Milestones</button><br/><button class="sb sb-b" style="width: 100%;">Promotes</button><br/><button class="sb sb-red" style="width: 100%;">Discussions</button><br/><center><a href="//class.nokedo.com/pro">Dev Network</a><br/><a href="//class.nokedo.com/nor">Nor Network</a></center>
 <d clear/>
  Trending :
  <div style="color:lightblue;padding-right:10px;margin-top:5px;">
  <?
  foreach($db->query("SELECT * FROM trend ORDER BY hits DESC LIMIT 9") as $r){
   $cn++;
   echo '<span style="margin-right:10px;color:black;">'.$cn.'</span><a href="../explore.php?hash='.urlencode($r['title']).'" style="color:white;">'.$r['title'].'</a><div style="margin-top:5px;"></div>';
  }
  $db->query("DELETE FROM trend WHERE hits=(SELECT MIN(hits) FROM (SELECT * FROM trend HAVING COUNT(hits)>15) x);");
  ?>
  </div>
 </div>
 </div>
 <div class='rside'>
 <script>localStorage['ps']='nor';</script>
 <form class="postform">
  <input name="pr" id="pr" value="pub" type="hidden"/>
  <input type="file" name="img" id="upimg"/>
  <input onclick="$('.form').show();$(this).hide();" id="togform" placeholder="Share something new !" size="50" type="text"/>
  <div class="form">
  <span class="close" onclick="$('.form').hide();$('#togform').show();"></span>
  <table id="switcher"><tbody><tr><td><button type="button" class="sb">Normal</button></td><td><button type="button" class="sb sb-g">Milestone</button></td><td><button type="button" class="sb sb-b">Promote your site</button></td><td><button type="button" class="sb sb-red">Discuss</button></td></tr></tbody></table>
  <textarea name="text" id="text"></textarea>
  <div class="bot-panel"><button type="button" class="small" onclick="$('#privacy').toggle();"></button><button type="button" class="small cam" onclick="$('#upimg').click();"></button><div id="privacy" hide><button type="button" value='pub'>Visible to everyone</button><button type="button" value='fri'>Visible To my friends</button><button type="button" value='meo'>Only Me</button></div>
  <input type="submit" value="Post" class="sb"/></div>
  </div>
 </form><br/>
 <div id="feed">
  <?$_GET['awregvawegb']=1;$_GET['parse']='';include('../data.php');?>
 </div>
 <div id="last_msg_loader" style="text-align: center;height:30px;background:#EEE;width: 100%;margin-top: 1em;border-radius: 10px;border:2px solid black;"><img title="Loading more Posts.." src="//cdn.nokedo.com/images/load.gif" height="30" /></div>
 </div>
</div>
</body></html>
