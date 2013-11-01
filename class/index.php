<!DOCTYPE html><html><head>
<?include('config.php');check();?>
<link href="//cdn.nokedo.com/css/all.php" rel="stylesheet">
<script src="http://cdn.nokedo.com/js/js.php?f=class"></script>
<title>MyClass - A Social Network</title>
</head><body>
<div id="content">
 <div class='lside'>
  <div style="padding: 8px 15px;background: rgba(0, 0, 0, 0.2);display:inline-block;">
   Trending :
   <div style="color:lightblue;border-right:1px solid lightgreen;padding-right:10px;margin-top:5px;">
   <?
   foreach($db->query("SELECT * FROM trend ORDER BY hits DESC LIMIT 9") as $r){
    $cn++;
    echo '<span style="margin-right:10px;color:black;">'.$cn.'</span><a href="explore.php?hash='.urlencode($r['title']).'" style="color:white;">'.$r['title'].'</a><div style="margin-top:5px;"></div>';
   }
   $db->query("DELETE FROM trend WHERE hits=(SELECT MIN(hits) FROM (SELECT * FROM trend HAVING COUNT(hits)>15) x);");
   ?>
   </div>
  </div>
 </div>
 <div class='rside'>
  <form class="postform">
   <input name="pr" id="pr" value="pub" type="hidden"/>
   <input type="file" name="img" onchange="$('.cam').css('background-color','rgb(214, 179, 133)').attr('title','Image Chosen');" id="upimg"/>
   <input onclick="$('.form').show();$(this).hide();" id="togform" placeholder="Share something new !" size="50" type="text"/>
   <div class="form">
    <span class="close" onclick="$('.form').hide();$('#togform').show();"></span>
    Share Something to your friends :
    <textarea name="text" id="text"></textarea>
    <div class="bot-panel"><button type="button" class="small" onclick="$('#privacy').toggle();"></button><button type="button" class="small cam" onclick="$('#upimg').click();"></button><div id="privacy" hide><button type="button" value='pub'>Visible To Everyone</button><button type="button" value='fri'>Visible To My Friends</button><button type="button" value='meo'>Only Me</button></div>
    <input type="submit" value="Post" class="sb"/></div>
   </div>
   </form><br/>
   <div id="feed">
    <?$_GET['awregvawegb']=1;include('data.php');?>
   </div>
   <div id="last_msg_loader" style="text-align: center;height:30px;background:#EEE;width: 100%;margin-top: 1em;border-radius: 10px;border:2px solid black;"><img title="Loading more Posts.." src="//cdn.nokedo.com/images/load.gif" height="30" /></div>
 </div>
</div>
</body></html>
