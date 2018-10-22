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

			// 重要度のHTML生成
			if($value['importance']) {
				$importance_html = 
					'<div class="importance_box">
						<span class="lsf symbol box_font_color_'.$value['importance'].'">tag</span>
					</div>';
					$no_importance_style = '';
			}
				else {
					$no_importance_style = '';
					$importance_html     = '';
				}
			// ステータスのHTML生成
			if($value['status']) {
				if($value['importance']) {
					$no_importance_style = '';
				}
				else {
					$no_importance_style = ' style="top: 11px;"';
				}
				// ステータスのカラーを取得
				$status_color = Model_Sales_Basis::status_color_get($value['status']);
				$status_html = 
					'<div class="status_box"'.$no_importance_style.'>
						<span class="lsf symbol box_font_color_'.$status_color.'">●</span>
					</div>';
			}
				else {
					$status_html = '';
				}

			// 現在見ている案件であれば
			if((int)$value['primary_id'] == $sales_primary_id) {
				$li_html = $li_html.'<li class="now"><a href="'.HTTP.'sales/'.$value['url_id'].'/"><h1>'.$title.'</h1><p>'.$summary_contents.'</p>
										'.$importance_html.'
										'.$status_html.'
									</a></li>';
			}
				else {
					$li_html = $li_html.'<li><a href="'.HTTP.'sales/'.$value['url_id'].'/"><h1>'.$title.'</h1><p>'.$summary_contents.'</p>
						'.$importance_html.'
						'.$status_html.'
					</a></li>';
				}
		}
		// 合体
		$sales_list_html = 
		'<ul class="list">
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
			$sales_array['importance']      = $value['importance'];
			$sales_array['note']            = $value['note'];
			$sales_array['budget']          = $value['budget'];
			$sales_array['earnings']          = $value['earnings'];
