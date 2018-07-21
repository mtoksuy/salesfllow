<?php 
/**
 * コントローラーセールステンプレート
 * 
 * 汎用的なテンプレート
 * 
 * 
 */

class Controller_Sales_Template extends Controller {
	// コントラスト
	public function __construct(\Request $request) {
		$this->request = $request;
	}
	// テンプレート
	public function before() {
		$this->sales_template            = View::forge('basic/template');
		$this->sales_template->view_data = array(
			'title'        => TITLE,
			'meta'         => View::forge('basic/meta'),
//			'import_css'   => View::forge('basic/importcss'),
//			'drawer'       => View::forge('basic/drawer'),
			'header'       => View::forge('basic/header'),
			'content'      => View::forge('basic/content'),
//			'sidebar'      => View::forge('basic/sidebar'),
//			'footer'       => View::forge('basic/footer'),
			'script'       => View::forge('basic/script'),
		);
	}
	// 最後に値を渡す
	public function after($response) {
		if($response === null) {
			$response = $this->sales_template;
		}
		return parent::after($response);
	}
}