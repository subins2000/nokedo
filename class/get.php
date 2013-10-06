<?if(isset($_GET['hd'])){?><img onclick="shown({message:'Saving profile header image. Please Wait',type:'warn',duration:20});$.post('action.php',{action:'up_profile',wh:'hd',new:$(this).attr('src')},function(data){shown({message:'Saved profile header image.'});});" style="border:3px solid white;cursor:pointer;" src="//cdn.nokedo.com/images/header/Abstract.jpg" height="120" width="560"/><br/><br/><img onclick="shown({message:'Saving profile header image. Please Wait',type:'warn',duration:20});$.post('action.php',{action:'up_profile',wh:'hd',new:$(this).attr('src')},function(data){shown({message:'Saved profile header image.'});});" style="border:3px solid white;cursor:pointer;" src="//cdn.nokedo.com/images/header/mountains.jpg" height="120" width="560"/><br/><br/><img style="border:3px solid white;cursor:pointer;" onclick="shown({message:'Saving profile header image. Please Wait',type:'warn',duration:20});$.post('action.php',{action:'up_profile',wh:'hd',new:$(this).attr('src')},function(data){shown({message:'Saved profile header image.'});});" src="//cdn.nokedo.com/images/header/diff.jpg" height="120" width="560"/><br/><br/><img style="border:3px solid white;cursor:pointer;" onclick="shown({message:'Saving profile header image. Please Wait',type:'warn',duration:20});$.post('action.php',{action:'up_profile',wh:'hd',new:$(this).attr('src')},function(data){shown({message:'Saved profile header image.'});});" src="//cdn.nokedo.com/images/header/nature.jpg" height="120" width="560"/><script></script><?}?>
<?if(isset($_GET['lang'])){?><h2>Choose languages you know and click Submit button</h2>
<form id="langchooser">
<h3>Client Side languages</h3>
<input type="checkbox" value='HTML' />HTML
<input type="checkbox" value='CSS' />CSS
<input type="checkbox" value='Javascript' />Javascript
<input type="checkbox" value='jQuery' />jQuery
<h3>Server Side languages</h3>
<input type="checkbox" value='PHP' />PHP
<input type="checkbox" value='NodeJS' />NodeJS
<input type="checkbox" value='ASP' />ASP
<input type="checkbox" value='JSP' />JSP
<input type="checkbox" value='VBScript' />VBScript
<input type="checkbox" value='SMX' />SMX
<input type="checkbox" value='WebDNA' />WebDNA
<h3>Metaprogramming languages</h3>
<input type="checkbox" value='Python' />Python
<input type="checkbox" value='C' />C
<input type="checkbox" value='C#' />C#
<input type="checkbox" value='C++' />C++
<input type="checkbox" value='Java' />Java
<input type="checkbox" value='Perl' />Perl
<input type="checkbox" value='Ruby' />Ruby
<h3>Data-oriented languages</h3>
<input type="checkbox" value='SQL' />SQL
<input type="checkbox" value='WebQl' />WebQl
<br/><br/><input type="button" id="sv" value="Save Languages" style="margin: 0px auto;display: table;">
</form>
<script>
$r={};
$(".langknown").each(function(){$r[$(this).text()]='';});console.log($r);
for(var k in $r){$("#langchooser input[value="+k+"]").click();}
$("#langchooser #sv").live('click',function(){$t={};
shown({message:'Saving profile. Please Wait',type:'warn',duration:20});
$("#langchooser").find(":checked").map(function(){$t[$(this).val()]='true';});
$.post('action.php',{action:'lang',wh:JSON.stringify($t)},function(data){shown({message:'Saved profile. <a href="profile.php">Reload Page</a>'});}).error(function(){shown({message:'Profile Saving Failed.',type:"error"});});
});
</script>
<?}?>
