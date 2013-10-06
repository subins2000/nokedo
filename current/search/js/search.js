function doagain(){$.post('action.php',{q:localStorage['q'],p:1,action:"anq"}).fail(function(){doagain();});}
$(document).ready(function(){doagain();
p = localStorage['p'];q = localStorage['q'];function Display_Load(){$("#content").addClass('overlap');}function Hide_Load(){$("#content").removeClass('overlap');}
$("#pagination .pgn#"+p).removeClass('sb-g').addClass('sb-submit');
if($("#pagination .pgn").length>4){
if($("#pagination .pgn#"+p).attr('id')>$("#pagination .pgn:last").attr('id')-3){
    var start = $("#pagination .pgn:last").index()-5;
    var end = $("#pagination .pgn:last").index();
    var $li = $("#pagination tr > td.pgn");
    var $keepLi = $li.slice(start, end)
    $li.not($keepLi).remove();
}else{
if($("#pagination .pgn#"+p).index()<3){
    var start = 0;
    var end = 5;
    var $li = $("#pagination tr > td.pgn");
    var $keepLi = $li.slice(start, end)
    $li.not($keepLi).remove();
}else{
    var start = $("#pagination .pgn#"+p).index() - 3;
    var end = $("#pagination .pgn#"+p).index() + 2;
    var $li = $("#pagination tr > td.pgn");

    start = (start < 0) ? 0 : start;
    end = (end > $li.length) ? $li.length : end;

    var $keepLi = $li.slice(start, end)
    $li.not($keepLi).remove();}}}
$("#pagination .pgn#"+p).removeClass('sb-g');$('#pagination .pgn#'+p).addClass('sb-submit');var str = q;str = str.replace(/ /g, '+');
function di(url,u,k){p = localStorage['p'];q = localStorage['q'];
Display_Load();
$.post(url,{q:u,p:k},function(data){myJsonObject=eval('('+data+')');$("#nrf").html(myJsonObject.no);
if(myJsonObject.error=='yes'){var wht=myJsonObject.msg;$("#results").html(wht);}else{
localStorage['ach']='<div style="display: inline-block;">';
$.each(myJsonObject.results, function(i, obj) {
if(i==10){
localStorage['ach']=localStorage['ach']+'</div><div style="display: inline-block;position: absolute;right: 0px;"><div style="border: 2px dashed #EEE;margin-right:10px;"><div style="display:inline-block;"><img src="'+obj.img+'" height="32px" width="32px"></div><div style="display: inline-block;position: relative;top: -12px;left: 5px;"><a target="_blank" style="color:blue !important;" href="'+obj.url+'">'+obj.title+'</a></div></div>';
}else{
localStorage['ach']=localStorage['ach']+'<div style="border: 2px dashed #EEE;margin-right:10px;"><div style="display:inline-block;"><img src="'+obj.img+'" height="32px" width="32px"></div><div style="display: inline-block;position: relative;top: -12px;left: 5px;max-width: 244px;text-overflow: ellipsis;white-space: nowrap;overflow: hidden;"><a target="_blank" style="color:blue !important;" href="'+obj.url+'">'+obj.title+'</a></div></div>';
}
});
$("#results").html('<div style="display: inline-block;">'+localStorage['ach']+'</div><ul id="pagination"><center style="position: relative;left: -45px;"><table style="display: inline-block;"><tbody><tr height="30px"><td class="nc sb pointer" id="prev"><</td>');
for(i=0; i<myJsonObject.ps; i++){if(i==0){i=1;}
$("#pagination td:last").after('<td class="pgn sb" id="'+i+'">'+i+'</td>');
}
$("#pagination td:last").after('<td class="nc sb pointer" id="next">></td></tr></tbody></table></center></ul>');
if($("#pagination .pgn").length>4){
if($("#pagination .pgn#"+p).attr('id')>$("#pagination .pgn:last").attr('id')-3){
    var start = $("#pagination .pgn:last").index()-5;
    var end = $("#pagination .pgn:last").index();
    var $li = $("#pagination tr > td.pgn");
    var $keepLi = $li.slice(start, end)
    $li.not($keepLi).remove();
}else{
if($("#pagination .pgn#"+p).index()<3){
    var start = 0;
    var end = 5;
    var $li = $("#pagination tr > td.pgn");
    var $keepLi = $li.slice(start, end)
    $li.not($keepLi).remove();
}else{
    var start = $("#pagination .pgn#"+p).index() - 3;
    var end = $("#pagination .pgn#"+p).index() + 2;
    var $li = $("#pagination tr > td.pgn");

    start = (start < 0) ? 0 : start;
    end = (end > $li.length) ? $li.length : end;

    var $keepLi = $li.slice(start, end)
    $li.not($keepLi).remove();}}}
$("#pagination .pgn#"+p).removeClass('sb-g').addClass('sb-submit');
}
Hide_Load();
});
}
$(".pgn").live('click',function(){Display_Load();$("#pagination td").css({'border' : 'solid solid rgb(221, 221, 221) 1px'}).css({'color' : 'white'});$(this).css({'color' : '#FF0084'}).css({'left' : '0px'}).css({'position' : 'relative'}).css({'border' : 'none'});localStorage['p']=this.id;var pageNum = this.id;window.history.replaceState('', q, "search.php?q="+q+"&p="+this.id);
di("get.php",q,pageNum);});$("#prev").live('click',function(){var pageNum = parseFloat($(".pgn.sb-submit").attr('id'))-1;if(pageNum<$(".pgn:first").attr('id')){}else{localStorage['p']=pageNum;window.history.replaceState('', q, "search.php?q="+q+"&p="+pageNum);di("get.php",q,pageNum);}});$("#next").live('click',function(){var pageNum = parseFloat($(".pgn.sb-submit").attr('id'))+1;if(pageNum>$(".pgn:last").attr('id')){}else{localStorage['p']=pageNum;di("get.php",q,pageNum);window.history.replaceState('', q, "search.php?q="+q+"&p="+pageNum);}});
$("#vlform").live('submit',function(){Display_Load();event.preventDefault();localStorage['p']=1;
p = localStorage['p'];var ana=$(this).find('#vl').val().replace(" ","+");localStorage['q']=ana;q = localStorage['q'];window.history.replaceState('', q, "search.php?q="+ana+"&p=1");di("get.php",ana,'1');
});

});
