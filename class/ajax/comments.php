<?
include("../config.php");check();
$pid=$_POST['id'];
$l  =$_POST['limit'];
if($pid!='' && $l!=''){
 $cmts="";
 $db->setAttribute( PDO::ATTR_EMULATE_PREPARES, false );
 $sql=$db->prepare("SELECT * FROM cmt WHERE pid=? ORDER BY posted ASC LIMIT ?");
 $sql->execute(array($pid,$l));
 while($r=$sql->fetch()){
  $id=$r['id'];
  $cmts.="<div class='comment' id='".$r['id']."'>";
  if($r['uid']==$whod){
   $cmts.='<div onclick="$(\'.coptb#'.$id.'\').toggle();" class="copt"></div><div id="'.$id.'" class="coptb"><button onclick="var awd=confirm(\'Do you wish to delete this comment ?\');if(awd==true){$.post(\'../action.php\',{action:\'dcmt\',id:\''.$id.'\',pid:\''.$i.'\'},function(data){$(\'.comment#'.$id.'\').remove();}).error(function(){shown({message:\'Failed to delete comment\',type:\'error\'});});}" class=\'sb sb-submit\'>Delete Comment</button></div>';
  }
  $cmts.="<div class='left'><img height='32' width='32' src='".get('imgs',$r['uid'])."'/></div><div class='right'><div class='info'><a class='uname' href='../profile.php?id=".$r['uid']."'>".un($r['uid'])['name']."</a><span class='time timeago' title='".$r['posted']."'>".date_format(date_create($r['posted']), 'd F 20y h:m:s')."</span></div><div class='cont'>".$r['cmt']."</div></div></div>";
 }
 $sql=$db->prepare("SELECT * FROM cmt WHERE pid=?");
 $sql->execute(array($pid));
 if($sql->rowCount() > $l){
  $cmts.="<a class='lmc' id='$pid'>Load More Comments</a>";
 }
 if($sql->rowCount()==0){
  echo '<h2>No Comments</h2>';
 }else{
  echo $cmts;
 }
}else{
 ser();
}
?>
