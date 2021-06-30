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
	
	<title>基礎プログラミング演習 質問システム : 質問投稿</title>
</head>
<body>
	<h1>基礎プログラミング演習 質問システム</h1>
	<hr>
	<h2>質問内容を確認してください</h2>
	<br>
	<table border="1" class="detail check">
		<tr>
			<th>投稿者</th>
			<td><?php if(isset($_POST['q_name'])){echo(htmlspecialchars($_POST['q_name']));}?></td>
		</tr>
		<t>
			<th>件名</th>
			<td><?php if(isset($_POST['q_title'])){echo(htmlspecialchars($_POST['q_title']));}?></td>
		</tr>
		<tr>
			<th>メールアドレス</th>
			<td><?php if(isset($_POST['q_mail'])){echo(htmlspecialchars($_POST['q_mail']));}?></td>
		</tr>
		<tr>
			<th>質問</th>
			<td><?php if(isset($_POST['q_content'])){echo(htmlspecialchars($_POST['q_content']));}?></td>
		</tr>
		<tr>
			<th>コード(html)</th>
			<td>
<pre><code>
<?php if(isset($_POST['q_code1'])){echo(htmlspecialchars($_POST['q_code1']));}?>
</code></pre>
			</td>
		</tr>
		<tr>
			<th>コード(html)</th>
			<td>
<pre><code>
<?php if(isset($_POST['q_code2'])){echo(htmlspecialchars($_POST['q_code2']));}?>
</code></pre>
			</td>
		</tr>
	</table>

	<div class="regist-btn">
		<form method="POST" class="div-regist-btn" action="index.php">
			<input type="text" name="q_name" class="display-none" value="<?php if(isset($_POST['q_name'])){echo(htmlspecialchars($_POST['q_name']));}?>" >
			<input type="text" name="q_title" class="display-none" value="<?php if(isset($_POST['q_title'])){echo(htmlspecialchars($_POST['q_title']));}?>">
			<input type="text" name="q_mail" class="display-none" value="<?php if(isset($_POST['q_mail'])){echo(htmlspecialchars($_POST['q_mail']));}?>">
			<textarea name="q_content" class="display-none" cols="100" rows="10"><?php if(isset($_POST['q_content'])){echo(htmlspecialchars($_POST['q_content']));}?></textarea>
			<textarea name="q_code1" class="display-none" cols="100" rows="10"><?php if(isset($_POST['q_code1'])){echo(htmlspecialchars($_POST['q_code1']));}?></textarea>
			<textarea name="q_code2" class="display-none" cols="100" rows="10"><?php if(isset($_POST['q_code2'])){echo(htmlspecialchars($_POST['q_code2']));}?></textarea>
			<button type="submit" class="btn btn-blue" name="q_regist" value="q_send_submit">質問する</button>
		</form>
		
		<form method="POST" class="div-regist-btn" action="regist.php">
			<input type="text" name="q_name" class="display-none" value="<?php if(isset($_POST['q_name'])){echo(htmlspecialchars($_POST['q_name']));}?>">
			<input type="text" name="q_title" class="display-none" value="<?php if(isset($_POST['q_title'])){echo(htmlspecialchars($_POST['q_title']));}?>">
			<input type="text" name="q_mail" class="display-none" value="<?php if(isset($_POST['q_mail'])){echo(htmlspecialchars($_POST['q_mail']));}?>">
			<textarea name="q_content" class="display-none" cols="100" rows="10"><?php if(isset($_POST['q_content'])){echo(htmlspecialchars($_POST['q_content']));}?></textarea>
			<textarea name="q_code1" class="display-none" cols="100" rows="10"><?php if(isset($_POST['q_code1'])){echo(htmlspecialchars($_POST['q_code2']));}?></textarea>
			<textarea name="q_code2" class="display-none" cols="100" rows="10"><?php if(isset($_POST['q_code2'])){echo(htmlspecialchars($_POST['q_code2']));}?></textarea>
			<button type="submit" class="btn btn-black" name="q_regist" value="q_send_fix">回答を修正する</button>
		</form>
	</div>
</body>
</html>