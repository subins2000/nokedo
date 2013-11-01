<?
include('config.php');
include('resizer.php');
function ra($length) {
 $chars = "subinsblogabcdefghijklmanopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789"; 
 $size = strlen( $chars );
 for($i=0;$i<$length;$i++) {
  $str.=$chars[rand(0,$size-1)];
 }
 return $str;
}
$who=$_POST['user'];
$whod=decrypter($_POST['whod']);
$in=un($who);
$en=md5(md5(md5(md5(md5(md5($who.'rnad'.$in['joined'].$in['name']))))));
$inp=$_POST['input'];
$raw=ra(5).'_'.ra(7).'_'.ra(10);
$file_path=$en.'/'.md5($inp).$raw;
if($_POST['type']=='pimg'){
 $sh=md5($who.'pimg');//File Name
 $file_path=$en.'/'.$sh;
}
if($_POST['type']=='postimg'){
 $sh=md5($who.md5($inp).$raw);
 $file_path=$en.'/uploads/'.$sh;
}
if($_POST['auth']==md5(md5(md5('dataofusersinnokedo'))) && $who==$whod){
 if(!file_exists($en)){mkdir($en, 0777);}
 if(!file_exists($en.'/uploads')){mkdir($en.'/uploads', 0777);}
 if($inp!=''){
  file_put_contents($file_path,base64_decode($inp));
  $resize = new ResizeImage($file_path);
  $resize->resizeTo($resize->imgw(), $resize->imgh(), 'exact');
  $resize->saveImage($file_path,40);
  if($_POST['type']=='pimg'){
   $resize->resizeTo(200, 200, 'exact');
   $resize->saveImage($en.'/200_'.$sh,70);
  }
  echo '{"ok":"yes","url":"//usercontent.nokedo.com/'.$file_path.'","urls":"//usercontent.nokedo.com/'.$en.'/200_'.$sh.'"}';
 }
}else{
 include('primary.php');
}
?>
