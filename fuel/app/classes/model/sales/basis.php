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
		// ノートの順番に制御
		$note_num        = 1;
		$node_primary_id = 0;
		$node_path       = '';
		foreach($note_array as $note_array_key => $note_array_value) {
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
				else if($note_num == 2) {
					// ノートがあるかどうかを検索
					$note_next_res = DB::query("
						SELECT * 
						FROM note_node
						WHERE user_primary_id = ".(int)$_COOKIE['user_data']['user_primary_id']." 
						AND name LIKE '".$note_array_value."'")->execute();
					$note_next_res_check = false;
					foreach($note_next_res as $note_next_res_key => $note_next_res_value) {
						$pattern = "/^".$node_path."/";
						if(preg_match($pattern, $note_next_res_value['path'], $nest_true_array)) {
							if(mb_substr_count($note_next_res_value['path'], '.') == $note_num+1) {
								$note_next_res_check = true;
								$node_primary_id     = (int)$note_next_res_value['primary_id'];
								$node_path           = $note_next_res_value['path'];
							}
						}
					}  // foreach($note_next_res as $note_next_res_key => $note_next_res_value) {
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
				//
				//
				//
				else if($note_num == 3) {
					// ノートがあるかどうかを検索
					$note_next_res = DB::query("
						SELECT * 
						FROM note_node
						WHERE user_primary_id = ".(int)$_COOKIE['user_data']['user_primary_id']." 
						AND name LIKE '".$note_array_value."'")->execute();
					$note_next_res_check = false;
					foreach($note_next_res as $note_next_res_key => $note_next_res_value) {
						$pattern = "/^".$node_path."/";
						if(preg_match($pattern, $note_next_res_value['path'], $nest_true_array)) {
							if(mb_substr_count($note_next_res_value['path'], '.') == $note_num+1) {
								$note_next_res_check = true;
								$node_primary_id     = (int)$note_next_res_value['primary_id'];
							}
						}
					}  // foreach($note_next_res as $note_next_res_key => $note_next_res_value) {
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
				importance, 
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
				'".$post['importance']."',
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
	//------------
	//案件追加作成
	//------------
	public static function sales_add_create($post) {
		// 現在の時間表記を取得
		$now_date = Model_Info_Basis::now_date_get();
//		var_dump($now_date);
pre_var_dump($post);
$post['sales_primary_id'];

/*
		// 登録
		$res = DB::query("
			INSERT INTO sales_fllow (
				user_primary_id,
				title,
				text,
				status, 
				approach, 
				client, 
				appointment, 
				importance, 
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
				'".$post['importance']."',
				'".$node_primary_id."',
				'".$post['budget']."',
				'".$post['earnings']."',
				'".$post['deadline']."',
				'".$now_date."'
			)")->execute();

*/



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
	//--------------------
	//案件ノートリスト取得
	//--------------------
	public static function sales_note_list_get($user_primary_id, $note_node_primary_id) {
		$sales_note_res = DB::query("
			SELECT *
			FROM sales
			WHERE user_primary_id = ".(int)$user_primary_id."
			AND note              = ".$note_node_primary_id."
			ORDER BY create_time DESC
			LIMIT  0, 100")->execute();
		return $sales_note_res;
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
	public static function sales_nest_type_1_list_get($user_primary_id) {
		//
		// note_node_primary_idリスト取得
		//
		$note_node_primary_id_list_word = '';
		$sales_note_res = DB::query("SELECT distinct note
		FROM sales
		WHERE user_primary_id = ".$user_primary_id."
		AND del = 0
		")->execute();
		foreach($sales_note_res as $sales_note_res_key => $sales_note_res_value) {
			$note_node_primary_id_list_word = $note_node_primary_id_list_word.$sales_note_res_value['note'].',';
		}
		$note_node_primary_id_list_word = rtrim($note_node_primary_id_list_word, ',');
		//
		// 大親取得
		//
		$node_1_res = DB::query("SELECT *
		FROM note_node
		WHERE primary_id IN(".$note_node_primary_id_list_word.")
		ORDER BY name  ASC")->execute();
		$user_note_node_master_array   = array();
		$user_note_node_array          = array();
		$note_node_list_array          = array();
		$note_node_list_parent_array   = array();
		$note_node_list_test_array     = array();
		$note_node_list_array_num      = 0;
		$note_node_list_test_array_num = 0;
		$note_node_list_word           = '';
		$note_node_parent_list_word    = '';

/*
もう一度
仕組みの流れ

セールスからnote_idを取得し、
そのnote_nodeを取得

取得したnote_node_idのpathを全て取得し
note_node_idのarrayとwordを作成する

wordで全てのnote_node_idの情報をarray化する

階層ずつでソートして行きながら、先に取得したarrayの情報を入れ込んでソートしているarrayを作成

*/
//$note_node_list_test_array[0] = 1
//var_dump($note_node_list_test_array);
		//
		// 
		//
		foreach($node_1_res as $node_1_res_key => $node_1_res_value) {
//			pre_var_dump($node_1_res_value);
//			pre_var_dump($node_1_res_value['path']);
			//
			//$note_node_list_array作成
			//
			$node_1_res_value_path  = $node_1_res_value['path'];
			$node_1_res_value_count = mb_substr_count($node_1_res_value['path'], '.');
			// 存在するnote_node_idを取得(array)
			$pattern = '/[0-9]+/';
			preg_match_all($pattern, $node_1_res_value['path'], $node_1_res_value_array);
			foreach($node_1_res_value_array[0] as $node_1_res_value_array_key => $node_1_res_value_array_value) {
				$note_node_list_array[$note_node_list_array_num] = (int)$node_1_res_value_array_value;
				$note_node_list_array_num++;
			}
			// 
			// 大親取得
			//
			$pattern = '/[0-9]+/';
			preg_match($pattern, $node_1_res_value['path'], $node_1_res_value_array);
			$note_node_list_parent_array[$node_1_res_key] = $node_1_res_value_array[0];
// for
/*
			// 階層分掘る
			for($node_1_res_value_count; $node_1_res_value_count > 1; $node_1_res_value_count--) {
				$pattern_1 = '/^\.[0-9]+\./';
				$pattern_2 = '/^\.[0-9]+/';
				preg_match($pattern_1, $node_1_res_value_path, $node_1_res_value_path_array);
				$node_1_res_value_path = preg_replace($pattern_2, '', $node_1_res_value_path);

ここで階層別のarryを作成する
				pre_var_dump($node_1_res_value_path_array[0]);
				pre_var_dump($node_1_res_value_path);
				pre_var_dump('-----------');
				$note_node_list_test_array[$note_node_list_test_array_num];
			} // for
*/
		} // foreach($node_1_res as $node_1_res_key => $node_1_res_value) {
		// 全体のarray
		$note_node_list_array_unique = array_unique($note_node_list_array);
		$note_node_list_array        = array_values($note_node_list_array_unique);
		// 重要
//		pre_var_dump($note_node_list_array);
		// 大親のarray
		$note_node_list_parent_array_unique = array_unique($note_node_list_parent_array);
		$note_node_list_parent_array        = array_values($note_node_list_parent_array_unique);
//		pre_var_dump($note_node_list_parent_array);
		//
		//$note_node_list_word作成 
		//
		foreach($note_node_list_array as $note_node_list_array_kye => $note_node_list_array_value) {
//			pre_var_dump($note_node_list_array_value);
			$note_node_list_word = $note_node_list_word.$note_node_list_array_value.',';
		}
		$note_node_list_word = rtrim($note_node_list_word, ',');
//		pre_var_dump($note_node_list_word);
		//
		//$user_note_node_array作成
		//
		$note_node_list_word_res = DB::query("
		SELECT
		primary_id,CONCAT(REPEAT('\t',LENGTH(path) - LENGTH(REPLACE(path,'.',''))-2),name) as name,path
		FROM note_node 
		WHERE primary_id IN(".$note_node_list_word.")
		ORDER BY path
		")->execute();
		foreach($note_node_list_word_res as $note_node_list_word_res_key => $note_node_list_word_res_value) {
			$user_note_node_array[$note_node_list_word_res_key]['primary_id'] = (int)$note_node_list_word_res_value['primary_id'];
			$user_note_node_array[$note_node_list_word_res_key]['name']       = $note_node_list_word_res_value['name'];
			$user_note_node_array[$note_node_list_word_res_key]['path']       = $note_node_list_word_res_value['path'];
		}
		//////////////////////////////////
		//$user_note_node_master_array作成
		//////////////////////////////////
		$$note_node_list_parent_array_num = 0;
		foreach($note_node_list_parent_array as $note_node_list_parent_array_key => $note_node_list_parent_array_value) {
//			pre_var_dump($note_node_list_parent_array_value);
			$array_search_key              = array_search((int)$note_node_list_parent_array_value, array_column($user_note_node_array, 'primary_id'));
			// 第1層
// 下記でmaster使用 			$user_note_node_master_array[] = $user_note_node_array[$array_search_key];
			// 第2層〜
			$pattern = '/^\.'.(int)$note_node_list_parent_array_value.'\.[0-9]+\./';
//.1.2."
			foreach($user_note_node_array as $user_note_node_array_key => $user_note_node_array_value) {
//				pre_var_dump($user_note_node_array_value['path']);
				preg_match($pattern, $user_note_node_array_value['path'], $user_note_node_array_value_path_array);
//				pre_var_dump($user_note_node_array_value_path_array[0]);
			}
			foreach($user_note_node_array as $user_note_node_array_key => $user_note_node_array_value) {
//				pre_var_dump($user_note_node_array_value);
			}
//var_dump('---------');

//			preg_match($pattern, );



			///////////////////////////////////
//			pre_var_dump($note_node_list_parent_array_value);
			$note_node_parent_list_word = $note_node_parent_list_word.$note_node_list_parent_array_value.',';
		}
		//
		//
		//
		foreach($user_note_node_array as $user_note_node_array_key => $user_note_node_array_value) {
//			pre_var_dump($user_note_node_array_key);
//			pre_var_dump($user_note_node_array_value);
			// 第1層
			$pattern = '/^\.[0-9]+\.$/';
			preg_match($pattern, $user_note_node_array_value['path'], $user_note_node_array_value_path_array_1);
//			pre_var_dump($user_note_node_array_value_path_array_1[0]);
			if($user_note_node_array_value_path_array_1[0]) {
//				pre_var_dump($user_note_node_array_value_1);
				$user_note_node_master_array[] = $user_note_node_array_value;
			}
			// 第2層〜
			$pattern = '/^\.[0-9]+\.[0-9]+\./';
			preg_match($pattern, $user_note_node_array_value['path'], $user_note_node_array_value_path_array_2);
//			pre_var_dump($user_note_node_array_value['path']);
//			pre_var_dump($user_note_node_array_value_path_array_2[0]);
//			pre_var_dump($user_note_node_array_key);
//var_dump('------');










		}
//pre_var_dump($user_note_node_master_array);


/*
$user_note_node_master_array[0]['子供'] = 2;
$user_note_node_master_array[0][] = array(
'primary_id' => 4214,
'name' => '名前',
'path' => '.',);
$user_note_node_master_array[0][] = array(
'primary_id' => 4214,
'name' => '名前',
'path' => '.',);
pre_var_dump($user_note_node_master_array[0]);
*/






//pre_var_dump($user_note_node_array);

$result = preg_grep('/\./', $user_note_node_array);
//pre_var_dump($result);






		//
		//ソート
		//
		foreach($user_note_node_master_array as $key => $value) {
			$sort[$key] = $value['name'];
		}
		array_multisort($sort, SORT_ASC, $user_note_node_master_array);
		//pre_var_dump($user_note_node_master_array);
		













/*
		$note_node_parent_list_word = rtrim($note_node_parent_list_word, ',');
		// 大親をソートで取得
		$note_node_parent_sord_res = DB::query("
			SELECT *
			FROM note_node
			WHERE primary_id IN(".$note_node_parent_list_word.")
			ORDER BY name  ASC
		")->execute();
*/








	}
	//------------------------
	//ネスト型の案件リスト取得
	//------------------------
	public static function sales_nest_type_2_list_get($user_primary_id) {
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
	//------------------------
	//ネスト型の案件リスト取得
	//------------------------
	public static function sales_nest_type_3_list_get($user_primary_id) {
		/////////////////////////////////
		// note_node_primary_idリスト取得
		/////////////////////////////////
		$note_node_primary_id_list_word = '';
		$sales_note_res = DB::query("SELECT distinct note
		FROM sales
		WHERE user_primary_id = ".$user_primary_id."
		AND del = 0
		")->execute();
		foreach($sales_note_res as $sales_note_res_key => $sales_note_res_value) {
			$note_node_primary_id_list_word = $note_node_primary_id_list_word.$sales_note_res_value['note'].',';
		}
		$note_node_primary_id_list_word = rtrim($note_node_primary_id_list_word, ',');
		if($note_node_primary_id_list_word) {
			// 親ノードから見て子ノード一覧取得
			$note_node_child_check_res = DB::query("
				SELECT
				parent.primary_id AS parent, parent.name parent_name,
				child.primary_id AS child, child.name AS child_name
				FROM note_node AS parent LEFT JOIN note_node AS child
				ON parent.path = (SELECT MAX(path) 
				FROM note_node 
				WHERE note_node.user_primary_id = ".$user_primary_id."
				AND child.path LIKE CONCAT(path,'_%'))")->execute();

			$node_1_res = DB::query("SELECT *
			FROM note_node
			WHERE primary_id IN(".$note_node_primary_id_list_word.")
			ORDER BY name  ASC")->execute();
			$note_node_list_array_num = 0;
			foreach($node_1_res as $node_1_res_key => $node_1_res_value) {
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
				$note_node_list_word = $note_node_list_word.$note_node_list_array_value.',';
			}
			$note_node_list_word = rtrim($note_node_list_word, ',');
			//
			//
			//
			$note_node_big_parent_res = DB::query("SELECT *
			FROM note_node
			WHERE primary_id IN(".$note_node_list_word.")
			ORDER BY name  ASC")->execute();
			foreach($note_node_big_parent_res as $note_node_big_parent_res_key => $note_node_big_parent_res_value) {
				$user_note_node_array[$note_node_big_parent_res_key]['primary_id']      = (int)$note_node_big_parent_res_value['primary_id'];
				$user_note_node_array[$note_node_big_parent_res_key]['user_primary_id'] = (int)$note_node_big_parent_res_value['user_primary_id'];
				$user_note_node_array[$note_node_big_parent_res_key]['name']            = $note_node_big_parent_res_value['name'];
				$user_note_node_array[$note_node_big_parent_res_key]['path']            = $note_node_big_parent_res_value['path'];
				$pattern = '/\./';
				preg_match_all($pattern, $note_node_big_parent_res_value['path'], $note_node_big_parent_res_value_array);
				$level_count = (count($note_node_big_parent_res_value_array[0])) - 1;
				$user_note_node_array[$note_node_big_parent_res_key]['level'] = $level_count;
				if($level_count >= 2) {
					$pattern = '/([0-9]+)\.([0-9]+)\.$/';
					preg_match($pattern, $note_node_big_parent_res_value['path'], $parent_check_array);
					$user_note_node_array[$note_node_big_parent_res_key]['parent'] = (int)$parent_check_array[1];
				}
					else {
						$user_note_node_array[$note_node_big_parent_res_key]['parent'] = null;
					}
				foreach($note_node_child_check_res as $note_node_child_check_res_key => $note_node_child_check_res_value) {
					if((int)$note_node_big_parent_res_value['primary_id'] === (int)$note_node_child_check_res_value['parent'] && $note_node_child_check_res_value['child'] != NULL) {
						$user_note_node_array[$note_node_big_parent_res_key]['child'][] = (int)$note_node_child_check_res_value['child'];
					}
						else {

						}
				} // foreach($note_node_child_check_res as $note_node_child_check_res_key => $note_node_child_check_res_value) {
			} // foreach($note_node_big_parent_res as $note_node_big_parent_res_key => $note_node_big_parent_res_value) {
		} // if($note_node_primary_id_list_word) {
			else {
				return false;
			}



//pre_var_dump($user_note_node_array);
$arr =
	[
	  ['primary_id' => 1, 'name' => 'ノート_1', 'path' => '.1.', 'level' => 1, 'parent' => null, 'child' => [2,3]],
	  ['primary_id' => 2, 'name' => 'ノート_1_1', 'path' => '.1.2.', 'level' => 2, 'parent' => null, 'child' => []],
	  ['primary_id' => 3, 'name' => 'ノート_1_2', 'path' => '.1.3.', 'level' => 2, 'parent' => null, 'child' => []],
	  ['primary_id' => 4, 'name' => 'ノート_2', 'path' => '.4.', 'level' => 1, 'parent' => null, 'child' => []],
	  ['primary_id' => 5, 'name' => 'ノート_3', 'path' => '.5.', 'level' => 1, 'parent' => null, 'child' => []],
	  ['primary_id' => 6, 'name' => 'ノート_4', 'path' => '.5.', 'level' => 1, 'parent' => null, 'child' => []],
	  ['primary_id' => 7, 'name' => 'ノート_55', 'path' => '.5.', 'level' => 1, 'parent' => null, 'child' => [8,9,10]],
	  ['primary_id' => 8, 'name' => 'ノート_5', 'path' => '.5.', 'level' => 1, 'parent' => null, 'child' => []],
	  ['primary_id' => 9, 'name' => 'ノート_5', 'path' => '.5.', 'level' => 1, 'parent' => null, 'child' => []],
	  ['primary_id' => 10, 'name' => 'ノート_5です', 'path' => '.5.', 'level' => 1, 'parent' => null, 'child' => [11]],
	  ['primary_id' => 11, 'name' => 'ノート_5お', 'path' => '.5.', 'level' => 1, 'parent' => null, 'child' => []],
	];
$arr =
	[
	  ['primary_id' => 1, 'name' => 'ノート_1', 'path' => '.1.', 'level' => 1, 'parent' => null, 'child' => [2]],
	  ['primary_id' => 2, 'name' => 'ノート_1_1', 'path' => '.1.2.', 'level' => 2, 'parent' => null, 'child' => [3]],
	  ['primary_id' => 3, 'name' => 'ノート_1_1_1', 'path' => '.1.2.3.', 'level' => 3, 'parent' => null, 'child' => []],
	];

//pre_var_dump($arr);

//////////
//差し替え
//////////
$arr = $user_note_node_array;
//pre_var_dump($arr);
////////////
//検索の仕方
////////////
$array_search_key = array_search(3, array_column($arr, 'primary_id'));
		///////////////////////////////////
		//ソート ここで名前別のソートを行う
		///////////////////////////////////
		foreach($arr as $key => $value) {
			$sort[$key] = $value['name'];
		}
		array_multisort($sort, SORT_ASC, $arr);
//		pre_var_dump($sort);
	/////////////////////////////////////
	//$level_array_〜作成   階層別のarray
	/////////////////////////////////////
	$max_level   = 3;
	$start_level = 1;
	for($max_level; $max_level > 0; $max_level--) {
		foreach($arr as $key => $value) {
			if($start_level == $value['level']) {
//				pre_var_dump($value);
				${'level_array_'.$start_level}[] = $value;
			}
		}
		$start_level++;
	}
//pre_var_dump($level_array_1);
	////////////////////////////
	//
	////////////////////////////


//pre_var_dump($level_array_1);
	/////////////////////
	//$note_node_html作成
	/////////////////////
	foreach($level_array_1 as $level_array_key => $level_array_value) {
		// 1世代のHTML記述
		// 最初の処理 ulを始まり
    if ($level_array_value === reset($level_array_1)) {
			$note_node_html = '<ul level-data="1">';
    }
		// 1世代のli始まり
		$note_node_html = $note_node_html.'<li primary_id-data="'.$level_array_value['primary_id'].'" path-data="'.$level_array_value['path'].'"><a href=""><img class="allow" src="http://localhost/salesfllow/assets/img/common/function_alow_side_1.png">'.$level_array_value['name'].'</a>';

//pre_var_dump($level_array_value['child']);
		// もし子供がいた場合(2世代検索) ///////////////////////////////
		foreach($level_array_value['child'] as $level_2_child_key => $level_2_child_value) {
//pre_var_dump($level_2_child_value);


			// 最初の処理 ulを始まり
	    if ($level_2_child_value === reset($level_array_value['child'])) {
				$note_node_html = $note_node_html.'<ul class="hidden" level-data="2">';
	    }
			// array検索
			$array_search_key_2 = array_search((int)$level_2_child_value, array_column($arr, 'primary_id'));

//			pre_var_dump($arr[$array_search_key_2]['child']);
			// 2世代のli始まりに 使う allow
			if($arr[$array_search_key_2]['child']) {
				$allow_class_html = '<img class="allow allow_level_2" src="http://localhost/salesfllow/assets/img/common/function_alow_side_1.png">';
			}
				else {
					$allow_class_html = '';
				}
			// 2世代のli始まり
			$note_node_html = $note_node_html.'
<li primary_id-data="'.$arr[$array_search_key_2]['primary_id'].'" path-data="'.$arr[$array_search_key_2]['path'].'"><a class="level_2" href="">'.$allow_class_html.$arr[$array_search_key_2]['name'].'</a>';


				// もし子供がいた場合(3世代検索) ////////////////////////
				foreach($arr[$array_search_key_2]['child'] as $level_3_child_key => $level_3_child_value) {
					// 最初の処理 ulを始まり
			    if ($level_3_child_value === reset($arr[$array_search_key_2]['child'])) {
						$note_node_html = $note_node_html.'<ul class="hidden" level-data="3">';
			    }
					// array検索
					$array_search_key_3 = array_search((int)$level_3_child_value, array_column($arr, 'primary_id'));
					// 3世代のli始まり
					$note_node_html = $note_node_html.'
		<li primary_id-data="'.$arr[$array_search_key_3]['primary_id'].'" path-data="'.$arr[$array_search_key_3]['path'].'"><a class="level_3" href="">'.$arr[$array_search_key_3]['name'].'</a>';
					// 3世代のli閉じる
					$note_node_html = $note_node_html.'</li>';
					// 最後の処理 ulを閉じる
			    if ($level_3_child_value === end($arr[$array_search_key_2]['child'])) {
						$note_node_html = $note_node_html.'</ul>';
			    }
				} ///////////33333333333333333333////////////////////////
			// 2世代のli閉じる
			$note_node_html = $note_node_html.'</li>';
			// 最後の処理 ulを閉じる
	    if ($level_2_child_value === end($level_array_value['child'])) {
				$note_node_html = $note_node_html.'</ul>';
	    }
		} //////////22222222222222////////////////////////////////
		// 1世代のli閉じる
		$note_node_html = $note_node_html.'</li>
';
		// 1世代のHTML記述
		// 最後の処理 ulを閉じる
    if ($level_array_value === end($level_array_1)) {
			$note_node_html = $note_node_html.'</ul>';
    }
	} // foreach($level_array_1 as $level_array_key => $level_array_value) {
//	var_dump($note_node_html);
	$function_html = $note_node_html;
	return $function_html;
	}
	//----------------------------------
	//シンプル型の案件フォルダリスト取得
	//----------------------------------
	public static function sales_type_simple_folder_list_res_get($user_primary_id) {
		/////////////////////////////////
		// note_node_primary_idリスト取得
		/////////////////////////////////
		$note_node_primary_id_list_word = '';
		$sales_note_res = DB::query("SELECT distinct note
		FROM sales
		WHERE user_primary_id = ".$user_primary_id."
		AND del = 0
		")->execute();
		foreach($sales_note_res as $sales_note_res_key => $sales_note_res_value) {
			$note_node_primary_id_list_word = $note_node_primary_id_list_word.$sales_note_res_value['note'].',';
		}
		$note_node_primary_id_list_word = rtrim($note_node_primary_id_list_word, ',');
		if($note_node_primary_id_list_word) {
			$note_node_res = DB::query("SELECT *
			FROM note_node
			WHERE primary_id IN(".$note_node_primary_id_list_word.")
			ORDER BY name  ASC")->execute();
		}
		return $note_node_res;
	}
	//----------------------------------
	//セールスのノートプライマリーid取得
	//----------------------------------
	public static function sales_note_primary_id_get($sales_primary_id) {
		$res = DB::query("
			SELECT note
			FROM sales
			WHERE primary_id = ".$sales_primary_id."
		")->execute();
		foreach($res as $key => $value) {
			$note_primary_id = $value['note'];
		}
		return $note_primary_id;
	}

	//----------------------------
	//ノートとゴミ箱のリストを取得
	//----------------------------
	public static function note_trash_list_get($user_primary_id) {
		$res = DB::query("
			SELECT *
			FROM sales
			WHERE user_primary_id = ".$user_primary_id."
		")->execute();
		return $res;
	}
	//------------------------
	//ノートノードの情報を取得
	//------------------------
	public static function note_node_data_get($note_primary_id) {
		$note_node_data_res = DB::query("
			SELECT *
			FROM note_node
			WHERE primary_id = ".$note_primary_id."
		")->execute();
		return $note_node_data_res;
	}
	//------------------------
	//ステータスのカラーを取得
	//------------------------
	public static function status_color_get($status) {
		switch($status) {
			case '交渉中':
				$status_color = 'red';
			break;
			case '成約':
				$status_color = 'limegreen';
			break;
			case '破談':
				$status_color = 'grey';
			break;
			case '検討':
				$status_color = 'deepskyblue';
			break;
		}
		return $status_color;
	}





		











}