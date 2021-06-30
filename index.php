<?php require "core.php";
/**
 * get_qestion
 * 
 */
if(isset($_POST['q_regist']) && $_POST['q_regist']=="q_send_submit"){
	$name = $title = $mail = $content = $code1 = $code2 = "";
	$time = getCurrentTime();
	if(isset($_POST['q_name'])){ $q_name = htmlspecialchars($_POST['q_name']);}
	if(isset($_POST['q_title'])){ $q_title = htmlspecialchars($_POST['q_title']);}
	if(isset($_POST['q_mail'])){ $q_mail = htmlspecialchars($_POST['q_mail']);}
	if(isset($_POST['q_content'])){ $q_content = htmlspecialchars($_POST['q_content']);}
	if(isset($_POST['q_code1'])){ $q_code1 = htmlspecialchars($_POST['q_code1']);}
	if(isset($_POST['q_code2'])){ $q_code2 = htmlspecialchars($_POST['q_code2']);}
	
	$query = 
		"INSERT INTO qa(q_name, q_title, q_mail, q_content, q_code1, q_code2, state, created_at, update_at) VALUES (\"$q_name\", \"$q_title\", \"$q_mail\", \"$q_content\", \"$q_code1\", \"$q_code2\", 0, \"$time\", \"$time\")";

		$state = db_query($query);
	
		if(!$state){
			debug("q_regist_error/db_query_fetch_error");
			debug($query);
		}
}
/**
 * 
 * get_answer
 * 
 */
if(isset($_POST['a_regist']) && $_POST['a_regist']=="a_send_submit"){
	$name = $content = $code1 = $code2 = "";
	$state = 1;
	$time = getCurrentTime();
	if(!isset($_POST['id'])){ 
		debug("a_regist/POST['id'] not found");
	} else {
		$id = $_POST['id'];
		if(isset($_POST['a_name'])){ $name = htmlspecialchars($_POST['a_name']);}
		if(isset($_POST['a_content'])){ $content = htmlspecialchars($_POST['a_content']);}
		if(isset($_POST['a_code1'])){ $code1 = htmlspecialchars($_POST['a_code1']);}
		if(isset($_POST['a_code2'])){ $code2 = htmlspecialchars($_POST['a_code2']);}
		if(isset($_POST['a_state'])){ $state = $_POST['a_state'];}

		$query = 
		"UPDATE qa SET 
		answer = $name, answer_content = $content, $answer_code_content_1 = $code1, $answer_code_content_2 = $code2, state = $state, update_at = $time
		WHERE id = $id";
		
		$state = db_query($query);
	
		if(!$state){
			debug("a_regist_error/db_query_fetch_error");
			debug($query);
		}
	}
}

 /**
  * user判定
  */
	if((!isset($_GET['u']))||($_GET['u'] == '')){
		$user = '';
	} elseif($_GET['u']=='sa') {
		$user = 'sa';
	} elseif($_GET['u']='t'){
		$user = 't';
	}
	echo($user);
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="style.css">
	<title>基礎プログラミング演習 質問システム : 一覧</title>
	
</head>
<body>
	<h1>基礎プログラミング演習 質問システム</h1>
	<hr>
	<a href="regist.php" class="btn btn-blue">質問を投稿する</a>
	<br>
	<table border="1" class="index">
		<tr>
			<th class="q-no">
				No.
			</th>
			<th class="q-title">
				質問タイトル
			</th>
			<th class="state">
				回答状態
			</th>
			<th class="q-detail-link">
				詳細
			</th>
		</tr>
		<?php
		$query = "SELECT id, q_title, q_name, state FROM qa ORDER BY ASC id";
		$lines = db_query_fetch($query);
		for($i=0; $i<=count($lines); $i++){
			if($user=='' && ($lines[$i]['state']== 0 || $lines[$i]['state']== 2)){
				echo <<<EOT
				<tr>
					<td class="q-no">
						$lines[$i]['id']
					</td>
					<td class="q-title">
						$lines[$i]['subject']
					</td>
					<td class="q-state">
						$lines[$i]['state']
					</td>
					<td class="q-detail-link">
						<a href="detail.php?id=$lines[$i]['id']&u=$user">詳細</a>
					</td>
				</tr>
				EOT;
			} elseif($user == 'sa'|| $user=='t') {
				echo <<<EOT
				<tr>
					<td class="q-no">
						$lines[$i]['id']
					</td>
					<td class="q-title">
						$lines[$i]['subject']
					</td>
					<td class="q-state">
						$lines[$i]['state']
					</td>
					<td class="q-detail-link">
						<a href="detail.php?id=$lines[$i]['id']&u=$user">詳細</a>
					</td>
				</tr>
				EOT;
			}
		}
		?>
	</table>
</body>
</html>