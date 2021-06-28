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
	$q_name = $q_time = $title = $mail = $q_content = $q_code1 = $q_code2 = "";
	$a_name = $a_time = $a_content = $a_code1 = $a_code2 = "";
	$state = 1;

	$query = "SELECT * FROM qa WHERE id = $id";
	$lines = db_query_fetch($query);

	if($lines[0]['questioner']){$q_name = $lines[0]['questioner'];}
	if($lines[0]['created_at']){$q_time = $lines[0]['created_at'];}
	/**作業中！ */
	$title = $lines[0]['title'];
	$mail = $lines[0]['mail'];
	$q_content = $lines[0]['q_content'];
	$q_code1 = $lines[0]['q_code1'];
	$q_code2 = $lines[0]['q_code2'];
	$state = $lines[0]['state'];
	$created_at = $lines[0]['created_at'];
	$updated_at = $lines[0]['updated_at'];
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
		<a href="index.html" class="btn btn-blue btn-left">←前の画面に戻る</a>
		<?php 
		if($user == 'sa'||$user == 't'){
			echo <<<EOF
			<a href="answer.php?id=$id" class="btn btn-green btn-right">回答する</a>
			EOF;
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
			echo <<<EOF
			<td class="q-no">$id</td>
			<td class="">$q_name</td>
			<td>$created_at</td>
			EOF;
			?>
			<td class="q-state"><?php echo(getAnsState($state)); ?></td>
		</tr>
		<tr>
			<th colspan="2" class="q-detail">質問タイトル</th>
			<td colspan="2" class="q-detail"><?php echo($title) ?></td>
		</tr>
		<tr>
			<th colspan="2" class="q-detail">メールアドレス</th>
			<td colspan="2" class="q-detail"><?php if($user = 't' || $user == 'sa'){echo($mail);} else { echo("教員/SAにのみメールアドレスを表示しています");}?></td>
		</tr>
		<tr>
			<th colspan="2" class="q-detail">質問詳細</th>
			<td colspan="2" class="q-detail"><?php echo($q_content);?></td>
		</tr>
		<tr>
			<th colspan="2" class="q-detail">コード (html)</th>
			<td colspan="2" class="q-detail">
<pre><code>
<?php echo($q_code1);?>
&lt;html&gt;
	&lt;head&gt;
		&lt;title&gt;テスト&lt;/title&gt;
	&lt;/head&gt;
	&lt;body&gt;
		&lt;h1&gt;Hello, World&lt;/h1&gt;
	&lt;body&gt;
&lt;/html&gt;
</code></pre>
			</td>
		</tr>
		<tr>
			<th colspan="2" class="q-detail">コード (javascript)</th>
			<td colspan="2">
<pre><code>
<?php echo($q_code2);?>
function call_a(){
	alert('hello, world');
}
</code></pre>
			</td>
		</tr>
	</table>
	
	<br>
	<hr>
	<br>

	<table border="1" class="answer">
		<tr>
			<th class="q-detail">回答日時</th>
			<th class="q-detail">回答者</th>

			
		</tr>
		<tr>
			<td class="q-detail">2021-01-01 00:00:00</td>
			<td class="q-detail">テスト次郎</td>
		</tr>
		<tr>
			<th class="q-detail">回答</th>
			<td class="q-detail">alertを<br>スペルミスしています</td>
		</tr>
		<tr>
			<th class="q-detail">コード (html)</th>
			<td class="q-detail">
<pre><code>
&lt;html&gt;
	&lt;head&gt;
		&lt;title&gt;テスト&lt;/title&gt;
	&lt;/head&gt;
	&lt;body&gt;
		&lt;h1&gt;Hello, World&lt;/h1&gt;
	&lt;body&gt;
&lt;/html&gt;
</code></pre>
			</td>
		</tr>
		<tr>
			<th class="q-detail">コード (javascript)</th>
			<td >
<pre><code>
function call_a(){
	alert('hello, world');
}
</code></pre>
			</td>
		</tr>
	</table>
</body>
</html>