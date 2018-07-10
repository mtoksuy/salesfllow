<?php 
/*
* 
* サインアップ基本クラス
* 
* 
* 
*/
class Model_Signup_Basis {
	//----------------------------
	//新規登録sharetube_idチェック
	//----------------------------
	public static function sharetube_id_check($post) {
		// チェック変数
		$user_sharetube_id_check = true;

		// 半角英数字(-_含む)だけか調べる
		$pattern = '/^[a-zA-Z0-9_-]+$/';
		if(preg_match($pattern, $post["sharetube_id"], $sharetube_id_array)) {
			// idかぶってないかチェック
			if($sharetube_id_array[0] != 'Sharetube' && $sharetube_id_array[0] != 'sharetube') {
				$signup_sharetube_id_res = DB::query("
					SELECT *
					FROM user
					WHERE sharetube_id = '".$post["sharetube_id"]."'")->execute();	
					foreach($signup_sharetube_id_res as $key => $value) {
						$user_sharetube_id_check = false;
					}
			}
			// サイト名は弾く
				else {
					$user_sharetube_id_check = false;
				}
		}
			else {
				$user_sharetube_id_check = false;
			}
		return $user_sharetube_id_check;
	}
	//----------------------------
	//メールアドレスをチェックする
	//----------------------------
	public static function email_check($post) {
		// チェック変数
		$user_email_check = true;
		// 正しいメールアドレスかどうか調べる関数
		$user_email_check = Library_Validateemail_Basis::validate_email($post["email"]);
		if($user_email_check) {
			$signup_email_res = DB::query("
				SELECT *
				FROM user
				WHERE email = '".$post["email"]."'")->execute();
			foreach($signup_email_res as $key => $value) {
				$user_email_check = false;
			}
		}
			else {
				$user_email_check = false;
			}
		return $user_email_check;
	}
	//------------------------
	//パスワードをチェックする
	//------------------------
	public static function password_check($post) {
		// チェック変数
		$user_password_check = true;
		// 半角英数字だけか調べる
		$pattern = '/^[a-zA-Z0-9]+$/';
		if(preg_match($pattern, $post["password"], $password_array)) {
			$password_number = strlen($post["password"]);
			// 4文字未満ならアウト
			if($password_number < 4) {
					$user_password_check = false;
			}
		}
			// 半角英数字以外が入っている場合
			else {
				$user_password_check = false;
			}
		return $user_password_check;
	}
	//------------------------
	//パスワードを●に変換する
	//------------------------
	public static function password_hidden_string($post) {
		// 何文字あるか取得
		$password_num = strlen($post["password"]);
		// リターンする変数
		$password_hidden_string = '';
		// パスワードを●に変換する
		for($i = 0; $i < $password_num; $i++) {
			$password_hidden_string .= '●';
		}
		return $password_hidden_string;
	}
	//------------
	//ユーザー登録
	//------------
	public static function user_signup($post) {
				$now_time          = time();
				$now_date          = date('Y-m-d', $now_time);
				$create_date       = date('Y-m-d H:i:s', $now_time);
				$article_year_time = date('Y', $now_time);
//				echo md5($post["password"]);

				// ユーザー登録
				DB::query("
					INSERT INTO user (
					sharetube_id ,
					email, 
					password ,
					name, 
					update_time)
					VALUES (
					'".$post["sharetube_id"]."', 
					'".$post["email"]."', 
					'".md5($post["password"])."', 
					'".$post["sharetube_id"]."', 
					'".$create_date."')")->execute();

			// パスワードを●に変換する
			$password_hidden_string = Model_Signup_Basis::password_hidden_string($post);
			// ユーザーへ登録完了メール送信
			Model_Mail_Basis::new_account_contact_mail($post, $password_hidden_string);
			// ユーザー登録された主旨のレポートメールを受け取る
			Model_Mail_Basis::new_account_report_mail($post, $password_hidden_string);
	}
}