//			$sales_array['proceed']         = $value['proceed'];
			$sales_array['deadline']        = $value['deadline'];
			$sales_array['create_time']     = $value['create_time'];
			$sales_array['update_time']     = $value['update_time'];
		}
		// ステータス
		if($sales_array['status']) {
			// ステータスのカラーを取得
			$status_color = Model_Sales_Basis::status_color_get($sales_array['status']);
			$fllow_circle_color = $status_color;
			$status_html = 
				'<div class="setting_box">
					<span class="setting_type">ステータス：</span><span class="setting_block box_color_'.$status_color.'">'.$sales_array['status'].'</span>
				</div>';
		}
		// アプローチ
		if($sales_array['approach']) {
			$approach_html = 
				'<div class="setting_box">
					<span class="setting_type">アプローチ：</span><span class="setting_block box_color_deepskyblue">'.$sales_array['approach'].'</span>
				</div>';
		}
		// アポイント
		if($sales_array['appointment']) {
			$appointment_html = 
				'<div class="setting_box">
					<span class="setting_type">アポイント：</span><span class="setting_block box_color_deepskyblue">'.$sales_array['appointment'].'</span>
				</div>';
		}
		// 予算
		if($sales_array['budget']) {
			$budget_html = 
				'<div class="setting_box">
					<span class="setting_type">予算：</span><span class="setting_block box_color_deepskyblue">'.$sales_array['budget'].'</span>
				</div>';
		}
		// 売上
		if($sales_array['earnings']) {
			$earnings_html = 
				'<div class="setting_box">
					<span class="setting_type">売上：</span><span class="setting_block box_color_deepskyblue">'.$sales_array['earnings'].'</span>
				</div>';
		}
		// 締切日
		if($sales_array['deadline']) {
			$deadline_html = 
				'<div class="setting_box">
					<span class="setting_type">締切日：</span><span class="setting_block box_color_deepskyblue">'.$sales_array['deadline'].'</span>
				</div>';
		}
		// クライアント
		if($sales_array['client']) {
			$client_html = 
				'<div class="setting_box">
					<span class="setting_type">クライアント：</span><span class="setting_block box_color_deepskyblue">'.$sales_array['client'].'</span>
				</div>';
		}
		// ノート
		if($sales_array['note']) {
			$note_node_data_res = Model_Sales_Basis::note_node_data_get((int)$sales_array['note']);
			foreach($note_node_data_res as $key => $value) {
				$note_name = $value['name'];
			}
			$note_html = 
				'<div class="setting_box">
					<span class="setting_type">ノート：</span><span class="setting_block box_color_deepskyblue">'.$note_name.'</span>
				</div>';
		}
		// 更新時間
		if($sales_array['update_time']) {
			$update_date = Model_Info_Basis::date_conversion_date_get($sales_array['update_time'], 'Y年m月d日');
			$update_time_html = 
				'<div class="setting_box">
					<span class="setting_type">更新時間：</span><span class="setting_block box_color_deepskyblue">'.$update_date.'</span>
				</div>';
		}

		$sales_header_html = 
			'<h1>'.$sales_array['title'].'</h1>
			<div class="sales_fllow_add" sales-url_id-data="'.$sales_array['url_id'].'">
				追加
			</div>';



		// salesの1番目をblock
		$sales_block_bottom_html = 
			'<div class="sales_block">
				<div class="fllow_circle" style="color: '.$fllow_circle_color.';">●</div>
				<div class="action_delete_box">
					<div class="lsf symbol">delete</div>
					<div class="hidden_area">案件削除</div>
				</div>
				<div class="action_edit_box">
					<div class="lsf symbol">edit</div>
					<div class="hidden_area">案件編集</div>
				</div>
					'.$status_html.'
					'.$approach_html.'
					'.$appointment_html.'
					'.$budget_html.'
					'.$earnings_html.'
					'.$deadline_html.'
					'.$client_html.'
					'.$note_html.'
					'.$update_time_html.'
				<pre class="text">'.$sales_array['text'].'</pre>
			</div>';

			// 
			$salse_html = 
			'<div class="sales">
				<div class="sales_inner">
					<div class="sales_box clearfix">
						'.$sales_header_html.'
						'.$sales_block_add_html.'
						'.$sales_block_bottom_html.'
					</div>
				</div>
			</div>';
		return $salse_html;

	}
	//--------------------------
	//セールスフォルダーHTML生成
	//--------------------------
	public static function sales_folder_html_create($note_node_res, $note_node_primary_id) {
		foreach($note_node_res as $level_array_key => $level_array_value) {
			if($note_node_primary_id == (int)$level_array_value['primary_id']) {
				$now_class = 'class="now" ';
			}
				else {
					$now_class = '';
				}
			// 1世代のli始まり
			$note_node_html = $note_node_html.'<li '.$now_class.'primary_id-data="'.$level_array_value['primary_id'].'" path-data="'.$level_array_value['path'].'"><a href="'.HTTP.'sales/note/'.$level_array_value['primary_id'].'">
<span class="lsf symbol folder_lsf_tabs">tabs</span>
'.$level_array_value['name'].'</a></li>
';
		} // foreach($note_node_res as $level_array_key => $level_array_value) {
		switch($note_node_primary_id) {
			case 'root':
				$now_root_class = 'class="now" ';
			break;
			case 'importance':
				$now_importance_class = 'class="now" ';
			break;
			case 'status':
				$now_status_class = 'class="now" ';
			break;
			case 'complete':
				$now_complete_class = 'class="now" ';
			break;
			case 'trash':
				$now_trash_class = 'class="now" ';
			break;
			default:
				$now_class = '';
		}
		$folder_html = 
			'<ul>
				<li '.$now_root_class.'>
					<a href="'.HTTP.'sales/">
			<span class="lsf symbol folder_lsf_note">memo</span>
						ノート
					</a>
				</li>
				<li '.$now_importance_class.'>
					<a href="'.HTTP.'sales/importance/">
			<span class="lsf symbol folder_lsf_tag">tag</span>
						重要度
					</a>
				</li>
				<li '.$now_status_class.'style="margin: 0 0 15px 0;">
					<a href="'.HTTP.'sales/status/">
			<span class="lsf symbol folder_lsf_tag">tag</span>
						ステータス
					</a>
				</li>

				'.$note_node_html.'

				<li  '.$now_complete_class.'style="margin: 8px 0 0 0;">
					<a href="'.HTTP.'sales/complete/">
			<span class="lsf symbol folder_lsf_complete">check</span>
						コンプリート
					</a>
				</li>
				<li '.$now_trash_class.'>
					<a href="'.HTTP.'sales/trash/">
			<span class="lsf symbol folder_lsf_trash">delete</span>
						ゴミ箱
					</a>
				</li>
			</ul>';
		return $folder_html;
	}









}