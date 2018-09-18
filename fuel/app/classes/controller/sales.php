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
	// ルーター
	public function router($method, $params) {
		// トークン確認
		$token_check = Model_Login_Basis::token_check($_COOKIE['user_data']['email'], $_COOKIE['user_data']['salesfllow_login_token']);
		if($token_check) {
		
		} // if($token_check) {
			else {
				header('Location: '.HTTP.'');
				exit;
			}
		// トップページ
		if($method == 'index') {
			return $this->action_index($post);
		}
			// 案件詳細ページ
			else if($params == false) {
				// 数字を圧縮する
				$encode = Library_Shorturl_Basis::shot_url_encode(777);
				// 圧縮した数字(文字列)を数字に戻す
				$decode           = Library_Shorturl_Basis::shot_url_decode($method);
				$sales_primary_id = $decode;
				return $this->action_sales($sales_primary_id);
			}
				// エラーページ
				else {
					return $this->action_404($post);
				}
		// ポストの中身をエンティティ化する
		$post = Model_Security_Basis::post_security($_POST);
		return $this->action_index($post);
	}
	// 親のbefore実行
	public function before() {
		parent::before();
	}
	/////////////////
	// 基本アクション
	/////////////////
	public function action_index() {
		// ポストの中身をエンティティ化する
		$post = Model_Security_Basis::post_security($_POST);
		// ポストがあった場合
		if($post) {
			// 案件作成
			Model_Sales_Basis::sales_create($post);
		}

$time_start = microtime(true);



		Model_Sales_Basis::sales_nest_type_1_list_get((int)$_COOKIE['user_data']['user_primary_id']);
$time = microtime(true) - $time_start;
//echo "{$time} 秒";




		// コンテンツデータセット
		$this->sales_template->view_data["content"]->set('content_data', array(
			'function_html'   => View::forge('salesfllow/function2'),
			'sales_list_html' => View::forge('salesfllow/sales/list'),
			'content_html'    => View::forge('salesfllow/sales/salescreate'),
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
	}
	/////////////////////
	// 案件詳細アクション
	/////////////////////
	public function action_sales($sales_primary_id) {
		// セールスresを取得
		$sales_res = Model_Sales_Basis::sales_res_get($sales_primary_id);
		// セールスHTML生成
		$sales_html = Model_Sales_Html::sales_html_create($sales_res);
		// コンテンツデータセット
		$this->sales_template->view_data["content"]->set('content_data', array(
			'function_html'   => View::forge('salesfllow/function'),
			'sales_list_html' => View::forge('salesfllow/sales/list'),
			'content_html'    => $sales_html,
		), false);

		// コンテンツデータセット
		$this->sales_template->view_data["content"]->content_data['function_html']->set('content_data', array(
			'sales_now'  => 'now',
		), false);

		//案件リスト取得
		$sales_res = Model_Sales_Basis::sales_list_get($_COOKIE['user_data']['user_primary_id']);
		// 案件リストHTML生成
		$sales_list_html = Model_Sales_Html::sales_list_html_create($sales_res, $sales_primary_id);
		// コンテンツデータセット
		$this->sales_template->view_data["content"]->content_data['sales_list_html']->set('content_data', array(
			'sales_list_html'  => $sales_list_html,
		), false);
	}


















	///////////////
	// エラーページ
	///////////////
	public function action_404() {
		$error_word = 'エラーページ';
		// 404ステータスにする
		$this->response_status                                      = 404;
		$this->active_request->response->status                     = 404;
		$this->active_request->controller_instance->response_status = 404;

		// メタセット
		$this->sales_template->view_data['meta'] = View::forge('404/meta');

		// 記事コンテンツセット
		$this->sales_template->view_data["content"]->set('content_data', array(
			'content_html' => $error_word,
		), false);
	}

}
