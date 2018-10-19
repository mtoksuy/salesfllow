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
			// ノート詳細ページ
			else if($method == 'note' && $params[0]) {
				$note_node_primary_id = (int)$params[0];
				return $this->action_note($note_node_primary_id);
			}
			// 案件詳細ページ
			else if($params == false) {
				// 数字を圧縮する
//				$encode = Library_Shorturl_Basis::shot_url_encode(777);
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
		// シンプル型の案件フォルダリスト取得
		$note_node_res = Model_Sales_Basis::sales_type_simple_folder_list_res_get((int)$_COOKIE['user_data']['user_primary_id']);
		// セールスフォルダーHTML生成
		$folder_html = Model_Sales_Html::sales_folder_html_create($note_node_res, 'root');
		// ゴミ箱(使ってないようだ
		$note_trash_list_res = Model_Sales_Basis::note_trash_list_get((int)$_COOKIE['user_data']['user_primary_id']);


		// コンテンツデータセット
		$this->sales_template->view_data["content"]->set('content_data', array(
			'folder_html'     => View::forge('salesfllow/sales/folder'),
			'sales_list_html' => View::forge('salesfllow/sales/list'),
			'content_html'    => View::forge('salesfllow/sales/salescreate'),
		), false);
		// コンテンツデータセット
		$this->sales_template->view_data["content"]->content_data['folder_html']->set('content_data', array(
			'sales_now'   => 'now',
			'folder_html' => $folder_html,
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
	///////////////////
	// ノートアクション
	///////////////////
	public function action_note($note_node_primary_id) {
		// シンプル型の案件フォルダリストres取得
		$note_node_res = Model_Sales_Basis::sales_type_simple_folder_list_res_get((int)$_COOKIE['user_data']['user_primary_id']);
		// セールスフォルダーHTML生成
		$folder_html = Model_Sales_Html::sales_folder_html_create($note_node_res, $note_node_primary_id);

		// コンテンツデータセット
		$this->sales_template->view_data["content"]->set('content_data', array(
			'folder_html'     => View::forge('salesfllow/sales/folder'),
			'sales_list_html' => View::forge('salesfllow/sales/list'),
			'content_html'    => View::forge('salesfllow/sales/salescreate'),
		), false);
		// コンテンツデータセット
		$this->sales_template->view_data["content"]->content_data['folder_html']->set('content_data', array(
			'sales_now'   => 'now',
			'folder_html' => $folder_html,
		), false);

		// 案件リスト取得
		$sales_note_res = Model_Sales_Basis::sales_note_list_get($_COOKIE['user_data']['user_primary_id'], $note_node_primary_id);
		// 案件リストHTML生成
		$sales_list_html = Model_Sales_Html::sales_list_html_create($sales_note_res);
		// コンテンツデータセット
		$this->sales_template->view_data["content"]->content_data['sales_list_html']->set('content_data', array(
			'sales_list_html'  => $sales_list_html,
		), false);
	}
	/////////////////////
	// 案件詳細アクション
	/////////////////////
	public function action_sales($sales_primary_id) {
		// 
		Model_Sales_Basis::a();
		// シンプル型の案件フォルダリスト取得
		$note_node_res = Model_Sales_Basis::sales_type_simple_folder_list_res_get((int)$_COOKIE['user_data']['user_primary_id']);
		// セールスフォルダーHTML生成
		$folder_html = Model_Sales_Html::sales_folder_html_create($note_node_res);

		// セールスresを取得
		$sales_res = Model_Sales_Basis::sales_res_get($sales_primary_id);
		// セールスHTML生成
		$sales_html = Model_Sales_Html::sales_html_create($sales_res);

		// コンテンツデータセット
		$this->sales_template->view_data["content"]->set('content_data', array(
			'folder_html'   => View::forge('salesfllow/sales/folder'),
			'sales_list_html' => View::forge('salesfllow/sales/list'),
			'content_html'    => $sales_html,
		), false);
		// コンテンツデータセット
		$this->sales_template->view_data["content"]->content_data['folder_html']->set('content_data', array(
			'sales_now'  => 'now',
			'folder_html' => $folder_html,
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
