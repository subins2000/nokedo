<!DOCTYPE html><html><head>
<?include('../config.php');?>
<meta name="description" value="Find different types of online apps and tools created by the professionals."/>
<script src="http://cdn.nokedo.com/js/js.php?f=store"></script>
<link href="//cdn.nokedo.com/css/all.php" rel="stylesheet">
<title>App Store - Nokedo OneStore</title>
</head><body>
<div id="ncontent">
<h2 style="text-align:left;">OneStore - Apps</h2>
<div style=""><button style="width: 32%;" onclick="window.location='../'">Softwares</button><button style="width: 32%;" onclick="window.location='../games'">Games</button><button style="width: 32%;" class="sb-b" onclick="window.location.reload();">Apps</button></div>
<blockquote>Find different types of online apps and tools created by the professionals.</blockquote><c clear/>
 <div class="leftb">
  <div style="background:#RRR;">Platforms:</div><div clear></div>
  <?
  $arr=array('All'=>'',"Accessories"=>"acc","Education"=>"edu","Graphics"=>"gra","Internet"=>"net","Multimedia"=>"media","Office"=>"off","Programming"=>"pro","Science"=>"sci");
  foreach($arr as $k=>$v){
  if($_GET['pl']==$v && $_GET['pl']!=''){$t=true;}
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
  if($t){
   $sql=$db->prepare("SELECT * FROM store WHERE JSON LIKE ? AND ty='app' ORDER BY hits DESC");
   $sql->execute(array('%"pl":"'.$_GET['pl'].'"%'));
  }else{
   $sql=$db->prepare("SELECT * FROM store WHERE ty='app' ORDER BY hits DESC");
   $sql->execute();
  }
  $cn=0;$k=array();
  if($sql->rowCount()==0){die("<h2>Nothing Found. Wanna <a href='request.php'>add one</a> ?</h2>");}
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
   echo"<span title='Viewed $h times'>$h used</span>$rn</div></a></div>";
   $cn=sprintf("%02u", $cn+1);
  }
  echo "</div></div></div><div clear style='border-top:2px solid #CCC;'></div><div class='pages'>";
  $pages = ceil($rows/10);
  for($i=0; $i<=$pages-1; $i++){echo '<a class="bullet';if($i==0){echo' active';}echo'" id="'.$i.'">'.$i.'</a>';$l=$i;}
  echo "</div>";
  ?>
</div>
</body></html>
