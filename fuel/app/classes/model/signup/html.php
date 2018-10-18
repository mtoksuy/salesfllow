<?php 
/*
* 
* サインアップ基本クラス
* 
* 
* 
*/
class Model_Signup_Html {
	//-------------------------
	//新規登録ステップ1HTML生成
	//-------------------------
	public static function signup_step_1_html_create($post) {
		$signup_step_1_html = '
<div class="signup_content">
	<div class="signup_content_inner">
		<h1>パスワードを設定してください</h1>
		<form action="'.HTTP.'signup/complete/" method="post">
			<input type="hidden" name="email" value="'.$post['email'].'">
			<input type="password" name="password" placeholder="パスワード(英数字のみ4文字以上)" autocomplete="off" required>
			<button type="submit" class="o_9">Salesfllow を始める</button>
		</form>
	</div>
</div>
';
		return $signup_step_1_html;
	}
}
