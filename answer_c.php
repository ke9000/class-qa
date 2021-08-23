<?php require "core.php";

if(isset($_GET['id'])){
	$id = $_GET['id'];
	$q_name = $created_at = $title = $mail = $q_content = $q_code1 = $q_code2 = "";
	$a_name = $updated_at = $a_content = $a_code1 = $a_code2 = "";
	$state = 2;

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

	if(isset($_POST['a_regist'])){
		if(isset($_POST['a_name'])){$a_name = $_POST['a_name'];}
		if(isset($_POST['a_content'])){$a_content = $_POST['a_content'];}
		if(isset($_POST['a_code1'])){$a_code1 = $_POST['a_code1'];}
		if(isset($_POST['a_code2'])){$a_code2 = $_POST['a_code2'];}
		if(isset($_POST['state'])){$state = $_POST['state'];}
	} 
} else {
	echo "質問IDが指定されていません <a href=\"./index.php\">戻る</a>";
	exit();
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
	
	<title>基礎プログラミング演習 質問システム : 回答確認</title>
</head>
<body>
	<h1>基礎プログラミング演習 質問システム</h1>
	<hr>
	<h2>回答内容を確認してください</h2>
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

	<table border="1" class="answer check">
		<tr>
			<th>回答者</th>
			<td><?php echo(htmlspecialchars($a_name));?></td>
		</tr>
		<tr>
			<th>回答</th>
			<td><?php echo(nl2br(htmlspecialchars($a_content)));?></td>
		</tr>
		<tr>
			<th>コード(html)</th>
			<td>
<pre><code>
<?php echo(htmlspecialchars($a_code1));?>
</code></pre>
			</td>
		</tr>
		<tr>
			<th>コード(javascript)</th>
			<td>
<pre><code>
<?php echo(htmlspecialchars($a_code2));?>
</code></pre>
			</td>
		</tr>
		<tr>
			<th>回答状態</th>
			<td><?php echo(getAnsState($state));?></td>
		</tr>
	</table>

	<div class="regist-btn">
		<form method="POST" name="a_regist" class="div-regist-btn" action="index.php?id=<?php echo($id."&u=".$user)?>">
			<input type="text" name="id" class="display-none" value="<?php echo($id);?>" >
			<input type="text" name="a_name" class="display-none" value="<?php echo(htmlspecialchars($a_name));?>" >
			<textarea name="a_content" class="display-none" cols="100" rows="10"><?php echo(htmlspecialchars($a_content));?></textarea>
			<textarea name="a_code1" class="display-none" cols="100" rows="10"><?php echo(htmlspecialchars($a_code1));?></textarea>
			<textarea name="a_code2" class="display-none" cols="100" rows="10"><?php echo(htmlspecialchars($a_code2));?></textarea>
			<select class="display-none" name="state" required>
				<option value="0" <?php if($state == 0){echo("selected");}?> >未回答</option>
				<option value="1" <?php if($state == 1){echo("selected");}?> >回答作成中</option>
				<option value="2" <?php if($state == 2){echo("selected");}?> >回答済み</option>
				<option value="3" <?php if($state == 3){echo("selected");}?> >回答スキップ</option>
			</select>
			<button type="submit" class="btn btn-green" name="a_regist" value="a_send_submit">回答する</button>
		</form>
		
		<form method="POST" name="a_regist" class="div-regist-btn" action="answer.php?id=<?php echo($id."&u=".$user)?>">
			<input type="text" name="id" class="display-none" value="<?php echo($id);?>" >
			<input type="text" name="a_name" class="display-none" value="<?php echo($a_name);?>">
			<textarea name="a_content" class="display-none" cols="100" rows="10"><?php echo(htmlspecialchars($a_content));?></textarea>
			<textarea name="a_code1" class="display-none" cols="100" rows="10"><?php echo(htmlspecialchars($a_code1));?></textarea>
			<textarea name="a_code2" class="display-none" cols="100" rows="10"><?php echo(htmlspecialchars($a_code2));?></textarea>
			<select class="display-none" name="state" required>
				<option value="0" <?php if($state == 0){echo("selected");}?> >未回答</option>
				<option value="1" <?php if($state == 1){echo("selected");}?> >回答作成中</option>
				<option value="2" <?php if($state == 2){echo("selected");}?> >回答済み</option>
				<option value="3" <?php if($state == 3){echo("selected");}?> >回答スキップ</option>			
			</select>
			<button type="submit" class="btn btn-black" name="a_regist" value="a_send_fix">回答を修正する</button>
		</form>
	</div>
</body>
</html>