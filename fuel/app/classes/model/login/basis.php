<?php 

/**
 * ログイン関連のクラス
 * 
 * 
 * 
 * 
 */

class Model_Login_Basis extends Model {
	//--------
	//ログイン
	//--------
	public static function login($post) {
		$login_res = DB::query("
			SELECT *
			FROM user
			WHERE	salesfllow_id = '".$post["login_user"]."'
			OR    email         = '".$post["login_user"]."'")->execute();
		foreach($login_res as $key => $value) {
			$hash                         = $value['password'];
			$user_data['user_primary_id'] = $value['primary_id'];
			$user_data['salesfllow_id']   = $value['salesfllow_id'];
			$user_data['email']           = $value['email'];
			$user_data['password']        = $value['password'];
			$user_data['name']            = $value['name'];
			$user_data['profile_icon']    = $value['profile_icon'];
			$user_data['profile_html']    = $value['profile_html'];
		}
		// パスワードを照合(ログイン)
		if(password_verify($post['login_pass'], $hash)) {
			// 前のトークンを無効
			$login_res = DB::query("
				UPDATE login_token 
					SET token_check = 0
					WHERE email = '".$user_data['email']."'
					AND token = '".$_COOKIE['user_data']['salesfllow_login_token']."'")->execute();
			// ログイントークン生成
			$login_token = Model_Login_Basis::login_token_create(32);
			// 現在のトークンを登録
			$login_res = DB::query("
				INSERT INTO login_token (
					email,
					token
				)
				VALUES (
					'".$user_data['email']."',
					'".$login_token."'
				)")->execute();
			// クッキー生成(一ヶ月有効)
			setcookie('user_data[user_primary_id]', $user_data['user_primary_id'], time() + 2592000, '/');
			setcookie('user_data[salesfllow_id]', $user_data['salesfllow_id'], time() + 2592000, '/');
			setcookie('user_data[salesfllow_login_token]', $login_token, time() + 2592000, '/');
			setcookie('user_data[email]', $user_data['email'], time() + 2592000, '/');
			setcookie('user_data[name]', $user_data['name'], time() + 2592000, '/');
			setcookie('user_data[profile_icon]', $user_data['profile_icon'], time() + 2592000, '/');
			setcookie('user_data[profile_html]', $user_data['profile_html'], time() + 2592000, '/');

			// ログイン履歴登録
			Model_Login_Basis::login_history_record($user_data['salesfllow_id']);
			header('Location: '.HTTP.'');
			exit;
		}
			else {
				// ログイン出来ない場合
				$lohin_message = 'ユーザー名かパスワードが間違っています。';
				return $lohin_message;
			}
	}
	//----------------
	//ログインチェック
	//----------------
	public static function login_check() {
		// エラー表示設定()
		error_reporting(0);
		ini_set('display_errors', 1);

		$login_check = '';
		// セッションがある場合
		if($_SESSION["salesfllow_id"]) {
			$login_check = true;
		}
			// セッションがない場合
			else {
				$login_check = false;
				// クッキーがある場合
				if($_COOKIE['salesfllow_id']) {
					// クッキーでログイン
					$login_check  = Model_Login_Basis::cookie_login();
				}
			}
		return $login_check;
	}
	//----------
	//ログアウト
	//----------
	public static function logout() {
		// 前のトークンを無効
		$login_res = DB::query("
			UPDATE login_token 
				SET token_check = 0
				WHERE email = '".$_COOKIE['user_data']['email']."'
				AND token   = '".$_COOKIE['user_data']['salesfllow_login_token']."'")->execute();

		// クッキー削除
		setcookie('user_data[user_primary_id]', '', time() + -10000, '/');
		setcookie('user_data[salesfllow_id]', '', time() + -10000, '/');
		setcookie('user_data[salesfllow_login_token]', '', time() + -10000, '/');
		setcookie('user_data[email]', '', time() + -10000, '/');
		setcookie('user_data[name]', '', time() + -10000, '/');
		setcookie('user_data[profile_icon]', '', time() + -10000, '/');
		setcookie('user_data[profile_html]', '', time() + -10000, '/');
		header('location: '.HTTP.'');
		exit;
	}
	//----------------------
	//ログイン履歴を記録する
	//----------------------
	public static function login_history_record($salesfllow_id) {
		DB::query("
			INSERT INTO login_history (
				salesfllow_id
			)
			VALUES (
				'".$salesfllow_id."'
			)
		")->execute();
	}
	//--------------------
	//ログイントークン生成
	//--------------------
	public static function login_token_create($token_length) {
		$bytes       = openssl_random_pseudo_bytes($token_length, $cstrong);
		$login_token = bin2hex($bytes);
		return $login_token;
	}
	//------------
	//トークン確認
	//------------
	public static function token_check($email, $token) {
		$token_check = false;
		$toke_res = DB::query("
			SELECT * 
			FROM login_token
			WHERE email = '".$email."'
			AND token = '".$token."'
			AND token_check = 1")->execute();
		foreach($toke_res as $key => $value) {
			$token_check = true;
		}
		return $token_check;
	}















}