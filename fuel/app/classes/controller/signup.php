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
		return $this->action_index($method);
	}
	// 親のbefore実行
	public function before() {
		parent::before();
	}
	// 基本アクション
	public function action_index($method) {
		$post = Model_Security_Basis::post_security($_POST);
		// ポストがある場合
		if($post) {
			// メールアドレスをチェックする
			$user_email_check = Model_Signup_Basis::email_check($post);
			// メールアドレスが登録されていなくて正しい場合
			if($user_email_check) {
				// 新規登録ステップ1HTML生成
				$signup_step_1_html = View::forge('signup/signup');
			}
				else {

				}
		}
			// ポストがない場合
			else {

			}
				// コンテンツセット
				$this->signup_template->view_data["content"]->set('content_data', array(
					'content_html' => $signup_step_1_html,
				));
				// フォーム制御変数コンテンツセット
				$this->signup_template->view_data["content"]->content_data["content_html"]->set('sign_data', array(
					'email' => $post['email'],
				));
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
