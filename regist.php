
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="style.css">
	<title>基礎プログラミング演習 質問システム : 質問投稿</title>
</head>
<body>
	<h1>基礎プログラミング演習 質問システム</h1>
	<hr>
	<a href="index.html" class="btn btn-blue">←前の画面に戻る</a>
	<br>
	<form method="POST" action="regist_c.php">
		<h3>投稿者</h3>
		<input type="text" name="q_name" id="" placeholder="テスト太郎" value="<?php if(isset($_POST['q_name'])){echo($_POST['q_name']);}?>" required minlength="1">
		<h3>質問タイトル</h3>
		<input type="text" name="q_title" id="" placeholder="第N回 課題Mでエラーが表示されます" value="<?php if(isset($_POST['q_title'])){echo($_POST['q_title']);}?>" required>
		<h3>メールアドレス</h3>
		<p class="form-commnet">この欄は教員とSAのみに表示されます</p>
		<p class="form-commnet">都市大メールアドレスのみ受け付けます</p>
		<input type="text" name="q_mail" id="" placeholder="g9999999@tcu.ac.jp" value="<?php if(isset($_POST['q_mail'])){echo($_POST['q_mail']);}?>" required pattern="g\d{7}@tcu.ac.jp">
		<h3>質問</h3>
		<p class="form-commnet">なるだけ詳細に書いてください。</p>
		<p class="form-commnet">(例:画面に何も表示されない / aleartが表示されない / ～～というエラーがコンソールに表示される 等)</p>
		<textarea name="q_content" id="" cols="100" rows="10" required><?php if(isset($_POST['q_content'])){echo($_POST['q_content']);}?></textarea>
		<h3>コード (html) </h3>
		<p class="form-commnet">htmlのソースコードをコピペで貼り付けてください</p>
		<textarea name="q_code1" id="" cols="100" rows="10"><?php if(isset($_POST['q_code1'])){echo($_POST['q_code1']);}?></textarea>
		<h3>コード (javascript) </h3>
		<p class="form-commnet">javascriptのソースコードをコピペで貼り付けてください</p>
		<textarea name="q_code2" id="" cols="100" rows="10"><?php if(isset($_POST['q_code1'])){echo($_POST['q_code2']);}?></textarea>
		<br>
		<button type="submit" class="btn btn-blue" name="q_regist" value="q_send_check">質問する</button>
	</form>
</body>
</html>