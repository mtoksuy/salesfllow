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
class Controller_Sales extends Controller_Sales_Template {
	// 親のbefore実行
	public function before() {
		parent::before();
	}
	// 基本アクション
	public function action_index() {
		// 数字を圧縮する
		Library_Shorturl_Basis::shot_url_encode(1034778073013);



		// ポストの中身をエンティティ化する
		$post = Model_Security_Basis::post_security($_POST);
		// ポストがあった場合
		if($post) {
			// 案件作成
			Model_Sales_Basis::sales_create($post);
		}

		// トークン確認
		$token_check = Model_Login_Basis::token_check($_COOKIE['user_data']['email'], $_COOKIE['user_data']['salesfllow_login_token']);
		if($token_check) {
			// ヘッダーセット
			$this->sales_template->view_data['header'] = View::forge('salesfllow/header');
			// CSSセット
			$this->sales_template->view_data['import_css'] = View::forge('salesfllow/importcss');
			//JSセット
			$this->sales_template->view_data['script'] = View::forge('salesfllow/script');


			// コンテンツデータセット
			$this->sales_template->view_data["header"]->set('content_data', array(
				'content_html' => 'afafds',
			), false);
			// コンテンツデータセット
			$this->sales_template->view_data["content"]->set('content_data', array(
				'function_html'    => View::forge('salesfllow/function'),
				'sales_list_html'  => View::forge('salesfllow/sales/list'),
				'content_html'     => '',
			), false);
			// コンテンツデータセット
			$this->sales_template->view_data["content"]->content_data['function_html']->set('content_data', array(
				'sales_now'  => 'now',
			), false);

			//案件リスト取得
			$sales_res = Model_Sales_Basis::sales_list_get($_COOKIE['user_data']['user_primary_id']);
			// 案件リストHTML生成
			$sales_list_html = Model_Sales_Html::sales_list_html_create($sales_res);
			// コンテンツデータセット
			$this->sales_template->view_data["content"]->content_data['sales_list_html']->set('content_data', array(
				'sales_list_html'  => $sales_list_html,
			), false);
		} // if($token_check) {
			// ログインしていない状態
			else {
				// CSSセット
				$this->sales_template->view_data['import_css'] = View::forge('root/importcss');
		
				// コンテンツデータセット
				$this->sales_template->view_data["content"]->set('content_data', array(
					'recommend_html' => View::forge('root/lp'),
				), false);
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
