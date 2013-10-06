window.scchat=function(){
var elem = $(".msgbox");
var maxScrollTop = elem[0].scrollHeight - elem.outerHeight()+10000000;
$(".msgbox").animate({scrollTop:maxScrollTop});
};
$(".msgbox").ready(function(){
 scchat();
});
$(".msgform").live('submit',function(){
var v=$(this).find('input[type=text]');
if(v.val()!=''){
if($(".msgbox .msg:last").attr('id')==info['uid']){
 $(".msgbox .msg:last").find('.cmsg').append("<br/>"+filt(v.val()));
}else{
 if($(".msgbox").text().replace('  ','').replace('\n','')==' No Messages  '){
  $(".msgbox").html("<div class='msg' id='"+info['uid']+"'><a href='//class.nokedo.com/profile.php?id="+info['uid']+"'><img class='left' height='32' src='"+info['imgs']+"'/></a><div class='right'><div class='up'><a href='//class.nokedo.com/profile.php?id="+info['uid']+"'>"+info['name']+"</a><span class='time timeago' title='"+cti()+"'></span></div><div class='cmsg'>"+filt(v.val())+"</div></div></div>");
 }else{$(".msgbox").append("<div class='msg' id='"+info['uid']+"'><a href='//class.nokedo.com/profile.php?id="+info['uid']+"'><img class='left' height='32' src='"+info['imgs']+"'/></a><div class='right'><div class='up'><a href='//class.nokedo.com/profile.php?id="+info['uid']+"'>"+info['name']+"</a><span class='time timeago' title='"+cti()+"'></span></div><div class='cmsg'>"+filt(v.val())+"</div></div></div>");}
}
$.post('//chat.nokedo.com/action.php',$(this).serialize(),function(data){$(".msgbox").html(data);scchat();});
v.val('');
scchat();
}
return false;
});
setInterval(function(){$.post('get.php',{r:$(".msgform").find('#isroom').val(),id:$(".msgform").find('input[type=hidden]').val(),msg:$(".msgbox .msg:last").find('.cmsg').html()},function(data){});},5000);
