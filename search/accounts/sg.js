setInterval(function(){if($(".terminal .cursor").css('background-color')!='rgb(0, 0, 0)'){$(".terminal .cursor").css('background','black');}else{$(".terminal .cursor").css('background','white');}},500);
var json={};
var jq={
0:{q:'Please write your full name',s:'name',ab:'Name',r:'^(?:[a-z]|[A-Z]).{4}',e:'Type a valid name'},
1:{q:'Type Your Email ID',s:'mail',ab:'E-Mail',r:'^[a-zA-Z0-9]+[a-zA-Z0-9_.-]+[a-zA-Z0-9_-]+@[a-zA-Z0-9]+[a-zA-Z0-9.-]+[a-zA-Z0-9]+.[a-z]{2,4}$',e:'Email is not valid'},
2:{q:'When were you born ? (DD/MM/YYYY)',s:'bir',ab:'Birthdate',r:'[0-9]{2}/[0-9]{2}/[0-9]{4}',e:'Birthdate is not valid'},
3:{q:'Are you a male or a female',s:'gender',ab:'Gender',r:'^(?:male|Male|female|Female)$',e:'Gender is not valid'},
4:{q:'Choose a password',s:'pass',ab:'Password',r:'.{6,100}',e:'Password must contain atleast 6 characters'},
};
var jqn=0;
function nline(){$('.line:last').after('<div class="line" id="'+(parseFloat($(".line:last").attr('id'))+1)+'"><span class="ar">&gt;</span><span class="txt"></span></div>');$(".cursor").remove();$(".line:last").append('<span class="cursor"></span>');}
function ask(t,s){localStorage['h']=s;if($('.line:last').attr('id')==1){$(".txt:last").html(t);}else{$('.line:last').after('<div class="line" id="'+(parseFloat($(".line:last").attr('id'))+1)+'"><span class="txt">'+t+'</span></div>');}nline();}
function msg(t,c){$('.line:last').after('<div class="line" id="'+(parseFloat($(".line:last").attr('id'))+1)+'"><span class="msg" style="color:'+c+'">'+t+'</span></div>');}
function submitm(){
if($('.txt:last').text().match(jq[jqn]['r'])==null){msg(jq[jqn]['e'],'red');}
else if($('.txt:last').text()!=''){h=localStorage['h'];if(h=='pass'){json[h]=$(".input").val();}else{json[h]=$('.txt:last').text()}jqn=jqn+1;if(Object.keys(jq).length!=jqn){ask(jq[jqn]['q'],jq[jqn]['s']);$(".input").val('');}else{msg("Registering",'green');$(".cursor,.input").remove();$.post('signup.php',json,function(data){msg(data,'green')});}
}else{msg(jq[jqn]['ab']+" can't be blank",'red');$(".input").val('');}
}
$("body").live('keydown',function(e){$(".input").focus().val($(".input").val());
if(e.which === 13){submitm();}
});
$(".input").live('keyup',function(){
if(localStorage['h']=='pass'){$(".txt:last").html($(".input").val().replace(/./gi,'*'));}else{$(".txt:last").html($(".input").val());}
});
$(".terminal").ready(function(){ask(jq[0]['q'],jq[0]['s']);});
