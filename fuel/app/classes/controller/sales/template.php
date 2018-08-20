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
			'import_css'   => View::forge('salesfllow/sales/importcss'),
			'header'       => View::forge('salesfllow/header'),
			'content'      => View::forge('basic/content'),
//			'footer'       => View::forge('basic/footer'),
			'script'       => View::forge('salesfllow/sales/script'),
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