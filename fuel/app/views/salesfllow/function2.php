<!--
<div class="function">
	<div class="function_inner">
		<ul>
			<li class="<?php echo $content_data['dash_bord_now']; ?>"><a href="<?php echo HTTP; ?>">ダッシュボード</a></li>
			<li class="<?php echo $content_data['sales_now']; ?>"><a href="<?php echo HTTP; ?>sales/">案件</a></li>
			<li class="<?php echo $content_data['schedule_now']; ?>"><a href="<?php echo HTTP; ?>schedule/">スケジュール</a></li>
			<li class="<?php echo $content_data['client_now']; ?>"><a href="<?php echo HTTP; ?>client/">クライアント</a></li>
			<li class="<?php echo $content_data['analysis_now']; ?>"><a href="<?php echo HTTP; ?>analysis/">分析</a></li>
			<li class="<?php echo $content_data['card_now']; ?>"><a href="<?php echo HTTP; ?>card/">名刺</a></li>
			<li class="<?php echo $content_data['dailyreport_now']; ?>"><a href="<?php echo HTTP; ?>dailyreport">日報</a></li>
	</ul>	
	</div>
</div>
-->

<!--
#### ログイン後
* トップページがトップページ
* ユーザーページ xxx/
* 案件ページ xxx/sales/xxx/
* 会社ページ company/xxx/
* 部署ページ company/xxx/unit/xxx/
* スケジュールページ xxx/schedule/xxx/
* スケジュールページ company/xxx/schedule/xxx/
* スケジュールページ company/xxx/unit/xxx/schedule/xxx/
-->












<?php

$test_array = array();

$test_array[] = array(
	'primary_id' => 1,
//	'name'       => 'ノート',
//	'path'       => '.1.',
);
$test_array[] = array(
	'primary_id' => 2,
//	'name'       => '第2ノート',
//	'path'       => '.2.',
);

$test_array[0][] = array(
	'primary_id' => 3,
//	'name'       => 'ノートボヨヨーン',
//	'path'       => '.1.3.',
);
$test_array[0][] = array(
	'primary_id' => 4,
//	'name'       => 'ボヨヨーンです',
//	'path'       => '.1.4.',
);
$test_array[0][1][] = array(
	'primary_id' => 5,
//	'name'       => '第3ノート',
//	'path'       => '.1.4.5.',
);
$test_array[1][] = array(
	'primary_id' => 6,
//	'name'       => '第2ノート',
//	'path'       => '.2.6.',
);


$arr =
	[
	  ['primary_id' => 2, 'name' => 'ノート_2', 'path' => '.2.', 'level' => 1, 'parent' => null, 'child' => [3]],
	  ['primary_id' => 1, 'name' => 'ノート_1', 'path' => '.1.', 'level' => 1, 'parent' => null, 'child' => []],
	  ['primary_id' => 3, 'name' => 'ノート_1_1', 'path' => '.1.3.', 'level' => 2, 'parent' => 2, 'child' => [4]],
	  ['primary_id' => 4, 'name' => 'ノート_1_1_1', 'path' => '.1.3.4.', 'level' => 3, 'parent' => 3, 'child' => []],
	];


$arr =
	[
	  ['primary_id' => 1, 'name' => 'ノート_1', 'path' => '.1.', 'level' => 1, 'parent' => null, 'child' => [2,3]],
	  ['primary_id' => 2, 'name' => 'ノート_1_1', 'path' => '.1.2.', 'level' => 2, 'parent' => null, 'child' => []],
	  ['primary_id' => 3, 'name' => 'ノート_1_2', 'path' => '.1.3.', 'level' => 2, 'parent' => null, 'child' => []],
	  ['primary_id' => 4, 'name' => 'ノート_1', 'path' => '.4.', 'level' => 1, 'parent' => null, 'child' => []],
	];




//pre_var_dump($arr);
////////////
//検索の仕方
////////////
$array_search_key = array_search(3, array_column($arr, 'primary_id'));
//pre_var_dump($array_search_key);
//pre_var_dump($arr[$array_search_key]);
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
	$max_level   = 3;
	$start_level = 1;



	$start_level = 1;
	$generation_1_check = false;
	$generation_2_check = false;
	$generation_3_check = false;
	$generation_4_check = false;

	$generation_1_count = 1;
	$generation_2_count = 1;
	$generation_3_count = 1;
	$generation_4_count = 1;

//pre_var_dump($level_array_1);
	foreach($level_array_1 as $level_array_key => $level_array_value) {
		// 1世代のHTML記述
		// 最初の処理
    if ($level_array_value === reset($level_array_1)) {
			$note_node_html = '<ul>';
    }
		$note_node_html = $note_node_html.'<li primary_id-data="'.$level_array_value['primary_id'].'" path-data="'.$level_array_value['path'].'">'.$level_array_value['name'];
		// もし子供がいた場合(2世代検索)
		foreach($level_array_value['child'] as $level_array_value_child_key => $level_array_value_child_value) {
			// array検索
			$array_search_key = array_search((int)$level_array_value_child_value, array_column($arr, 'primary_id'));
			// 2世代のHTML記述
			$note_node_li = $note_node_li.'
<li primary_id-data="'.$arr[$array_search_key]['primary_id'].'" path-data="'.$arr[$array_search_key]['path'].'">'.$arr[$array_search_key]['name'];
//pre_var_dump($arr[$array_search_key]);

			// 2世代
			$note_node_li = $note_node_li.'</li>';
		} // 2
		// 1世代のli閉じる
		$note_node_html = $note_node_html.'</li>
';
		// 最後の処理
    if ($level_array_value === end($level_array_1)) {
			$note_node_html = $note_node_html.'</ul>';
    }
	}

var_dump($note_node_html);


























foreach($arr as $key_1 => $value_1) {
	for($max_level; $max_level > 0; $max_level--) {
			$array_search_key = array_search(1, array_column($arr, 'level'));
//			var_dump($array_search_key);
			// 第1層
  		$user_note_node_master_array[] = $user_note_node_array[$array_search_key];

//		var_dump($start_level);
		$start_level++;
	}
//	pre_var_dump($value_1);
}

//var_dump('<ul>'.$html_li.'</ul>');
?>


<div class="function_________">
	<div class="function_inner">
		<ul>
			<li class="<?php echo $content_data['dash_bord_now']; ?>"><a href="">ノート</a>
				<ul>
					<li><a href="">ノートボヨヨーン</a></li>
					<li><a href="">ボヨヨーンです</a>
						<ul>
							<li><a href="">第3ノート</a></li>
						</ul>
					</li>
				</ul>
			</li>
			<li class="<?php echo $content_data['sales_now']; ?>"><a href="">第2ノート</a>
				<ul>
					<li><a href="">第2ノートボヨヨーン</a></li>
				</ul>
			</li>
	</ul>	
	</div>
</div>



















