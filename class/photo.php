<?include('config.php');$id=$_GET['id'];
$sql=$db->prepare("SELECT * FROM posts WHERE id=?");
$sql->execute(array($id));
if($sql->rowCount()==0){ser();}
while($r=$sql->fetch()){
 $img=preg_match('/\<img class=\"postimg\" src=\"(.*?)\"/',$r['post'],$ms);
 $img=$ms[1];
 $user=$r['uid'];
 $time=json_decode($r['json'],true)['time'];
 $pr=str_replace('pub','Public',str_replace('meo','Private',str_replace('fri','Friends',json_decode($r['json'],true)['pr'])));
 $ty=str_replace('nor','Normal',str_replace('mil','Milestone',str_replace('pro','Promote',str_replace('dis','Discussion',$r['ty']))));
 $lk=$r['likes'];
 $cmt=$r['cmt'];
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
if(strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){?>
<div class="photo">
 <div class="phleft" style="vertical-align: middle;"><img style="display: table;max-height: 1368px;max-width: 768px;overflow:auto;margin:0px auto;" src="<?echo$img;?>"/></div>
 <div class="phright">
  <div class="upper" style="white-space: nowrap;border-bottom:1px solid #ccc;padding-bottom:10px;">
   <img style="vertical-align: middle;" height="80" width="80" src="<?echo get('imgs',$user);?>"/>
   <div style="vertical-align:top;display: inline-block;">
    <a href="../profile.php?id=<?echo$user;?>" class="uname" title="<?echo un($user)['name'];?>"><?echo un($user)['name'];?></a>
    <a href="../view.php?id=<?echo$id;?>" class="timeago" title="<?echo $time;?>" style="color:gray;margin-top:5px;display:block;"><?echo date_format(date_create($time), 'd F 20y h:m:s');?></a>
    <a href="../view.php?id=<?echo$id;?>" style="background: url(//cdn.nokedo.com/images/web.png) no-repeat left;color: gray;margin-top: 5px;display: block;padding-left: 17px;background-size: 15px;" title="Visible to"><?echo $pr;?></a>
    <a href="../view.php?id=<?echo$id;?>" style="color: gray;margin-top: 5px;display: block;" title="Post Type"><?echo $ty;?></a>
   </div>
  </div>
  <div class="bottom">
   <div style="display: table;margin:0px auto;"><div class="<?if($plikes[$id]=='yes'){echo'unlike';}else{echo'like';}?>" id="<?echo$id;?>"><?echo$lk;?></div>&nbsp;&nbsp;&nbsp;<div class="cmt" id="<?echo$id;?>"><?echo$cmt;?></div></div>
   <div class='comments' style="border-top:1px solid #CCC;margin-top:5px;display:block;" id="<?echo$id?>"><div class='loader' id="<?echo$id?>"><?echo cmts($id)?></div><form class='cmtform' id="<?echo$id;?>"><input placeholder="Type your comment here" type='text'><input type='submit' class="sb sb-b" value='Comment' /></form></div>
  </div>
 </div>
</div>
<?}else{?>
<!DOCTYPE html><html><head>

</head><body>

</body></html>
<?}?>
