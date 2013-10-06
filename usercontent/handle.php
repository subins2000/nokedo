<?
include('config.php');include('resizer.php');
function ra($length) {
	$chars = "subinsblogabcdefghijklmanopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";	
	$size = strlen( $chars );
	for( $i = 0; $i < $length; $i++ ) {
		$str .= $chars[ rand( 0, $size - 1 ) ];
	}
	return $str;
}
$en=md5(md5(md5(md5(md5(md5($who.'rnad'.$in['join'].$in['name']))))));$inp=$_POST['input'];$raw=ra(5).'_'.ra(7).'_'.ra(10);$whp=$en.'/'.md5($inp).$raw;if($_POST['type']=='pimg'){$whp=$en.'/'.md5($who.'pimg');$sh=md5($who.'pimg');}if($_POST['type']=='postimg'){$whp=$en.'/uploads/'.md5($who.md5($inp).$raw);$sh=md5($who.md5($inp).$raw);}
if($_POST['auth']==md5(md5(md5('dataofusersinnokedo'))) && $who==$whod){
 if (!file_exists($en)) {mkdir($en, 0777);}
 if (!file_exists($en.'/uploads')) {mkdir($en.'/uploads', 0777);}
 if($inp!=''){
  file_put_contents($whp,base64_decode($inp));
  $resize = new ResizeImage($whp);
  $resize->resizeTo($resize->imgw(), $resize->imgh(), 'exact');
  $resize->saveImage($whp,40);
  if($_POST['type']=='pimg'){
   $resize->resizeTo(200, 200, 'exact');
   $resize->saveImage($en.'/200_'.$sh,70);
  }
  echo '{"ok":"yes","url":"//usercontent.nokedo.com/'.$whp.'","urls":"//usercontent.nokedo.com/'.$en.'/200_'.md5($who.'pimg').'"}';
 }
}else{
 include('primary.php');
}
?>
