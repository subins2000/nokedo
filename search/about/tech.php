<!DOCTYPE html><html><head>
<script src="http://cdn.nokedo.com/js/js.php"></script>
<link href="//cdn.nokedo.com/css/all.php" rel="stylesheet">
</head><body style="margin:5% auto;">
<center>Last Updated : 27/08/2013</center><br/>
<div style="margin:0px auto;width:500px;">
 <div class="polu">
  <h1>Client Side</h1>
  <b>Nokedo</b> uses <a href='#jquery'><b>jQuery</b></a> Library.<br/>
  <b>Nokedo</b> also uses <b>jQuery</b> <a href='#plugins'>Plugins</a> at different places.<br/>
  <b>Javascript</b> code for different sites are served by <a href='#js'>js.php</a>.
  <h1>Server Side</h1>
  <b>Nokedo</b> uses <b>PHP</b> as the server side language. No other languages are used in the server side.<br/>
  <b>Nokedo</b> doesn't use any external <b>PHP</b> classes other than the <a href="#store">rating system</a> on <b>Nokedo Store</b>.
 </div>
 <div id="jquery" class="polu">
  <h2>jQuery</h2>
  <b>Nokedo</b> uses the <b>1.10.0</b> version of <b>jQuery</b> Library:
  <blockquote>
  /*!<br/>
  * jQuery JavaScript Library v1.10.0<br/>
  * http://jquery.com/<br/>
  *<br/>
  * Includes Sizzle.js<br/>
  * http://sizzlejs.com/<br/>
  *<br/>
  * Copyright 2012 jQuery Foundation and other contributors<br/>
  * Released under the MIT license<br/>
  * http://jquery.org/license<br/>
  *<br/>
  * Date: 2013-07-03T13:48Z<br/>
  */
  </blockquote>
  <h3>Why jQuery ?</h3>
  <blockquote>
   <b>jQuery</b> is a trusted JavaScript Library by developers for many years and a lot of people have created plugins in <b>jQuery</b> which makes <b>jQuery</b> the perfect Javascript Library.
  </blockquote>
 </div>
 <div id="plugins" class="polu">
  <h2>jQuery Plugins</h2>
  <b>Nokedo</b> uses the following <b>jQuery</b> plugins :
  <ul>
   <li>Colorbox</li>
   <li>TimeAgo</li>
   <li>liveQuery</li>
  </ul>
 </div>
 <div id="js" class="polu">
  <h2>JavaScript serving</h2>
  <b>Nokedo</b> serves <b>JavaScript</b> to it's children sites with the file <b>js.php</b> in <b>CDN</b> subdomain. The url of the <b>js.php</b> file is <a href='http://cdn.nokedo.com/js/js.php'>http://cdn.nokedo.com/js/js.php</a>
  <br/>The following list shows the sites that has a special <b>js</b> file.
  <ul>
   <li>MyClass</li>
   <li>Search</li>
   <li>Store</li>
   <li>Chat</li>
  </ul>
 </div>
 <div id="store" class="polu">
  <h2>OneStore</h2>
  <b>OneStore</b> is the only child site that uses an external <b>PHP</b> class. It's actullay a class named <b>Xoriant Ratings</b> delivered by <b>PHPClasses.ORG</b>
 </div>
</div>
<style>.polu{text-align:left;background:white;border:2px solid #EEE;word-wrap: break-word;border-radius:15px;padding-left:15px;padding-right:15px;padding-bottom:15px;line-height:20px;margin-top:15px;}</style>
</body></html>
