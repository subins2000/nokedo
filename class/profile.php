<?
include('config.php');
$id=$_GET['id'];
if($id==''){$id=$who;}
if($id==$who && $who!=$whod){
 header("Location:http://nokedo.com/accounts/login.php?c=//class.nokedo.com/profile.php");
 exit;
}
?>
<!DOCTYPE html><html><head>
<?
function age($birthday){
 list($day,$month,$year) = explode("/",$birthday);
 $year_diff  = date("Y") - $year;
 $month_diff = date("m") - $month;
 $day_diff   = date("d") - $day;
 if($day_diff < 0 && $month_diff==0){$year_diff--;}
 if($day_diff < 0 && $month_diff <0){$year_diff--;}
 return $year_diff;
}
$sql=$db->prepare("SELECT * FROM users WHERE id=?");
$sql->execute(array($id));
$idt=$sql->rowCount();
if($idt==0){
 $sql=$db->prepare("SELECT * FROM users WHERE json LIKE ?");
 $sql->execute(array('%"username":"'.$id.'"%'));
 $idt=$sql->rowCount();
}
if($idt==1){
 while($r=$sql->fetch()){
  $id=$r['id'];
  $email=$r['username'];
  $name=$r['name'];
  $birth=$r['birth'];
  $age=age($birth);
  $join=$r['joined'];
  $gender=strtoupper($r['gender']);
  $stat=$r['stat'];
  $t=$name.'\'s profile';
  $json=json_decode($r['json'],true);
  $loc=$json['loc'];
  $ph=$json['ph'];
  $img=$json['img']=='' ? '//cdn.nokedo.com/images/guest.png':$json['img'];
  $wr=$json['wr']=='' ? 'Null':$json['wr'];
  $ds=$json['ds']=='' ? 'Null':$json['ds'];
  $hd=$json['hd']=='' ? '//cdn.nokedo.com/images/header/mountains.jpg':$json['hd'];
  $fb=$json['fb']=='' ? 'Null':$json['fb'];
  $lang=json_decode($json['lang'],true);
  $pr=$json['privacy'];
  $page=$pr['age'];
  $ploc=$pr['loc'];
  $pphone=$pr['phone'];
  $pmail=$pr['mail'];
  $sd=array();
  if($page=='prt'){$sd['age']='selected';}
  if($ploc=='prt'){$sd['loc']='selected';}
  if($pphone=='prt'){$sd['phone']='selected';}
  if($pmail=='prt'){$sd['mail']='selected';}
 }
}
if($idt==0){
 ser();
}
?>
<meta name="rudceid" value="<?echo$id;?>"/>
<link href="//cdn.nokedo.com/css/all.php" rel="stylesheet">
<script src="http://cdn.nokedo.com/js/js.php?f=class"></script>
<title><?echo$t;?></title>
</head><body>
<?
if($who==$id && $jin['username']==""){
?>
<div style="position:absolute;background:rgb(100,160,400);padding:10px;text-align:center;z-index:1852;right:0px;left:0px;top:40px;color:white;">
 Get Your Own Profile Page (http://class.nokedo.com/~YouHere). Submit Your Username <a href='username'>Here</a>
</div><br/>
<?
}
?>
<div id="content" style="width:750px;">
 <?if($er!=''){echo$er;exit;}?>
 <div style="display: inline-block;margin-right: 20px;width: 572px;">
 <div style="background: white;height: 175px;position:relative;text-align: center;overflow: hidden;width: 560px;border: 6px solid yellowGreen;"><?if($whod==$id){?><button class="sb sb-b ajax cboxElement" style="display:block;position: absolute;right: -2px;top: -2px;border-left: 1px solid red;border-bottom: 1px solid red;color: white;cursor: pointer;padding-top: 2px;z-index: 1;margin:0px;" href="get.php?hd=1">Change Header Image</button><?}?><img height="175" width="562" id="hdimg" src="<?echo$hd;?>" /><?if($id==$who || empty($lang)==false){?><div style="position: absolute;background: rgba(0, 0, 0, .3);left: 0px;right: 0px;bottom: 0px;color:white;padding: 10px;overflow:hidden;white-space:nowrap;border-top: 1px solid white;" class="langs"><?if(empty($lang) || $lang=='' && $id==$who){echo "<a class='cboxajax' href='get.php?lang' style='color:black;background: white;border:3px dashed #CCC;padding: 3px 8px;display: inline-block;border-radius: 10px;'>Add a language</a>";}else{foreach($lang as $k=>$v){echo"<a style='color:black;background: white;border:3px dashed #CCC;padding: 3px 8px;border-radius: 10px;' class='langknown' href='find.php?lang=$k'>$k</a>&nbsp;&nbsp;";}if($id==$who){echo "<a class='cboxajax' href='get.php?lang' style='color:black;background: white;border:3px dashed #CCC;padding: 3px 8px;border-radius: 10px;'>Add a language</a>";}}?></div><?}?></div><br/>
 <div style="margin:0px auto;display:table;" id="ptabt">
  <button class="sb-b" style="width:150px;" onclick="$('.ptab').hide();$('#feed').show();$('#ptabt button').removeClass('sb-b');$(this).addClass('sb-b');">Feed</button>
  <button style="width:150px;" onclick="$('.ptab').hide();$('#about').show();$('#ptabt button').removeClass('sb-b');$(this).addClass('sb-b');">About</button>
  <button style="width:150px;" onclick="$('.ptab').hide();$('#cont').show();$('#ptabt button').removeClass('sb-b');$(this).addClass('sb-b');">Contact</button>
 </div>
 <div id="feed" class='ptab'><br/>
  <?$_GET['awregvawegb']=1;$_POST['user']=$id;include('data.php');?>
  <div id="last_msg_loader" style="text-align: center;color:black;height:30px;background:#EEE;width: 100%;margin-top: 1em;border-radius: 10px;border:2px solid black;"><img title="Loading more Posts.." src="//cdn.nokedo.com/images/load.gif" height="30" /></div>
 </div>
 <div id='about' class='ptab' hide>
  <h2>About</h2>
<?if($who!=$id){?>
 <?if($ds!='Null'){?>
 <div class='icont'>
   <d>About Me : </d><v><?echo$ds;?></v>
 </div>
 <?}?>
 <?if($wr!='Null' && $pr['wr']=='pub'){?>
 <div class='icont'>
   <d>Works At : </d><v><?echo$wr;?></v>
 </div>
 <?}?>
 <?if($pr['ge']=='pub'){?>
 <div class='icont'>
   <d>Gender : </d><v><?echo$gender;?></v>
 </div>
 <?}?>
 <?if($pr['bir']=='pub'){?>
 <div class='icont'>
   <d>Date Of Birth : </d><v><?echo$birth;?></v>
 </div>
 <?}?>
<?}?>
<?if($who==$id){?>
 <div class='icont'>
   <d>About Me : </d><v><?echo$ds;?></v><button alt="Write an about me" id="ds" class="sb-g edit">EDIT</button>
 </div>
 <div class='icont'>
   <d>Works At : </d><v><?echo$wr;?></v><button alt="Where do you work ?" id="wr" class="sb-g edit">EDIT</button><select class='pchanger' id='wr' name='privacy'><option value='pub'>Public</option><option <?echo$sd['wr'];?> value='prt'>Private</option></select>
 </div>
 <div class='icont'>
   <d>Gender : </d><v><?echo$gender;?></v><select class='pchanger' id='ge' name='privacy'><option value='pub'>Public</option><option <?echo$sd['ge'];?> value='prt'>Private</option></select>
 </div>
 <div class='icont'>
   <d>Date Of Birth : </d><v><?echo$birth;?></v><select class='pchanger' id='bir' name='privacy'><option value='pub'>Public</option><option <?echo$sd['ge'];?> value='prt'>Private</option></select>
 </div>
<?}?>
 </div>
 <div id='cont' class='ptab' hide>
  <h2>Contact</h2>
  <?if($who!=$id){?>
   <?if($fb!='Null'){?>
   <div class='icont'>
    <d>Facebook : </d><v><a target="_blank" href="https://www.facebook.com/<?echo$fb;?>" class="fb_butt"><?echo$fb;?></a></v>
   </div>
   <?}?>
  <?}?>
  <?if($who==$id){?>
   <div class='icont'>
    <d>Facebook : </d><v><a target="_blank" href="https://www.facebook.com/<?echo$fb;?>" class="fb_butt"><?echo$fb;?></a></v><button alt="What's Your FB Username ?" id="fb" class="sb-g edit">EDIT</button>
   </div>
  <?}?>
 </div>
</div>
<div style="vertical-align: top;display: inline-block;"><div style="position:relative;"><img style="display:block;margin: 0px auto;" width="150" height="150" src="<?echo$img;?>"><?if($who!=$id){$sql=$db->prepare("SELECT * FROM fds WHERE fid=? and uid=? LIMIT 0,30");$sql->execute(array($id,$who));$matches=$sql->rowCount();if ($matches==0){if($who!=$whod){?><a href="//nokedo.com/accounts/login.php?c=//class.nokedo.com/profile.php?id=<?echo$id?>"><?}?><button style="display:block;position: absolute;top: -2px;left:0px;cursor: pointer;padding-top: 2px;z-index: 1;right:0px;margin: 2px;width: 98%;" id="<?echo$id;?>" class="sb sb-g follow">Follow</button><?if($who!=$whod){?></a><?}}else{?><button style="display:block;position: absolute;top: -2px;border-left: 1px solid red;border-bottom: 1px solid red;color: white;cursor: pointer;padding-top: 2px;z-index: 1;left:2px;margin:0px;width: initial;right: 2px;width: 98%;" class="sb sb-red unfollow" id="<?echo$id;?>">Unfollow</button></div><?}}else{?><button style="display:block;position: absolute;top: -2px;margin: 2px;cursor: pointer;padding-top: 2px;z-index: 1;right:0px;left:0px;width: 98%;" class="sb sb-b cboxframe" width="400" height="200" href="http://cdn.nokedo.com/pic.php">Edit Picture</button><?}?><div clear></div>
<div class="block" id="1" title="My name"><span><?echo$name;?></span></div><div clear></div>
<?if($page!='prt' && $age!='' || $who==$id){?><div class="block" id="2" title="Age"><?echo$age;?> years old<?if($who==$id){?><select class='pchanger' id='age' name='privacy'><option value='pub'>Public</option><option <?echo$sd['age'];?> value='prt'>Private</option></select><?}?></div><div clear></div>
<?}if($ploc!='prt' && $loc!=''  || $who==$id){?><div class="block ed" id="loc" title="Location"><span><?echo$loc;?></span><?if($id==$who){?><select class='pchanger' id='loc' name='privacy'><option value='pub'>Public</option><option <?echo$sd['loc'];?> value='prt'>Private</option></select><?}?></div><div clear></div>
<?}if($pphone!='prt' && $ph!='' || $who==$id){?><div class="block ed" id="ph" title="Contact Number"><span><?echo$ph;?></span><?if($id==$who){?><select class='pchanger' id='phone' name='privacy'><option value='pub'>Public</option><option <?echo$sd['phone'];?> value='prt'>Private</option></select><?}?></div><div clear></div>
<?}if($pmail!='prt' && $email!='' || $who==$id){?><div class="block" id="5" title="Mail me"><span><a style="color:lightblue;" href="mailto:<?echo$email;?>"><?echo$email;?></a></span><?if($who==$id){?><select class='pchanger' id='mail' name='privacy'><option value='pub'>Public</option><option <?echo$sd['mail'];?> value='prt'>Private</option></select><?}?></div><div clear></div><?}?>
 <div style="width: 136px;border:1px solid black;border-radius:10px;padding:5px 8px;">
 <?
 $sql=$db->prepare("SELECT * FROM fds WHERE uid=? LIMIT 10");
 $sql->execute(array($id));
 echo "Following (".$sql->rowCount().")<br/><div clear></div>";
 while($r=$sql->fetch()){echo "<a href='profile.php?id={$r['fid']}'><img style='border-radius: 0.7em;margin:2px 2px 0px 0px;' title='".un($r['fid'])['name']."' height='32' width='32' src='".get('imgs',$r['fid'])."'></a>";}
 ?>
 </div><br/>
 <div style="width: 136px;border:1px solid black;border-radius:10px;padding:5px 8px;">
 <?
 $sql=$db->prepare("SELECT * FROM fds WHERE fid=? LIMIT 10");
 $sql->execute(array($id));
 echo "Followers (".$sql->rowCount().")<br/><div clear></div>";
 while($r=$sql->fetch()){echo "<a href='profile.php?id={$r['uid']}'><img style='border-radius: 0.7em;margin-left:2px;' title='".un($r['uid'])['name']."' height='32' width='32' src='".get('imgs',$r['uid'])."'></a>";}
 ?>
 </div>
</div></div>
<style>.heimg{display:inline-block;border:1px solid #CCC;width: 120px;height: 120px;}[clear]{margin-top:5px;}.block{position:relative;word-wrap: break-word;width: 120px;margin: 0px auto;text-align:left;background:black;padding:5px 10px;color:white;border-radius: 5px;}.pchanger{padding: 4px !important;width: 100%;margin-left: 0px;}</style>
<script>$('.langs').on('mousewheel',function(e){e.preventDefault();scroll = $('.langs').scrollLeft();if(e.originalEvent.wheelDeltaY.toString().slice(0,1)=='-'){$('.langs').scrollLeft(scroll+100);}else{$('.langs').scrollLeft(scroll-100);}});</script>
<?if($id==$who){?>
<script>
$(".ed").each(function(){$(this).html("<br>"+$(this).html());$(this).append('<div id="'+$(this).attr('id')+'" class="sb sb-submit edv" style="left: 0px;line-height: 13px;position: absolute;right: 0px;top: 0px;border: none;background: green;color: white;cursor: pointer;padding-top: 2px;z-index: 1;min-height: 0px;" title="'+$(this).attr('title')+'">EDIT</div>');});
$(".edv").live('click',function(){var fg=$(this).attr('id');var t=prompt('Enter New Value for '+$(this).attr('title'));if(t!='' && t!=null){shown({message:'Saving profile. Please Wait',type:'warn',duration:20});$(this).parents('.block.ed').find('span').text(t);$.post('action.php',{new:t,action:'up_profile',wh:fg},function(data){shown({message:'Saved profile.'});});}});
</script>
<?}?>
</body></html>
