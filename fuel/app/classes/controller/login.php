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
class Controller_Login extends Controller_Login_Template {
	// ルーター
	public function router($method, $params) {
		// ポストの中身をエンティティ化する
		$post = Model_Security_Basis::post_security($_POST);
		return $this->action_index($post);
	}
	// 親のbefore実行
	public function before() {
		parent::before();
	}
	// 基本アクション
	public function action_index($post) {
		// ポストがある場合
		if($post) {
			// ログイン
			$lohin_message = Model_Login_Basis::login($post);
		}
			// ポストがない場合
			else {

			}
		// ログインHTML生成
		$login_html = View::forge('login/login');
		// コンテンツセット
		$this->login_template->view_data["content"]->set('content_data', array(
			'content_html' => $login_html,
		));
		// コンテンツセット
		$this->login_template->view_data["content"]->content_data['content_html']->set('login_data', array(
			'lohin_message' => $lohin_message,
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
