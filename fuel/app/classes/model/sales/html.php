<?php 

/**
 * セールス関連のクラス
 * 
 * 
 * 
 * 
 */

class Model_Sales_Html extends Model {
	//------------------
	//案件リストHTML作成
	//------------------
	public static function sales_list_html_create($sales_res, $sales_primary_id) {
		foreach($sales_res as $key => $value) {
			// 改行を消す&タブ削除
			$sales_contests = str_replace(array("\r\n", "\r", "\n", "\t"), '', $value["text"]);
			// 本文を5680文字に丸める
			$sales_contests = mb_strimwidth($sales_contests, 0, 5680, "...", 'utf8');
			// HTMLタグを取り除く
			$sales_contests = preg_replace('/<("[^"]*"|\'[^\']*\'|[^\'">])*>/', '', $sales_contests);	
			// 本文を84文字に丸める
			$summary_contents = mb_strimwidth($sales_contests, 0, 84, "...", 'utf8');
			// タイトルのエンティティを戻す
			$title        = htmlspecialchars_decode($value["title"], ENT_NOQUOTES);
			// タイトルを82文字に丸める
			$title = mb_strimwidth($title, 0, 82, "...", 'utf8');

			if((int)$value['primary_id'] == $sales_primary_id) {
				$li_html = $li_html.'<li class="now"><a href="'.HTTP.'sales/'.$value['url_id'].'/"><h1>'.$title.'</h1><p>'.$summary_contents.'</p></a></li>';
			}
				else {
					$li_html = $li_html.'<li><a href="'.HTTP.'sales/'.$value['url_id'].'/"><h1>'.$title.'</h1><p>'.$summary_contents.'</p></a></li>';
				}
		}
		// 合体
		$sales_list_html = 
		'<ul>
			'.$li_html.'
		</ul>';
		return $sales_list_html;
	}
	//----------------
	//セールスHTML生成
	//----------------
	public static function sales_html_create($sales_res) {
		$sales_array = array();
		foreach($sales_res as $key => $value) {
			$sales_array['primary_id']      = $value['primary_id'];
			$sales_array['url_id']          = $value['url_id'];
			$sales_array['user_primary_id'] = $value['user_primary_id'];
			$sales_array['title']           = $value['title'];
			$sales_array['text']            = $value['text'];
			$sales_array['status']          = $value['status'];
			$sales_array['approach']        = $value['approach'];
			$sales_array['client']          = $value['client'];
			$sales_array['appointment']     = $value['appointment'];
			$sales_array['tag']             = $value['tag'];
			$sales_array['budget']          = $value['budget'];
			$sales_array['proceed']         = $value['proceed'];
			$sales_array['deadline']        = $value['deadline'];
			$sales_array['create_time']     = $value['create_time'];
			$sales_array['update_time']     = $value['update_time'];
		}
		$salse_html = '

<div class="sales">
	<div class="sales_inner">
		<h1>'.$sales_array['title'].'</h1>
		<p class="text">'.$sales_array['text'].'</p>
	</div>
</div>';
		return $salse_html;

	}


}