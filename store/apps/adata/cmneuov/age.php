<html xmlns="http://www.w3.org/1999/xhtml"><head profile="http://www.w3.org/2005/10/profile">
	<title> Online age calculator, calculate your birthday </title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<script type="text/javascript">
function isNum(arg){
	var args = arg;
	if (args == "" || args == null || args.length == 0)
	{
		return false;
	}
	args = args.toString();
	for (var i = 0;  i<args.length;  i++)
	{
		if ((args.substring(i,i+1) < "0" || args.substring(i, i+1) > "9") && args.substring(i, i+1) != ".")
		{
		return false;
		}
	}
	return true;
}
function checkday(aa){
	var val = aa.value;
	var valc = val.substring(0,1);
	if(val.length>0 && val.length<3)
	{
		if(!isNum(val) || val == 0)
		{
			aa.value="";
		}
		else if( val < 1 || val > 31)
		{
			aa.value=valc;
		}
	}
	else if(val.length>2)
	{
		val = val.substring(0, 2);
		aa.value=val;
	}
}
function checkmon(aa){
	var val = aa.value;
	var valc = val.substring(0,1);
	if(val.length>0 && val.length<3)
	{
		if(!isNum(val) || val == 0)
		{
			aa.value="";
		}
		else if(val < 1 || val > 12)
		{
			aa.value=valc;
		}
	}
	else if(val.length>2)
	{
		val = val.substring(0, 2);
		aa.value=val;
	}
}
function checkyear(aa){
	var val = aa.value;
	var valc = val.substring(0,(val.length-1));
	if(val.length>0 && val.length<7)
	{
		if(!isNum(val) || val == 0)
		{
			aa.value=valc;
		}
		else if(val < 1 || val>275759)
		{
			aa.value="";
		}
	}
	else if(val.length>4)
	{
		aa.value=valc;
	}
}
function checkleapyear(datea){
	if(datea.getYear()%4 == 0)
	{
		if(datea.getYear()% 10 != 0)
		{
			return true;
		}
		else
		{
			if(datea.getYear()% 400 == 0)
				return true;
			else
				return false;
		}
	}
return false;
}

function DaysInMonth(Y, M) {
    with (new Date(Y, M, 1, 12)) {
        setDate(0);
        return getDate();
    }
}

function datediff(date1, date2) {
    var y1 = date1.getFullYear(), m1 = date1.getMonth(), d1 = date1.getDate(),
	 y2 = date2.getFullYear(), m2 = date2.getMonth(), d2 = date2.getDate();
    if (d1 < d2) {
        m1--;
        d1 += DaysInMonth(y2, m2);
    }
    if (m1 < m2) {
        y1--;
        m1 += 12;
    }
    return [y1 - y2, m1 - m2, d1 - d2];
}
function calage(){
	var curday = document.cir.len11.value;
	var curmon = document.cir.len12.value;
	var curyear = document.cir.len13.value;
	var calday = document.cir.len21.value;
	var calmon = document.cir.len22.value;
	var calyear = document.cir.len23.value;
	if(curday == "" || curmon=="" || curyear=="" || calday=="" || calmon=="" || calyear=="")
	{
		alert("please fill all the values and click go -");
                result_empty();
	}	
	else if(curday == calday &&  curmon==calmon && curyear==calyear)
	{
            alert("Today your birthday & Your age is 0 years old");
            result_empty();
        }
	else
	{
            if(parseFloat(calyear)>parseFloat(curyear))
            {   
                alert("Enter Your date of birth year less than current year");
                result_empty();
            }
            else if(parseFloat(calyear)==parseFloat(curyear) && parseFloat(calmon)>parseFloat(curmon))
            {   
                alert("Enter Your date of birth month less than current month");
                result_empty();
            }
            else if(parseFloat(calyear)==parseFloat(curyear) && parseFloat(calmon)==parseFloat(curmon) && parseFloat(calday)>parseFloat(curday))
            {   
                alert("Enter Your date of birth date less than current date");
                result_empty();
            }
            else
            {
		var curd = new Date(curyear,curmon-1,curday);
		var cald = new Date(calyear,calmon-1,calday);
		
		var diff =  Date.UTC(curyear,curmon-1,curday,0,0,0) - Date.UTC(calyear,calmon-1,calday,0,0,0);
		var dife = datediff(curd,cald);
		document.cir.val.value=dife[0]+" years, "+dife[1]+" months, and "+dife[2]+" days";
		var secleft = diff/1000/60;
		document.cir.val3.value=secleft+" minutes since your birth";
		var hrsleft = secleft/60;
		document.cir.val2.value=hrsleft+" hours since your birth";
	
		var daysleft = hrsleft/24;
		document.cir.val1.value=daysleft+" days since your birth";	
		
		//alert(""+parseInt(calyear)+"--"+dife[0]+"--"+1);
		var as = parseInt(calyear)+dife[0]+1;
		var diff =  Date.UTC(as,calmon-1,calday,0,0,0) - Date.UTC(curyear,curmon-1,curday,0,0,0);
		var datee = diff/1000/60/60/24;
		document.cir.val4.value=datee+" days left for your next birthday";	
            }
	}
}
function color(test){
	for(var j=7; j<12; j++)
	{
		var myI=document.getElementsByTagName("input").item(j);
		//myI.setAttribute("style",ch);
		myI.style.backgroundColor=test;
	}
}

