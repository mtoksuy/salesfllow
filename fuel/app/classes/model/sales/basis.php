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
//		pre_var_dump($post['note']);
		// 文頭
		$pattern = '/^\//';
		preg_match($pattern, $post['note'], $test_array);
		if($test_array != true) {
			$post['note'] = '/'.$post['note'];
		}
		// 文末
		$pattern = '/\/$/';
		preg_match($pattern, $post['note'], $test_array);
		if($test_array != true) {
			$post['note'] = $post['note'].'/';
		}
		//pre_var_dump($post['note']);
		// 分解
		$pattern = '/\/(.+?)\//';
		$pattern = '/\/(案件|初めての)\//';
		$pattern = '/\/(.+?)\/|(.+?)\//';
		preg_match_all($pattern, $post['note'], $note_preg_match_all_array);

		// 整列
		foreach($note_preg_match_all_array[0] as $key => $value) {
			$pattern = '/\//';
			$note_array[$key] = preg_replace($pattern, '', $value);
		}
		//pre_var_dump($note_array);
		
		// ノートの順番に制御
		$note_num        = 1;
		$node_primary_id = 0;
		$node_path       = '';
		foreach($note_array as $note_array_key => $note_array_value) {
//var_dump($note_array_value);
			// 1番目のノート
			if($note_num == 1) {
				// ノートがあるかどうかを検索
				$note_1_res = DB::query("
					SELECT * 
					FROM note_node
					WHERE user_primary_id = ".(int)$_COOKIE['user_data']['user_primary_id']." 
					AND name 
					LIKE '".$note_array_value."' 
					AND path")->execute();
				$note_1_res_check = false;
				foreach($note_1_res as $note_1_res_key => $note_1_res_value) {
					$path_count = mb_substr_count($note_1_res_value['path'], '.');
					if($path_count == 2) {
						$note_1_res_check = true;
						$node_path       = '.'.$note_1_res_value['primary_id'].'.';
 						$node_primary_id = (int)$note_1_res_value['primary_id'];
					}
				}
				// なかった場合
				if(!$note_1_res_check) {
					$note_2_res = DB::query("
						INSERT INTO note_node (
							user_primary_id,
							name
						)
						VALUES (
							".(int)$_COOKIE['user_data']['user_primary_id'].",
							'".$note_array_value."'
						)")->execute();
					foreach($note_2_res as $note_2_res_key => $note_2_res_value) {
						if($note_2_res_key == 0) {
							$node_path = '.'.$note_2_res_value.'.';
							$note_3_res = DB::query("
								UPDATE note_node 
									SET path         = '".$node_path."'
									WHERE primary_id = ".$note_2_res_value."")->execute();
							$node_primary_id = (int)$note_2_res_value;
						}
					}
				} // if(!$note_1_res_check) {
			} // if($note_num == 1) {
				/////////////////////////////
				// ノートがネストしている場合
				/////////////////////////////
				else if($note_num > 1) {
					// ノートがあるかどうかを検索
					$note_next_res = DB::query("
						SELECT * 
						FROM note_node
						WHERE user_primary_id = ".(int)$_COOKIE['user_data']['user_primary_id']." 
						AND name  LIKE '".$note_array_value."'")->execute();
					$note_next_res_check = false;
					foreach($note_next_res as $note_next_res_key => $note_next_res_value) {
/*
						pre_var_dump($note_next_res_value['path']);
						pre_var_dump($node_path);
						pre_var_dump($node_primary_id);
*/
						$pattern = "/^".$node_path."/";
						if(preg_match($pattern, $note_next_res_value['path'], $nest_true_array)) {
							if(mb_substr_count($note_next_res_value['path'], '.') == $note_num+1) {
								$note_next_res_check = true;
								$node_primary_id     = (int)$note_next_res_value['primary_id'];						
							}
						}
/*
						$nest_path_count = mb_substr_count($note_1_res_value['path'], '.');
//						pre_var_dump($nest_path_count);

						if( ($nest_path_count - $note_num) === 1) {
							$note_next_res_check = true;
							$node_primary_id = (int)$note_next_res_value['primary_id'];						
						}
*/
					}
					// なかった場合
					if(!$note_next_res_check) {
						$note_4_res = DB::query("
							INSERT INTO note_node (
								user_primary_id,
								name
							)
							VALUES (
								".(int)$_COOKIE['user_data']['user_primary_id'].",
								'".$note_array_value."'
							)")->execute();
						foreach($note_4_res as $note_4_res_key => $note_4_res_value) {
							if($note_4_res_key == 0) {
								$node_path = $node_path.$note_4_res_value.'.';
								$note_5_res = DB::query("
									UPDATE note_node 
										SET path         = '".$node_path."',
 										parent           = '".$node_primary_id."'
										WHERE primary_id = ".$note_4_res_value."")->execute();
								$node_primary_id = (int)$note_4_res_value;
							}
						}
					} // if(!$note_next_res_check)
				} // else if($note_num > 1) {
			$note_num++;
		//	$note_wording = $note_wording.$value.'.';
		} // foreach($note_array as $note_array_key => $note_array_value) {






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
				'".$node_primary_id."',
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
	//------------------------
	//ネスト型の案件リストテストコード置き場
	//------------------------
	public static function sales_nest_type_list_get_test_code($user_primary_id) {
		// 第1回クエリ 深さを知る
				$max_depth_res = DB::query("
		SELECT
			MAX(LENGTH(path) - LENGTH(REPLACE(path,'.','')) -1) AS max_depth
		FROM
		  sales INNER JOIN note_node
		ON
		  sales.note = note_node.primary_id
		WHERE
			sales.user_primary_id = 1")->execute();
			foreach($max_depth_res as $key => $value) {
				$max_depth = (int)$value['max_depth'];
			}
		
		
		
		// 第2回クエリ
				$res = DB::query("
		SELECT
		  sales.primary_id,
		  sales.note,
			note_node.primary_id,
			note_node.user_primary_id,
			note_node.name,
			note_node.path,
			LENGTH(path) - LENGTH(REPLACE(path,'.','')) -2 AS depth
		FROM
		  sales INNER JOIN note_node
		ON
		  sales.note = note_node.primary_id
		WHERE
		sales.user_primary_id = 1
		ORDER BY depth ASC")->execute();
		
		
		
		// 正解
		"
		SELECT
		note_node.primary_id,CONCAT(REPEAT('\t',LENGTH(path) - LENGTH(REPLACE(path,'.',''))-2),name) as name,path
		FROM 
		  sales INNER JOIN note_node
		ON
		  sales.note = note_node.primary_id
		WHERE
		sales.user_primary_id = 1
		ORDER BY path";
		
		
		
		/*
		echo'
		<ul>
			<li>初めての
				<ul>
					<li>案件
						<ul>
							<li>成立</li>
						</ul>
					</li>
				</ul>
			</li>
			<li>応募</li>
		<ul>';
		*/
		
		// 個人的sql
		
	}
	//------------------------
	//ネスト型の案件リスト取得
	//------------------------
	public static function sales_nest_type_list_get($user_primary_id) {
		// 1
		$sales_note_res = DB::query("SELECT distinct note
		FROM sales
		WHERE user_primary_id = 1
		AND del = 0
		")->execute();
		
		foreach($sales_note_res as $sales_note_res_key => $sales_note_res_value) {
			pre_var_dump($sales_note_res_value['note']);
		}
		
		// 2
		$node_1_res = DB::query("SELECT *
		FROM note_node
		WHERE primary_id IN(4,8,13,12)
		ORDER BY name  ASC")->execute();
		$note_node_list_array     = array();
		$note_node_list_array_num = 0;
		$note_node_list_word      = '';
		foreach($node_1_res as $node_1_res_key => $node_1_res_value) {
		//	pre_var_dump($node_1_res_value['path']);
			$pattern = '/[0-9]+/';
			preg_match_all($pattern, $node_1_res_value['path'], $node_1_res_value_array);
			foreach($node_1_res_value_array[0] as $node_1_res_value_array_key => $node_1_res_value_array_value) {
				$note_node_list_array[$note_node_list_array_num] = (int)$node_1_res_value_array_value;
				$note_node_list_array_num++;
			}
		}
		$note_node_list_array_unique = array_unique($note_node_list_array);
		$note_node_list_array        = array_values($note_node_list_array_unique);
		
		foreach($note_node_list_array as $note_node_list_array_kye => $note_node_list_array_value) {
		//	pre_var_dump($note_node_list_array_value);
			$note_node_list_word = $note_node_list_word.$note_node_list_array_value.',';
		}
		$note_node_list_word = rtrim($note_node_list_word, ',');
		//var_dump($note_node_list_word);
		
		// 正解だが、保留
		$note_node_list_word_res = DB::query("
		SELECT
		primary_id,CONCAT(REPEAT('\t',LENGTH(path) - LENGTH(REPLACE(path,'.',''))-2),name) as name,path
		FROM note_node 
		WHERE primary_id IN(".$note_node_list_word.")
		ORDER BY path
		")->execute();






	}

















}