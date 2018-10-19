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
				<li  '.$now_importance_class.'style="margin: 0 0 15px 0;">
					<a href="'.HTTP.'sales/importance/">
			<span class="lsf symbol folder_lsf_tag">tag</span>
						重要度
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