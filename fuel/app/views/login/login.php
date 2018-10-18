
<div class="login_content">
	<div class="login_content_inner">
		<h1 class="text_center"><a href="<?php echo HTTP; ?>"><img src="http://localhost/salesfllow/assets/img/logo/logo_1.png" alt="セールスフロー" title="セールスフロー" width="204" height="64"></a></h1>
	<!-- login_form -->
	<form class="login_form" name="login_form" action="" method="post">
		<!-- block -->
		<div class="block">
			<p class="m_0">
				<label for="user_login">ユーザー名 or メールアドレス
			</label></p>
			<input class="input" id="user_login" name="login_user" value="" size="20" type="text">
		</div>
		<!-- block -->
		<div class="block">
			<p class="m_0">
				<label for="user_pass">パスワード
			</label></p>
			<input class="input" id="user_pass" name="login_pass" value="" size="20" type="password">
		</div>
		<!-- submit -->
		<p class="submit clearfix">
			<a class="reissue_link" href="<?php echo HTTP; ?>reissue/">パスワードを忘れた方</a>
			<input class="login_button" name="login_submit" value="ログイン" type="submit">
		</p>
		<?php echo ($login_data['lohin_message']); ?>
	</form>
	</div>
</div>



