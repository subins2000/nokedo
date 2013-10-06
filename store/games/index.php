<!DOCTYPE html><html><head>
<?include('../config.php');?>
<meta name="description" value="Play Games Online. Download Games Online. Games added from different quality sites."/>
<script src="http://cdn.nokedo.com/js/js.php?f=store"></script>
<link href="//cdn.nokedo.com/css/all.php" rel="stylesheet">
<title>Games Arena - Nokedo Store</title>
</head><body>
<div id="ncontent">
<h2 style="text-align:left;">OneStore - Games</h2>
<div style=""><button style="width: 32%;" onclick="window.location='../'">Softwares</button><button style="width: 32%;" class="sb-b" onclick="window.location.reload();">Games</button><button style="width: 32%;" onclick="window.location='../apps'">Apps</button></div>
<blockquote>Play Games Online. Download Best Free Games. Games from different quality sites.</blockquote><c clear/>
 <div class="slider">
<?
$sql=$db->prepare("SELECT * FROM store WHERE json LIKE '%big%' AND ty='game' ORDER BY hits DESC LIMIT 5");
$sql->execute();
while($r=$sql->fetch()){
$j=json_decode($r['json'],true);
 echo "<img onclick=\"window.location='view.php?id=".$r['id']."'\" style='cursor:pointer;width:700px;height:300px;' src='".$j['big']."'/>";
}
?>
 </div><br/><br/>
 <script>$(function(){$(".slider").orbit({bullets: true,});});</script>
 <div class="leftb">
  <div style="background:#RRR;">Type :</div><div clear></div>
  <?
  $arr=array('All'=>'','Online'=>"on",'Download'=>"down");
  foreach($arr as $k=>$v){
   if($_GET['pl']==$v){
    echo "<button onclick=\"window.location='?pl=$v';\" class='sb-b' style='text-align:left;width:100%;'>$k</button><br/>";
   }else{
    echo "<button onclick=\"window.location='?pl=$v';\" style='text-align:left;width:100%;'>$k</button><br/>";
   }
  }
  ?>
 </div>
 <div class="rightb">
  <div class='pc'>
  <?
  include("../RMI.php");
  if($_GET['pl']=='Flash' | $_GET['pl']=='down'){
   $sql=$db->prepare("SELECT * FROM store WHERE JSON LIKE ? AND ty='game' ORDER BY hits DESC");
   $sql->execute(array('%"pl":"'.str_replace('down','Downloadable',$_GET['pl']).'"%'));
  }else{
   $sql=$db->prepare("SELECT * FROM store WHERE ty='game' ORDER BY hits DESC");
   $sql->execute();
  }
  $cn=0;$k=array();
  echo "<div style='box-shadow: inset 52px -10px 22px -50px black,inset -52px 10px 22px -50px black;overflow:hidden;'><div class='p c' id='00'>";
  while($r=$sql->fetch()){
   $j=json_decode($r['json'],true);
   $rn=sts($r['id']);
   $h=$r['hits'];
   $rows=$sql->rowCount();
   if($cn==0){$k['0']='s';}
   if($k[substr($cn,0,1)]==''){
    echo "</div><div class='p' id='".substr($cn,0,1)."'>";
   }
   if(substr($cn,-1)==0){$k[substr($cn,0,1)]='s';}
   echo "<div class='box' title='".$r['title']."'><a href='view.php?id={$r['id']}' style='color:indianred;'><span style='font-size:18px;font-weight:bold;white-space: pre;width: 95%;overflow: hidden;display: block;' title='".$r['title']."'>".$r['title']."</span></a><div clear style='font-size:14px;'>";
   echo"<span title='Played $h times'>$h played</span>$rn</div></a></div>";
   $cn=sprintf("%02u", $cn+1);
  }
  echo "</div></div></div><div clear style='border-top:2px solid #CCC;'></div><div class='pages'>";
  $pages = ceil($rows/10);
  for($i=0; $i<=$pages-1; $i++){echo '<a class="bullet';if($i==0){echo' active';}echo'" id="'.$i.'">'.$i.'</a>';$l=$i;}
  echo "</div>";
  ?>
</div>
</body></html>
