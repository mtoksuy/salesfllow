<?php 
/**
 * コントローラーサインアップテンプレート
 * 
 * 
 * 
 * 
 */

class Controller_Signup_Template extends Controller {
	// コントラスト
	public function __construct(\Request $request) {
		$this->request = $request;
	}
	// テンプレート
	public function before() {
		$this->signup_template            = View::forge('basic/template');
		$this->signup_template->view_data = array(
			'title'        => TITLE,
			'meta'         => View::forge('basic/meta'),
			'import_css'   => View::forge('signup/importcss'),
			'header'       => View::forge('signup/header'),
			'content'      => View::forge('basic/content'),
			'script'       => View::forge('basic/script'),
		);
	}
	// 最後に値を渡す
	public function after($response) {
		if($response === null) {
			$response = $this->signup_template;
		}
		return parent::after($response);
	}
}