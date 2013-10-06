<?
Header("content-type: application/x-javascript");
include('config.php');
if($who!=$whod){die();}
$sql=$db->prepare("SELECT * FROM fds WHERE uid=? AND fds='1'");
$sql->execute(array($who));
$arr=array();
while($r=$sql->fetch()){
 $polu=un($r['fid']);
 $arr[$r['fid']]['name']=$polu['name'];
 $arr[$r['fid']]['img']=get('imgs',$r['fid']);
 if($polu['stat']<date("Y-m-d H:i:s",strtotime('-25 seconds', time()))){
  $arr[$r['fid']]['status']="off";
 }
 $arr[$r['fid']]['status']=$arr[$r['fid']]['status']=="off" ? "off":"on";
}
?>
$('body').append('
<div class="chat">
 <iframe src="http://chat.nokedo.com/gadget/checker.php" style="position:fixed;display:none;"></iframe>
 <div class="chatboxes"></div>
 <div class="roster">
  <div class="statusbar">
   <table><tbody><tr>
   <td><span class="status on"></span></td>
   <td><a target="_blank" class="uname" href="//class.nokedo.com/profile.php?id=<?echo$who;?>"><?echo$in['name'];?></a></td>
   <td style="position: absolute;right: 13px;font-size: 40px;cursor:pointer;" title="Minimize">-</td>
   </tr></tbody></table>
  </div>
  <div class="list">
  <?
  foreach($arr as $k=>$v){
   echo "<button class=\"sb-chat\" status=\"{$v['status']}\" name=\"{$v['name']}\" id=\"$k\"><table><tbody><tr><td><img height=\"32px\" width=\"32px\" src=\"{$v['img']}\"/></td><td style=\"vertical-align: middle;\"><span style=\"margin-top: 0px;\" class=\"status ".$v['status']."\"></span></td><td>{$v['name']}</td></tr></tbody></table></button>";
  }
  if(count($arr)==''){echo"<center><h2>No Friends.<br/> Forever Alone</h2></center>";}
  ?>
  </div>
 </div>
</div>');
$('.statusbar table td:last').live('click',function(){
 if($('.roster').css('height')==$('.roster .statusbar').height()+'px'){
  localStorage['minized']=0;
  $(this).text('-').css('font-size','40px').attr('title','Minimize');
  $('.roster').animate({height:'60%'},function(){$('.roster .list').fadeIn(1000);});
 }else{
  localStorage['minized']=1;
  $(this).text('\u25A2').css('font-size','20px').attr('title','Maximize');
  $('.roster .list').fadeOut(500,function(){$('.roster').animate({height:$('.roster .statusbar').height()});});
 }
});
if(localStorage['minized']==1){
 $('.statusbar table td:last').text('\u25A2').css('font-size','20px').attr('title','Maximize');
 $('.roster .list').hide();$('.roster').css({height:$('.roster .statusbar').height()});
}
$('.roster .list .sb-chat').livequery('click',function(){
 tid=$(this).attr('id');
 function lsc(a){
 $.post('http://chat.nokedo.com/gadget/get.php',{u:a},function(data){return data;});
 }
 if($('.chatboxes').find('.chatbox#'+tid).length==0){
  $('.chatboxes').append('
<div class="chatbox" id="'+$(this).attr('id')+'">
 <div class="chatboxstatus">
  <table><tbody><tr>
  <td><span class="status '+$(this).attr('status')+'"></span></td>
  <td><a target="_blank" href="//class.nokedo.com/profile.php?id='+$(this).attr('id')+'">'+$(this).attr('name')+'</a></td>
  <td style="position: absolute;right: 13px;font-size: 20px;top: -2px;cursor:pointer;" class="tvis" title="Close">x</td>
  </tr></tbody></table>
 </div>
 <iframe id="fcont" class="fcont" src="http://chat.nokedo.com/gadget/get.php?id='+$(this).attr('id')+'" frameborder="0"></iframe>
</div>');
 }else{
 $('.chatbox#'+tid).show();
 $('.chatbox#'+tid).find('.fcont').css('height','300px').css('display','block');
 }
});
$('.chatboxstatus .tvis').livequery('click',function(){
 $(this).parents('.chatbox').find('.fcont').css('display','block').animate({height:0},2000,function(){$(this).fadeOut(function(){$(this).parents('.chatbox').hide();});});
});
window.addEventListener("message",function(e){
 if(e.origin=='http://chat.nokedo.com'){
 var po=e.data;
  $.each(po.statuses,function(k,v){
  wtr=v=='off' ? "on":"off";
  $('.roster .list #'+k).find('table tr td:nth-child(2) span').removeClass(wtr).addClass(v);
  });
  if(po.is=="true"){
   $.each(po.users,function(k,v){
    if($('.chatbox#'+k).length!=0){
    $('.chatbox#'+k).show();
    $('.chatbox#'+k).find('.fcont').css('height','300px').css('display','block');
    $('.chatbox#'+k).find('.fcont')[0].contentWindow.postMessage(po.data[k],'*');
    }else{
    $('.chatboxes').append('
<div class="chatbox" id="'+k+'">
 <div class="chatboxstatus">
  <table><tbody><tr>
  <td><span class="status on"></span></td>
  <td><a target="_blank" href="//class.nokedo.com/profile.php?id='+k+'">'+v+'</a></td>
  <td style="position: absolute;right: 13px;font-size: 20px;top: -2px;cursor:pointer;" class="tvis" title="Close">x</td>
  </tr></tbody></table>
 </div>
 <iframe id="fcont" class="fcont" src="http://chat.nokedo.com/gadget/get.php?id='+k+'" frameborder="0"></iframe>
</div>');
    }
   });
  }
 }
},false);
