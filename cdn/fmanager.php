<?
$f=$_GET['w8gp'];
$h=$_SERVER['HTTP_HOST'];
if($h=='class.nokedo.com'){
 if(preg_match("/\~/",$f)){
  $_GET['id']=str_replace("~","",$f);
  include("profile.php");
 }elseif(file_exists($f) || file_exists($f.".php")){
  $f=substr($f,0,-4)==".php" ? $f:$f.".php";
  include($f);
 }else{
  include("config.php");
  ser();
 }
}elseif($h=='chat.nokedo.com'){
 if(preg_match("/rooms/",$f)){
  $_GET['id']=explode("/",$f)[1];
  include("room.php");
 }else if(preg_match("/users/",$f)){
  $_GET['id']=explode("/",$f)[1];
  include("index.php");
 }else{
  include("config.php");
  ser();
 }
}else{
 if(file_exists($f) || file_exists($f.".php")){
  include($f);
 }else{
  include("config.php");
  ser();
 }
}
?>
