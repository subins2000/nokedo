<?
include('config.php');$hsh=urldecode($_GET['hash']);$id='%hash":"'.$hsh.'"%';
$sql=$db->prepare("SELECT * FROM posts WHERE post LIKE ? ORDER BY id DESC");
$sql->execute(array("%$hsh%"));
if($hsh==''){
$sql=$db->prepare("SELECT * FROM posts WHERE json LIKE ? ORDER BY id DESC");
$sql->execute(array("%pr\":\"pub%"));
}
$npf=$sql->rowCount($sql);
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
function parse($t){global$npf;global $whod;
if($npf==0){$r='<div style="color:black;"><h2>No Posts matched with your search term.</h2></div>';return $r;}
foreach($t as $k){$wslou=$k['liked'];$id=$k['id'];$user=$k['user'];
$html.="<div class='post ".$k['ty']."' id='".$id."'><div onclick=\"$('.moptb#$id').toggle();\" class='mopt'></div><div id='$id' class='moptb'><button onclick=\"alert('http://class.nokedo.com/view.php?id=$id');\" class='sb sb-submit'>Link To This Post</button>";
if($user==$whod){
$html.='<br/><button style=\'margin-top: 10px;\' onclick="var awd= confirm(\'Do you wish to delete this post ?\');if(awd==true){$.post(\'../action.php\',{action:\'dpost\',id:\''.$id.'\'},function(data){$(\'.post#'.$id.'\').remove();}).error(function(){shown({message:\'Failed to delete post\',type:\'error\'});});}" class=\'sb sb-submit\'>Delete Post</button>';}
$html.="</div><div class='left'><img src='".get('imgs',$user)."'/><div class='bottom'><div class='$wslou' title='$wslou' id='".$id."'>".$k['likes']."</div><br/><div class='cmt' id='".$id."'>".$k['cmt']."</div></div></div><div class='right'><div class='container'><div class='info'><a href='../profile.php?id=".$k['user']."'>".un($k['user'])['name']."</a><a href='../view.php?id=".$id."' class='time timeago' title='".$k['o']['time']."'>".date_format(date_create($k['o']['time']), 'd F 20y h:m:s')."</a></div><div class='cont'>".$k['p']."</div><div class='extra' hide>".htmlspecialchars($k['p'])."</div></div><div class='comments' id='".$id."'><div class='loader' id='".$id."'>".cmts($id)."</div><form class='cmtform' id='".$id."'><input size='45' placeholder='Type your comment here' type='text'><input type='submit' class='sb sb-b' value='Comment'/></form></div></div></div>";
}
return $html;
}
?>
<!DOCTYPE html><html><head>
<script src="http://cdn.nokedo.com/js/js.php?f=class"></script>
<link href="//cdn.nokedo.com/css/all.php" rel="stylesheet">
<title>Trending on MyClass - <?echo$hsh;?></title>
</head><body>
<div id="content">
 <div class='lside'>
  <div style="padding: 8px 15px;background: rgba(0, 0, 0, 0.2);display:inline-block;">
  Most Searched:
  <div style="color:lightblue;border-right:1px solid lightgreen;padding-right:10px;margin-top:5px;">
  <?
  if($hsh!=''){
   $sql=$db->prepare("UPDATE trend SET hits=hits+1 WHERE title=?;");
   $sql->execute(array($hsh));
  }
  if($sql->rowCount()==0){
   $sql=$db->prepare("INSERT INTO trend(hits,title)VALUES('1',?);");
   $sql->execute(array($hsh)); 
  }
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
<?if($hsh!=''){?>Searching for <b><?echo$hsh;?></b> posts<br/><form style="display:table;margin:0px auto;"><input type="text" autocomplete="off" style="margin-top:-2px;" value="<?echo$hsh;?>" name="hash"/><input type="submit" style="margin-top:-2px;" value="Search"/></form>
<?if($who==$whod){?>
 <form class="postform">
  <input name="pr" id="pr" value="pub" type="hidden"/>
  <input type="file" name="img" id="upimg"/>
  <input onclick="$('.form').show();$(this).hide();" id="togform"  style="margin-top: 0px;" placeholder="Share something new on '<?echo$hsh;?>' topic" size="50" type="text"/>
  <div class="form">
  <span class="close" onclick="$('.form').hide();$('#togform').show();"></span>
  Share Something to the public :
  <textarea name="text" id="text"><?echo$hsh;?></textarea>
  <div class="bot-panel"><button type="button" class="small" onclick="$('#privacy').toggle();"></button><button type="button" class="small cam" onclick="$('#upimg').click();"></button><div id="privacy" hide><button type="button" value='pub'>Visible To Everyone</button><button type="button" value='fri'>Visible To My Friends</button><button type="button" value='meo'>Only Me</button></div>
  <input type="submit" value="Post" class="sb"/></div>
  <span style="color:red;">To make your post visible on "<?echo$hsh;?>" search, your post should have the word "<?echo$hsh;?>" atleast once.</span>
  </div>
 </form>
<?}else{echo"<a href='//nokedo.com/accounts/login.php?c=".urlencode('//class.nokedo.com/explore.php?hash='.$hsh)."'>Log In</a> to post on the topic $hsh<br/>";}}else{echo "Showing all Public posts:";}?>
  <div id="feed">
   <?echo parse($tp);?>
  </div>
 </div>
</div>
</body></html>
