<?
if(!isset($_POST) && !isset($_GET['awregvawegb'])){header("HTTP/1.0 404 Not Found");include('primary.php');exit;}
$k=0;if(isset($_POST['data'])){include('config.php');}$type=$_POST['type'];
function cmts($i){
 global $db;
 global $who;
 global $whod;
 $sql=$db->prepare("SELECT * FROM cmt WHERE pid=? ORDER BY posted ASC LIMIT 2");
 $sql->execute(array($i));
 while($r=$sql->fetch()){
  $id=$r['id'];
  $cmts.="<div class='comment' id='".$r['id']."'>";
  if($r['uid']==$whod){
   $cmts.='<div onclick="$(\'.coptb#'.$id.'\').toggle();" class="copt"></div><div id="'.$id.'" class="coptb"><button onclick="var awd=confirm(\'Do you wish to delete this comment ?\');if(awd==true){$.post(\'../action.php\',{action:\'dcmt\',id:\''.$id.'\',pid:\''.$i.'\'},function(data){$(\'.comment#'.$id.'\').remove();}).error(function(){shown({message:\'Failed to delete comment\',type:\'error\'});});}" class=\'sb sb-submit\'>Delete Comment</button></div>';
  }
   $cmts.="<div class='left'><img height='32' width='32' src='".get('imgs',$r['uid'])."'/></div><div class='right'><div class='info'><a class='uname' href='../profile.php?id=".$r['uid']."'>".un($r['uid'])['name']."</a><span class='time timeago' title='".$r['posted']."'>".date_format(date_create($r['posted']), 'd F 20y h:m:s')."</span></div><div class='cont'>".$r['cmt']."</div></div></div>";
 }
 $sql=$db->prepare("SELECT * FROM cmt WHERE pid=? ORDER BY posted ASC");
 $sql->execute(array($i));
 if($sql->rowCount()>2){
  $cmts.="<a class='lmc' id='$i'>Load More Comments</a>";
 }
 if($sql->rowCount()==0){
  return '<h2>No Comments</h2>';
 }else{
  return $cmts;
 }
}
if(isset($_GET['awregvawegb']) || isset($_POST['data'])){
 if($whod==$who || $_POST['user']!=''){
  if($_POST['ex']!='' && $type!=''){
   $sql=$db->prepare("SELECT * FROM posts WHERE id < :ex AND (uid=:who OR uid IN (SELECT fid FROM fds WHERE uid=:who)) AND ty=:ty ORDER BY id DESC LIMIT 5");
   $sql->execute(array(":who"=>$who,":ex"=>$_POST['ex'],":ty"=>$type));
  }elseif($_POST['ex']!='' && $_POST['uid']!=''){
   $sql=$db->prepare("SELECT * FROM posts WHERE id < :ex AND (ty='nor' OR ty='pro') AND uid=:who ORDER BY id DESC LIMIT 5");
   $sql->execute(array(":who"=>$_POST['uid'],":ex"=>$_POST['ex']));
  }elseif($_POST['ex']!=''){
   $sql=$db->prepare("SELECT * FROM posts WHERE id < :ex AND (ty='nor' OR ty='pro') AND (uid=:who OR uid IN (SELECT fid FROM fds WHERE uid=:who)) ORDER BY id DESC LIMIT 5");
   $sql->execute(array(":who"=>$who,":ex"=>$_POST['ex']));
  }elseif($type!=''){
   $sql=$db->prepare("SELECT * FROM posts WHERE ty=:ty AND (uid=:who OR uid IN (SELECT fid FROM fds WHERE uid=:who)) ORDER BY id DESC LIMIT 5");
   $sql->execute(array(":who"=>$who,":ty"=>$type));
  }elseif($_POST['user']!=''){
   $sql=$db->prepare("SELECT * FROM posts WHERE uid=:id AND (json LIKE '%pub%' OR (json LIKE '%fri%' AND uid IN (SELECT fid FROM fds WHERE uid=:who AND fid=:id AND fds='1'))) ORDER BY id DESC LIMIT 5");
   $sql->execute(array(":id"=>$_POST['user'],":who"=>$who));
  }elseif($_POST['nor']!=''){
   $sql=$db->prepare("SELECT * FROM posts WHERE uid=:who AND (ty='nor' OR ty='pro') OR uid IN (SELECT fid FROM fds WHERE uid=:who) AND (json LIKE '%pub%' OR (json LIKE '%fri%' AND uid IN (SELECT fid FROM fds WHERE uid=:who AND fds='1'))) ORDER BY id DESC LIMIT 5");
   $sql->execute(array(":who"=>$who));
  }else{
   $sql=$db->prepare("SELECT * FROM posts WHERE uid=:who OR uid IN (SELECT fid FROM fds WHERE uid=:who) AND (json LIKE '%pub%' OR (json LIKE '%fri%' AND uid IN (SELECT fid FROM fds WHERE uid=:who AND fds='1'))) ORDER BY id DESC LIMIT 5");
   $sql->execute(array(":who"=>$who));
  }
  $tp=array();
  while($r=$sql->fetch()){
   $tp[$k]['id']=$r['id'];
   $tp[$k]['user']=$r['uid'];
   $tp[$k]['p']=$r['post'];
   $tp[$k]['o']=json_decode($r['json'],true);
   $tp[$k]['likes']=$r['likes'];
   $tp[$k]['cmt']=$r['cmt'];
   $tp[$k]['liked']=$plikes[$r['id']];
   $tp[$k]['ty']=$r['ty'];
   $tp[$k]['prs']=str_replace('pub','Public',str_replace('meo','Only Me',str_replace('fri','Friends',$tp[$k]['o']['pr'])));
   $tp[$k]['pr']=str_replace('pub','Everyone can see this post',str_replace('meo','Only You can see this post',str_replace('fri','Only your Friends can see this post',$tp[$k]['o']['pr'])));
   if($tp[$k]['liked']=='yes'){$tp[$k]['liked']='unlike';}else{$tp[$k]['liked']='like';}
   $k++;
  }
  echo parse($tp);
 }
}
function parse($t){global$sql;global $whod;
if($sql->rowCount()==0){$r.='<div style="color:black;"><h2>No Posts to show</h2></div>';if($_POST['user']==''){$r.='<div style="color:black;">Try <a href="../find.php">Adding someone</a><br/><br/>Or <a href="../explore.php">See all the public posts</a><br/><br/></div>';}return $r;}
foreach($t as $k){$wslou=$k['liked'];$id=$k['id'];$user=$k['user'];
$html.="<div class='post ".$k['ty']."' id='".$id."'><div onclick=\"$('.moptb#$id').toggle();\" class='mopt'></div><div id='$id' class='moptb'><button onclick=\"alert('http://class.nokedo.com/view.php?id=$id');\" class='sb sb-submit'>Link To This Post</button>";
if($user==$whod){
$html.='<br/><button style=\'margin-top: 10px;\' onclick="var awd= confirm(\'Do you wish to delete this post ?\');if(awd==true){$.post(\'../action.php\',{action:\'dpost\',id:\''.$id.'\'},function(data){$(\'.post#'.$id.'\').remove();}).error(function(){shown({message:\'Failed to delete post\',type:\'error\'});});}" class=\'sb sb-submit\'>Delete Post</button>';}
$html.="</div><div class='left'><img src='".get('imgs',$user)."'/><div class='bottom'><div class='$wslou' title='$wslou' id='".$id."'>".$k['likes']."</div><br/><div class='cmt' id='".$id."'>".$k['cmt']."</div></div></div><div class='right'><div class='container'><div class='info'><a href='../profile.php?id=".$k['user']."'>".un($k['user'])['name']."</a><a href='../view.php?id=".$id."'><span class='time timeago' title='".$k['o']['time']."'>".date_format(date_create($k['o']['time']), 'd F 20y h:m:s')."</span>&nbsp;&nbsp;&nbsp;<span style='color:gray;' title='".$k['pr']."'>".$k['prs']."</span></a></div><div class='cont'>".$k['p']."</div><div class='extra' hide>".htmlspecialchars($k['p'])."</div></div><div class='comments' id='".$id."'><div class='loader' id='".$id."'>".cmts($id)."</div><form class='cmtform' id='".$id."'><input style='width:70%;' placeholder='Type your comment here' type='text'><input type='submit' style='margin-top: 6px;' class='sb sb-b' value='Comment'/></form></div></div></div>";
}
return $html;
}
?>
