<?
if(!isset($_POST['text'])){
 ser();
}
include('config.php');
check();
function filt($post){
 $post=str_replace('<','&lt;',$post);
 $post=str_replace('>','&gt;',$post);
 $post=preg_replace("/\*\*(.*?)\*\*/",'<b>$1</b>',$post);
 $post=preg_replace("/\*\/(.*?)\/\*/",'<i>$1</i>',$post);
 $post=preg_replace("/\[link\((.*?)\)\](.*?)\[\/link\]/",'<a target="_blank" href="$1">$2</a>',$post);
 $post=preg_replace('@((www|http://)[^ ]+)@', '<a target="_blank" href="//nokedo.com/link.php?url=\1">\1</a>', $post);
 $post=str_replace("\n","<br/>",$post);
 $post=preg_replace('@(\#[^ ]+)@','<a href="//class.nokedo.com/explore.php?hash=\1">\1</a>',$post);
 $post=str_replace("//class.nokedo.com/explore.php?hash=#","//class.nokedo.com/explore.php?hash=%23",$post);
 return$post;
}
$t=$_POST['text'];
$pr=$_POST['pr'];
$i=$_POST['imgs'];
if($i==''){
 if($t!='' && $pr!=''){ 
  $j='{"time":"'.date("Y-m-d H:i:s").'","pr":"'.$pr.'"}';
  $sql=$db->prepare("INSERT INTO posts(uid,post,json) VALUES(?,?,?)");
  $sql->execute(array($who,filt($t),$j));
  $sql=$db->prepare("SELECT * FROM posts WHERE uid=? ORDER BY id DESC LIMIT 1");
  $sql->execute(array($who));
  while($r=$sql->fetch()){
   $id=$r['id'];
   $time=json_decode($r['json'],true)['time'];
  }
  $cont=filt($t);
  $html.="<div class='post' id='".$id."'><div onclick=\"$('.moptb#$id').toggle();\" class='mopt'></div><div id='$id' class='moptb'><button onclick=\"alert('http://class.nokedo.com/view.php?id=$id');\" class='sb sb-submit'>Link To This Post</button>";
$html.='<br/><button style=\'margin-top: 10px;\' onclick="var awd= confirm(\'Do you wish to delete this post ?\');if(awd==true){$.post(\'http://class.nokedo.com/action.php\',{action:\'dpost\',id:\''.$id.'\'},function(data){$(\'.post#'.$id.'\').remove();}).error(function(){shown({message:\'Failed to delete post\',type:\'error\'});});}" class=\'sb sb-submit\'>Delete Post</button>';
$html.="</div><div class='left'><img src='$imgs'/><div class='bottom'><div class='like' title='like' id='".$id."'>0</div><br/><div class='cmt' id='".$id."'>0</div><br/></div></div><div class='right'><div class='container'><div class='info'><a href='//class.nokedo.com/profile.php?id=".$who."'>".$in['name']."</a><a href='//class.nokedo.com/view.php?id=".$id."' class='time timeago' title='".$time."'>".date_format(date_create($time), 'd F 20y h:m:s')."</a></div><div class='cont'>".$cont."</div><div class='extra' hide>".htmlspecialchars($cont)."</div></div><div class='comments' id='".$id."'><div class='loader' id='".$id."'><h2>No Comments</h2></div><form class='cmtform' id='".$id."'><input size='45' placeholder='Type your comment here' type='text'><input type='submit' class='sb sb-b' value='Comment'/></form></div></div></div>";
  echo $html;
 }else{ser();}
}elseif($pr!=''){
    $filename = $_FILES['img']['tmp_name'];
    $handle = fopen($filename, "r");
    $data = fread($handle, filesize($filename));
    $pvars   = array('input'=>base64_encode($data),'type'=>'postimg','auth'=>md5(md5(md5('dataofusersinnokedo'))),'user'=>$who,'whod'=>$_COOKIE['wervsi']);
    $curl    = curl_init();
    curl_setopt($curl, CURLOPT_URL, 'http://usercontent.nokedo.com/handle.php');
    curl_setopt($curl, CURLOPT_TIMEOUT, 30);
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $pvars);
    $xml = curl_exec($curl);
    curl_close ($curl);
    $params = json_decode($xml,true);
 if($params['ok']!=''){
  $j='{"time":"'.date("Y-m-d H:i:s").'","pr":"'.$pr.'"}';
  $cont=filt($t).'<img class="postimg" src="'.$params['url'].'" />';
  $sql=$db->prepare("INSERT INTO posts(uid,post,json) VALUES(?,?,?)");
  $sql->execute(array($who,$cont,$j));
  $sql=$db->prepare("SELECT * FROM posts WHERE uid=? ORDER BY id DESC LIMIT 1");
  $sql->execute(array($who));
  while($r=$sql->fetch()){
   $id=$r['id'];
   $time=json_decode($r['json'],true)['time'];
  }
  $html.="<div class='post' id='".$id."'><div onclick=\"$('.moptb#$id').toggle();\" class='mopt'></div><div id='$id' class='moptb'><button onclick=\"alert('http://class.nokedo.com/view.php?id=$id');\" class='sb sb-submit'>Link To This Post</button>";
  $html.='<br/><button style=\'margin-top: 10px;\' onclick="var awd= confirm(\'Do you wish to delete this post ?\');if(awd==true){$.post(\'http://class.nokedo.com/\',{action:\'dpost\',id:\''.$id.'\'},function(data){$(\'.post#'.$id.'\').remove();}).error(function(){shown({message:\'Failed to delete post\',type:\'error\'});});}" class=\'sb sb-submit\'>Delete Post</button>';
  $html.="</div><div class='left'><img src='$imgs'/><div class='bottom'><div class='like' title='like' id='".$id."'>0</div><br/><div class='cmt' id='".$id."'>0</div></div></div><div class='right'><div class='container'><div class='info'><a href='//class.nokedo.com/profile.php?id=".$who."'>".$in['name']."</a><a href='//class.nokedo.com/view.php?id=".$id."' class='time timeago' title='".$time."'>".date_format(date_create($time), 'd F 20y h:m:s')."</a></div><div class='cont'>".$cont."</div><div class='extra' hide>".htmlspecialchars($cont)."</div></div><div class='comments' id='".$id."'><div class='loader' id='".$id."'><h2>No Comments</h2></div><form class='cmtform' id='".$id."'><input size='45' placeholder='Type your comment here' type='text'><input type='submit' class='sb sb-b' value='Comment'/></form></div></div></div>";
echo $html;
 }
}
?>
