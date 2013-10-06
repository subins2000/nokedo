function cti(){var currentdate = new Date();
 var time=currentdate.getFullYear()+"-"+(currentdate.getMonth()+1)+"-"+currentdate.getDate()+" "+currentdate.getHours()+":"+currentdate.getMinutes()+":"+currentdate.getSeconds();
 return time;
}
window.filt=function($msg){$msg=$msg.replace(/\</g,'&lt;');
 $msg=$msg.replace(/\>/g,'&gt;');
 $msg=$msg.replace(/\//g,'\/');
 $msg=$msg.replace(/\*\*(.*?)\*\*/g,'<b>$1</b>');
 $msg= $msg.replace(/"/g,'\"');
 $msg=$msg.replace(/\*\/(.*?)\/\*/g,'<i>$1</i>');
 $msg= $msg.replace(/\[link\((.*?)\)\](.*?)\[\/link\]/g,'<a target="_blank" href="//nokedo.com/link.php?url=$1">$2</a>');
 $msg=$msg.replace(RegExp('((www|http://)[^ ]+)','g'), '<a target="_blank" href="//nokedo.com/link.php?url=$1">$1</a>');
 $msg=$msg.replace("\n","<br/>");
 $msg=$msg.replace(RegExp('(\#[^ ]+)','g'),'<a href="//class.nokedo.com/explore.php?hash=$1">$1</a>');
 $msg=$msg.replace("//class.nokedo.com/explore.php?hash=#","//class.nokedo.com/explore.php?hash=%23");
 return $msg;
};
$("body").append('<div class="top"><mn><a class="ser" href="//nokedo.com">Search</a><a class="ser" href="//class.nokedo.com">MyClass</a><a class="ser" href="//get.nokedo.com">Store</a><a class="ser" href="//chat.nokedo.com">Chat</a><a class="ser" href="//sites.nokedo.com">Sites</a></mn><shn><?if($who==$whod){?><button id="tname" class="sb"><?echo$in['name'];?></button><?}else{?><button class="sb" onclick="window.location=\'http://nokedo.com/accounts/login.php?c='+location+'\'">Log In</button><button class="sb sb-red" onclick="window.location=\'http://nokedo.com/accounts/signup.php\';">Sign Up</button><?}?></shn></div><?if($who==$whod){?><div class="sprofile"><div class="sprofile-l"><h3><?if(strlen($in['name'])>20){echo explode(' ',$in['name'])[0];}else{echo$in['name'];}?></h3><a href="//class.nokedo.com/profile.php"><button class="sb sb-b">View Profile</button></a></div><div class="sprofile-r"><div id="chimg" class="cboxframe" width="400" height="200" href="//cdn.nokedo.com/pic.php">Change Picture</div><img height="100" src="<?echo $img;?>" width="120"></div><div class="sprofile-b"><a href="//nokedo.com/accounts" style="margin-left:10px;"><button class="sb sb-b">Manage Account</button></a><form style="position:absolute;right: 20px;top:1px;" method="post" action="//nokedo.com/accounts/login.php?c='+location+'"><button id="sout" class="sb sb-red" type="submit" name="logout">Log Out</button></form></div><?}?></div>');
$("#content").after('<div style="background: #EEE;border-top: 1px solid black;padding:4px 5px 8px 5px;position: absolute;right: 0px;left: 0px;"><div style="display: inline-block;margin-left: 40px;">&copy;<a href="//class.nokedo.com/profile.php?id=1">Subin Siby</a> <?echo date('Y');?> (Forever and ever)</div><div style="float: right;display: inline-block;margin-right: 20px;"><a href="//nokedo.com/about.php#privacy">Privacy Policy</a>, <a href="//nokedo.com/about.php#terms">Terms and Conditions</a>, <a href="//nokedo.com/about.php">About Nokedo</a></div></div>');
$("#tname").on('click',function(){
 $('.sprofile').toggle('100');
});
localStorage['userinfo']='<?echo '{"img":"'.$img.'","imgs":"'.$imgs.'","name":"'.$in['name'].'","uid":"'.$who.'"}';?>';
var info=JSON.parse(localStorage['userinfo']);
window.shown=function(e){
 var t={showAfter:0,duration:3,autoClose:true,type:"success",message:"",link_notification:"",description:""};
 $.extend(true,t,e);
 var n="succ_bg";
 if(t["type"]=="error"){
  n="error_bg";
 }else if(t["type"]=="info"){
  n="info_bg";
 }else if(t["type"]=="warn"){
  n="warn_bg";
 }
 var r='<div id="info_message" class="'+n+'"><div class="center_auto"><div class="info_message_text message_area">';
 r+=t["message"];
 r+='</div><div class="info_close_btn button_area" onclick="return closeNotification()"></div><div class="clearboth"></div>';
 r+='</div><div class="info_more_descrption"></div></div>';
 $notification=$(r);
 $("body").append($notification);
 var i=$("div#info_message").height();
 $("div#info_message").css({top:"-"+i+"px"});
 $("div#info_message").show();
 slideDownNotification(t["showAfter"],t["autoClose"],t["duration"]);
 $(".link_notification").live("click",function(){$(".info_more_descrption").html(t["description"]).slideDown("fast")})
 function closeNotification(e){
  var t=$("div#info_message").height();
  setTimeout(function(){
   $("div#info_message").animate({top:"-"+t});
   setTimeout(function(){
    $("div#info_message").remove();
   },200);
  },parseInt(e*1e3))
 }
 function slideDownNotification(e,t,n){
  setTimeout(function(){
   $("div#info_message").animate({top:0});
   if(t){
    setTimeout(function(){
     closeNotification(n);
    },n);
   }
  },parseInt(e*1e3));
 }
};
setInterval(function(){
 $.post('http://'+window.location.host+'/checks.php',{user:info['uid'],},function(d){});
},10000);
