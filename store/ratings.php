<?php
include('config.php');check();
class Xoriant_Ratings {

	private $hostname_conn;
	private $database_conn;
	private $username_conn;
	private $password_conn;
	private $conn;
	private static $instance;
	
	public function __construct() {
		if(self::$instance) {
			return self::$instance;
		} else {
			self::$instance = $this;
			$this->hostname_conn = "localhost";
			$this->database_conn = "d";
			$this->username_conn = "root";
			$this->password_conn = "backstreetboys";
			$this->conn = mysql_connect($this->hostname_conn, $this->username_conn, $this->password_conn); 
			if(!$this->conn) throw new Exception(mysql_error()." on line number ".__LINE__." of file ".__FILE__);
			mysql_select_db($this->database_conn, $this->conn);
		}
	}
	
	public function display_table_fields($table_name) {
		$rs = @mysql_query("select * from ".$table_name." LIMIT 1");
		if(!$rs) {
			throw new Exception(mysql_error()." on line number ".__LINE__." of file ".__FILE__);
		}
		$i = 0;
		$register_main_arr = array();
		while ($i < mysql_num_fields($rs)) {
			$meta = mysql_fetch_field($rs, $i);
			$register_arr[] = $meta->name;
			$i++;
		}
		return $register_arr;
	}
	public function phpinsert($table_name,$pk,$postarray) {
		$register_arr = array();
		$register_arr = $this->display_table_fields($table_name);
		$query = "insert into ".$table_name." set ";
		foreach($postarray as $key=>$value) {
			if(gettype($value)=="array") {
				$string = '';
				foreach($value as $val) {
					if(strlen($val)>0) { 
						$val = $this->processString($val);
						$string .= $val.'|';
					}
				}
				$string = substr($string,0,-1);
				if(in_array($key,$register_arr)) {
					$query .= $key."='".$string."',"; 
				}
			} else {
				if(in_array($key,$register_arr)) {
					$value = $this->processString($value);
					$query .= $key."='".$value."',";
				}
			}
		}
		$query = substr($query,0,-1);
		$result = @mysql_query($query);
		if(!$result) {
			throw new Exception(mysql_error()." on line number ".__LINE__." of file ".__FILE__);
		}
		$uid = mysql_insert_id();
		return $uid;
	}
	
	public function phpedit($table_name,$pk,$postarray,$uid) {
		$register_arr = array();
		$register_arr = $this->display_table_fields($table_name);
		$query = "update ".$table_name." set ";
		foreach($postarray as $key=>$value) {
			if(gettype($value)=="array") {
				$string = '';
				foreach($value as $val) {
					if(strlen($val)>0) { 
						$val = $this->processString($val);
						$string .= $val.'|';
					}
				}
				$string = substr($string,0,-1);
				if(in_array($key,$register_arr)) {
					$query .= $key."='".$string."',"; 
				}
			} else {
				if(in_array($key,$register_arr)) {
					$value = $this->processString($value);
					$query .= $key."='".$value."',";
				}
			}
		}
		$query = substr($query,0,-1);
		$query .= " where ".$pk." = '".$uid."'";		
		$result = @mysql_query($query);
		if(!$result) {
			throw new Exception(mysql_error()." on line number ".__LINE__." of file ".__FILE__);
		}
		return $uid;
	}
	
	private function processString($text) {
		return addslashes(stripslashes(trim($text)));
	}
	
	
	public function validateData($record) {		
		if(!isset($record['rating'])) {
			throw new Exception("Rating is empty. ");
		}
		return true;
	}
	
	public function checkRatingUniqueIp($record) {
		$sql = "SELECT count(*) as cnt FROM xoriant_ratings WHERE item_id = '".$this->processString($record['item_id'])."' and rating_ip = '".$this->processString($record['rating_ip'])."'";
		$rs = @mysql_query($sql);
		if(!$rs) {
			throw new Exception(mysql_error()." on line number ".__LINE__." of file ".__FILE__);
		}
		$rec = mysql_fetch_array($rs);
		$count = $rec['cnt'];
		return $count;
	}
	
