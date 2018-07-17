<?php 
class Model_Mail_Basis extends Model {
	//------------------------------
	//QBメール送信(全てはここに通す)
	//------------------------------
	public static function qbmail_send($post_array) {
		// エラー表示設定(qbmail仕様上エラー非表示にする)
		error_reporting(0);
		ini_set('display_errors', 1);
		// qdmail呼び出し
//		require_once PATH."assets/library/qdmail/qdmail.php";
//		require_once PATH."assets/library/qdmail/qdsmtp.php";
		require_once INTERNAL_PATH."fuel/app/classes/library/qdmail/qdmail.php";
		require_once INTERNAL_PATH."fuel/app/classes/library/qdmail/qdsmtp.php";



//			$mail = & new Qdmail(); ??
			$mail = new Qdmail();

//			pre_var_dump($mail);
//exit;
			$mail->smtp(true);

			// param設定
			$mail -> smtpServer($post_array["param"]);
			// 送信先
			$mail ->to($post_array["to"]);
			// 題名
			$mail ->subject($post_array["subject"]);
			// 送信元情報
			$mail ->from($post_array["from"]);
			// 本文挿入
			$mail ->text($post_array["message"]);
//			$mail ->html($post_array["message"]);
			// 自動テキスト生成機能はOFF
			$mail -> autoBoth(false);

			// 送信
			$return_flag = $mail ->send();
	}
	//-----------------------------------------------------
	//メール配信許可があるSalesfllowユーザー全員へメール送信
	//-----------------------------------------------------
	public static function mail_delivery_ok_sharetube_id_uses_mail_send($post, $mail_delivery_ok_sharetube_id_uses_data_res) {
		$mail_message = $post['mail_message'];
		$bottom_fixed_phrase = "

━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
Salesfllow - シェアしたくなるコンテンツが集まる、集まる。
発行：Salesfllow[シェアチューブ]サポートチーム
http://salesfllow.cloud/

お問合せ: http://salesfllow.cloud/contact/
COPYRIGHT(C) Salesfllow ALL RIGHTS RESERVED.";
		// 合体
		$message = $mail_message.$bottom_fixed_phrase;
		// デコード
		$message = htmlspecialchars_decode($message);
/*
/ ヘッダー情報
$headers = '';
$headers .= 'Content-Type: multipart/alternative; boundary="' . $boundary . '"' . "\r\n";
$headers .= 'Content-Transfer-Encoding: binary' . "\r\n";
$headers .= 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
$headers .= "From: " . mb_encode_mimeheader($mail_from_name) . "<" . $mail_from . ">" . "\r\n";
// 送信者名を指定しない場合は次のよう
*/
//		pre_var_dump($message);
		foreach($mail_delivery_ok_sharetube_id_uses_data_res as $key => $value) {
			$post_array = array(
				'from'    => 'Salesfllow <info@salesfllow.cloud>',
				'to'      => $value['email'],
//				'subject' => '良いキュレーターになるためのSalesfllowマガジン Vol.1',
				'subject' => $post['mail_title'],
				'message' => $message,
				'param'   => array(
					'host'     => 'localhost',
					'port'     => 25,
					'from'     => 'info@salesfllow.cloud', 
					'protocol' => 'SMTP',
					'user'     => '',
					'pass'     => '',),
			);
//			pre_var_dump($post_array);
			// qbメール送信
			Model_Mail_Basis::qbmail_send($post_array);
		}
	}
	//--------------------------------------------------
	//ユーザーがログインしたらお知らせのメールを送信する
	//--------------------------------------------------
	public static function login_account_report_mail($post) {
//	var_dump($post);

		// time関連取得
		$now_time = time();
		$now_date = date('Y-m-d H:i:s', $now_time);
		$message = ("ユーザーがログインしました
---------------------
[ログイン情報]

sharetube_id：{$post['sharetube_id']}
ログインした時間：".$now_date."

---------------------

Salesfllow
http://salesfllow.cloud/

ログインページ
http://salesfllow.cloud/login/

━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
Salesfllow - シェアしたくなるコンテンツが集まる、集まる。
発行：Salesfllow[シェアチューブ]サポートチーム
http://salesfllow.cloud/

お問合せ: http://salesfllow.cloud/contact/
COPYRIGHT(C) Salesfllow ALL RIGHTS RESERVED.");
		$post_array = array(
			'from'    => 'system_report@salesfllow.cloud',
			'to'      => 'system_report@salesfllow.cloud',
			'subject' => 'Salesfllowのユーザーがログインしました',
			'message' => $message,
			'param'   => array(
				'host'     => 'localhost',
				'port'     => 25,
				'from'     => 'system_report@salesfllow.cloud', 
				'protocol' => 'SMTP',
				'user'     => '',
				'pass'     => '',),
		);
			// qbメール送信
			Model_Mail_Basis::qbmail_send($post_array);
	}
	//--------------------------------------
	//新規アカウントがいたら報告メールがくる
	//--------------------------------------
	public static function new_account_report_mail($post) {
		$message = ("新規登録がありました

---------------------
[登録情報]

登録e-mail：{$post['mail']}
パスワード：{$password_hidden_string}
---------------------

━━━━━━━━━━━━━━━━━━━━━━━━━━━━━

営業の進捗をサポート。営業における生産性を最適化するなら[Salesfllow]
https://salesfllow.cloud/

発行：Salesfllowサポートチーム
https://salesfllow.cloud/


お問合せ: https://salesfllow.cloud/contact/
COPYRIGHT(C) Salesfllow ALL RIGHTS RESERVED.");
		$post_array = array(
			'from'    => 'system_report@salesfllow.cloud',
			'to'      => 'system_report@salesfllow.cloud',
			'subject' => 'Salesfllowへ新規登録者がいます',
			'message' => $message,
			'param'   => array(
				'host'     => 'localhost',
				'port'     => 25,
				'from'     => 'system_report@salesfllow.cloud', 
				'protocol' => 'SMTP',
				'user'     => '',
				'pass'     => '',),
		);
			// qbメール送信
			Model_Mail_Basis::qbmail_send($post_array);
	}
	//------------------------------------
	//新規アカウント登録者へ自動メール送信
	//------------------------------------
	public static function new_account_contact_mail($post, $password_hidden_string) {
		$message = ("Salesfllowへご登録ありがとうございます。



---------------------
[登録情報]

登録e-mail：{$post['mail']}
パスワード：{$password_hidden_string}
---------------------

salesfllow
https://salesfllow.cloud/

ログインページ
https://salesfllow.cloud/login/

利用規約
http://salesfllow.cloud/rule/rule/

---------------------


━━━━━━━━━━━━━━━━━━━━━━━━━━━━━

営業の進捗をサポート。営業における生産性を最適化するなら[Salesfllow]
https://salesfllow.cloud/

発行：Salesfllowサポートチーム
https://salesfllow.cloud/

お問合せ: https://salesfllow.cloud/contact/
COPYRIGHT(C) Salesfllow ALL RIGHTS RESERVED.");
		$post_array = array(
			'from'    => 'Salesfllow <info@salesfllow.cloud>',
			'to'      => ''.$post["email"].'',
			'subject' => ''.$post['mail'].'さん Salesfllowへようこそ',
			'message' => $message,
			'param'   => array(
				'host'     => 'localhost',
				'port'     => 25,
				'from'     => 'info@salesfllow.cloud', 
				'protocol' => 'SMTP',
				'user'     => '',
				'pass'     => '',),
		);
			// qbメール送信
			Model_Mail_Basis::qbmail_send($post_array);
	}


















































































































































































		//--------------------------------------------------------------------------
		//コンタクトformメール送信(PEARを利用した関数。一応サンプルとして残しておく)
		//--------------------------------------------------------------------------
		function contact_post($post) {
			$mail = 'info@programmerbox.com';
			// mb_encode_mimeheader用エンコードの設定
			mb_language("japanese");
			mb_internal_encoding("UTF-8");
			require_once 'Mail.php';
			require_once 'Mail/mime.php';
			// ① Mail_Mimeクラスのインスタンス化
			$mime = new Mail_Mime("\n");
			// ② テキスト本文の設定
			$mime->setTxtBody("CONTACTからフォーム送信されました。
お名前:{$post['name']}
メールアドレス:{$post['email']}
web:{$post['web']}
---------------------------------
メッセージ:{$post['text_area']}");
			// ③ 添付ファイルの指定
//			$mime->addAttachment("nagoya.jpg", "image/jpg");

			// ④ メッセージの設定
			$bodyParam = array(
			"head_charset"  => "ISO-2022-JP",
			"text_encoding" => "ISO-2022-JP",
			"text_charset"  => "UTF-8"
			);
			// ⑤ メッセージを構築する
			$body = $mime->get($bodyParam);

			$addHeaders = array(
			'From'    => 'info@programmerbox.com',                            //送信元
			'To'      =>  'info@programmerbox.com',                           //送信宛
			'Subject' =>  mb_encode_mimeheader("Programmerboxのフォーム通知") //タイトル
			);
			// ⑥ ヘッダ行を構築する
			$headers = $mime->headers($addHeaders);

			// 送信元smtp設定
			$params = array(
			'host'     => 'smtp.souya-matsuoka.net',
			'port'     => 587,
			'auth'     => true,
			'username' => 'info@programmerbox.com',
			'password' => 'matu1012'
			);
			$recipients =  $mail;
			$smtp = Mail::factory( 'smtp', $params);
//			var_dump($smtp);
			$e = $smtp->send( $recipients, $headers, $body);
			if ( PEAR::isError($e) )
			{
				print( $e->getMessage() );
			}
				else
				{
//					print( "<h2>詳細を{$recipients}様宛にメールを送りました。</h2>" );
				}
				return $event_date;
		} // function contact_post($post)
}