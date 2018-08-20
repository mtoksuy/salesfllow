<?php
/*
* Ajax セールス データフォーマットコントローラー
* 
* 
* 
*/
class Controller_Ajax_Sales_Dateformat extends Controller {
	// アクション
	public function action_index() {
		// ポストの中身をエンティティ化する
		$post = Model_Security_Basis::post_security($_POST);
		$strtotime_selectedDates = strtotime($post['selectedDates']);
		$format_date = date($post['format'], $strtotime_selectedDates);

		header ("Content-Type: text/javascript; charset=utf-8");
		$json_data = array(
			'POST'             => $post,
			'format_date'      => $format_date,
		);
		return json_encode($json_data);
	}
}