function color1(test){
var myI=document.getElementsByTagName("table").item(0);
//myI.setAttribute("style",ch);
myI.style.backgroundColor=test;
}
function result_empty(){
    document.cir.val.value="";
    document.cir.val1.value="";
    document.cir.val2.value="";
    document.cir.val3.value="";
    document.cir.val4.value="";
    return false;
}
</script> </head>
<body bgcolor="#e6ecf6">
<center><h2>Age calculator</h2></center>
<form name="cir">[date range can be from <span class="form"><b>01-01-01 to 31-12-275759 </b></span>] 
<table cellspacing="0" cellpadding="3"><tbody>
<tr><td colspan="2"> <br> Today's Date is :</td></tr>
<tr><td colspan="2" align="center">
 Date - <input name="len11" type="text" size="2" onkeyup="checkday(this)" value="5">
 Month - <input name="len12" type="text" size="2" onkeyup="checkmon(this)" value="8">
 Year - <input name="len13" type="text" size="4" onkeyup="checkyear(this)" value="2013"> <br><br>
 </td></tr>
 <tr><td colspan="2">
 Enter Your Date of Birth : </td></tr> <tr><td colspan="2" align="center"> 
 Date - <input name="len21" type="text" size="2" onkeyup="checkday(this)">
 Month - <input name="len22" type="text" size="2" onkeyup="checkmon(this)">
 Year - <input name="len23" type="text" size="4" onkeyup="checkyear(this)"><br><br> 
 <input name="but" type="button" value=" Go " onclick="calage()" class="calc"><br><br>
 </td></tr>
 <tr><td width="30%" align="center" class="form"><b>
</b></td></tr></tbody></table>
<table><tbody><tr><td><b>Your Age is </b></td><td> <input name="val" type="text" size="36" class="resform" readonly=""> </td></tr> 		
<tr><td><b>Your Age in Days </b></td><td> <input name="val1" type="text" size="36" class="resform" readonly=""></td>
</tr><tr><td><b>
Your Age in Hours </b></td><td> <input name="val2" type="text" size="36" class="resform" readonly="">(Approximate)</td></tr> 	
  <tr><td class="form"><b>Your Age in Minutes </b></td><td> <input name="val3" type="text" size="36" class="resform" readonly="">(Approximate)</td></tr>
  <tr><td>&nbsp;</td></tr> 		
  <tr><td></td><td> <input name="val4" type="text" size="36" readonly=""> </td></tr>
  </tbody></table>
</form>

</body></html>
