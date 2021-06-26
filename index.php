<?php require "core.php" 
/**
 * get_qestion
 * 
 * get_answer
 * 
 */



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
	<a href="regist.html" class="btn btn-blue">質問を投稿する</a>
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
		$query = "SELECT id, subject, questioner, state FROM qa ORDER BY ASC";
		$lines[] = db_query_fetch($query);
		for($i=0; $i<=count($lines); $i++){
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
					<a href="detail.php?id=$lines[$i]['id']">詳細</a>
				</td>
			</tr>
			EOT;
		}
		?>
	</table>
</body>
</html>