	public function checkRatingUniqueUser($record) {
		$sql = "SELECT count(*) as cnt FROM xoriant_ratings WHERE item_id = '".$this->processString($record['item_id'])."' and  user_id = '".$this->processString($record['user_id'])."'";
		$rs = @mysql_query($sql);
		if(!$rs) {
			throw new Exception(mysql_error()." on line number ".__LINE__." of file ".__FILE__);
		}
		$rec = mysql_fetch_array($rs);
		$count = $rec['cnt'];
		return $count;
	}
	
	public function showRating($item_id) {
		$sql = "SELECT item_id, AVG(rating) as avg_rating, COUNT(rating) as counter FROM xoriant_ratings WHERE item_id = '".$item_id."' GROUP BY item_id";
		$rs = @mysql_query($sql);
		if(!$rs) {
			throw new Exception(mysql_error()." on line number ".__LINE__." of file ".__FILE__);
		}
		$arr = mysql_fetch_array($rs);
                return $arr;
	}
	
	public function drawStars($addWrapperDiv = false, $allowVote = false) {
		$currentRating = @number_format($this->totalValues / $this->totalVotes, 2) * STARWIDTH;	
		$voteClass = ($allowVote == true)? 'allow': 'voted';
		$ratingString = array("<ul class=\"ratings\">");
		$ratingString[] = "<li class=\"current\" style=\"width:". $currentRating ."px;\">Currently " . $currentRating ."</li>";
		for ($i = 1; $i <= TOTALSTARS; $i++) { 
			$ratingString[] = "<li><a href=\"num={$i}&id={$this->id}\" title=\"{$i} out of " . TOTALSTARS ."\" class=\"s{$i} {$voteClass}\" onclick=\"return vote(this, {$this->id}, '{$voteClass}');\">{$i}</a></li>";
		}
		$ratingString[] = "</ul>"; //show the updated value of the vote
		
		//name of the div id to be updated | the html that needs to be changed
		if ($addWrapperDiv === true) {
			$output = '<div id="' . $this->id. '">' . implode("",$ratingString) . '</div>';
		}
		else {
			$output = implode("",$ratingString);
		}
		
		return $output;
	}	

	public function showAllRating() {
		$sql = "SELECT item_id, AVG(rating) as avg_rating, COUNT(rating) as counter FROM xoriant_ratings GROUP BY item_id";
		$rs = @mysql_query($sql);
		if(!$rs) {
			throw new Exception(mysql_error()." on line number ".__LINE__." of file ".__FILE__);
		}
		while($arr = mysql_fetch_array($rs)) {
			$return[$arr['item_id']] = $arr;
		}
		return $return;
	}
}
if($_POST['clicked_on']!='' && isset($_POST) && $_POST['id']!=''){
preg_match_all('/star_(.*?) ratings_stars/',$_POST['clicked_on'],$s);
$s=$s[1][0];
$id=$_POST['id'];
$R = new Xoriant_Ratings();
$data['user_id'] = $who;
$data['item_id'] = $id;
$data['rating'] = $s;
$data['rating_ip'] = $_SERVER['REMOTE_ADDR'];
$data['rating_date'] = date('Y-m-d H:i:s');
$R->validateData($data);
$count = $R->checkRatingUniqueUser($data);
if($count>0){$sql=$db->prepare("UPDATE xoriant_ratings SET rating=? WHERE item_id=? AND user_id=?");$sql->execute(array($s,$id,$who));}else{$R->phpinsert('xoriant_ratings', $id, $data);}
$r=$R->showRating($id);
$av=$r['avg_rating'];
echo '{"widget_id": ".rate_widget#'.$id.'","number_votes": "'.$r['counter'].'","total_points":"'.$r['counter'].'","dec_avg":"'.round($av,2).'","whole_avg":"'.round($av).'"}';
}
?>
