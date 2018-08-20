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
		// 登録
		$res = DB::query("
			INSERT INTO sales (
				user_primary_id,
				title,
				text,
				status, 
				approach, 
				client, 
				appointment, 
				note, 
				budget, 
				earnings, 
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
				'".$post['note']."',
				'".$post['budget']."',
				'".$post['earnings']."',
				'".$post['deadline']."',
				'".$now_date."'
			)")->execute();
// deadline 締め切り
		foreach($res as $key => $value) {
			if($key == 0) {
				$sales_primary_id = (int)$value;
			}
		}
		// 数字を圧縮する
		$shot_url_encode = Library_Shorturl_Basis::shot_url_encode($sales_primary_id);
		// url_idを追加するために更新
		DB::query("
			UPDATE sales 
			SET url_id = '".$shot_url_encode."'
			WHERE

			primary_id = ".$sales_primary_id."")->execute();


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
			LIMIT  0, 100")->execute();
		return $sales_res;
	}
	//-----------------
	//セールスresを取得
	//-----------------
	public static function sales_res_get($sales_primary_id) {
		$sales_res = DB::query("
			SELECT *
			FROM sales
			WHERE primary_id = ".$sales_primary_id."")->execute();
		return $sales_res;
	}
}