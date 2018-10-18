<?php
/**
 * Fuel is a fast, lightweight, community driven PHP 5.4+ framework.
 *
 * @package    Fuel
 * @version    1.8.1
 * @author     Fuel Development Team
 * @license    MIT License
 * @copyright  2010 - 2018 Fuel Development Team
 * @link       http://fuelphp.com
 */

/**
 * The Welcome Controller.
 *
 * A basic controller example.  Has examples of how to set the
 * response body and status.
 *
 * @package  app
 * @extends  Controller
 */
class Controller_Signup extends Controller_Signup_Template {
	// ルーター
	public function router($method, $params) {
		// ポストの中身をエンティティ化する
		$post = Model_Security_Basis::post_security($_POST);
		// コンプリートの場合
		if($method == 'complete') {
			// パスワードチェック
			$user_password_check = Model_Signup_Basis::password_check($post);
			// 正しいパスワードの場合
			if($user_password_check) {
				return $this->action_complete();
			}
				// 正しくないパスワードの場合
				else {
					return $this->action_miss($post);
				}
		}
			// コンプリート以外の場合
			else {
				return $this->action_index($post);
			}
	}
	// 親のbefore実行
	public function before() {
		parent::before();
	}
	// 基本アクション
	public function action_index($post) {
		// ポストがある場合
		if($post) {
			// メールアドレスをチェックする
			$user_email_check = Model_Signup_Basis::email_check($post);
			// メールアドレスが登録されていなくて正しい場合
			if($user_email_check) {
				// 新規登録ステップ1HTML生成
				$signup_step_1_html = View::forge('signup/signup');
				// コンテンツセット
				$this->signup_template->view_data["content"]->set('content_data', array(
					'content_html' => $signup_step_1_html,
				));
				// フォーム制御変数コンテンツセット
				$this->signup_template->view_data["content"]->content_data["content_html"]->set('sign_data', array(
					'email' => $post['email'],
				));
			}
				else {
					// 新規登録ステップ1HTML生成
					$signup_step_1_html = View::forge('signup/error');
					// コンテンツセット
					$this->signup_template->view_data["content"]->set('content_data', array(
						'content_html' => $signup_step_1_html,
					));
				}
		}
			// ポストがない場合
			else {
				header('location: '.HTTP.'');
				exit;
			}
	}


	// コンプリートアクション
	public function action_complete() {
		// ポストの中身をエンティティ化する
		$post = Model_Security_Basis::post_security($_POST);
		// ポストがある場合
		if($post) {
			// メールアドレスをチェックする
			$user_email_check = Model_Signup_Basis::email_check($post);
			// メールアドレスが登録されていなくて正しい場合
			if($user_email_check) {
				// 新規登録
				Model_Signup_Basis::user_signup($post);
				// パスワードを●に変換する
				$password_hidden_string = Model_Signup_Basis::password_hidden_string($post);
				// 新規アカウント登録者へ自動メール送信
//				Model_Mail_Basis::new_account_contact_mail($post,$password_hidden_string);
				// ユーザー登録された主旨のレポートメールを受け取る
//				Model_Mail_Basis::new_account_report_mail($post, $password_hidden_string);
 			}
 				// メールアドレスが正しくない場合
 				else {

				}
//pre_var_dump($_COOKIE);
			// 新規登録ステップ1HTML生成
			$signup_step_1_html = View::forge('signup/complete');
			// コンテンツセット
			$this->signup_template->view_data["content"]->set('content_data', array(
				'content_html' => $signup_step_1_html,
			));




		} // if($post) {






	}


	// ミスアクション
	public function action_miss($post) {
		// ポストがある場合
		if($post) {
			// 新規登録ステップ1HTML生成
			$signup_miss_1_html = View::forge('signup/miss');
			// コンテンツセット
			$this->signup_template->view_data["content"]->set('content_data', array(
				'content_html' => $signup_miss_1_html,
			));
			// フォーム制御変数コンテンツセット
			$this->signup_template->view_data["content"]->content_data["content_html"]->set('sign_data', array(
				'email' => $post['email'],
			));
			}
		}


















	/**
	 * A typical "Hello, Bob!" type example.  This uses a Presenter to
	 * show how to use them.
	 *
	 * @access  public
	 * @return  Response
	 */
	public function action_hello()
	{
		return Response::forge(Presenter::forge('welcome/hello'));
	}

	/**
	 * The 404 action for the application.
	 *
	 * @access  public
	 * @return  Response
	 */
	public function action_404()
	{
		return Response::forge(Presenter::forge('welcome/404'), 404);
	}
}
