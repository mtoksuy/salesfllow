//
//
//
$.fn.closestOpposite = function(selector) {
  // 1階層下の子要素を取得
  var children = this.children();
  
  // 子要素がないときは探索終了
  if (children.length === 0) return $();
  
  // 現在の要素が探索するクラス名を持っていたとき
  if (this.filter(selector).length) {
    return this.filter(selector);
  }
  
  // それ以外のときはさらに下層を再帰的に探索
  return children.closestOpposite(selector);
};
//----------------
//読み込み後の処理
//----------------
$(function() {
	//----------------
	//フォルダ機能挙動
	//----------------
	$('.folder').on( {
		'click' : function(event) {
			var level_this_num = Number($(this).parent('ul').attr('level-data'));
			var parent_this    = $(this).parent('ul');
			var this_child_ul  = $(this).closestOpposite('ul');
			var this_li        = $(this);

			// 
			this_child_ul.each(function(i, elem) {
					// 開ける
					if(parent_this.attr('gate-data') != 'true') {
						parent_this.attr('gate-data', 'true');
						this_li.closestOpposite('a').find('img').attr('src', 'http://localhost/salesfllow/assets/img/common/function_alow_vertical_1.png');
						this_li.closestOpposite('a').find('img').attr('class', 'allow_open');
						$(this).css( {
							'max-height' : '300px',
						});
					}
						// 閉じる
						else {
							parent_this.attr('gate-data', 'false');
							this_li.closestOpposite('a').find('img').attr('src', 'http://localhost/salesfllow/assets/img/common/function_alow_side_1.png');
							this_li.closestOpposite('a').find('img').attr('class', 'allow');
							$(this).css( {
								'max-height' : '0px',
							});
						}
			});

			return false;
			// イベントをここで止める
			event.stopPropagation();
		}
	}, 'li');

}); // $(function() {




/*
			var level_this_num = Number($(this).attr('level-data'));
			var parent_this    = $(this);
			$(this).find('ul').each(function(i, elem) {
				if((level_this_num+1) == Number($(this).attr('level-data'))) {
			p( $(this) );
			p($(this).attr('level-data'));
			p($(this).find('ul').attr('level-data'));
					// 開ける
					if(parent_this.attr('gate-data') != 'true') {
						parent_this.attr('gate-data', 'true');
						$(this).css( {
							'max-height' : '100px',
						});
						$(this).find('a').each(function(i_i, elem_e) {
							if(i_i == 0) {

							}
						});
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

*/