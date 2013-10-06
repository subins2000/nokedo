<?
include('config.php');
function filt($post){$post=str_replace('<','&lt;',$post);$post=str_replace('>','&gt;',$post);$post=preg_replace("/\*\*(.*?)\*\*/",'<b>$1</b>',$post);$post=preg_replace("/\*\/(.*?)\/\*/",'<i>$1</i>',$post); $post=preg_replace("/\[link\((.*?)\)\](.*?)\[\/link\]/",'<a target="_blank" href="$1">$2</a>',$post);$post=preg_replace('@((www|http://)[^ ]+)@', '<a target="_blank" href="//nokedo.com/link.php?url=\1">\1</a>', $post);$post=str_replace("\n","<br/>",$post);$post=preg_replace('@(\#[^ ]+)@','<a href="//class.nokedo.com/explore.php?hash=\1">\1</a>',$post);$post=str_replace("//class.nokedo.com/explore.php?hash=#","//class.nokedo.com/explore.php?hash=%23",$post);return$post;}
if($_POST['action']=='' || $who!=$whod){ser();}
$a=$_POST['action'];$n=$_POST['new'];$w=$_POST['wh'];$id=$_POST['id'];
if($a=='up_profile'){
 if($n=='' || ($w!='ph' && $w!='loc' && $w!='hd' && $w!='wr' && $w!='ds')){die("{error:'Something\'s wrong.'}");}
 save($w,filt($n));
 echo "{ok:'Updated Profile'}";
}
if($a=='privacyc'){
 if($w=='' || $n=='' || ($n!='prt' && $n!='pub' && $n!='fri') || ($w!='loc' && $w!='age' && $w!='mail' && $w!='phone' && $w!='wr' && $w!='ge' && $w!='bir')){ser();}
 $sql=$db->prepare("SELECT * FROM users WHERE `id`=?");
 $sql->execute(array($who));
  while($rcsdvasd=$sql->fetch()){
   $arr = json_decode($rcsdvasd['json'],true);
   $arr['privacy'][$w]=$n;
   $sql=$db->prepare("UPDATE users SET json=? WHERE `id`=?");
   $sql->execute(array(json_encode($arr),$who));
   echo "{ok:'Updated Privacy Settings'}";
  }
}
if($a=='lang'){
$w=json_decode($w,true);
 if($w=='' || ($w['HTML']!='' && $w['CSS']!='' && $w['Javascript']!='' && $w['jQuery']!='' && $w['PHP']!='' && $w['NodeJS']!='' && $w['ASP']!='' && $w['JSP']!='' && $w['VBScript']!='' && $w['SMX']!='' && $w['WebDNA']!='' && $w['Python']!='' && $w['C']!='' && $w['C#']!='' && $w['C++']!='' && $w['Java']!='' && $w['Perl']!='' && $w['Ruby']!='' && $w['SQL']!='' && $w['WebQl']!='')){die("{error:'Something\'s wrong.'}");}
 $sql=$db->prepare("SELECT * FROM users WHERE `id`=?");
 $sql->execute(array($who));
  while($rcsdvasd=$sql->fetch()){
   $arr = json_decode($rcsdvasd['json'],true);
   $arr['lang']=json_encode($w);
   $sql=$db->prepare("UPDATE users SET json=? WHERE `id`=?");
   $sql->execute(array(json_encode($arr),$who));
   echo "{ok:'Updated Privacy Settings'}";
  }
}
if($a=='like' || $a=='unlike'){
if(is_numeric($id)==false){ser();}
 $sql=$db->prepare("SELECT * FROM likes WHERE uid=? AND pid=?");
 $sql->execute(array($who,$id));
 if($sql->rowCount()==0 && $a=='like'){
  $sql=$db->prepare("UPDATE posts SET likes=likes+1 WHERE id=?;INSERT INTO likes (uid,pid)VALUES(?,?);");
  $sql->execute(array($id,$who,$id));
 }else if($a=='unlike' && $sql->rowCount()!=0){
  $sql=$db->prepare("UPDATE posts SET likes=likes-1 WHERE id=?;DELETE FROM likes WHERE uid=? AND pid=?;");
  $sql->execute(array($id,$who,$id));
 }
}
if($a=='cmt'){
if($n=='' || $id==''){ser();}
 $sql=$db->prepare("INSERT INTO cmt (uid,pid,cmt,posted) VALUES(?,?,?,NOW());UPDATE posts SET cmt=cmt+1 WHERE id=?;");
 $sql->execute(array($who,$id,filt($n),$id));
}
if($a=='dpost'){
if($id==''){ser();}
 $sql=$db->prepare("DELETE FROM posts WHERE id=? AND uid=?;DELETE FROM cmt WHERE pid=?;DELETE FROM likes WHERE pid=?");
 $sql->execute(array($id,$who,$id,$id));
}
if($a=='dcmt'){
if($id==''){ser();}
 $sql=$db->prepare("DELETE FROM cmt WHERE id=? AND uid=?;UPDATE posts SET cmt=cmt-1 WHERE id=?");
 $sql->execute(array($id,$who,$_POST['pid']));
}
if($a=='foll' || $a=='unfoll'){
if(is_numeric($id)==false || $id==$who){ser();}
 $sql=$db->prepare("SELECT * FROM fds WHERE uid=? AND fid=?");
 $sql->execute(array($who,$id));
 if($sql->rowCount()==0 && $a=='foll'){
  $sql=$db->prepare("INSERT INTO fds (uid,fid,posted)VALUES(?,?,NOW());");
  $sql->execute(array($who,$id));
  $sql=$db->prepare("SELECT * FROM fds WHERE uid=? AND fid=?");
  $sql->execute(array($id,$who));
  if($sql->rowCount()==1){
   $sql=$db->prepare("UPDATE `fds` SET fds='1' WHERE (uid=? AND fid=?) OR (uid=? AND fid=?);");
   $sql->execute(array($who,$id,$id,$who));
  }
 }else if($a=='unfoll' && $sql->rowCount()!=0){
  $sql=$db->prepare("DELETE FROM fds WHERE uid=? AND fid=?;UPDATE `fds` SET fds='0' WHERE uid=? AND fid=?;");
  $sql->execute(array($who,$id,$id,$who));
 }
}
?>
