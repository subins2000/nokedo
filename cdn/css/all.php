<?
header("Content-Type:text/css");
include("cssmin-v3.0.1-minified.php");
function tyw($s){
 $plugins = array(
        "Variables"                     => true,
        "ConvertFontWeight"             => true,
        "ConvertHslColors"              => true,
        "ConvertRgbColors"              => true,
        "ConvertNamedColors"            => true,
        "CompressColorValues"           => true,
        "CompressUnitValues"            => true,
        "CompressExpressionValues"      => true
 );
 $minifier = new CssMinifier(file_get_contents('./'.$s), $filters, $plugins);
 $result = $minifier->getMinified();
 return $result;
}
$d=preg_replace('/http(.*?)\/\//','',$_SERVER['HTTP_REFERER']);
$d=explode('/',$d)[0];
echo tyw('main.css');
if($d=='nokedo.com'){echo tyw('search.css');}
if($d=='class.nokedo.com'){echo tyw('class.css');}
if($d=='chat.nokedo.com'){echo tyw('chat.css');}
if($d=='get.nokedo.com'){echo tyw('store.css');}
echo tyw('di.css');
?>
