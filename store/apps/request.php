<!DOCTYPE html><html><head>
<?include('../config.php');?>
<meta name="description" value="Request an app addition."/>
<script src="http://cdn.nokedo.com/js/js.php?f=store"></script>
<link href="//cdn.nokedo.com/css/all.php" rel="stylesheet">
<title>Request an App Add - Nokedo OneStore</title>
</head><body>
<div id="content">
<h2>Request for an App Addition.</h2>
If you have an app that you would like to add on <b>OneStore</b>, then fill up the form:
<form clear style="border-top:1px solid black;" method="POST">
 Type of App : 
<select name="type">
<option value="acc">Accessories</option>
<option value="edu">Education</option>
<option value="sci">Science</option>
<option value="gra">Graphics</option>
<option value="net">Internet</option>
<option value="off">Office</option>
<option value="pro">Programming</option>
<option value="media">Multimedia</option>
</select><br/>
Information about your app.<br/>
<textarea name="msg"></textarea><br/>
Do you need hosting for your app ?<br/>
<textarea name="host"></textarea><br/>
What is youe e-mail ?<br/>
<input type="text" name='mail' /><br/>
(We ask you to fill this from because there may be an app with the same purpose of your app.)
<div clear style="border-top:1px solid black;"/>
<input type="submit"/>
The information you have given to us are sent to one of the site admins(<a target="_blank" href='//class.nokedo.com/profile.php?id=1'>Subin</a>).
</form>
<?
if(isset($_POST['type'])){
 if($_POST['type']!='' && $_POST['msg']!='' && $_POST['host']!='' && $_POST['mail']!=''){
  send_mail('subins2000@gmail.com','App Request','Type: '.$_POST['type'].'<br/>Message: '.$_POST['msg'].'<br/>Hosting: '.$_POST['host'].'<br/>Email: '.$_POST['mail']);
 }else{
  die("<h2>Fill Up all the fields.</h2>");
 }
}
?>
</div>
</body></html>
