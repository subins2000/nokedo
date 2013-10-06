<!DOCTYPE html><html><head>
<script src="//code.jquery.com/jquery-latest.min.js"></script>
<script src="http://easycalculation.com/basic-calculator.js"></script>
</head><body>
<div id="calculator">
 <h2>Scientific Calculator</h2>
  <table width="100%" border="0" cellpadding="0" cellspacing="4" bgcolor="#e6ecf6">
	 <tbody><tr><td colspan="2"><table class="result" width="100%" height="100%">
     <tbody><tr><td>
	<form name="calci" onsubmit="return false">
	 <div style="background:#c1c1c1 url(images/bg.jpg) repeat-x; width:200px; height:310px; padding:5px; border:1px solid #aaaaaa;">
		<table width="190" border="0" cellspacing="0" cellpadding="4">
			  <tbody><tr><td> <input name="result" type="button" value="" class="txt_box" readonly=""> </td> </tr>
			  <tr><td>
				<table class="funct" border="0" align="center" width="50%" cellpadding="0" cellspacing="0"> <tbody><tr width="100%" align="center">
					<td width="20%" align="center"> <input title="1/x" type="button" name="oneby" onclick="change(this)" value="1/x" class="button"></td>
					<td width="20%" align="center"><input title="square of x" type="button" name="squareof" onclick="change(this)" value="x^2" class="button"></td>
					<td width="20%" align="center"><input title="square root of x" type="button" name="squareroot" onclick="change(this)" value="SQRT" class="button"></td>
					<td width="20%" align="center"><input title="Clear" type="button" name="clear" onclick="change(this)" value="AC" class="button"></td>
				</tr></tbody></table>
			</td></tr>
			<tr><td>
				<table width="50%" border="0" align="center" cellpadding="0" cellspacing="0"> <tbody><tr width="100%" align="center">
					<td width="20%" align="center"><input type="button" title="Inverse of" class="button" name="inverse" value="Inv" disabled=""></td>
					<td width="20%" align="center"><input type="button" title="sin(x)" name="sin" onclick="change(this)" value="sin" class="button"></td>
					<td width="20%" align="center"><input type="button" title="cos(x)" name="cos" onclick="change(this)" value="cos" class="button"></td>
					<td width="20%" align="center"><input type="button" title="tan(x)" name="tan" onclick="change(this)" value="tan" class="button"></td>
				</tr></tbody></table>
			</td></tr>
			<tr><td>
				<table width="50%" border="0" align="center" cellpadding="0" cellspacing="0"> <tbody><tr width="100%" align="center">
					<td width="20%" align="center"><input type="button" title="Base of Natural Logarithm" name="nnlog" onclick="change(this)" value="e" class="button"></td>
					<td width="20%" align="center"><input type="button" title="Base 10 Logarithm" name="tenlog" onclick="change(this)" value="log" class="button"></td>
					<td width="20%" align="center"><input type="button" title="Natural Logarithm" name="nlog" onclick="change(this)" value="ln" class="button"></td>
					<td width="20%" align="center"><input type="button" title="x to the power of y" name="power" onclick="change(this)" value="^" class="button"></td>
				</tr></tbody></table>
			</td></tr>
			<tr><td>
				<table width="50%" border="0" align="center" cellpadding="0" cellspacing="0"> <tbody><tr width="100%" align="center">
					<td width="20%" align="center"><input type="button" title="exponential" name="exp" onclick="change(this)" value="exp" class="button"></td>
					<td width="20%" align="center"><input type="button" title="PI" name="pi" onclick="change(this)" value="PI" class="button"></td>
					<td width="20%" align="center"><input type="button" title="factorial" name="fact" onclick="change(this)" value="x!" class="button"></td>
					<td width="20%" align="center"><input type="button" title="Divide By" name="dby" onclick="change(this)" value="/" class="button"></td>
				</tr></tbody></table>
			</td></tr>
			<tr><td>
				<table width="50%" border="0" align="center" cellpadding="0" cellspacing="0"> <tbody><tr width="100%" align="center">
					<td width="20%" align="center"><input type="button" title="seven" name="seven" onclick="change(this)" value="7" class="button"></td>
					<td width="20%" align="center"><input type="button" title="eight" name="eight" onclick="change(this)" value="8" class="button"></td>
					<td width="20%" align="center"><input type="button" title="nine" name="nine" onclick="change(this)" value="9" class="button"></td>
					<td width="20%" align="center"><input type="button" title="Multiply By" name="multiply" onclick="change(this)" value="*" class="button"></td>
				</tr></tbody></table>
			</td></tr>
			<tr><td>
				<table width="50%" border="0" align="center" cellpadding="0" cellspacing="0"> <tbody><tr width="100%" align="center">
					<td width="20%" align="center"><input type="button" title="four" name="four" onclick="change(this)" value="4" class="button"></td>	
					<td width="20%" align="center"><input type="button" title="five" name="five" onclick="change(this)" value="5" class="button"></td>
					<td width="20%" align="center"><input type="button" title="six" name="six" onclick="change(this)" value="6" class="button"></td>		
					<td width="20%" align="center"><input type="button" title="Subtract" name="subtract" onclick="change(this)" value="-" class="button"></td>
				</tr></tbody></table>
			</td></tr>
			<tr><td>
				<table width="50%" border="0" align="center" cellpadding="0" cellspacing="0"> <tbody><tr width="100%" align="center">
					<td width="20%" align="center"><input type="button" title="one" name="one" onclick="change(this)" value="1" class="button"></td>
					<td width="20%" align="center"><input type="button" title="two" name="two" onclick="change(this)" value="2" class="button"></td>
					<td width="20%" align="center"><input type="button" title="three" name="three" onclick="change(this)" value="3" class="button"></td>
					<td width="20%" align="center"><input type="button" title="Add" name="add" onclick="change(this)" value="+" class="button"></td>
				</tr></tbody></table>
			</td></tr>
			<tr><td>
				<table width="50%" border="0" align="center" cellpadding="0" cellspacing="0"> <tbody><tr width="100%" align="center">
					<td width="20%" align="center"><input title="Zero" type="button" name="zero" onclick="change(this)" value="0" class="button"></td>
					<td width="20%" align="center"><input title="dot" type="button" name="dot" onclick="change(this)" value="." class="button"></td>
					<td width="20%" align="center"><input title="go back" type="button" name="back" onclick="change(this)" value="&lt;" class="button"></td>
					<td width="20%" align="center"><input title="EQUALS" type="button" name="equals" onclick="change(this)" value="=" class="button"></td>
				</tr></tbody></table>
			</td></tr>
		  </tbody></table> </div>
	</form></td> <td width="60%">
		<div class="res" style="background:#c1c1c1 url(images/bg.jpg) repeat-x; width:450px; height:279px; padding:5px; border:1px solid #aaaaaa;">
		    <table width="100%" height="100%" border="0" align="left">
			<tbody><tr valign="top">
				<td align="left" valign="top">
					<div id="results">
					<div align="center" class="res1"><b> Result History </b></div> <br>
					<div id="lastrow"> </div><br>
					</div>
				</td></tr></tbody></table>
		</div>
	</td> </tr>
	</tbody></table>
     <br>
   </td>
   <td>&nbsp;</td>
   </tr>
   <tr>
    <td colspan="2" align="right">&nbsp;</td>
    <td>&nbsp;</td>
   </tr>
</tbody></table>
</div>
<style type="text/css">
.button
{
	background:url(http://easycalculation.com/images/button.jpg) no-repeat;
	width:44px;
	height:26px;
	font:14px Arial, Helvetica, sans-serif;
	border:0;
}
.txt_box
{
	background:url(http://easycalculation.com/images/txt_box.jpg) repeat-x;
	width:195px;
	height:30px;
	font:14px Arial, Helvetica, sans-serif;
	border:1px solid #999999;
}
.mouseove:hover
{
	cursor: pointer;
}

</style>
</body></html>
