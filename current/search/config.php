<?php
function dob ($birthday){
    list($day,$month,$year) = explode("/",$birthday);
    $year_diff  = date("Y") - $year;
    $month_diff = date("m") - $month;
    $day_diff   = date("d") - $day;
    if ($day_diff < 0 || $month_diff < 0)
      $year_diff--;
    return $year_diff;
  }
function deCookie($value){
   if(!$value || $value==null || $value==''){return 'truth';}else{
   $key = 'gbfre8*^&%$#%^@(t0+_3a=t[tg;emj';
   $crypttext = base64_decode($value); //decode cookie
   $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
   $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
   $decrypttext = mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $key, $crypttext, MCRYPT_MODE_ECB, $iv);
   return trim($decrypttext);}
}
$mysql_hostname = "sql300.byethost15.com";
$mysql_user = "b15_12726744";
$mysql_password = "Subin123";
$mysql_database = "b15_12726744_db";
$bd = mysql_connect($mysql_hostname, $mysql_user, $mysql_password) or die("Opps some thing went wrong");
mysql_select_db($mysql_database, $bd) or die("Opps some thing went wrong");
?>
