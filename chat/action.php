<?
function filt($post){$post=str_replace('<','&lt;',$post);$post=str_replace('>','&gt;',$post);$post=preg_replace("/\*\*(.*?)\*\*/",'<b>$1</b>',$post);$post=preg_replace("/\*\/(.*?)\/\*/",'<i>$1</i>',$post); $post=preg_replace("/\[link\((.*?)\)\](.*?)\[\/link\]/",'<a target="_blank" href="$1">$2</a>',$post);$post=preg_replace('@((www|http://)[^ ]+)@', '<a target="_blank" href="//nokedo.com/link.php?url=\1">\1</a>', $post);$post=str_replace("\n","<br/>",$post);$post=preg_replace('@(\#[^ ]+)@','<a href="//class.nokedo.com/explore.php?hash=\1">\1</a>',$post);$post=str_replace("//class.nokedo.com/explore.php?hash=#","//class.nokedo.com/explore.php?hash=%23",$post);return$post;}
include('config.php');check();
$id=$_POST['id'];$msg=$_POST['msg'];$rid=$_POST['room'];
if(is_numeric($id) && $msg!=''){
$msg=filt($msg);$json='{"time":"'.date("Y-m-d H:i:s").'","ip":"'.$_SERVER['REMOTE_ADDR'].'"}';
$sql=$db->prepare("SELECT * FROM fds WHERE uid=? AND fid=? AND fds='1'");
$sql->execute(array($who,$id));
 if($sql->rowCount()==0){ser();}else{
  $sql=$db->prepare("SELECT * FROM msg WHERE (uid=? AND fid=?) OR (uid=? AND fid=?) ORDER BY id DESC LIMIT 1");
  $sql->execute(array($who,$id,$id,$who));
  while($r=$sql->fetch()){$lu=$r['uid'];$lm=$r['msg'];}
  if($lu==$who){
   $sql=$db->prepare("UPDATE msg SET msg=?,red='0' WHERE uid=? AND fid=? ORDER BY id DESC LIMIT 1");
   $sql->execute(array($lm."<br/>".$msg,$who,$id));
  }else{
   $sql=$db->prepare("INSERT INTO msg(uid,fid,msg,json)VALUES(?,?,?,?)");
   $sql->execute(array($who,$id,$msg,$json));
  }
  $sql=$db->prepare("UPDATE msg SET red='1' WHERE uid=? AND fid=?");
  $sql->execute(array($id,$who));
  $sql=$db->prepare("SELECT * FROM msg WHERE (uid=? AND fid=?) OR (uid=? AND fid=?)");
  $sql->execute(array($who,$id,$id,$who));
  while($r=$sql->fetch()){$k=json_decode($r['json'],true);
  echo "<div class='msg' id='".$r['uid']."'><a class='left' href='//class.nokedo.com/profile.php?id=".$r['uid']."'><img height='32' src='".get('imgs',$r['uid'])."'/></a><div class='right'><div class='up'><a href='//class.nokedo.com/profile.php?id=".$r['uid']."'>".un($r['uid'])['name']."</a><span class='time timeago' title='".$k['time']."'>".date_format(date_create($k['time']), 'd F 20y h:m:s')."</span></div><div class='cmsg'>".$r['msg']."</div></div></div>";
  }
 }
}elseif(is_numeric($rid) && $msg!=''){
$msg=filt($msg);$json='{"time":"'.date("Y-m-d H:i:s").'","ip":"'.$_SERVER['REMOTE_ADDR'].'"}';
 $sql=$db->prepare("SELECT * FROM rchat WHERE room=? ORDER BY id DESC LIMIT 1");
 $sql->execute(array($rid));
 while($r=$sql->fetch()){$lu=$r['uid'];$lm=$r['msg'];}
 if($lu==$who){
  $sql=$db->prepare("UPDATE rchat SET msg=? WHERE uid=? AND room=? ORDER BY id DESC LIMIT 1");
  $sql->execute(array($lm."<br/>".$msg,$who,$rid));
 }else{
  $sql=$db->prepare("INSERT INTO rchat(uid,room,msg,json)VALUES(?,?,?,?)");
  $sql->execute(array($who,$rid,$msg,$json));
 }
 $sql=$db->prepare("SELECT * FROM rchat WHERE room=?");
 $sql->execute(array($rid));
 while($r=$sql->fetch()){$k=json_decode($r['json'],true);
 echo "<div class='msg' id='".$r['uid']."'><a class='left' href='//class.nokedo.com/profile.php?id=".$r['uid']."'><img height='32' src='".get('imgs',$r['uid'])."'/></a><div class='right'><div class='up'><a href='//class.nokedo.com/profile.php?id=".$r['uid']."'>".un($r['uid'])['name']."</a><span class='time timeago' title='".$k['time']."'>".date_format(date_create($k['time']), 'd F 20y h:m:s')."</span></div><div class='cmsg'>".$r['msg']."</div></div></div>";
 }
}else{
ser();
}
?>
