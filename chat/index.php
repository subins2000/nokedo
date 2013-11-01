<!DOCTYPE html><html><head>
<?
include('config.php');
check();
$id=$_GET['id'];
if($id!=""){
 $sql=$db->prepare("SELECT * FROM fds WHERE uid=? AND fid=? AND fds='1'");
 $sql->execute(array($who,$id));
 if($sql->rowCount()==0){
  ser();
 }
}
?>
<script src="http://cdn.nokedo.com/js/js.php?f=chat"></script>
<link href="//cdn.nokedo.com/css/all.php" rel="stylesheet">
<title>Nokedo Chat</title>
</head><body>
<div id="content" style="display: table;">
 <div style='display:table-cell;'>
  <div class="users">
  Chat With:<br/>
  <div class="with">
   <?
   $sql=$db->prepare("SELECT * FROM fds WHERE uid=? AND fds='1'");
   $sql->execute(array($who));
   while($rs=$sql->fetch()){
    $sqls=$db->prepare("SELECT * FROM users WHERE id=? ORDER BY `stat`");
    $sqls->execute(array($rs['fid']));
    while($r=$sqls->fetch()){
     echo "<button onclick=\"window.location='http://chat.nokedo.com/users/".$r['id']."';\" class='sb sb-chat";
     if($r['stat']<date('Y-m-d G:i:s',strtotime('- 15 seconds'))){}else{echo " sb-g";}
     echo "' id='".$r['id']."'>".$r['name']."</button>";
    }
   }
   ?>
  </div>
  <script>if($(".users .sb-g").length!=0 && $(".users .sb").length>1){$(".users .sb-g").each(function(){if($(this).is(':not(:first-child)')==true){$(".users .sb:first").before($(this)[0]);}});}</script>
 </div><br/>
 <div class='rooms'>
  Public Rooms :<br/>
  <?
  $sql=$db->query("SELECT * FROM rooms");
  while($r=$sql->fetch()){
   echo "<button onclick=\"window.location='http://chat.nokedo.com/rooms/".$r['id']."';\" class='sb sb-chat'>{$r['title']}</button>";
  }
  ?>
  </div>
 </div>
 <div class="messages">
  <?if(is_numeric($id)){?>
  <h2>Messages - <a href="//class.nokedo.com/profile.php?id=<?echo$id;?>" target="_blank"><?echo un($id)['name'];?></a></h2>
  <?}?>
  <div class="msgbox">
   <?
   if(!is_numeric($id)){echo "<h2>Choose A User</h2>";$v=false;}else{
   $sql=$db->prepare("UPDATE msg SET red='1' WHERE uid=? AND fid=?");
   $sql->execute(array($id,$who));
   $sql=$db->prepare("SELECT * FROM msg WHERE (uid=? AND fid=?) OR (uid=? AND fid=?)");
   $sql->execute(array($who,$id,$id,$who));
   while($r=$sql->fetch()){
   $k=json_decode($r['json'],true);
   echo "<div class='msg' id='".$r['uid']."'><a class='left' href='//class.nokedo.com/profile.php?id=".$r['uid']."'><img height='32' src='".get('imgs',$r['uid'])."'/></a><div class='right'><div class='up'><a href='//class.nokedo.com/profile.php?id=".$r['uid']."'>".un($r['uid'])['name']."</a><span class='time timeago' title='".$k['time']."'>".date_format(date_create($k['time']), 'd F 20y h:m:s')."</span></div><div class='cmsg'>".$r['msg']."</div></div></div>";
   }
   if($sql->rowCount()==0){echo "<h2>No Messages</h2>";}
   $v=true;
   }
   ?>
  </div>
  <?if($v){?>
  <form class="msgform">
   <input type="text" style="width:80%;display:table-cell;" name="msg" autocomplete="off" placeholder="Type Message Here and Hit Enter"/>
   <input type="hidden" name="id" value="<?echo$id;?>"/>
   <input type="submit" style="display:table-cell;margin:2px;" name="submit" value="Send"/>
  </form><br/>
  <?}?>
 </div>
</div>
</body></html>
