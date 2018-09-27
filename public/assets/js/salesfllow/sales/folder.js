//----------------
//読み込み後の処理
//----------------
$(function() {
	//----------------
	//フォルダ機能挙動
	//----------------
	$('.folder').on( {
		'click' : function(event) {
			p( $(this) );
			p($(this).attr('level-data'));
			p($(this).find('ul').attr('level-data'));
			var level_this_num = Number($(this).attr('level-data'));
			var parent_this    = $(this);
			$(this).find('ul').each(function(i, elem) {
				if((level_this_num+1) == Number($(this).attr('level-data'))) {
					// 開ける
					if(parent_this.attr('gate-data') != 'true') {
						parent_this.attr('gate-data', 'true');
						$(this).css( {
							'max-height' : '100px',
						});
						$(this).find('a').each(function(i_i, elem_e) {
							if(i_i == 0) {

//p(i_i);
/*
function_alow_vertical_1

現在変更をした瞬間に矢印の画像を変えるか
そもそも画像を使用せずにiconか
文字列で行うかを検証する


								$(this).css( {
									'content': 'url(http://localhost/salesfllow/assets/img/common/function_alow_vertical_3.png)',								
								});
*/


							}
						});

//	'content': 'url(http://localhost/salesfllow/assets/img/common/function_alow_vertical_1.png)',

/*
	vertical-align: middle;
	-webkit-transform: scale(0.6);
	transform: scale(0.6);
	display: inline-block;
	position: relative;
	top: -2px;
	width: 24px;
	height: 24px;
	overflow: hidden;
*/














					}
						// 閉じる
						else {
							parent_this.attr('gate-data', 'false');
							$(this).css( {
								'max-height' : '0px',
							});
						}			
				}
			});

			return false;
			// イベントをここで止める
			event.stopPropagation();
		}
	}, 'ul');

}); // $(function() {
