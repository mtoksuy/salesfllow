
<div class="signup_content">
	<div class="signup_content_inner">
		<h1>パスワードが正しくありません<br>正しいパスワードを設定してください</h1>
		<form action="<?php echo HTTP; ?>signup/complete/" method="post">
			<input type="hidden" name="email" value="<?php echo $sign_data['email']; ?>">
			<input type="password" name="password" placeholder="パスワード(英数字のみ4文字以上)" autocomplete="off" required>
			<button type="submit" class="o_9">Salesfllow を始める</button>
		</form>
	</div>
</div>
