<?
header("content-type: application/x-javascript");
function filt($post){$post=str_replace('<','&lt;',$post);$post=str_replace('>','&gt;',$post);$post=preg_replace("/\*\*(.*?)\*\*/",'<b>$1</b>',$post);$post=preg_replace("/\*\/(.*?)\/\*/",'<i>$1</i>',$post); $post=preg_replace("/\[link\((.*?)\)\](.*?)\[\/link\]/",'<a target="_blank" href="$1">$2</a>',$post);$post=preg_replace('@((www|http://)[^ ]+)@', '<a target="_blank" href="//nokedo.com/link.php?url=\1">\1</a>', $post);$post=str_replace("\n","<br/>",$post);$post=preg_replace('@(\#[^ ]+)@','<a href="//class.nokedo.com/explore.php?hash=\1">\1</a>',$post);$post=str_replace("//class.nokedo.com/explore.php?hash=#","//class.nokedo.com/explore.php?hash=%23",$post);return$post;}
include('config.php');
$id=$_POST['id'];$msg=str_replace('<br>','<br/>',$_POST['msg']);
if(is_numeric($id) && $_POST['r']!=true && $msg!=''){
 $sql=$db->prepare("SELECT * FROM msg WHERE (uid=? AND fid=?) OR (uid=? AND fid=?) ORDER BY id DESC LIMIT 1");
 $sql->execute(array($who,$id,$id,$who));
 while($r=$sql->fetch()){$t=$r['msg'];}
 if($t!=$msg){
  $sql=$db->prepare("UPDATE msg SET red='1' WHERE uid=? AND fid=?");
  $sql->execute(array($id,$who));
  $sql=$db->prepare("SELECT * FROM msg WHERE (uid=? AND fid=?) OR (uid=? AND fid=?)");
  $sql->execute(array($who,$id,$id,$who));
  echo "if($(\".msgform\").find('input[type=hidden]').val()!='' && $(\".msgbox .msg:last\").find('.cmsg').length!=0){ $(\".msgbox\").html(\"";
  while($r=$sql->fetch()){$k=json_decode($r['json'],true);
  echo "<div class='msg' id='".$r['uid']."'><a class='left' href='//class.nokedo.com/profile.php?id=".$r['uid']."'><img height='32' src='".get('imgs',$r['uid'])."'/></a><div class='right'><div class='up'><a href='//class.nokedo.com/profile.php?id=".$r['uid']."'>".un($r['uid'])['name']."</a><span class='time timeago' title='".$k['time']."'>".date_format(date_create($k['time']), 'd F 20y h:m:s')."</span></div><div class='cmsg'>".$r['msg']."</div></div></div>";
  }
  echo "\");}";
 }
 $sql=$db->prepare("SELECT * FROM fds WHERE uid=? AND fds='1'");
 $sql->execute(array($who));
 echo "$(\".users\").html('Chat With:<br/>";
 while($rs=$sql->fetch()){
  $sqls=$db->prepare("SELECT * FROM users WHERE id=? ORDER BY `stat`");
  $sqls->execute(array($rs['fid']));
  while($r=$sqls->fetch()){
   echo "<button onclick=\"window.location=\'index.php?id=".$r['id']."\';\" class=\"sb sb-chat";
   if($r['stat']<date('Y-m-d G:i:s',strtotime('- 15 seconds'))){}else{echo " sb-g";}
   echo "\" id=\"".$r['id']."\">".$r['name']."</button>";
  }
 }
 echo "');";
 echo 'if($(".users .sb-g").length!=0 && $(".users .sb").length>1){$(".users .sb-g").each(function(){if($(this).is(":not(:first-child)")==false){$(".users .sb:first").before($(this)[0]);}});}';
}elseif(is_numeric($id) && $_POST['r']==true && $msg!=''){
 $sql=$db->prepare("SELECT * FROM rchat WHERE room=? ORDER BY id DESC LIMIT 1");
 $sql->execute(array($id));
 while($r=$sql->fetch()){$t=$r['msg'];}
 if($t!=$msg){
  $sql=$db->prepare("SELECT * FROM rchat WHERE room=?");
  $sql->execute(array($id));
  echo "if($(\".msgform\").find('input[type=hidden]').val()!='' && $(\".msgbox .msg:last\").find('.cmsg').length!=0){ $(\".msgbox\").html(\"";
  while($r=$sql->fetch()){$k=json_decode($r['json'],true);
  echo "<div class='msg' id='".$r['uid']."'><a class='left' href='//class.nokedo.com/profile.php?id=".$r['uid']."'><img height='32' src='".get('imgs',$r['uid'])."'/></a><div class='right'><div class='up'><a href='//class.nokedo.com/profile.php?id=".$r['uid']."'>".un($r['uid'])['name']."</a><span class='time timeago' title='".$k['time']."'>".date_format(date_create($k['time']), 'd F 20y h:m:s')."</span></div><div class='cmsg'>".$r['msg']."</div></div></div>";
  }
  echo "\");}scchat();";
 }
 $sql=$db->prepare("SELECT * FROM fds WHERE uid=? AND fds='1'");
 $sql->execute(array($who));
 echo "$(\".users\").html('Chat With:<br/>";
 while($rs=$sql->fetch()){
  $sqls=$db->prepare("SELECT * FROM users WHERE id=? ORDER BY `stat`");
  $sqls->execute(array($rs['fid']));
  while($r=$sqls->fetch()){
   echo "<button onclick=\"window.location=\'index.php?id=".$r['id']."\';\" class=\"sb sb-chat";
   if($r['stat']<date('Y-m-d G:i:s',strtotime('- 15 seconds'))){}else{echo " sb-g";}
   echo "\" id=\"".$r['id']."\">".$r['name']."</button>";
  }
 }
 echo "');";
 echo 'if($(".users .sb-g").length!=0 && $(".users .sb").length>1){$(".users .sb-g").each(function(){if($(this).is(":not(:first-child)")==false){$(".users .sb:first").before($(this)[0]);}});}';
}else{
header("content-type: text/html");
ser();
}
?>
