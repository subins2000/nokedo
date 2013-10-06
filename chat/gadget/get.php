<?
header('Content-type: text/html; charset=utf-8');
include('../config.php');
$id=$_GET['id'];
if($who!=$whod || is_numeric($id)==false){ser();}
?><meta content="utf-8" http-equiv="encoding">
<style>
::-webkit-scrollbar-thumb{background-color: rgba(0, 0, 0, .2);background-clip: padding-box;border: solid transparent;border-width: 1px 1px 1px 6px;min-height: 28px;padding: 100px 0 0;box-shadow: inset 1px 1px 0 rgba(0, 0, 0, .1),inset 0 -1px 0 rgba(0, 0, 0, .07);}
::-webkit-scrollbar-thumb:hover{background-color: rgba(0, 0, 0, .5);}
::-webkit-scrollbar{width: 15px;border-width: 0 1px 0 2px;}
::-webkit-scrollbar-track{background-clip: padding-box;border: solid transparent;border-width: 0 0 0 4px;border-width: 0;}
::-webkit-scrollbar-corner {background: transparent;}
</style>
<script><?echo file_get_contents('http://cdn.nokedo.com/js/jquery.min.js').file_get_contents('http://cdn.nokedo.com/js/time.js');?></script>
<div class='msgs' style='height:90%;overflow:auto;'>
<?
$sql=$db->prepare("UPDATE msg SET red='1' WHERE uid=? AND fid=?");
$sql->execute(array($id,$who));
$sql=$db->prepare("SELECT * FROM msg WHERE (uid=? AND fid=?) OR (uid=? AND fid=?)");
$sql->execute(array($who,$id,$id,$who));
if($sql->rowCount()==0){echo "<h2>No Messages.<br/><br/>Are you a true friend ?</h2>";}else{echo "<center style='border-bottom:1px solid black;'><a target='_blank' href='//chat.nokedo.com/?id=$id'>See all messages</a></center>";}
while($r=$sql->fetch()){
 $k=json_decode($r['json'],true);
 if($r['uid']==$who){
 echo "<div class='msg' id='".$r['uid']."'><div style='display: table-cell;margin-top: -5px;vertical-align: top;background: white;padding: 6px;padding-top:1px;'><div class='up'><a target='_blank' href='//class.nokedo.com/profile.php?id=".$r['uid']."'>".explode(' ',un($r['uid'])['name'])[0]."</a><span class='time timeago' title='".$k['time']."'>".date_format(date_create($k['time']), 'd F 20y h:m:s')."</span></div><div class='cmsg'>".$r['msg']."</div></div><div style='display: table-cell;vertical-align: top;width: 15%;'><a href='//class.nokedo.com/profile.php?id=".$r['uid']."'><img style='border-left: 1px solid black;' class='left' height='32' src='".get('imgs',$r['uid'])."'/></a></div></div>";
 }else{
 echo "<div class='msg' id='".$r['uid']."'><a href='//class.nokedo.com/profile.php?id=".$r['uid']."' style='display: table-cell;width: 15%;vertical-align: top;'><img class='left' style='border-right: 1px solid black;' height='32' src='".get('imgs',$r['uid'])."'/></a><div class='right' style='margin-top: -5px;background: white;padding: 6px;padding-top:1px;'><div class='up'><a target='_blank' href='//class.nokedo.com/profile.php?id=".$r['uid']."'>".explode(' ',un($r['uid'])['name'])[0]."</a><span class='time timeago' title='".$k['time']."'>".date_format(date_create($k['time']), 'd F 20y h:m:s')."</span></div><div class='cmsg'>".$r['msg']."</div></div></div>";
 }
}
?>
</div>
<form id="cform" style="height:10%;position:fixed;botom:0px;left:0px;right:0px;border-top:1px solid black;">
 <input type="text" style="width: 70%;" placeholder="Type Your Message Here" autocomplete="off" name="msg"/>
 <input type="hidden" name="id" value="<?echo$id;?>"/>
 <input type="submit" style="width: 9%;" value="Send"/>
