<?
include('config.php');$id=$_GET['id'];
$sql=$db->prepare("SELECT * FROM posts WHERE id=:id AND (uid IN (SELECT fid FROM fds WHERE uid=:who) AND (uid!=:who AND json NOT LIKE '%meo%') OR (json LIKE '%pub%' OR (json LIKE '%fri%' AND uid IN (SELECT fid FROM fds WHERE uid=:who AND fds='1'))))");
$sql->execute(array(":who"=>$who,":id"=>$id));
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
function cmts($i){global $db;global$who;global$whod;$sql=$db->prepare("SELECT * FROM cmt WHERE pid=? ORDER BY posted ASC");$sql->execute(array($i));
while($r=$sql->fetch()){$id=$r['id'];
 $cmts.="<div class='comment' id='".$r['id']."'>";
if($r['uid']==$whod){
$cmts.='<div onclick="$(\'.coptb#'.$id.'\').toggle();" class="copt"></div><div id="'.$id.'" class="coptb"><button onclick="var awd=confirm(\'Do you wish to delete this comment ?\');if(awd==true){$.post(\'../action.php\',{action:\'dcmt\',id:\''.$id.'\',pid:\''.$i.'\'},function(data){$(\'.comment#'.$id.'\').remove();}).error(function(){shown({message:\'Failed to delete comment\',type:\'error\'});});}" class=\'sb sb-submit\'>Delete Comment</button></div>';}
$cmts.="<div class='left'><img height='32' width='32' src='".get('imgs',$r['uid'])."'/></div><div class='right'><div class='info'><a class='uname' href='../profile.php?id=".$r['uid']."'>".un($r['uid'])['name']."</a><span class='time timeago' title='".$r['posted']."'>".date_format(date_create($r['posted']), 'd F 20y h:m:s')."</span></div><div class='cont'>".$r['cmt']."</div></div></div>";
}
if($sql->rowCount($sql)==0){return '<h2>No Comments</h2>';}else{return $cmts;}
}
function parse($t){global$sql;global $whod;
if($sql->rowCount()==0){$r.='<div style="color:black;"><h2>No Posts to show</h2></div>';if($_POST['user']==''){$r.='<div style="color:black;">Try <a href="../find.php">Adding someone</a><br/><br/>Or <a href="../explore.php">See all the public posts</a><br/><br/></div>';}return $r;}
foreach($t as $k){$wslou=$k['liked'];$id=$k['id'];$user=$k['user'];
$html.="<div class='post ".$k['ty']."' id='".$id."'><div onclick=\"$('.moptb#$id').toggle();\" class='mopt'></div><div id='$id' class='moptb'><button onclick=\"alert('http://class.nokedo.com/view.php?id=$id');\" class='sb sb-submit'>Link To This Post</button>";
if($user==$whod){
$html.='<br/><button style=\'margin-top: 10px;\' onclick="var awd= confirm(\'Do you wish to delete this post ?\');if(awd==true){$.post(\'../action.php\',{action:\'dpost\',id:\''.$id.'\'},function(data){$(\'.post#'.$id.'\').remove();}).error(function(){shown({message:\'Failed to delete post\',type:\'error\'});});}" class=\'sb sb-submit\'>Delete Post</button>';}
$html.="</div><div class='left'><img src='".get('imgs',$user)."'/><div class='bottom'><div class='$wslou' title='$wslou' id='".$id."'>".$k['likes']."</div><br/><div class='cmt' id='".$id."'>".$k['cmt']."</div></div></div><div class='right'><div class='container'><div class='info'><a href='../profile.php?id=".$k['user']."'>".un($k['user'])['name']."</a><a href='../view.php?id=".$id."'><span class='time timeago' title='".$k['o']['time']."'>".date_format(date_create($k['o']['time']), 'd F 20y h:m:s')."</span>&nbsp;&nbsp;&nbsp;<span style='color:gray;' title='".$k['pr']."'>".$k['prs']."</span></a></div><div class='cont'>".$k['p']."</div><div class='extra' hide>".htmlspecialchars($k['p'])."</div></div><div class='comments' id='".$id."'><div class='loader' id='".$id."'>".cmts($id)."</div><form class='cmtform' id='".$id."'><input size='45' placeholder='Type your comment here' type='text'><input type='submit' class='sb sb-b' value='Comment'/></form></div></div></div>";
}
return $html;
}
?>
<!DOCTYPE html><html><head>
<script src="http://cdn.nokedo.com/js/js.php?f=class"></script>
<link href="//cdn.nokedo.com/css/all.php" rel="stylesheet">
<title><?echo$tp[$id]['user'];?></title>
</head><body>
<div id="feed" style="margin:5% auto;max-width:500px;">
 <?echo parse($tp);?>
</div>
</body></html>
