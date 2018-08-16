<?php 

/**
 * セールス関連のクラス
 * 
 * 
 * 
 * 
 */

class Model_Sales_Html extends Model {
	//--------
	//案件作成
	//--------
	public static function sales_list_html_create($sales_res) {
		foreach($sales_res as $key => $value) {
			$li_html = $li_html.'<li><a href="'.HTTP.'sales/'.$value['primary_id'].'/"><h1>'.$value['title'].'</h1><p>'.$value['text'].'</p></a></li>';
		}
		// 合体
		$sales_list_html = 
		'<ul>
			'.$li_html.'
		</ul>';
		return $sales_list_html;
	}




}