</form>
<script>
var info=JSON.parse(localStorage['userinfo']);
function cti(){var currentdate = new Date();var time=currentdate.getFullYear()+"-"+(currentdate.getMonth()+1)+"-"+currentdate.getDate()+" "+currentdate.getHours()+":"+currentdate.getMinutes()+":"+currentdate.getSeconds();return time;}
function filt($msg){$msg=$msg.replace(/\</g,'&lt;');$msg= $msg.replace(/\>/g,'&gt;');$msg=$msg.replace(/\//g,'\/');$msg=$msg.replace(/\*\*(.*?)\*\*/g,'<b>$1</b>');  $msg= $msg.replace(/"/g,'\"');$msg=$msg.replace(/\*\/(.*?)\/\*/g,'<i>$1</i>');$msg= $msg.replace(/\[link\((.*?)\)\](.*?)\[\/link\]/g,'<a target="_blank" href="$1">$2</a>');return $msg;}
window.scchat=function(){
 var elem = $(".msgs");
 var maxScrollTop = elem[0].scrollHeight - elem.outerHeight()+10000000;
 elem.animate({scrollTop:maxScrollTop});
}
scchat();
$('#cform').live('submit',function(){
 var v=$(this).find('input[type=text]');
 if(v.val()!=''){
  if($(".msgs .msg:last").attr('id')==info['uid']){
   $(".msgs .msg:last").find('.cmsg').append("<br>"+filt(v.val()));
  }else{
   if($(".msgs").text().replace('  ','').replace('\n','')=='No Messages.Are you a true friend ?'){
    $(".msgs").html();
   }else{
    $(".msgs").append("<div class='msg' id='"+info['uid']+"'><div style='display: table-cell;margin-top: -5px;vertical-align: top;background: white;padding: 6px;padding-top:1px;'><div class='up'><a target='_blank' href='//class.nokedo.com/profile.php?id="+info['uid']+"'>"+info['name'].split(' ')[0]+"</a><span class='time timeago' title='"+cti()+"'></span></div><div class='cmsg'>"+v.val()+"</div></div><div style='display: table-cell;vertical-align: top;width: 15%;'><a href='//class.nokedo.com/profile.php?id="+info['uid']+"'><img style='border-left: 1px solid black;' class='left' height='32' src='"+info['imgs']+"'/"+"></a></div></div>");
   }
  }
 $.post('//chat.nokedo.com/action.php',$(this).serialize(),function(data){});
 v.val('');
 scchat();
 }
return false;
});
window.addEventListener("message",function(e){
 if(e.origin.match('/(.*?)\.com')[1]=='/nokedo' || e.origin.match('[.](.*?)\.com')[1]=='nokedo'){
 var msg=e.data;
 $(".msgs").append("<div class='msg' id='"+msg.id+"'><div style='display: table-cell;margin-top: -5px;vertical-align: top;background: white;padding: 6px;padding-top:1px;'><div class='up'><a target='_blank' href='//class.nokedo.com/profile.php?id="+msg.id+"'>"+msg.name.split(' ')[0]+"</a><span class='time timeago' title='"+cti()+"'></span></div><div class='cmsg'>"+msg.msg+"</div></div><div style='display: table-cell;vertical-align: top;width: 15%;'><a href='//class.nokedo.com/profile.php?id="+msg.id+"'><img style='border-left: 1px solid black;' class='left' height='32' src='"+msg.imgs+"'/"+"></a></div></div>");
 scchat();
 }
},false);
</script>
<style>body{background:#CCC;font-family:Ubuntu;font-size: 14px;line-height: 16px;}.left{background: white;padding: 6px;}.right{display:table-cell;vertical-align:top;}.up{border-bottom:1px solid #EEE;}.time{margin-left:10px;color:gray;}.cmsg{margin-top:0px;}.msg{display: table;width:100%;border-bottom:1px solid black;padding-bottom: 6px;padding-top: 8px;}a{color: rgb(56, 76, 129);text-decoration:none;}input[type=text]{font-family: Ubuntu;vertical-align: top;border:1px solid rgba(204, 204, 204,.7);background:rgba(255, 255, 255,.7);border-radius:.4em;min-height:27px;min-width: 200px;text-shadow: 0 1px 0 rgb(240, 240, 240);box-shadow: inset 0 1px 0 rgba(0, 0, 0, 0.08),inset 0 1px 2px rgba(255, 255, 255, 0.75);display: inline-block;outline: none;padding: 5px 10px;}input[type=text]:hover{border:1px solid rgba(204, 204, 204,1);background: rgba(255, 255, 255,.8);box-shadow: inset 0 .5px 1px rgba(0,0,0,0.1);}input[type=text]:active,input[type=number]:active,textarea:active,input[type=password]:active{border:1px solid rgba(204, 204, 204,1);background: rgba(255, 255, 255,1);}input[type=text]:focus{border:1px solid rgb(77, 137, 254);background: rgba(255, 255, 255,1);}input[type=submit]{margin: 3px;text-align: center;padding: 1px 6px;font-size: 13px;cursor:pointer;font-weight:bold;font-family: sans-serif,ubuntu;min-width:67px;min-height:30px;border-radius:.2em;vertical-align: middle;border: 1px solid rgba(204, 204, 204,.7);background: rgb(245, 245, 245);display:inline-block;}input[type=submit]:hover{border:1px solid rgba(204, 204, 204,.9);background: rgb(255, 255, 255);box-shadow: inset 0 2px 2px rgba(0,0,0,0.1);}input[type=submit]:active{border:1px solid rgba(204, 204, 204,1);background: rgb(255, 255, 255);box-shadow: inset 0 4px 2px rgba(0,0,0,0.1);}input[type=submit]:focus{outline:none;}
</style>
