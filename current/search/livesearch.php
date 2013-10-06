<?php
include('config.php');
$page=$_POST['p'];
$q = $_POST['q'];
$tbl_name="search"; // Table name 
$q = $_GET['q'];
 $dataa = mysql_query("SELECT * FROM search WHERE title LIKE'%$q%' ORDER BY id"); 
 //If they did not enter a search term we give them an error 
 if ($q == "") 
 { 
 echo "<h2><p>Please Enter a search term</p></h2>"; 
 exit; 
 } 
 // Otherwise we connect to our Database 
 // We preform a bit of filtering 
 //Now we search for our search term, in the field the user specified 
 //And we display the results
 // This shows the user what page they are on, and the total number of page
 // First we check if we are on page one. If we are then we don't need a link to the previous page or the first page so we do nothing. If we aren't then we generate links to the first page, and to the previous page. 
 //This counts the number or results - and if there wasn't any it gives them a little message explaining that 
 $anymatches=mysql_num_rows($dataa); 
 if ($anymatches == 0) 
 { 
 echo ''; 
 }  
else{
$limit = 10;
 $data = mysql_query("SELECT * FROM search WHERE title LIKE'$q%' ORDER BY hits DESC LIMIT 0,$limit"); 
 while($result = mysql_fetch_array($data)) 
 { $nb=$result['title'];
 echo "$nb\n"; 
 }
}
?>
