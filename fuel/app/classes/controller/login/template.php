<?php 
/**
 * コントローラーログインテンプレート
 * 
 * 
 * 
 * 
 */

class Controller_Login_Template extends Controller {
	// コントラスト
	public function __construct(\Request $request) {
		$this->request = $request;
	}
	// テンプレート
	public function before() {
		$this->login_template            = View::forge('basic/template');
		$this->login_template->view_data = array(
			'title'        => TITLE,
			'meta'         => View::forge('basic/meta'),
			'import_css'   => View::forge('login/importcss'),
//			'header'       => View::forge('signup/header'),
			'content'      => View::forge('basic/content'),
			'script'       => View::forge('basic/script'),
		);
	}
	// 最後に値を渡す
	public function after($response) {
		if($response === null) {
			$response = $this->login_template;
		}
		return parent::after($response);
	}
}