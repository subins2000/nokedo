<?include('config.php');if($who==$whod){header("Location:Home.php");}?>
<!DOCTYPE html><html><head>
<link href="//cdn.nokedo.com/css/all.php" rel="stylesheet">
<script src="//cdn.nokedo.com/js/js.php?f=sites"></script>
<title>MyClass - A Website Info Site</title>
</head><body>
<div id="content">
 <h2>Info about sites on the WWW</h2>
 <a href="//sites.nokedo.com">Nokedo Sites</a> contains information about websites which includes Website Owner, Quality, Category and ofcourse Ranking.<br/>
 <a href="//sites.nokedo.com/add.php">Let's add your site</a><br/>
 <a href="//sites.nokedo.com/search.php">See information about a site</a><br/><br/>
 You should need a <b>Nokedo</b> account to add a site and enjoy more features. <a href="//nokedo.com/accounts/login.php?c=<?echo urlencode('//sites.nokedo.com');?>">Log In</a> or <a href="//nokedo.com/accounts/signup.php?c=<?echo urlencode('//sites.nokedo.com');?>">Signup</a>
</div>
</body></html>
