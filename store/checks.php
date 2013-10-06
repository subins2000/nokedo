<?
Header("content-type: application/x-javascript");
include('config.php');
if(isset($_POST)){
 if($who!='' && $_POST['user']==$who){
  $sql=$db->prepare("UPDATE users SET stat=NOW() WHERE id=?");
  $sql->execute(array($who));
 }
 if($_POST['user']!=$who){
?>
window.location=window.location;
<?
 }
}?>
