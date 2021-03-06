<?php require "core.php";
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

if(!isset($_GET['id'])){
	echo "質問IDが指定されていません <a href=\"./index.php\">戻る</a>";
	exit();
} else {
	$id = $_GET['id'];
	$q_name = $created_at = $title = $mail = $q_content = $q_code1 = $q_code2 = "";
	$a_name = $update_at = $a_content = $a_code1 = $a_code2 = "";
	$state = 0;

	$query = "SELECT * FROM qa WHERE id = $id";
	$lines = db_query_fetch($query);

	if($lines[0]['q_name']){$q_name = $lines[0]['q_name'];}
	if($lines[0]['q_title']){$q_title = $lines[0]['q_title'];}
	if($lines[0]['q_mail']){$q_mail = $lines[0]['q_mail'];}
	if($lines[0]['q_content']){$q_content = $lines[0]['q_content'];}
	if($lines[0]['q_code1']){$q_code1 = $lines[0]['q_code1'];}
	if($lines[0]['q_code2']){$q_code2 = $lines[0]['q_code2'];}
	if($lines[0]['a_name']){$a_name = $lines[0]['a_name'];}
	if($lines[0]['a_content']){$a_content = $lines[0]['a_content'];}
	if($lines[0]['a_code1']){$a_code1 = $lines[0]['a_code1'];}
	if($lines[0]['a_code2']){$a_code2 = $lines[0]['a_code2'];}
	if($lines[0]['state']){$state = $lines[0]['state'];}
	if($lines[0]['created_at']){$created_at = $lines[0]['created_at'];}
	if($lines[0]['update_at']){$updated_at = $lines[0]['update_at'];}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="style.css">

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.15.10/styles/vs.min.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.15.10/highlight.min.js"></script>
	<script>hljs.initHighlightingOnLoad();</script>

	<title>基礎プログラミング演習 質問システム : 詳細</title>
</head>
<body>
	<h1>基礎プログラミング演習 質問システム</h1>
	<hr>
	<div class="detail-btns">
		<a href="index.php?u=<?php echo($user);?>" class="btn btn-blue btn-left">←前の画面に戻る</a>
		<?php 
		if($user == 'sa'||$user == 't'){
echo <<<EOT
			<a href="answer.php?id=$id&u=$user" class="btn btn-green btn-right">回答する</a>
EOT;
		}
		?>
	</div>
	<br>
	<table border="1" class="detail">
		<tr>
			<th class="q-no">No.</th>
			<th class="">質問者</th>
			<th class="">質問日時</th>
			<th class="q-state">回答状態</th>
		</tr>
		<tr>
			<?php
echo <<<EOT
			<td class="q-no">$id</td>
			<td class="">$q_name</td>
			<td>$created_at</td>
EOT;
			?>
			<td class="q-state"><?php echo(getAnsState($state)); ?></td>
		</tr>
		<tr>
			<th colspan="2" class="q-detail">質問タイトル</th>
			<td colspan="2" class="q-detail"><?php echo($q_title) ?></td>
		</tr>
		<tr>
			<th colspan="2" class="q-detail">メールアドレス</th>
			<td colspan="2" class="q-detail"><?php if($user == 't' || $user == 'sa'){echo($q_mail);} else { echo("教員/SAにのみメールアドレスを表示しています");}?></td>
		</tr>
		<tr>
			<th colspan="2" class="q-detail">質問詳細</th>
			<td colspan="2" class="q-detail"><?php echo(nl2br($q_content));?></td>
		</tr>
		<tr>
			<th colspan="2" class="q-detail">コード (html)</th>
			<td colspan="2" class="q-detail">
<pre><code>
<?php echo($q_code1);?>
</code></pre>
			</td>
		</tr>
		<tr>
			<th colspan="2" class="q-detail">コード (javascript)</th>
			<td colspan="2">
<pre><code>
<?php echo($q_code2);?>
</code></pre>
			</td>
		</tr>
	</table>
	
	<br>
	<hr>
	<br>

	<table border="1" class="answer
	<?php 
	if($user=="" && $state != 2|| $state == 0){
		echo("display-none");
	}
	?>
	">
		<tr>
			<th class="q-detail">回答日時</th>
			<th class="q-detail">回答者</th>

			
		</tr>
		<tr>
			<td class="q-detail"><?php echo($updated_at);?></td>
			<td class="q-detail"><?php echo($a_name);?></td>
		</tr>
		<tr>
			<th class="q-detail">回答</th>
			<td class="q-detail"><?php echo(nl2br($a_content));?></td>
		</tr>
		<tr>
			<th class="q-detail">コード (html)</th>
			<td class="q-detail">
<pre><code>
<?php echo($a_code1);?>
</code></pre>
			</td>
		</tr>
		<tr>
			<th class="q-detail">コード (javascript)</th>
			<td >
<pre><code>
<?php echo($a_code2);?>
</code></pre>
			</td>
		</tr>
	</table>
</body>
</html>