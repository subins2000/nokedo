<?php
$q=$_GET['q'];
$json=file_get_contents('https://www.google.co.in/s?gs_rn=19&gs_ri=psy-ab&tok=qsxJiO-TWi9JdQalZuJwMA&pq=a&cp=2&gs_id=4&xhr=t&q='.$q.'&es_nrs=true&pf=p&sclient=psy-ab&oq=&gs_l=&pbx=1&bav=on.2,or.r_cp.r_qf.&bvm=bv.48705608,d.aGc&fp=3722199bd8ef588b&biw=1368&bih=328&tch=1&ech=1&psi=VO3gUfDDDc-ZiQfIbA.1373695321436.1');
$json= preg_replace("/([a-zA-Z0-9_]+?):/" , "\"$1\":", $json);

$json=json_decode($json,true);
?>
<pre>
<?print_r($json);?>
</pre>
