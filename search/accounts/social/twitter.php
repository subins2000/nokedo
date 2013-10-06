<? session_start();if($_GET['continue']==null){$continue="http://nokedo.com";}else{$continue=$_GET['continue'];}
require_once('core/twitter.php');include('../../config.php');
$CONSUMER_KEY='InmlH0hBcqG9IWagi5MZg';$CONSUMER_SECRET='Ao7YzcXvD4Gki05LsdZpnmwccsuMcQdB1JOGasqem50';$OAUTH_CALLBACK='http://nokedo.com/accounts/social/twitter.php';
if($_GET['oauth_token']=='' || $_GET['oauth_verifier']==''){
$_SESSION['return_url']=$continue;
$connection = new TwitterOAuth($CONSUMER_KEY, $CONSUMER_SECRET);
$temporary_credentials = $connection->getRequestToken($OAUTH_CALLBACK);
$_SESSION['oauth_token']=$temporary_credentials['oauth_token'];$_SESSION['oauth_token_secret']=$temporary_credentials['oauth_token_secret'];
$redirect_url = $connection->getAuthorizeURL($temporary_credentials); // Use Sign in with Twitter
$redirect_url = $connection->getAuthorizeURL($temporary_credentials, FALSE);
header("Location:$redirect_url");
}
if($_GET['oauth_token']!='' && $_GET['oauth_verifier']!=''){
$connection = new TwitterOAuth($CONSUMER_KEY, $CONSUMER_SECRET, $_SESSION['oauth_token'],$_SESSION['oauth_token_secret']);
$token_credentials = $connection->getAccessToken($_REQUEST['oauth_verifier']);
save('tat',$token_credentials['oauth_token']);save('tats',$token_credentials['oauth_token_secret']);
header("Location:".$_SESSION['return_url']);
}
?>
