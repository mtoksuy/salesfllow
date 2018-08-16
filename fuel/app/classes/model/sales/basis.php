<?php 

/**
 * セールス関連のクラス
 * 
 * 
 * 
 * 
 */

class Model_Sales_Basis extends Model {
	//--------
	//案件作成
	//--------
	public static function sales_create($post) {
		// 現在の時間表記を取得
		$now_date = Model_Info_Basis::now_date_get();
		DB::query("
			INSERT INTO sales (
				user_primary_id,
				title,
				text,
				status, 
				approach, 
				client, 
				appointment, 
				tag, 
				budget, 
				proceed, 
				deadline,
				update_time
			)
			VALUES (
				".(int)$_COOKIE['user_data']['user_primary_id'].",
				'".$post['title']."',
				'".$post['text']."',
				'".$post['status']."',
				'".$post['approach']."',
				'".$post['client']."',
				'".$post['appointment']."',
				'".$post['tag']."',
				'".$post['budget']."',
				'".$post['proceed']."',
				'".$post['deadline']."',
				'".$now_date."'
			)")->execute();
// deadline 締め切り
		return '';
	}
	//--------------
	//案件リスト取得
	//--------------
	public static function sales_list_get($user_primary_id) {
		$sales_res = DB::query("
			SELECT *
			FROM sales
			WHERE user_primary_id = ".(int)$user_primary_id."
			ORDER BY create_time DESC
			LIMIT  0, 300")->execute();






		return $sales_res;
	}




}