<?
include('../config.php');
check();
if($who!=$whod || $_POST['malayalam']!="India Forever"){ser();}
$sql=$db->prepare("SELECT * FROM fds WHERE uid=? AND fds='1'");
$sql->execute(array($who));
$arr=array();
while($r=$sql->fetch()){
 if(un($r['fid'])['stat']<date("Y-m-d H:i:s",strtotime('-20 seconds', time()))){
  $arr[$r['fid']]="off";
 }
 $arr[$r['fid']]=$arr[$r['fid']]=="off" ? "off":"on";
}
$od=',"statuses":'.json_encode($arr);
$sql=$db->prepare("SELECT * FROM msg WHERE fid=? AND red='0'");
$sql->execute(array($who));
if($sql->rowCount()!=0){
 $or=array();
 while($r=$sql->fetch()){
 $or[$r['uid']]['json']=$r['json'];
 $or[$r['uid']]['msg']=$r['msg'];
 }
 $op=array();
 if(count($or)==1){
 $r=array_keys($or)[0];
 $nh=un($r)['name'];
 $op['users'][$r]=$nh;
 $op['data'][$r]['id']=$r;
 $op['data'][$r]['name']=$nh;
 $op['data'][$r]['imgs']=get('imgs',$r);
 $op['data'][$r]['json']=$or[$r]['json'];
 $op['data'][$r]['msg']=$or[$r]['msg'];
 $op=json_encode($op);
 }else{
  foreach($or as $r=>$k){
  $nh=un($r)['name'];
  $op['users'][$r]=$nh;
  $op['data'][$r]['id']=$r;
  $op['data'][$r]['name']=$nh;
  $op['data'][$r]['imgs']=get('imgs',$r);
  $op['data'][$r]['json']=$k['json'];
  $op['data'][$r]['msg']=$k['msg'];
  }
  $op=json_encode($op);
 }
 echo '{"is":"true","users":'.$op.''.$od.'}';
}else{
 echo '{"is":"false"'.$od.'}';
}
?>
