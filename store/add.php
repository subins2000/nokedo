<!DOCTYPE html><html><head>
<?include('config.php');check();?>
<script src="http://cdn.nokedo.com/js/js.php?f=store"></script>
<link href="//cdn.nokedo.com/css/all.php" rel="stylesheet">
<title>OneStore - Add</title>
</head><body>
<div id="content">
<h2>Add Your Magic !</h2>
Have you or you're company created a software ? Then <a href="add.php">add it</a> now to OneStore.
<?$name=$_POST['name'];$url=$_POST['url'];$ver=$_POST['ver'];$bit=$_POST['bit'];$ds=$_POST['ds'];
if(isset($_POST) && $name!='' && $url!='' && $ver!='' && $bit!='' && $ds!=''){echo"<br/><div clear/>";
 function url_exists($url) {
    if (!$fp = curl_init($url)) return false;
    return true;
 }
 if(!preg_match('@((www|apt://|http://)[^ ]+)@',$url) || !url_exists($url)){
  die("<span style='color:red;font-size:20px;'>Invalid URL</span>");
 }
 if(strlen($name)<3){die("<span style='color:red;font-size:20px;'>Name Must have atleast 3 characters</span>");}
 if($bit!='16' && $bit!='32' && $bit!='64'){die("<span style='color:red;font-size:20px;'>Not a valid Bit</span>");}
 $sp="";
 if($_POST['lin']){$sp.="lin";}if($_POST['win']){$sp.=",win";}if($_POST['mac']){$sp=",mac";}
 if($_POST['cname']!=''){$j='{"time":"'.date("Y-m-d H:i:s").'","bit":"'.$bit.'","pl":"'.$sp.'","ver":"'.$ver.'","cn":"'.$_POST['cname'].'"}';}else{$j='{"time":"'.date("Y-m-d H:i:s").'","bit":"'.$bit.'","pl":"'.$sp.'","ver":"'.$ver.'"}';}
 $sql=$db->prepare("INSERT INTO store(uid,title,ds,url,ty,json)VALUES(?,?,?,?,?,?)");
 $s=$sql->execute(array($who,$name,$ds,$url,'soft',$j));
 if($s==1){echo "<span style='color:red;font-size:20px;'>Successfully Added $name</span>";}
}?>
<form style="margin-top:12px;" method="POST">
<table><tbody>
<tr><td>Name : </td><td><input type="text" placeholder="Software Name" autocomplete="off" name="name" size="32"/></td></tr>
<tr><td>Description : </td><td><textarea name="ds"></textarea></td></tr>
<tr><td>Download Direct URL : </td><td><input type="text" autocomplete="off" placeholder="Download URL of the software setup file" name="url" size="32"/></td></tr>
<tr><td>Platform :</td><td><input type="checkbox" name="lin" checked>Linux&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="win" >Windows&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="mac">Mac</td></tr>
<tr><td>Bit : </td><td><select name="bit"><option value="16">16 Bit</option><option value="32" selected>32 Bit</option><option value="64">64 Bit</option></select></td></tr>
<tr><td>Version : </td><td><input type="text" placeholder="Software Version" autocomplete="off" name="ver" size="32"/></td></tr>
<tr><td>Developed By : </td><td><input type="text" placeholder="(Optional) Company Name" name="cname" size="32"/></td></tr>
<tr><td></td><td><input type="submit"/></td></tr>
</tbody></table>
</form>
</div>
</body></html>
