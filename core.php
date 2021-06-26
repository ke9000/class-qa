<?php
$ini = parse_ini_file("dbconf.ini");
$file = $ini['file'];
$db_file = "./".$file;

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



?>