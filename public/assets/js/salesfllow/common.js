
//----------------
//読み込み後の処理
//----------------
$(function() {
	//------------------
	//セールスサブミット
	//------------------
	$('html').on( {
		'click': function() {
			$('.sales_form').submit();
		}
	}, '.submit');
	//--------------------------
	//全体のポップアップ挙動操作
	//--------------------------
	$('html').on( {
		'click' : function(event) {
			///////////////////////////////
			// ユーザードロップダウン非表示
			///////////////////////////////
			if(dropdown_check == true) {
				$('.dropdown_header').css( {
					'display': 'none',
				});
				dropdown_check = false;
			}
			/////////////////////////////////
			//ステータスセッティングbox非表示
			/////////////////////////////////
			if($('.status_setting_box').attr('display-data') == 1) {	
				$('.status_setting_box').css( {
					'display': 'none',
				});
				$('.status_setting_box').attr('display-data', '0');
				// クラス追加
				$('.status').addClass('o_8');
				// イベントをここで止める
				event.stopPropagation();
			}
			/////////////////////////////////
			//アプローチセッティングbox非表示
			/////////////////////////////////
			if($('.approach_setting_box').attr('display-data') == 1) {	
				$('.approach_setting_box').css( {
					'display': 'none',
				});
				$('.approach_setting_box').attr('display-data', '0');
				// クラス追加
				$('.approach').addClass('o_8');
				// イベントをここで止める
				event.stopPropagation();
			}
			///////////////////////////////////
			//クライアントセッティングbox非表示
			///////////////////////////////////
			if($('.client_setting_box').attr('display-data') == 1) {	
				$('.client_setting_box').css( {
					'display': 'none',
				});
				$('.client_setting_box').attr('display-data', '0');
				// クラス追加
				$('.client').addClass('o_8');
				// 追加
				$('.client_setting_box').before('<div class="client_setting_block box_color_deepskyblue">'+$('#input_client').val()+'</div>');
				// 追加
				$('.client_hidden').attr('value', $('#input_client').val());
				// イベントをここで止める
				event.stopPropagation();
			}
			/////////////////////////////
			//重要度セッティングbox非表示
			/////////////////////////////
			if($('.importance_setting_box').attr('display-data') == 1) {	
				$('.importance_setting_box').css( {
					'display': 'none',
				});
				$('.importance_setting_box').attr('display-data', '0');
				// クラス追加
				$('.importance').addClass('o_8');
				// イベントをここで止める
				event.stopPropagation();
			}
			///////////////////////////
			//予算セッティングbox非表示
			///////////////////////////
			if($('.budget_setting_box').attr('display-data') == 1) {	
				$('.budget_setting_box').css( {
					'display': 'none',
				});
				$('.budget_setting_box').attr('display-data', '0');
				// クラス追加
				$('.budget').addClass('o_8');
				if($('#input_budget').val() > 1) {
					// 追加
					$('.budget_setting_box').before('<div class="budget_setting_block box_color_deepskyblue">'+$('#input_budget').val().replace(/(\d)(?=(\d\d\d)+$)/g, '$1,')+$('.money_type').attr('moneyType-data')+'</div>');
					// 追加
					$('.budget_hidden').attr('value', $('#input_budget').val());
				}
				// イベントをここで止める
				event.stopPropagation();
			}
			///////////////////////////
			//売上セッティングbox非表示
			///////////////////////////
			if($('.earnings_setting_box').attr('display-data') == 1) {	
				$('.earnings_setting_box').css( {
					'display': 'none',
				});
				$('.earnings_setting_box').attr('display-data', '0');
				// クラス追加
				$('.earnings').addClass('o_8');
				if($('#input_earnings').val() > 1) {
					// 追加
					$('.earnings_setting_box').before('<div class="earnings_setting_block box_color_deepskyblue">'+$('#input_earnings').val().replace(/(\d)(?=(\d\d\d)+$)/g, '$1,')+$('.money_type').attr('moneyType-data')+'</div>');
					// 追加
					$('.earnings_hidden').attr('value', $('#input_earnings').val());
				}
				// イベントをここで止める
				event.stopPropagation();
			}
			/////////////////////////////
			//ノートセッティングbox非表示
			/////////////////////////////
			if($('.note_setting_box').attr('display-data') == 1) {	
				$('.note_setting_box').css( {
					'display': 'none',
				});
				$('.note_setting_box').attr('display-data', '0');
				// クラス追加
				$('.note').addClass('o_8');
				// 追加
				$('.note_setting_box').before('<div class="note_setting_block box_color_deepskyblue">'+$('#input_note').val()+'</div>');
				// 追加
				$('.note_hidden').attr('value', $('#input_note').val());
				// イベントをここで止める
				event.stopPropagation();
			}







































		}
	}, 'body');
	//----------------------------------
	//ユーザードロップダウン表示・非表示
	//----------------------------------
	var dropdown_check = false;
	$('.header_nav_list').on( {
		'click' : function(event) {
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
			// イベントをここで止める
			return false;
		},
	}, '.user_icon');
	//------------------
	//全体のエンター挙動
	//------------------
	$('html').on( {
		'keydown': function(e) {
			if(e.keyCode === 13) {
				////////////
				//ステータス
				////////////
				if($('.status_setting_block').length) {
					$('.status_setting_box').css( {
						'display': 'none',
					});
					$('.status_setting_box').attr('display-data', '0');
					// クラス追加
					$('.status').addClass('o_8');
				}
				////////////
				//アプローチ
				////////////
				if($('.approach_setting_block').length) {
					$('.approach_setting_box').css( {
						'display': 'none',
					});
					$('.approach_setting_box').attr('display-data', '0');
					// クラス追加
					$('.approach').addClass('o_8');
				}
				////////
				//重要度
				////////
				if($('.importance_setting_block').length) {
					$('.importance_setting_box').css( {
						'display': 'none',
					});
					$('.importance_setting_box').attr('display-data', '0');
					// クラス追加
					$('.importance').addClass('o_8');
				}





			}
		}
	}, window);


	//
	//
	//
	

//変数storageにlocalStorageを格納
var storage = localStorage;
 


 
//  storage.clear();

/*​​
clear: function clear()
constructor: function ()
getItem: function getItem()
key: function key()
length: Getter
removeItem: function removeItem()
setItem: function setItem()

【サンプル付き】Local Storageとは？使い方を詳しく解説
​https://webliker.info/how-to-use-localstrage/
​*/
/*
	var k = 'k';
	var v = 'vbasghjkh';
	storage.setItem(k, v);
	storage.setItem('a', v);
	p(storage);
	p(storage.length);
*/


























}); // $(function() {
