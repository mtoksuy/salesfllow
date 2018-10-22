<?php 

/**
 * インフォ関連のクラス
 * 
 * 
 * 
 * 
 */

class Model_Info_Basis extends Model {
	//-----------
	//Uri情報取得
	//-----------
	public static function segment_info_get() {
		$top_judgment      = FALSE;
		$category_segment  = '';
		$category_name     = '';
		$parent_name       = '';
		$parent_segment    = '';
		$paging_segment    = 0;
		$last_segument     = '';
		$segment_error     = TRUE;
		$article_judgment  = FALSE;
		$article_url_error = FALSE;
		$title_segment     = '';

		// 現在いるファイル名を取得
		$url = $_SERVER["PHP_SELF"];
		// セグメントをarrayで並べる
		$segments_array = explode("/", $url);
		// 無駄なセグメント削除
		foreach($segments_array as $key => $value) {
			if($value == '' || $value == 'sharetube' || $value == 'index.php') {
				// 上記の値の場合削除
				unset($segments_array[$key]);
			}
		}
		// arrayを詰める
		$segments_array = array_merge($segments_array);
		// arrayの順番を逆にする
		// $segments = array_reverse($segments_array);

		// トップページ判定
		if($segments_array == array()) {
			$top_judgment = TRUE;
		}
		//---------------------
		// セグメントを走査する
		//---------------------
		foreach($segments_array as $key => $value) {
			//------------
			//記事判定取得
			//------------
			if(preg_match('/^[0-9]+$/', $value, $article_preg_array)) {
//			var_dump($article_preg_array);
//			var_dump($value);

				$query = DB::query("
					SELECT COUNT(link)
					FROM article
					WHERE link = '".$value."'
					AND del    = 0
					LIMIT 0, 1")->cached(86400)->execute();
				foreach($query as $key_1 => $value_1) {
					// 公開している記事である
					if((int)$value_1["COUNT(link)"] === 1) {
						$article_judgment  = TRUE;
						$article_url_error = TRUE;
					}
						// 公開している記事ではない
						else {
							$article_judgment  = TRUE;
							$article_url_error = FALSE;
						}
				} // foreach($query as $key_1 => $value_1) {
			} // if(preg_match('((^[0-9]{0,4})(-|_)([0-9]{0,2})(-|_)([0-9]{0,2})(-|_)(.*))', $value, $article_preg_array)) {
				//--------------
				//ページング判定
				//--------------
				else if(preg_match('/(^[0-9]+?$)/', $value, $paging_preg_array)) {
//					var_dump($paging_preg_array);
//					print "ページング";
					$paging_segment = (int)$value;
				}
					//----------------
					//記事ではない場合
					//----------------
					else {
						// セグメント情報取得
						$query_count = DB::query("
							SELECT COUNT(*)
							FROM category_segment 
							WHERE category_segment = '".$value."'")->cached(86400)->execute();
						//--------------
						//セグメント確認
						//--------------
						foreach($query_count as $key_2 => $value_2) {
							// セグメントあり
							if($value_2["COUNT(*)"]) {
								$last_segument   = $value;
							}
								// セグメントなし
								else {
									$segment_error = FALSE;
								}
						}
					} // 記事ではない場合 else {
		} // foreach($segments_array as $key => $value) {
//		var_dump($last_segument);
//		echo $last_segument;
//		echo $paging_segment;

		// セグメント情報取得
		$query = DB::query("
			SELECT * 
			FROM category_segment 
			WHERE category_segment = '".$last_segument."'")->cached(86400)->execute();
		foreach($query as $key => $value) {
//			var_dump($value);
			$category_name    = $value["category_name"];
			$category_segment = $value["category_segment"];
			$parent_name      = $value["parent_name"];
			$parent_segment   = $value["parent_segment"];
		}
//		var_dump($parent_name);
		// タイトルセグメント取得
		if($paging_segment) {
			$title_segment .= $paging_segment." | ";	
		}
		if($category_name) {
			$title_segment .= $category_name." | ";
		}
		if($parent_name) {
			$title_segment .= $parent_name." | ";
		}
//		var_dump($title_segment);


		$segment_info_get_array = array(
			'top_judgment'         => $top_judgment,      // 
			'segment'              => $category_segment,  // 
			'segment_error'        => $segment_error,     // 
			'category_name'        => $category_name,     // 
			'category_segment'     => $category_segment,  // 
			'parent_name'          => $parent_name,       // 
			'parent_segment'       => $parent_segment,    // 
			'paging_segment'       => $paging_segment,    // 
			'article_judgment'     => $article_judgment,  // 
			'article_url_error'    => $article_url_error, // 
			'title_segment'        => $title_segment,     //
		);
		return $segment_info_get_array;
	}
	//------------------------
	//ユーザーアクセス情報取得
	//------------------------
	static function user_access_data_get() {
		// エラー回避
		error_reporting(0);
		ini_set('display_errors', 1);

		$user_data_array = array();
		$httpvars = array(
		'REMOTE_ADDR'          => 'IPアドレス',
		'REMOTE_HOST'          => 'ホスト名',
		'REMOTE_PORT'          => 'ポート番号',
		'HTTP_USER_AGENT'      => 'ユーザーエージェント',
		'HTTP_REFERER'         => '参照ページアドレス',
		'HTTP_ACCEPT_LANGUAGE' => '言語',
		'HTTP_CONNECTION'      => 'コネクションヘッダ',
		);
		//REMOTE_HOSTがなければgethostbyaddrで取得
		if(!isset($_SERVER['REMOTE_HOST']) || $_SERVER['REMOTE_HOST'] == '') {
			if(preg_match('/localhost/',$_SERVER["HTTP_HOST"])) {} else { $_SERVER['REMOTE_HOST'] = gethostbyaddr($_SERVER['REMOTE_ADDR']); }
			foreach($httpvars as $key => $value) {
				$user_data_array[$key] = $_SERVER[$key];
			}
		}
		return $user_data_array;
	}
	//-----------------------------
	//Sharetubeのユーザーデータ取得
	//-----------------------------
	static function sharetube_user_data_get($sharetube_id, $cached = 900) {
		$sharetube_user_data_array  = array();
		$sharetube_user_data_res = DB::query("
			SELECT *
			FROM user 
			WHERE sharetube_id = '".$sharetube_id."'")->cached($cached)->execute();
		foreach($sharetube_user_data_res as $key => $value) {
			$sharetube_user_data_array["primary_id"]          = $value["primary_id"];
			$sharetube_user_data_array["sharetube_id"]        = $value["sharetube_id"];
			$sharetube_user_data_array["name"]                = $value["name"];
			$sharetube_user_data_array["email"]               = $value["email"];
			$sharetube_user_data_array["url"]                 = $value["url"];
			$sharetube_user_data_array["management_site_url"] = $value["management_site_url"];
			$sharetube_user_data_array["profile_contents"]    = $value["profile_contents"];
			$sharetube_user_data_array["profile_icon"]        = $value["profile_icon"];
			$sharetube_user_data_array["profile_html"]        = $value["profile_html"];
			$sharetube_user_data_array["twitter_id"]          = $value["twitter_id"];
			$sharetube_user_data_array["facebook_id"]         = $value["facebook_id"];
			$sharetube_user_data_array["pay_pv"]              = (int)$value["pay_pv"];
			$sharetube_user_data_array["all_page_view"]       = (int)$value["all_page_view"];
			$sharetube_user_data_array["bank_name"]           = $value["bank_name"];
			$sharetube_user_data_array["account_holder"]      = $value["account_holder"];
			$sharetube_user_data_array["account_type"]        = $value["account_type"];
			$sharetube_user_data_array["branch_code"]         = $value["branch_code"];
			$sharetube_user_data_array["account_number"]      = $value["account_number"];
			$sharetube_user_data_array["mail_delivery_ok"]    = $value["mail_delivery_ok"];
		}
		return $sharetube_user_data_array;
	}
	//------------------------------------------
	//モバイルからのアクセスなのかどうかを調べる
	//------------------------------------------
	static function mobil_is_access_check() {
		$user_agent = $_SERVER["HTTP_USER_AGENT"];
		$user_is_mobil = ((strpos($user_agent, 'iPhone') !== false) || (strpos($user_agent, 'iPod') !== false) || (strpos($user_agent, 'iPad') !== false) || (strpos($user_agent, 'Windows Phone') !== false) || (strpos($user_agent, 'BlackBerry') !== false) || (strpos($user_agent, 'Symbian') !== false));
		if($user_is_mobil == true) {

		}
// 参考にするサイト http://www.openspc2.org/userAgent/
		return $user_is_mobil;
	}
	//-----------------------------------------------------
	//モバイル判別するPHPクラスライブラリを利用した機種判別
	//-----------------------------------------------------
	static function mobile_detect_create() {
		// モバイル判別するPHPクラスライブラリ
		require_once PATH.'assets/library/Mobile-Detect-2.8.5/'.'Mobile_Detect.php';
		$detect = new Mobile_Detect;
/*
		var_dump($detect);
		var_dump($detect->isMobile());
		var_dump($detect->isTablet());
		var_dump($detect->isiOS());
		var_dump($detect->isAndroidOS());
		var_dump($detect->is('Chrome'));
		var_dump($detect->is('iOS'));
		var_dump($detect->is('UC Browser'));
if($detect->isMobile() || $detect->isTablet()) {
    // モバイル・タブレット
}
	else {
	    // PC
	}
*/
		return $detect;
	}
	//--------------------
	//現在の時間表記を取得
	//--------------------
	public static function now_date_get($denoted = 'Y-m-d H:i:s') {
		$now_time          = time();
		$now_date          = date($denoted, $now_time);
		return $now_date;
	}
	//--------------------------------------
	//現在の時間表記をマイクロ秒も含めて取得
	//--------------------------------------
	public static function now_micro_date_get() {
		$arrTime = explode('.',microtime(true));
		return date('Y-m-d H:i:s', $arrTime[0]) . '.' .$arrTime[1];
	}
	//----------------
	//処理時間計測関数
	//----------------
	/*
	microtime()の結果aとbの差を計算する
	a-bに相当する秒数を単一のfloat値で返す
	
	[使い方]
	// 開始時刻
	$start = microtime();
	// 2秒ほど実行遅延
	sleep(2);
	// 終了時刻
	$end = microtime();
	// 差を出力
	echo diffmicrotime($end, $start);
	*/
	public static function diffmicrotime($start, $end) {
		list($am, $at) = explode(' ', $start);
		list($bm, $bt) = explode(' ', $end);
		return ((float)$am-(float)$bm) + ((float)$at-(float)$bt);
	}
	//------------------------------------------------------------
	//日付をタイムスタンプに変換してもう一度日付の種類を変えて取得
	//------------------------------------------------------------
	public static function date_conversion_date_get($time, $denoted = 'Y年m月d日 H:i:s') {
		$date = date($denoted, strtotime($time));
		return $date;
	}





}
