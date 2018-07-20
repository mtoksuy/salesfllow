
//----------------
//読み込み後の処理
//----------------
$(function() {
	//--------------------------
	//ドロップダウン表示・非表示
	//--------------------------
	var dropdown_check = false;
	$('.header_nav_list').on( {
		'click' : function() {
			if(dropdown_check == false) {
				$('.dropdown_header').css( {
					'display': 'block',
				});
				dropdown_check = true;
			}
				else {
					$('.dropdown_header').css( {
						'display': 'none',
					});
					dropdown_check = false;
				}
			return false;
		},
	}, '.user_icon');










}); // $(function() {
