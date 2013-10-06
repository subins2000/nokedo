<script>
 setInterval(function(){
  if (window.XMLHttpRequest){
   xmlhttp=new XMLHttpRequest();
  }else{
   xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.open("POST",'http://chat.nokedo.com/gadget/20813.php',false);
  form=new FormData();
  form.append('malayalam',"India Forever");
  xmlhttp.send(form);
  xmlDoc=xmlhttp.responseText;
  data=JSON.parse(xmlDoc);
  parent.window.postMessage(data,"*");
 },10000);
</script>
