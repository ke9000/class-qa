<?php

$ini = parse_ini_file("qaconf.ini");
$file = $ini['file'];
$db_file = "./".$file;

date_default_timezone_set('Asia/Tokyo');

$debug = $ini['debug'];
if($debug == "1"){
	ini_set("display_errors", 'On');
	error_reporting(E_ALL);
}

$url = $ini['url'];
$mail_to = $ini['mail_to'];

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
	debug($query);
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
	$lines = array();
	debug($query);
	$res = $db->query($query);
	if($res){
		$i = 0;
		while($row = $res->fetchArray()){
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

/**
 * POSTでwebhookからメール通知する
 * Webohook->G SpleedSheet ->Gmail
 * 
 * @param string $str メール通知する文章
 * @return null
 */
function sendMailNotifer(string $str){
	global $url, $mail_to;
	debug("sendmail url= ".$url);
	debug("sendMailtext = ". $str);
	$CURLERR = NULL;

	$data = array(
		'mail_to'=> $mail_to,
		'msg' => $str
	);

	$ch = curl_init($url);

	curl_setopt($ch, CURLOPT_POST, TRUE);                            //POSTで送信
	curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));    //データをセット
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);                    //受け取ったデータを変数に
	$html = curl_exec($ch);

	if(curl_errno($ch)){        //curlでエラー発生
		$CURLERR .= 'curl_errno：' . curl_errno($ch) . "\n";
		$CURLERR .= 'curl_error：' . curl_error($ch) . "\n";
		$CURLERR .= '▼curl_getinfo' . "\n";
		foreach(curl_getinfo($ch) as $key => $val){
			$CURLERR .= '■' . $key . '：' . $val . "\n";
		}
		debug(nl2br($CURLERR));
	}
	curl_close($ch);
	debug($html);

	return null;
}
?>