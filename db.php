<?php
class db{
	/**
	 * DB環境設定読み込み
	 */
	$db_ini = parse_ini_file("dbconf.ini");

	$host = $db_ini['host'];
	$port = $db_ini['port'];
	$user = $db_ini['user'];
	$pass = $db_ini['pass'];
	$database = $db_ini['database'];
	$table = $db_ini['table']

	/**
	 * DB接続
	 */
	private function db_connect(){
		global $hostname, $user, $pass, $dbname;
		$link = mysqli_connect($hostname, $user, $pass, $dbname);
		if($link){
			return $link;
		} else {
			return null;
		}
	}

	/**
	 * $query: クエリ
	 * データありクエリ
	 */
	public function db_query_fetch($query){
		$link = db_connect();
		if(!$link){
			return null;
		} else {
			$result = mysqli_query($link, $query);
			if($result){
				$i=0;
				while($row = mysqli_fetch_assoc($result)){
					$lines[$i]=$row;
					$i++;
				}
			} else {
				$lines = null;
			}

			mysqli_free_result($result);
			return $lines;
		}
	}

	/**
	 * $query:クエリ
	 * データなしクエリ
	 */
	public function db_query($query){
		$link = db_connect();
		if(!$link){
			return null;
		} else {
			$result = mysqli_query($link, $query);
			if($result){
				$lines = "success";
			} else {
				$lines = null;
			}
			mysqli_free_result($result);
			return $lines;
		}
	}
}
?>