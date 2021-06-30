<?php

$ini = parse_ini_file("qaconf.ini");
$file = $ini['file'];
$db_file = "./".$file;

date_default_timezone_set('Asia/Tokyo');

$debug = $ini['debug'];

/**
 * デバッグ
 * @param string $str デバッグ内容
 * 
 */
function debug(string $str){
	global $debug;
	if($debug == 1){
		echo "<b>Debug</b>: $str<br>\n";
		ini_set("display_errors", 'On');
		error_reporting(E_ALL);
	} else {
        echo "<script>console.log(\"$str\");</script>\n";

    }
	return null;
}


class sqlite extends SQLite3
{
    
    function __construct()
    {
        global $db_file;
        $this->open($db_file);
    }
}

function db_connect(){

	$db = new sqlite();

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
			$str = "回答スキップ";
	}

	return $str;
}
?>