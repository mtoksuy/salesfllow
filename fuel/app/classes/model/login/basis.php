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
			$hash                       = $value['password'];
			$user_data['salesfllow_id'] = $value['salesfllow_id'];
			$user_data['email']         = $value['email'];
			$user_data['password']      = $value['password'];
			$user_data['name']          = $value['name'];
			$user_data['profile_icon']  = $value['profile_icon'];
			$user_data['profile_html']  = $value['profile_html'];
		}
		// パスワードを照合(ログイン)
		if(password_verify($post['login_pass'], $hash)) {
			// 前のトークンを無効
			$login_res = DB::query("
				UPDATE login_token 
					SET token_check = 0
					WHERE email = '".$user_data['email']."'
					AND token = '".$_COOKIE['salesfllow_login_token']."'")->execute();
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
			setcookie('salesfllow_id', $user_data["salesfllow_id"], time() + 2592000, '/');
			setcookie('salesfllow_login_token', $login_token, time() + 2592000, '/');
			setcookie('email', $user_data['email'], time() + 2592000, '/');
			setcookie('name', $user_data['name'], time() + 2592000, '/');
			setcookie('profile_icon', $user_data['profile_icon'], time() + 2592000, '/');
			setcookie('profile_html', $user_data['profile_html'], time() + 2592000, '/');
			// ログイン履歴登録
			Model_Login_Basis::login_history_record($_COOKIE["salesfllow_id"]);
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
	//クッキーログイン
	//----------------
	public static function cookie_login() {
		$login_check = false;
		$query = DB::query("
			SELECT *
			FROM user
			WHERE	salesfllow_id     = '".$_COOKIE['salesfllow_id']."'
			AND   password         = '".$_COOKIE['salesfllow_login_key']."'

			OR    email            = '".$_COOKIE['salesfllow_id']."'
			AND   password         = '".$_COOKIE['salesfllow_login_key']."'")->execute();

		foreach($query as $key => $value) {
			// セッション生成
			$_SESSION["primary_id"]          = $value["primary_id"];
			$_SESSION["salesfllow_id"]        = $value["salesfllow_id"];
			$_SESSION["email"]               = $value["email"];
			$_SESSION["name"]                = $value["name"];
			$_SESSION["management_site_url"] = $value["management_site_url"];
			$_SESSION["profile_contents"]    = $value["profile_contents"];
			$_SESSION["profile_icon"]        = $value["profile_icon"];
			$_SESSION["twitter_id"]          = $value["twitter_id"];
			$_SESSION["facebook_id"]         = $value["facebook_id"];
			$_SESSION["all_page_view"]       = $value["all_page_view"];
			$_SESSION["creation_time"]       = $value["creation_time"];
			$_SESSION["update_time"]         = $value["update_time"];
			// クッキー生成(一ヶ月有効)
			setcookie('salesfllow_id', $value["salesfllow_id"], time() + 2592000, '/');
			setcookie('salesfllow_login_key', $_COOKIE['salesfllow_login_key'], time() + 2592000, '/');
			// ユーザーがログインしたらお知らせのメールを送信する
			Model_Mail_Basis::login_account_report_mail($_SESSION);
			$login_check = true;
		}
			return $login_check;
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
		// セッション削除
		$_SESSION = array();
		session_destroy();
		// クッキー削除
		setcookie('salesfllow_id', '', time()-10000, '/');
		setcookie('salesfllow_login_key', '',time()-10000, '/');
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