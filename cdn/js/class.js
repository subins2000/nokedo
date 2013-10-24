localStorage['whty']="";
tmp();
$('.postform #privacy button:first').addClass('sb-b');
$("#switcher td button").on('click',function(){
 $(".postform .form").css('background',$(this).css('background-color'));
 localStorage['ps']=$(this).text().slice(0,3).toLowerCase();
});
$(".postform").die('submit').on('submit',function(){
 $('.postform').find(':input:not(:disabled)').prop('disabled',true);
 if($(this).find("#upimg").val()==''){
  var json={type:localStorage['ps'],text:$(this).find('#text').val(),pr:$(this).find("#pr").val(),imgs:''};
  $.post('http://class.nokedo.com/post.php',json,function(data){
   if($("#feed .post:first").length!=0){
    $("#feed .post:first").before(data);
   }else{
    $("#feed").html(data);
   }
   $('.postform')[0].reset();
   $('.postform').find(':input:disabled').prop('disabled',false);
  }).error(function(){
   shown({message:"Posting failed",type:"error"});
   $('.postform').find(':input:disabled').prop('disabled',false);
  });
 }else{
  var data = new FormData();
  data.append('img',$("#upimg")[0].files[0]);
  data.append('text',$(this).find('#text').val());
  data.append('type',localStorage['ps']);
  data.append('pr',$(this).find("#pr").val());data.append('imgs','1');
  $.ajax({
   url: 'http://class.nokedo.com/post.php',
   data: data,
   cache: false,
   contentType: false,
   processData: false,
   type: 'POST',
   success: function(data){
    $("#feed .post:first").before(data);$('.postform')[0].reset();$('.postform').find(':input:disabled').prop('disabled',false);
   }
  }).error(function(){
   shown({message:"Posting failed",type:"error"});
   $('.postform')[0].reset();$('.postform').find(':input:disabled').prop('disabled',false);
  });
 }
 return false;
});
$('.postform #privacy button').on('click',function(){
 $('.postform #privacy button.sb-b').removeClass('sb-b');
 $(this).addClass('sb-b');
 $('.postform #privacy').hide();
 $("#pr").val($(this).attr('value'));
});
$('#tgfeed button').live('click',function(){
 $("#feed").tload();
 localStorage['whty']=$(this).text().slice(0,3).toLowerCase();
 $(".postform .form").css('background',$(this).css('background-color'));
 localStorage['ps']=$(this).text().slice(0,3).toLowerCase();
 $.post('http://class.nokedo.com/data.php',{data:"1",type:$(this).text().slice(0,3).toLowerCase()},function(data){
  $("#feed").html(data);
 });
});
$('.cont .postimg').livequery('click',function(event){
 event.preventDefault();
 var id=$(this).parents('.post').attr('id');
 if($(this).attr('href')==undefined){
  $(this).after("<a class='postimg' href='"+'http://class.nokedo.com/photo.php?id='+id+"'><img src='"+$(this).attr('src')+"'/></a>");
  $(this).remove();
 }
 $.colorbox({ajax:true,scroll:false,href:'http://class.nokedo.com/photo.php?ajax=1&id='+id});
});
function last_msg_funtion(){
 var ID=$(".post:last").attr("id");
 if(window.location.href.split('id=')[1]==undefined){
  var aer=info['uid'];
 }else{
  var aer=window.location.href.split('id=')[1];
 }
 if(window.location.pathname=="/profile.php"){
  var dlink={uid:aer,ex:ID,data:1};
 }else{
  var dlink={ex:ID,data:1};
 }
 if(localStorage['whty']!=''){
  dlink['type']=localStorage['whty'];
 }
 $.post('http://class.nokedo.com/data.php',dlink,function(data){
  if(data.match(/moptb/gi)!=null) {
   $(".post:last").after(data).delay('2000');			
   $('div#last_msg_loader').empty();
  }else if(aer!=info['uid']){
   $('div#last_msg_loader').text('No more posts to show.');
  }else{
   $('div#last_msg_loader').text('No more posts to show. Try following more people or pages');
  }
 });
}
$(window).scroll(function(){
 if($(window).scrollTop() + $(window).height() == $(document).height() && $(".post").length!=0){
  last_msg_funtion();
 }
});
/*Profile*/
$('.edit').live('click',function(){
 v=prompt($(this).attr('alt'));
 fg=$(this).attr('id');
 if(v!=null){
  shown({message:'Saving profile. Please Wait',type:'warn',duration:20});
  $(this).parents('.icont').find('v').text(v);
  $.post('http://class.nokedo.com/action.php',{new:v,action:'up_profile',wh:fg},function(data){shown({message:'Saved profile.'});}).error(function(){shown({type:'error',message:"Profile saving failed."});});
 }
});
$(".pchanger").live('change',function(){
 shown({message:'Saving privacy settings. Please Wait',type:'warn',duration:20});
 $.post('action.php',{action:'privacyc',wh:$(this).attr('id'),new:$(this).val()},function(){
  shown({message:'Saved privacy settings.'});
 }).error(function(){
  shown({message:"Privacy Settings Saving failed",type:"error"});
 });
});
/*End Profile*/
/*Basics*/
$('.like').die('click').live('click',function(event){
 event.preventDefault();
 var p=$(this);
 var nt=parseFloat(p.text())+1;
 $(this).text(nt).removeClass('like').addClass('unlike').attr('title','unlike');
 $.post('http://class.nokedo.com/action.php',{action:'like',id:$(this).attr('id')}).error(function(){
  shown({message:"Failed to like the post",type:"error"});
  p.text(parseFloat(p.text())-1).removeClass('unlike').addClass('like').attr('title','like');
 });
});
$('.unlike').die('click').live('click',function(event){event.preventDefault();
 var p=$(this);
 var nt=parseFloat(p.text())-1;
 $(this).text(nt).removeClass('unlike').addClass('like').attr('title','like');
 $.post('http://class.nokedo.com/action.php',{action:'unlike',id:$(this).attr('id')}).error(function(){
   shown({message:"Failed to unlike the post",type:"error"});
   p.text(parseFloat(p.text())+1).removeClass('like').addClass('unlike').attr('title','unlike');
 });
});
$('.cmt').die('click').live('click',function(){
 $(".comments#"+$(this).attr('id')).toggle();
});
$('.cmtform').die('submit').live('submit',function(event){
 $(this).find(':input:not(:disabled)').prop('disabled',true);
 event.preventDefault();
 var id=$(this).attr('id');
 varaw=$(this);
 tmpid=tmp();
 if($(this).find('[type=text]').val()!='' && $(this).attr('id')!=''){
  var json={action:'cmt',new:$(this).find('[type=text]').val(),id:$(this).attr('id')};
  $('.cmt#'+id).each(function(){
   $(this).text(parseFloat($(this).text())+1);
  });
  $('.loader#'+$(this).attr('id')).find('.comment:last').after('<div class="comment" id="'+tmpid+'"><div class="left"><img src="'+info['img']+'"/></div><div class="right"><div class="info"><a href="../profile.php?id='+info['uid']+'">'+info['name'].split(' ')[0]+'</a><span class="time timeago" title="'+cti()+'"></span></div><div class="cont">'+filt($(this).find('[type=text]').val())+'</div></div></div>');
  if($('.loader#'+$(this).attr('id')).find('.comment:last').length==0){
   $('.loader#'+$(this).attr('id')).html("<div class='comment' id='"+tmpid+"'><div class='left'><img src='"+info['img']+"'/></div><div class='right'><div class='info'><a href='../profile.php?id="+info['uid']+"'>"+info['name'].split(' ')[0]+"</a><span class='time timeago' title='"+cti()+"'></span></div><div class='cont'>"+filt($(this).find('[type=text]').val())+"</div></div></div>");
  }
  $.post('http://class.nokedo.com/action.php',json,function(data){varaw[0].reset();varaw.find(':input:disabled').prop('disabled',false);}).error(function(){
   shown({message:"Failed to comment on post",type:"error"});
   $('.loader#'+id).find('.comment#'+tmpid+':last').remove();
   $('.cmt#'+id).text(parseFloat($('.cmt#'+id).text())-1);
   if($('.loader#'+id).text()==''){
    $('.loader#'+id).html("<h2>No Comments</h2>");
   }
   varaw[0].reset();
   varaw.find(':input:disabled').prop('disabled',false);
  }).error(function(){
   shown({message:"Failed to comment on post. Try Again.",type:"error"});
   $(".comment#"+tmpid).remove();
   varaw[0].reset();
   varaw.find(':input:disabled').prop('disabled',false);
  });
 }else{
  shown({message:"Failed to comment on post. Try Again.",type:"error"});
  varaw[0].reset();
  varaw.find(':input:disabled').prop('disabled',false);
 }
});
$('.follow').expire().livequery('click',function(){
 if(info['uid']!=''){
  $(this).text('Unfollow').removeClass('sb-g follow').addClass('sb-red unfollow');
  $.post('http://class.nokedo.com/action.php',{action:'foll',id:$(this).attr('id')}).error(function(){
   shown({type:'error',message:"Following Failed."});
   $(this).text('Follow').removeClass('sb-red').addClass('sb-g');
  });
 }
});
$('.unfollow').expire().livequery('click',function(){
 if(info['uid']!=''){
  $(this).text('Follow').removeClass('sb-red').addClass('sb-g');
  $.post('http://class.nokedo.com/action.php',{action:'unfoll',id:$(this).attr('id')}).error(function(){
   shown({type:'error',message:"Unfollowing Failed."});
   $(this).text('Follow').removeClass('sb-g').addClass('sb-red');
  });
 }
});
$(".lmc").expire().livequery('click',function(){
 id=$(this).attr('id');
 shown({message:"Loading More Comments...",type:"info"});
 $.post('//class.nokedo.com/ajax/comments.php',{id:$(this).attr('id'),limit:"50"},function(data){
  $(".loader#"+id).html(data);
  shown({message:"Successfully Loaded Comments",type:"suc"});
 }).error(function(){
   shown({type:'error',message:"Comments Loading Failed."});
 });
});
