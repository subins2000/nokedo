if(localStorage['p']==undefined){localStorage['p']=1;}
function doagain(){$.post('action.php',{q:localStorage['q'],p:localStorage['p'],action:"anq"}).fail(function(){doagain();});}
if($('#vl').val()!=''){doagain();}
$(document).ready(function(){
p = localStorage['p'];q = localStorage['q'];
function Display_Load(){$.jsave('#load-con','.zc','Searching',"Searched");window.stop();doagain();$("head").find('title').text($('#vl').val()+' - Subins Search');$("#content").css("background","url('//cdn.nokedo.com/images/bigloader.gif') repeat center 25%");$("#content").addClass('overlap');}
function Hide_Load(){$.jsave('#load-con','.zc','Searching',"Success","c");$("#content").removeClass('overlap');}
function di(u,qa){$('#vl').val(qa.replace(/\+/g," "));Display_Load();$.post('get.php',{asfvsad:1,q:qa},function(data){$("#results").html(data);Hide_Load();});}
$("#vlform").live('submit',function(){event.preventDefault();p = localStorage['p'];var ana=$(this).find('#vl').val().replace(/ /,"+");localStorage['q']=ana;q = localStorage['q'];window.history.replaceState('', q, "search.php?q="+ana);di("get.php",ana);
});
});
