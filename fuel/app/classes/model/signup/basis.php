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
	//新規登録salesfllow_idチェック
	//----------------------------
	public static function salesfllow_id_check($post) {
		// チェック変数
		$user_salesfllow_id_check = true;

		// 半角英数字(-_含む)だけか調べる
		$pattern = '/^[a-zA-Z0-9_-]+$/';
		if(preg_match($pattern, $post["salesfllow_id"], $salesfllow_id_array)) {
			// idかぶってないかチェック
			if($salesfllow_id_array[0] != 'Sharetube' && $salesfllow_id_array[0] != 'sharetube') {
				$signup_salesfllow_id_res = DB::query("
					SELECT *
					FROM user
					WHERE salesfllow_id = '".$post["salesfllow_id"]."'")->execute();	
					foreach($signup_salesfllow_id_res as $key => $value) {
						$user_salesfllow_id_check = false;
					}
			}
			// サイト名は弾く
				else {
					$user_salesfllow_id_check = false;
				}
		}
			else {
				$user_salesfllow_id_check = false;
			}
		return $user_salesfllow_id_check;
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
		$password_text = $post['password'];
		$options = [
			'cost' => 4,
		];
		$password_hash = password_hash($password_text, PASSWORD_DEFAULT, $options);
/*
		// 暗号化したいテキストを設定。今回は仮に「test」とします。
		$password_text = 'test';
		$options = [
			'cost' => 4,
		];
		$hash = password_hash($password_text, PASSWORD_DEFAULT, $options);
		pre_var_dump($hash);
		$true_password = 'test';
		// パスワードを照合
		pre_var_dump(password_verify($true_password, $hash));
*/
		$now_time          = time();
		$now_date          = date('Y-m-d', $now_time);
		$update_date       = date('Y-m-d H:i:s', $now_time);
		// ユーザー登録
		 $insert_res =DB::query("
			INSERT INTO user (
			email, 
			password ,
			name, 
			update_time)
			VALUES (
			'".$post["email"]."', 
			'".$password_hash."', 
			'".$post["name"]."', 
			'".$update_date."')")->execute();
		foreach($insert_res as $key => $value) {
			if($key == 0) {
				$salesfllow_id = (int)$value;
			}
		}
		DB::query("
			UPDATE user
			SET   salesfllow_id = '".$salesfllow_id."'
			WHERE primary_id    = ".$salesfllow_id."")->execute();
	}











}