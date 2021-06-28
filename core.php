<?php
$ini = parse_ini_file("dbconf.ini");
$file = $ini['file'];
$db_file = "./".$file;

date_default_timezone_set('Asia/Tokyo');

$debug = $ini['debug'];

function db_connect(){
	global $db_file;
	$db = new SQLite3($db_file);
	if($db){
		return $db;
	} else{
		echo "DATABASE Connection Faild!";
		exit;
		return null;
	}
}
/**
 * @param string $query クエリ文
 * @return $lines 実行結果/null
 */
function db_query(string $query){
	$db = db_connect();
	$lines = $db->exec($query);
	if($lines){
		$lines = "Query success";
	} else {
		$lines = null;
	}
	$db->close();
	return $lines;
}

/**
 * @param string $query クエリ文
 * @return $lines[] クエリ結果 or null
 */
function db_query_fetch(string $query){
	$db = db_connect();
	$lines = $db->query($query);
	if($lines){
		$i = 0;
		while($row = $lines->fetchArray()){
			$lines[$i]=$row;
			$i++;
		}
	} else {
		$lines = null;
	}

	$db->close();
	return $lines;
}

/**
 * 現在時刻を返す
 * @return string 時間
 * ex: `2021-01-01 00:00:00`
 */
function getCurrentTime(){
	return $currentTime = date('Y-m-d H:i:s');
}

/**
 * デバッグ
 * @param string $str デバッグ内容
 * 
 */
function debug(string $str){
	global $debug;
	if($debug == 1){
		echo "<b>Debug</b>: $str<br>\n";
	} else {
        echo "<script>console.log(\"$str\");</script>\n";
    }
	return null;
}

/**
 * 回答状態を文字で返す
 * 0 = 未回答
 * 1 = 回答作成中
 * 2 = 回答済み
 * 4 = 回答せず
 */
function getAnsState(int $state){
	switch($state){
		case 0:
			$str = "未回答";
			break;
		case 1:
			$str = "回答作成中";
			break;
		case 2:
			$str = "回答済み";
			break;
		case 3:
			$str = "回答せず";
	}

	return $str;
}
?>