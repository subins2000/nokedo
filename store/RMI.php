<?
function sts($id){
global $db;
$sql=$db->prepare("SELECT item_id, AVG(rating) as avg_rating, COUNT(rating) as counter FROM xoriant_ratings WHERE item_id = ? GROUP BY item_id");
$sql->execute(array($id));
$r=$sql->fetchAll()[0];
foreach($r as $k=>$v){if($v==''){$r[$k]=0;}}
$av=$r['avg_rating'];
$stars='<div id="'.$id.'" class="rate_widget" style="text-align:left;"><div class="star_1 ratings_stars"></div><div class="star_2 ratings_stars"></div><div class="star_3 ratings_stars"></div><div class="star_4 ratings_stars"></div><div class="star_5 ratings_stars"></div><div class="total_votes"></div></div><script>$(".rate_widget#'.$id.'").data("fsr",{"widget_id": ".rate_widget#'.$id.'","number_votes": "'.$r['counter'].'","total_points":"'.$r['counter'].'","dec_avg":"'.round($av,2).'","whole_avg":"'.round($av).'"});</script>';
return $stars;
}
?>
